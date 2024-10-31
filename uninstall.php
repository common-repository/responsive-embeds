<?php
// Exit if accessed directly
if( ! defined('WP_UNINSTALL_PLUGIN') ) exit;
require_once( __DIR__ . '/pkm-responsive-embeds.php' );
ResponsiveEmbed::uninstall();
