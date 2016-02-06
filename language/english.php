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
$english_array =  array(
	'classes' => array(
		0	=> 'Unknown',
		1	=> 'Tank',
		2	=> 'Healer',
		3	=> 'DPS',
		4	=> 'Melee',
		5   => 'Leech',
	),
	'races' => array(
		0	=> 'Unknown',
		1	=> 'Templars',
		2	=> 'Dragons',
		3	=> 'Illuminati',
	),
	'roles' => array(
		1	=> 'Healer',
		2	=> 'Tank',
		3	=> 'Damage Dealer',
		4	=> 'Add Control',
		5	=> 'Podder',
		),
	'lang' => array(
		'tsw'						=> 'The Secret World',
		'uc_race'					=> 'Faction',
		'uc_class'					=> 'prefered Class',
		'uc_faction'				=> 'Faction',
		
		// Profile information
		'uc_cat_misc'				=> 'miscellaneous',
		'uc_pvp'					=> 'PVP Battleground',
		'uc_pvp_help'				=> 'Battlegroup is Serverbound',
		'uc_RP'						=> 'Roleplayer',
		'uc_RP_help'				=> '',
		'uc_yes'					=> 'Yes',
		'uc_no'						=> 'No',
		'uc_unknown'				=> 'unknown',
		'uc_ED'						=> 'Eldorado',
		'uc_SH'						=> 'Stonehenge',
		'uc_ShB'					=> 'Shambala',	
		'uc_BG'						=> 'Battlegroup',
		'uc_BG_A'					=> 'Fusang BG-A',
		'uc_BG_B'					=> 'Fusang BG-B',
		'uc_guild'					=> 'Cabal',
		'uc_level'					=> 'Effusionrating',
		'uc_testlive'				=> 'Access to Testlive',
		'uc_18h_Raid_cooldown'		=> '18h Raid Cooldown',
		'uc_wings'					=> 'Wing Colour',
		'uc_blue'					=> 'Blue',
		'uc_gold'					=> 'Golden',
		'uc_purple'					=> 'Purple',				
		'uc_nowings'				=> 'none',
		
		//Eventa
		'eidolon'					=> 'Eidolon',
		'ny_raid'					=> 'New York',
		'flappy'					=> 'Flappy',

		// Admin Settings
		'core_sett_fs_gamesettings'	=> 'The Secret World Settings',
		
		//Guildbank
		'Heroic' 					=> 'Heroic', 
		'Epic'						=> 'Epic', 
		'Rare'						=> 'Rare', 
		'Normal'					=> 'Uncommon', 
		'Other'						=> 'Common', 
		'Augments' 					=> 'Augment Resonator', 
		'Signets'					=> 'Signets', 
		'Event-Items'				=> 'Event-Items', 
		'Clothes'					=> 'Clothes', 
		'Emotes'					=> 'Emotes',
		'Token-Items'				=> 'Token-Items', 
		'Material'					=> 'Material', 
		'Others'					=> 'Others',
	),
);

?>