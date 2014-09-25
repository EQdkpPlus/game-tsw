<?php
 /*
 * Project:		EQdkp-Plus
 * License:		Creative Commons - Attribution-Noncommercial-Share Alike 3.0 Unported
 * Link:		http://creativecommons.org/licenses/by-nc-sa/3.0/
 * -----------------------------------------------------------------------
 * Began:		2010
 * Date:		$Date$
 * -----------------------------------------------------------------------
 * @author		$Author$
 * @copyright	2006-2011 EQdkp-Plus Developer Team
 * @link		http://eqdkp-plus.com
 * @package		eqdkp-plus
 * @version		$Rev$
 * 
 * $Id$
 */

include_once('itt_parser.aclass.php');

if(!class_exists('parseyourself')) {
	class parseyourself extends itt_parser {
		public static $shortcuts = array('pdl', 'puf' => 'urlfetcher', 'pfh' => array('file_handler', array('infotooltips')));

		public $supported_games = array('tsw');
		public $av_langs = array('en' => 'en_US', 'de' => 'de_DE');

		public $settings = array(
			'itt_icon_loc' => array(
				'type' => 'text',
				'default' => 'http://localhost/beta/games/tsw/infotooltip/items/images/'),
			'itt_icon_ext' => array(
				'type' => 'text',
				'default' => '.png'),
			'itt_default_icon' => array(
				'type' => 'text',
				'default' => '100000'),
			'itt_useitemlist' => array(
				'type' => 'checkbox',
				'options' => true,
				'size' => false,
				'value' => '1'),
			'itt_xml_url' => array(
				'type' => 'text',
				'default' => 'http://localhost/beta/'),
		);

		public $itemlist = array();
		public $recipelist = array();

		private $searched_langs = array();
		
		public function __destruct(){
			unset($this->itemlist);
			unset($this->recipelist);
			unset($this->searched_langs);
			parent::__construct($init, $config, $root_path, $cache, $puf, $pdl);
			$this->av_langs = ((isset($g_lang[$this->config['game']])) ? $g_lang[$this->config['game']] : '');
			
		}

		//initializes the item/recipelist. if it does not exists in the cache, get it from: http://www.aiondatabase.com/xml/en_US/items(recipes)/item(recipe)list.xml
		private function getItemlist($lang, $forceupdate=false, $type='item')
		{
			$this->{$type.'list'} = unserialize(file_get_contents($this->pfh->FilePath($this->config['game'].'_'.$lang.'_'.$type.'list.itt', 'itt_cache')));
			if(!$this->itemlist OR $forceupdate)
			{
				$urlitemlist = $this->puf->fetch($this->config['xml_url'].'/games/'.$this->config['game'].'/infotooltip/'.$type.'s/'.$lang.'/'.$type.'list.xml');
				$xml = simplexml_load_string($urlitemlist);
				foreach($xml->children() as $item) {
					$name = (string) $item['name'];
					$this->{$type.'list'}[(int)$item['id']][$lang] = $name;
			

				}
				$this->pfh->putContent($this->pfh->FilePath($this->config['game'].'_'.$lang.'_'.$type.'list.itt', 'itt_cache'), serialize($this->{$type.'list'}));
			}
			#print "<pre>";				//Check the filepath
			#print_r($xml_url);			//Check the filepath
			return true;
		}

		private function getItemIDfromItemlist($itemname, $lang, $forceupdate=false, $searchagain=0, $type='item'){
			$searchagain++;
			$this->getItemlist($lang,$forceupdate,$type);
			$item_id = array(0,0);

			//search in the itemlist for the name
			$loaded_item_langs = array();
			if($type == 'item') {
				foreach($this->itemlist as $itemID => $iteml){
					foreach($iteml as $slang => $name) {
						$loaded_item_langs[] = $slang;
						if($itemname == $name){
							$item_id[0] = $itemID;
							$item_id[1] = 'items';
							break 2;
						}
					}
				}
			}
			
			if(!$item_id[0] AND count($this->av_langs) > $searchagain) {
				$toload = array();
				foreach($this->av_langs as $c_lang => $langlong) {
					if(!in_array($c_lang,$loaded_item_langs)) {
						$toload[$c_lang][] = 'item';
					}
					#if(!in_array($c_lang,$loaded_recipe_langs)) {
					#	$toload[$c_lang][] = 'recipe';
					#}
				}
				foreach($toload as $lang => $load) {
					foreach($load as $type) {
						$item_id = $this->getItemIDfromItemlist($itemname, $lang, true, $searchagain, $type);
						if($item_id[0]) {
							break 2;
						}
					}
				}
			}
			return $item_id;
		}


		protected function searchItemID($itemname, $lang){
			if($this->config['useitemlist']) {
				return $this->getItemIDfromItemlist($itemname, $lang);
			} else {
				return $this->getItemIDfromItemlist($itemname, $lang); //Finde Itemlist, egal was ist
			}
		}

		protected function getItemData($item_id, $lang, $itemname='', $type='item'){
			settype($item_id, 'int');
			$item = array('id' => $item_id);
			if(!$item_id) return null;
			
			
			$item['link'] = $this->config['xml_url'].'games/'.$this->config['game'].'/infotooltip/'.$type.'/'.$lang.'/'.$item['id'].'.xml';
			$itemxml = $this->puf->fetch($item['link'], array('Cookie: cookieLangId="'.$lang.'";'));
			//get the xml: http://www.aiondatabase.com/xml/$lang_code/items/xmls/$itemid.xml

			#print "<pre>";				//Check the filepath
			#print_r($item);			//Check the filepath

			$itemxml = simplexml_load_file($item['link']);
		
			$item['name'] = (!is_numeric($itemname) AND strlen($itemname) > 0) ? $itemname : trim($itemxml->name);
			
			

			//filter baditems
			if(!isset($itemxml->tooltip) OR strlen($itemxml->tooltip) < 5) {
				$item['baditem'] = true;
			}

			//build itemhtml
			
			$html = str_replace('"', "'", $itemxml->tooltip);
		
			$template_html = trim(file_get_contents($this->root_path.'games/tsw/infotooltip/templates/tsw_popup.tpl'));
			$item['html'] = str_replace('{ITEM_HTML}', stripslashes($html), $template_html);
			$item['lang'] = $lang;
			$item['icon'] = (string)$itemxml->iconpath;
			$item['color'] = 'tsw_q'.$itemxml->quality;

			return $item;
		}
	}
}
?>