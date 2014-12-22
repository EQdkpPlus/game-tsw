<?php
 /*
 * Project:		EQdkp-Plus
 * License:		Creative Commons - Attribution-Noncommercial-Share Alike 3.0 Unported
 * Link:		http://creativecommons.org/licenses/by-nc-sa/3.0/
 * -----------------------------------------------------------------------
 * Began:		2012
 * Date:		$Date: 2014-09-09 20:10:01 +0200 (Tue, 09 Sep 2014) $
 * -----------------------------------------------------------------------
 * @author		$Author: wallenium $
 * @copyright	2006-2012 EQdkp-Plus Developer Team
 * @link		http://eqdkp-plus.com
 * @package		eqdkp-plus
 * @version		$Rev: 14574 $
 * 
 * $Id: german.php 14574 2014-09-09 18:10:01Z wallenium $
 */

if ( !defined('EQDKP_INC') ){
	header('HTTP/1.0 404 Not Found');exit;
}
$german_array = array(
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
		'uc_BG'						=> 'Battelgroup',
		'uc_BG_A'					=> 'Battelgroup A',
		'uc_BG_B'					=> 'Battelgroup B',
		'uc_guild'					=> 'guilde',
		
		//Event
		'eidolon'					=> 'Eidolon',
		'ny_raid'					=> 'New York',
		'tokio'						=> 'Tokio',

		

		// Admin Settings
		'core_sett_fs_gamesettings'		=> 'The Secret World paramètres',

	),
);

?>