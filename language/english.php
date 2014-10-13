<?php
 /*
 * Project:		EQdkp-Plus
 * License:		Creative Commons - Attribution-Noncommercial-Share Alike 3.0 Unported
 * Link:		http://creativecommons.org/licenses/by-nc-sa/3.0/
 * -----------------------------------------------------------------------
 * Began:		2012
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
		4	=> 'Range',
		5	=> 'Podder',
	),
	'lang' => array(
		'tsw'						=> 'The Secret World',
		'uc_race'					=> 'Faction',
		'uc_class'					=> 'prefered Class',
		'uc_faction'				=> 'Faction',
		
		// Profile information
		'uc_pvp'					=> 'Fusang Battlegroup',
		'uc_pvp_help'				=> 'Battlegroup is Serverbound',
		'uc_RP'						=> 'Roleplayer',
		'uc_RP_help'				=> '',
		'uc_yes'					=> 'Yes',
		'uc_no'						=> 'No',
		'uc_unknown'				=> 'unknown',
		'uc_BG'						=> 'Battelgroup',
		'uc_BG_A'					=> 'Battelgroup A',
		'uc_BG_B'					=> 'Battelgroup B',
		'uc_guild'					=> 'Cabal',
		
		//Eventa
		'eidolon'					=> 'Eidolon',
		'ny_raid'					=> 'New York',
		'tokio'						=> 'Tokio',

		// Admin Settings
		'core_sett_fs_gamesettings'	=> 'The Secret World Settings',
		'uc_faction'				=> 'Faction',
		'uc_faction_help'			=> '',
	),
);

?>