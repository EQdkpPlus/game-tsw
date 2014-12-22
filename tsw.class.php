<?php
 /* Project: EQdkp-Plus
* Package: The Secret World game package
* Link: http://eqdkp-plus.eu
*
* Copyright (C) 2006-2015 EQdkp-Plus Developer Team
*
* This program is free software: you can redistribute it and/or modify
* it under the terms of the GNU Affero General Public License as published
* by the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU Affero General Public License for more details.
*
* You should have received a copy of the GNU Affero General Public License
* along with this program. If not, see <http://www.gnu.org/licenses/>.
*/

if ( !defined('EQDKP_INC') ){
	header('HTTP/1.0 404 Not Found');exit;
}

if(!class_exists('tsw')) {
	class tsw extends game_generic {
		protected static $apiLevel	= 20;
		public $version				= '1.10.1';
		protected $this_game		= 'tsw';
		public $author				= "Inkraja";
		public $types				= array('races', 'classes', 'classes_big', 'events', 'roles');
		protected $classes			= array();
		protected $factions			= array();
		protected $filters			= array();
		public $langs				= array('english', 'german');

		protected $class_dependencies = array(
			array(
				'name'		=> 'race',
				'type'		=> 'races',
				'admin' 	=> false,
				'decorate'	=> true,
				'roster' 	=> true,
				'parent'	=> false,
				'primary'	=> false,
				'colorize'	=> false,

			),
			
			array(
				'name'		=> 'class',
				'type'		=> 'classes',
				'admin'		=> false,
				'decorate'	=> true,
				'primary'	=> true,
				'roster'	=> false,
				'recruitment' => true,
				'colorize'	=> true,
				'parent'	=> false,
							
			),
			
		);
						
					
	
	public $default_roles = array(
			1 	=> array(0,1,2,3,4,5),			# healer
			2 	=> array(0,1,2,3,4,5),			# tank
			3 	=> array(0,1,2,3,4,5),			# DD
			4 	=> array(0,1,2,3,4,5),			# Add Controll
			5 	=> array(0,1,2,3,4,5),			# Podder
		);
		
	public function profilefields(){
			$xml_fields = array(
				'pvp'	=> array(
					'type'			=> 'dropdown',
					'category'		=> 'misc',
					'lang'			=> 'uc_pvp',
					'options'		=> array('unknown' => 'uc_unknown', 'Battlegroup A' => 'uc_BG_A', 'Battlegroup B' => 'uc_BG_B'),
					'undeletable'	=> true,
					'tolang'		=> true
				),
				'RP'	=> array(
					'type'			=> 'dropdown',
					'category'		=> 'misc',
					'lang'			=> 'uc_RP',
					'options'		=> array('unknown' => 'uc_unknown', 'No' => 'uc_no', 'Yes' => 'uc_yes'),
					'undeletable'	=> true,
					'tolang'		=> true
				),
				'guild'	=> array(
					'type'			=> 'text',
					'category'		=> 'character',
					'lang'			=> 'uc_guild',
					'size'			=> 25,
					'undeletable'	=> true,
					),
				
			);
			return $xml_fields;
		}
		protected $class_colors = array(
			1	=> '#32D6E5', 	# Tank
			2	=> '#5B933D',	# Healer
			3	=> '#800000',	# DD "maroon
			4	=> '#FF7F00', 	# Melee "orange"
			5	=> '#008080', 	# Leecher "teal"
		);
		protected $race_colors = array(
			1	=> '#dd0007',	# Dragons offical color
			2	=> '#5ca716',	# Templar offical color
			3	=> '#00a9fa', 	# Illuminati offical color
		);

		protected $glang		= array();
		protected $lang_file	= array();
		protected $path			= '';
		public $lang			= false;

		protected function load_filters($langs){
			if(!$this->classes) {
				$this->load_type('classes', $langs);
			}
			foreach($langs as $lang) {
				$names = $this->classes[$this->lang];
				$this->filters[$lang][] = array('name' => '-----------', 'value' => false);
				foreach($names as $id => $name) {
					$this->filters[$lang][] = array('name' => $name, 'value' => 'class:'.$id);
				}
			}
		}
		
		######################################################################
		##																	##
		##							EXTRA FUNCTIONS							##
		##																	##
		######################################################################
		
		/**
		 *	Content for the Chartooltip
		 *
		 */		
		public function chartooltip($intCharID){
			$template = $this->root_path.'games/'.$this->this_game.'/chartooltip/chartooltip.tpl';
			$content = file_get_contents($template);
			$charicon = $this->pdh->get('tsw', 'charicon', array($intCharID));
			if ($charicon == '') {
				$charicon = $this->server_path.'images/global/avatar-default.svg';
			}
			$charhtml = '<b>'.$this->pdh->get('member', 'html_name', array($intCharID)).'</b><br />';
			$guild = $this->pdh->get('member', 'profile_field', array($intCharID, 'guild'));
			if (strlen($guild)) $charhtml .= '<br />&laquo;'.$guild.'&raquo;';
			
			$charhtml .= '<br />'.$this->pdh->get('member', 'html_racename', array($intCharID));
			$charhtml .= ' '.$this->pdh->get('member', 'html_classname', array($intCharID));
			$charhtml .= '<br />'.$this->user->lang('level').' '.$this->pdh->get('member', 'level', array($intCharID));
			
			
			$content = str_replace('{CHAR_ICON}', $charicon, $content);
			$content = str_replace('{CHAR_HTML}', $charhtml, $content);
			
			return $content;
		}
		
		/**
		 *	Game Settings
		 *
		 */
		 
		public function install($install=false){
			$this->game->resetEvents();

			$arrEventIDs = array();
			$arrEventIDs[] = $this->game->addEvent($this->glang('ny_raid'), 0, "86.png");
			$arrEventIDs[] = $this->game->addEvent($this->glang('eidolon'), 0, "87.png");
			$arrEventIDs[] = $this->game->addEvent($this->glang('tokio'), 0, "93.png");

			$this->game->resetMultiDKPPools();
			$this->game->resetItempools();
			$intItempoolID = $this->game->addItempool("TSW", "TSW Itempool");

			$this->game->addMultiDKPPool("TSW", "TSW MultiDKPPool", $arrEventIDs, array($intItempoolID));
			
			//Links
			$this->game->addLink('Offcial Forum', 'http://forums.thesecretworld.com/');
			$this->game->addLink('TestServer Forum', 'https://forums-tl.thesecretworld.com/index.php');
			
			$this->game->resetRanks();
			//Ranks
			$this->game->addRank(0, "Guildmaster");
			$this->game->addRank(1, "Officer");
			$this->game->addRank(2, "Veteran");
			$this->game->addRank(3, "Member", true);
			$this->game->addRank(4, "Buddy" );
			$this->game->addRank(5, "Dummy Rank #1");
			
			

			
		}
		public function uninstall(){

			$this->game->removeLink("Offcial Forum");
			$this->game->removeLink("TestServer Forum");
			
		}	
	}
}
?>