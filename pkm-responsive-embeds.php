<?php
/*
Plugin Name: Responsive Embeds
Description: Automatically make embedded <code>&lt;iframe&gt;</code> items responsive e.g. YouTube videos, Google Maps
Version: 1.0.0
Author: Philip K Meadows
Author URI: http://www.philmeadows.com
Copyright: Copyright (C) Philip K Meadows
License: GPLv3 or later
License URI: http://www.gnu.org/licenses/gpl-3.0-standalone.html

This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program; if not, write to the Free Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
*/

// Exit if accessed directly
if( ! defined( 'ABSPATH' ) ) exit;

if( ! class_exists( 'ResponsiveEmbed' ) )
{
	
	class ResponsiveEmbed
	{
		
		private static $instance = NULL;
		private $className;
		private $pluginName;
		private $textDomain;
		
		/**
		* Our constructor
		*/
		public function __construct()
		{
			
			$this->className = get_class();
			$this->pluginName = 'Responsive Embeds';
			$this->textDomain = 'pkmrmbd';
			
			// add our assets
			add_action( 'wp_enqueue_scripts', array( $this, 'loadAssets' ) );
			
			// add links below plugin description on Plugins Page table
			add_filter( 'plugin_row_meta', array( $this, 'pluginLinks' ), 10, 2 );
			
		} // END __construct()
		
		/**
		* add the assets
		*/
		public function loadAssets()
		{
			wp_enqueue_style( $this->textDomain . '-styles', plugins_url( 'styles.css' , __FILE__ ) );
			wp_enqueue_script( $this->textDomain . '-scripts', plugins_url( 'scripts.js' , __FILE__ ), array('jquery'), '20161023', TRUE);
		} // END loadAssets()
		
		/**
		* Add links below plugin description
		* @param array $links: The array having default links for the plugin
		* @param string $file: The name of the plugin file
		* 
		* @return array $links: The new links array
		*/
		public function pluginLinks( $links, $file )
		{
			if ( $file == plugin_basename( dirname( __FILE__ ) . '/pkm-responsive-embeds.php' ) )
			{
				$links[] = '<a href="http://philmeadows.com/say-thank-you/" target="_blank" title="Opens in new window">' . __( 'Say Thanks', $this->textDomain ) . '</a>';
			}
			return $links;
		}
		
		/**
		* Create or return instance of this class
		*/
		public static function instance()
		{
			$className = get_class();
			if( ! isset( self::$instance ) && ! ( self::$instance instanceof $className ) && ( self::$instance === NULL ) )
			{
				self::$instance = new $className;
			}
			return self::$instance;
		} // END instance()
		
		/**
		* Called on uninstall
		* @return void
		*/
		public static function uninstall()
		{
			$theClass = self::instance();
			
			// code to totally destroy data
			
		} // END uninstall()
		
	} // END class ResponsiveEmbed
	
	// fire her up!
	ResponsiveEmbed::instance();	
	
}