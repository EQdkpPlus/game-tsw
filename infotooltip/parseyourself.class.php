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

include_once( 'itt_parser.aclass.php' );

if ( !class_exists( 'parseyourself' ) ) {
    /**
     * Class parseyourself
     */
    class parseyourself extends itt_parser {
        /**
         * @var array
         */
        public static $shortcuts = [
            'pdl',
            'puf'    => 'urlfetcher',
            'config' => 'configset',
            'pfh'    => [ 'file_handler', [ 'infotooltips' ] ]
        ];
        /**
         * @var array
         */
        public $supported_games = [ 'tsw' ];
        /**
         * @var array
         */
        public $av_langs = [ 'en' => 'en_US', 'de' => 'de_DE', 'fr' => 'fr_FR' ];
        /**
         * @var string
         */
        public $default_icon = '100000';
        /**
         * @var string
         */
        public $mygame = '';
        /**
         * @var array
         */
        public $settings = [ ];
        /**
         * @var array
         */
        public $itemlist = [ ];
        /**
         * @var array
         */
        public $recipelist = [ ];
        /**
         * @var array
         * @TODO needed?
         */
        //private $searched_langs = [ ];

        /**
         * Construct
         * Set mygame
         */
        public function __construct() {

            $this->mygame = registry::register( 'config' )->get( 'default_game' );
        }

        /**
         * @param bool $url
         *
         * @TODO where does $env come from!?
         * @return string
         */
        public function getDataFolder( $url = false ) {

            return ( $url ? $this->env->buildlink() : $this->root_path ) . 'games/' . $this->mygame . '/infotooltip/';
        }

        /**
         * @param        $lang
         * @param bool   $forceupdate
         * @param string $type
         *
         * @return bool
         */
        private function getItemlist( $lang, $forceupdate = false, $type = 'item' ) {

            if ( $this->itemlist && !$forceupdate ) {
                return true;
            }

            $typeListName = $type . 'list';

            /**
             * Set lang (or default-lang
             */
            $lang = ( isset( $this->av_langs[ $lang ] ) ? $this->av_langs[ $lang ] : 'en_US' );

            $fileName = $this->mygame . '_' . $lang . '_' . $type . 'list.itt';
            $cacheFileName = $this->pfh->FilePath( $fileName, 'itt_cache' );
            $this->$typeListName = unserialize( file_get_contents( $cacheFileName ) );

            $urlitemlist = $this->getDataFolder() . $type . 's/' . $lang . '/' . $type . 'list.xml';
            $xml = simplexml_load_file( $urlitemlist );
            $children = $xml->children();
            foreach ( $children AS $item ) {
                $quality = ( isset( $item[ 'quality' ] ) ? (int)$item[ 'quality' ] : 5 );
                $name = (string)$item[ 'name' ];
                $itemID = (int)$item[ 'id' ];

                $this->{$typeListName}[ "$itemID;$quality" ][ $lang ] = $name;
            }
            /**
             * Write back to cache
             */
            $this->pfh->putContent( $cacheFileName, serialize( $this->$typeListName ) );

            return true;
        }

        /**
         * @param        $itemname
         * @param        $lang
         * @param bool   $forceupdate
         * @param int    $searchagain
         * @param string $type
         *
         * @return array
         */
        private function getItemIDfromItemlist( $itemname, $lang, $forceupdate = false, $searchagain = 0, $type = 'item' ) {

            $searchagain++;
            $this->getItemlist( $lang, $forceupdate, $type );
            $itemID = [ 0, 0 ];

            //search in the itemlist for the name
            $loadedItemLangs = [ ];
            $quality = 5;
            if ( $type == 'item' ) {
                foreach ( $this->itemlist AS $itemIDQ => $iteml ) {

                    list( $itemIDV, $quality ) = explode( ";", $itemIDQ );

                    foreach ( $iteml AS $slang => $name ) {
                        if ( $itemname != $name ) {
                            continue;
                        }

                        $loadedItemLangs[ ] = $slang;

                        $itemID = [ $itemIDV, 'items' ];

                        break 2;
                    }
                }
            }
            if ( !$itemID[ 0 ] && count( $this->av_langs ) > $searchagain ) {
                $toload = [ ];
                foreach ( $this->av_langs AS $c_lang => $langlong ) {
                    if ( !in_array( $c_lang, $loadedItemLangs ) ) {
                        $toload[ $c_lang ][ ] = 'item';
                    }
                }
                foreach ( $toload AS $lang => $load ) {
                    foreach ( $load AS $type ) {
                        $itemID = $this->getItemIDfromItemlist( $itemname, $lang, true, $searchagain, $type );
                        if ( $itemID[ 0 ] ) {
                            break 2;
                        }
                    }
                }
            }
            if ( $itemID[0] ) {
                $itemID[ 0 ] .= ';' . $quality;
            }

            return $itemID;
        }

        /**
         * @param $itemname
         * @param $lang
         *
         * @return array
         */
        protected function searchItemID( $itemname, $lang ) {

            return $this->getItemIDfromItemlist( $itemname, $lang );
        }

        /**
         * @param        $itemIDQ
         * @param        $lang
         * @param string $itemname
         * @param string $type
         *
         * @return array
         */
        protected function getItemData( $itemIDQ, $lang, $itemname = '', $type = 'item' ) {

            list( $itemID, $wantedQuality ) = explode( ";", $itemIDQ );

            $origlang = $lang;
            settype( $item_id, 'int' );
            $item = [ 'id' => $itemID ];
            if ( !$itemID ) {
                $item[ 'baditem' ] = true;
                return $item;
            }

            $lang = ( isset( $this->av_langs[ $lang ] ) ? $this->av_langs[ $lang ] : 'en_US' );

            $item[ 'link' ] = $this->getDataFolder() . $type . '/' . $lang . '/' . $item[ 'id' ] . '.xml';
            if ( !file_exists( $item[ 'link' ] ) ) {
                $item[ 'baditem' ] = true;
                $this->pdl->log( 'infotooltip', 'File ' . $item[ 'link' ] . ' does not exist' );

                return $item;
            }

            $this->pdl->log( 'infotooltip', 'fetch item-data from: ' . $item[ 'link' ] );
            $itemxml = simplexml_load_file( $item[ 'link' ] );
            //filter baditems
            if ( !is_object( $itemxml ) || !isset( $itemxml->tooltip ) || strlen( $itemxml->tooltip ) < 5 ) {
                $this->pdl->log( 'infotooltip', 'no xml-object returned' );
                $item[ 'baditem' ] = true;

                return $item;
            }
            $item[ 'name' ] =
                ( !is_numeric( $itemname ) && strlen( $itemname ) > 0 ) ? $itemname : trim( $itemxml->name );

            //build itemhtml
            $tooltip = (string)$itemxml->tooltip;
            $tooltip = str_replace( ";QL_VALUE;", $wantedQuality, $tooltip );
            $tooltip = str_replace( '"', "'", $tooltip );
            $popUpTPLFileName = $this->root_path . 'games/tsw/infotooltip/templates/tsw_popup.tpl';
            $template_html = trim( file_get_contents( $popUpTPLFileName ) );
            $item[ 'params' ] = [
                'path' => $this->getDataFolder( true ) . 'items/images/',
                'ext'  => '.png',
            ];
            $item[ 'html' ] = str_replace( '{ITEM_HTML}', stripslashes( $tooltip ), $template_html );
            $item[ 'lang' ] = $origlang;
            $item[ 'icon' ] = (string)$itemxml->iconpath;
            $item[ 'color' ] = 'tsw_q' . (string)$wantedQuality;

            return $item;
        }
    }
}