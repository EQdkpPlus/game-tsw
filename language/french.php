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
		0	=> 'Anyrole',
		1	=> 'Fist-healer',
		2	=> 'Blood-healer',
		3	=> 'Leech/Riffle Heal',
		4	=> 'Tank',
		5	=> 'Buff-Tank',
		6 	=> 'Heal-Tank',
		7 	=> 'Leech-Tank',
		8 	=> 'DA/BS-Buff',
		9 	=> 'Full-DPS',
		10 	=> 'SF-Buff',
		11 	=> 'Melee',
		12 	=> 'MeleeVul',		
		13 	=> 'RangedVul',		
		14 	=> 'MagicVul',			
		),
	'lang' => array(
		'tsw'							=> 'The Secret World',
		'uc_race'						=> 'Fraction',
		'uc_class'						=> 'Rôle préféré',
		'uc_faction'					=> 'Fraction',

		// Profile information
		'uc_cat_misc'				=> 'divers',
		'uc_pvp'					=> 'PVP champ de bataille',
		'uc_pvp_help'				=> 'Battlegroup Server est lié',
		'uc_RP'						=> 'joueurs de rôle',
		'uc_RP_help'				=> '',
		'uc_yes'					=> 'Oui',
		'uc_no'						=> 'Non',
		'uc_unknown'				=> 'inconnu',
		'uc_ED'						=> 'Eldorado',
		'uc_SH'						=> 'Stonehenge',
		'uc_ShB'					=> 'Shambala',	
		'uc_BG'						=> 'Battlegroup',
		'uc_BG_A'					=> 'Fusang BG-A',
		'uc_BG_B'					=> 'Fusang BG-B',
		'uc_guild'					=> 'guilde',
		'uc_level'					=> 'Score de l’équipement',
		'uc_testlive'				=> 'Accès à  Testlive',
		'uc_18h_Raid_cooldown'		=> '18h Raid Cooldown',
		'uc_wings'					=> 'Wing Couleur',
		'uc_blue'					=> 'Bleu',
		'uc_gold'					=> 'Doré',
		'uc_purple'					=> 'violet',				
		'uc_nowings'				=> 'aucun',
		
		//Event
		'eidolon_elite'					=> 'Eidolon Elite',
		'ny_raid_elite'					=> 'New York Elite',
		'flappy_nm'						=> 'Flappy NM',
		'eidolon_nm'					=> 'Eidolon NM',
		'nyr_nm'						=> 'New York NM',
		'flappy_elite'					=> 'Flappy Elite',
		
		// Admin Settings
		'core_sett_fs_gamesettings'		=> 'The Secret World paramètres',
		
		//Guildbank
		'Heroic' 					=> 'Héroique', 
		'Epic'						=> 'Épique', 
		'Rare'						=> 'Rare', 
		'Normal'					=> 'Singulier', 
		'Other'						=> 'Courant', 
		'Augments' 					=> 'Résonateur d\'augmentation', 
		'Signets'					=> 'Insigne', 
		'Event-Items'				=> 'Evénements-objets', 
		'Clothes'					=> 'Vêtements', 
		'Emotes'					=> 'Emotes',
		'Token-Items'				=> 'Jeton-objets', 
		'Material'					=> 'Matériel', 
		'Others'					=> 'Divers',
	),
);

?>