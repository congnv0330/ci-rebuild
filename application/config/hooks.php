<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/user_guide/general/hooks.html
|
*/

/*
| Enable Multi Language
*/

$hook['post_controller_constructor'] = array(
	'class' => 'LanguageLoader',
	'function' => 'initialize',
	'filename' => 'LanguageLoader.php',
	'filepath' => 'hooks'
);

/*
| Enable Minify HTML using default codeigniter load view
*/

$hook['display_override'][] = array(
	'class' => '',
	'function' => 'compress',
	'filename' => 'Compress.php',
	'filepath' => 'hooks'
);
