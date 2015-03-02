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
$german_array = array(
	'classes' => array(
		0	=> 'Unbekannt',
		1	=> 'Tank',
		2	=> 'Heiler',
		3	=> 'DPS',
		4	=> 'Melee',
		5   => 'Leecher',
	),
	'races' => array(
		0	=> 'Unbekannt',
		1	=> 'Templer',
		2	=> 'Drachen',
		3	=> 'Illuminaten'
	),
	
	'roles' => array(
		1	=> 'Heiler',
		2	=> 'Tank',
		3	=> 'Damage Dealer',
		4	=> 'Add Controller',
		5	=> 'Podder',
		),
	'lang' => array(
		'tsw'							=> 'The Secret World',
		'uc_race'						=> 'Fraktion',
		'uc_class'						=> 'bevorzugte  Rolle',
		'uc_faction'					=> 'Fraktion',

		// Profile information
		'uc_cat_misc'				=> 'Sonstiges',
		'uc_pvp'					=> 'Fusang Battlegroup',
		'uc_pvp_help'				=> 'Battlegroup ist Servergebunden',
		'uc_RP'						=> 'Rollenspieler',
		'uc_RP_help'				=> '',
		'uc_yes'					=> 'Ja',
		'uc_no'						=> 'Nein',
		'uc_unknown'				=> 'unbekannt',
		'uc_BG'						=> 'Battelgroup',
		'uc_BG_A'					=> 'Battelgroup A',
		'uc_BG_B'					=> 'Battelgroup B',
		'uc_guild'					=> 'Gilde',
		'uc_level'					=> 'Ausrüstungswert',
		
		//Event
		'eidolon'					=> 'Eidolon',
		'ny_raid'					=> 'New York',
		'tokio'						=> 'Tokio',

		

		// Admin Settings
		'core_sett_fs_gamesettings'		=> 'The Secret World Einstellungen',

	),
);

?>