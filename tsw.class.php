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
		public $version				= '2.1.8';
		protected $this_game		= 'tsw';
		public $author				= "Inkraja";
		public $types				= array('races', 'classes', 'classes_big', 'events', 'roles');
		protected $classes			= array();
		protected $factions			= array();
		protected $filters			= array();
		public $langs				= array('english', 'german', 'french');

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
				'recruitment' => true,

			),
			
			array(
				'name'		=> 'class',
				'type'		=> 'classes',
				'admin'		=> false,
				'decorate'	=> true,
				'primary'	=> true,
				'roster'	=> false,
				'colorize'	=> true,
				'parent'	=> false,
				'recruitment' => false,
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
					'type'			=> 'multiselect',
					'category'		=> 'misc',
					'lang'			=> 'uc_pvp',
					'options'		=> array('Eldorado' => 'uc_ED','Stonehenge' => 'uc_SH','Shambala' => 'uc_ShB','Fusang Battlegroup A' => 'uc_BG_A', 'Fusang Battlegroup B' => 'uc_BG_B'),
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
				'level'	=> array(
					'type'			=> 'spinner',
					'category'		=> 'character',
					'lang'			=> 'uc_level',
					'max'			=> 100,
					'min'			=> 1,
					'undeletable'	=> true,
					'sort'			=> 4
				),
				'18h_Raid_cooldown'	=> array(
					'type'			=> 'radio',
					'category'		=> 'misc',
					'lang'			=> 'uc_18h_Raid_cooldown',
					'options'		=> array(0 => 'uc_no', 1 => 'uc_yes'),
					'undeletable'	=> true,
					'tolang'		=> true
				),
				'testlive'	=> array(
					'type'			=> 'radio',
					'category'		=> 'misc',
					'lang'			=> 'uc_testlive',
					'options'		=> array(0 => 'uc_no', 1 => 'uc_yes'),
					'undeletable'	=> true,
					'tolang'		=> true
				),
				'wings'	=> array(
					'type'			=> 'dropdown',
					'category'		=> 'character',
					'lang'			=> 'uc_wings',
					'image'			=> "games/tsw/icons/races/{VALUE}.png",
					'options'		=> array('nowings' => 'uc_nowings', 'blue' => 'uc_blue', 'gold' => 'uc_gold','purple' => 'uc_purple'),
					'undeletable'	=> true,
					'tolang'		=> true
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
		 *	Game Settings
		 *
		 */
		public function install($install=false){
			$this->game->resetEvents();
			$arrEventIDs = array();
			$arrEventIDs[] = $this->game->addEvent($this->glang('ny_raid'), 0, "86.png");
			$arrEventIDs[] = $this->game->addEvent($this->glang('eidolon'), 0, "87.png");
			$arrEventIDs[] = $this->game->addEvent($this->glang('flappy'), 0, "98.png");

			$intItempoolID = $this->game->addItempool("TSW", "TSW Itempool");

			$this->game->addMultiDKPPool("TSW", "TSW MultiDKPPool", $arrEventIDs, array($intItempoolID));

			//Links
			$this->game->addLink('TSW Forum', 'http://forums.thesecretworld.com/');
			$this->game->addLink('TSW TestServer Forum', 'https://forums-tl.thesecretworld.com/index.php');

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

			$this->game->removeLink("TSW Forum");
			$this->game->removeLink("TSW TestServer Forum");
		}
	/**
	 * Per game data for the calendar Tooltip
	*/
		public function calendar_membertooltip($memberid){
			return array(
				$this->game->glang('uc_wings').': '.$this->pdh->geth('member', 'profile_field', array($memberid, 'wings', true)),
				$this->game->glang('uc_18h_Raid_cooldown').': '.$this->pdh->geth('member', 'profile_field', array($memberid, '18h_Raid_cooldown', true)),					
				// Remove /**/ for active Tooltip 
			
				/*$this->game->glang('uc_pvp').': '.$this->pdh->geth('member', 'profile_field', array($memberid, 'pvp', true)),*/
			

			);
		}
		//Guildbank
		public function guildbank_money(){
		return $money_data = array(
		'PAX'		=> array(
			'icon'			=> array(
				'type'		=> 'image',
				'name'		=> 'pax.png',
			),
			'factor'		=> 1,
			'size'			=> 'unlimited',
			'language'		=> $this->user->lang(array('gb_currency', 'pax')),
			'short_lang'	=> $this->user->lang(array('gb_currency', 'pax_s')),
		)
		);}
		public function guildbank_itemrarity(){
			return array(
			  5 => $this->game->glang('Heroic'),
			  4 => $this->game->glang('Epic'),
			  3 => $this->game->glang('Rare'),
			  2 => $this->game->glang('Normal'),
			  1 => $this->game->glang('Other'));
		}
		public function guildbank_itemtype(){
			return array(
			1 => $this->game->glang('Signets'),			
			2 => $this->game->glang('Augments'),
			3 => $this->game->glang('Material'),
			4 => $this->game->glang('Clothes'),
			5 => $this->game->glang('Emotes'),
			6 => $this->game->glang('Event-Items'),
			7 => $this->game->glang('Token-Items'),
			8 => $this->game->glang('Others'));
			}
	}
}
?>
