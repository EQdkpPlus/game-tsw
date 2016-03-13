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
		0	=> 'Anyrole',
		1	=> 'Faust-Heiler',
		2	=> 'Blut-Heiler',
		3	=> 'Leech/Sturmgewehr Heilung',
		4	=> 'Tank',
		5	=> 'Buff-Tank',
		6 	=> 'Heal-Tank',
		7 	=> 'Leech-Tank',
		8 	=> 'DA/BS-Buffer',
		9 	=> 'Full-DPS',
		10 	=> 'SF-Buffer',
		11 	=> 'Melee',			
		),
	
	'lang' => array(
		'tsw'							=> 'The Secret World',
		'uc_race'						=> 'Fraktion',
		'uc_class'						=> 'bevorzugte  Rolle',
		'uc_faction'					=> 'Fraktion',

		// Profile information
		'uc_cat_misc'				=> 'Sonstiges',
		'uc_pvp'					=> 'PVP Spielfeld',
		'uc_pvp_help'				=> 'Battlegroup ist Servergebunden',
		'uc_RP'						=> 'Rollenspieler',
		'uc_RP_help'				=> '',
		'uc_yes'					=> 'Ja',
		'uc_no'						=> 'Nein',
		'uc_unknown'				=> 'unbekannt',
		'uc_ED'						=> 'Eldorado',
		'uc_SH'						=> 'Stonehenge',
		'uc_ShB'					=> 'Shambala',		
		'uc_BG'						=> 'Battlegroup',
		'uc_BG_A'					=> 'Fusang BG-A',
		'uc_BG_B'					=> 'Fusang BG-B',
		'uc_guild'					=> 'Gilde',
		'uc_level'					=> 'Ausrüstungswert',
		'uc_testlive'				=> 'Zugang zu Testlive',
		'uc_wings'					=> 'Flügelfarbe',
		'uc_18h_Raid_cooldown'		=> '18h Raidcooldown',
		'uc_blue'					=> 'Blau',
		'uc_gold'					=> 'Golden',
		'uc_purple'					=> 'Purple',				
		'uc_nowings'				=> 'keine',
		
		//Event
		'eidolon'					=> 'Eidolon',
		'ny_raid'					=> 'New York',
		'flappy'					=> 'Flappy',
		
		// Admin Settings
		'core_sett_fs_gamesettings'		=> 'The Secret World Einstellungen',
		
		//Guildbank
		'Heroic' 					=> 'Heroisch', 
		'Epic'						=> 'Episch', 
		'Rare'						=> 'Selten', 
		'Normal'					=> 'Ungewöhnlich', 
		'Other'						=> 'Gewöhnlich', 
		'Augments' 					=> 'Augmentierungsresonator', 
		'Signets'					=> 'Siegel', 
		'Event-Items'				=> 'Event-Gegenstände', 
		'Clothes'					=> 'Kleidung', 
		'Emotes'					=> 'Gesten',
		'Token-Items'				=> 'Token-Gegenstände', 
		'Material'					=> 'Materialien', 
		'Others'					=> 'Sonstiges',
	),
);

?>