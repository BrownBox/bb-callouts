<?php
/*
Plugin Name: BB Callouts
Description: Add callout rows to your pages
Version: 0.0.3
Author: Brown Box
Author URI: http://brownbox.net.au
License: GPLv2
Copyright 2016 Brown Box
*/

define('BB_CALLOUTS_DIR', dirname(__FILE__).'/');
define('BB_CALLOUTS_JS_DIR', dirname(__FILE__).'/js/');
define('BB_CALLOUTS_CSS_DIR', dirname(__FILE__).'/css/');
define('BB_CALLOUTS_CLASS_DIR', dirname(__FILE__).'/classes/');
define('BB_CALLOUTS_TEMPLATE_DIR', dirname(__FILE__).'/templates/');
define('BB_CALLOUTS_NS', 'bb_callouts');
define('BB_CALLOUTS_FIELD_PREFIX', '_'.BB_CALLOUTS_NS.'_');

require_once(BB_CALLOUTS_DIR.'fx.php');
require_once(BB_CALLOUTS_DIR.'ia.php');
require_once(BB_CALLOUTS_DIR.'fields.php');
require_once(BB_CALLOUTS_DIR.'scripts.php');
// require_once(BB_CALLOUTS_DIR.'ia/cmb2.php');
