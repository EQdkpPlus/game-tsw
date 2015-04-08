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
$french_array = array(
	'classes' => array(
		0	=> 'inconnu',
		1	=> 'Tank',
		2	=> 'Healer',
		3	=> 'DPS',
		4	=> 'Corps à corps',
		5   => 'Leech',
	),
	'races' => array(
		0	=> 'inconnu',
		1	=> 'Templars',
		2	=> 'Dragons',
		3	=> 'Illuminati'
	),
	
	'roles' => array(
		1	=> 'Healer',
		2	=> 'Tank',
		3	=> 'Damage Dealer',
		4	=> 'Add Controller',
		5	=> 'Podder',
		),
	'lang' => array(
		'tsw'							=> 'The Secret World',
		'uc_race'						=> 'Fraction',
		'uc_class'						=> 'Rôle préféré',
		'uc_faction'					=> 'Fraction',

		// Profile information
		'uc_cat_misc'				=> 'divers',
		'uc_pvp'					=> 'Fusang Battlegroup',
		'uc_pvp_help'				=> 'Battlegroup Server est lié',
		'uc_RP'						=> 'joueurs de rôle',
		'uc_RP_help'				=> '',
		'uc_yes'					=> 'Oui',
		'uc_no'						=> 'Non',
		'uc_unknown'				=> 'inconnu',
		'uc_BG'						=> 'Battlegroup',
		'uc_BG_A'					=> 'Battlegroup A',
		'uc_BG_B'					=> 'Battlegroup B',
		'uc_guild'					=> 'guilde',
		'uc_level'					=> 'Score de l’équipement',
		
		//Event
		'eidolon'					=> 'Eidolon',
		'ny_raid'					=> 'New York',
		'tokio'						=> 'Tokio',

		

		// Admin Settings
		'core_sett_fs_gamesettings'		=> 'The Secret World paramètres',

	),
);

?>