<?php
/**
 * @author		
 * @copyright	
 * @license		
 */

defined("_JEXEC") or die("Restricted access");

// Include the syndicate functions only once
require_once __DIR__ . '/helper.php';
$items = ModProgramasHelper::getItems();
$item = ModProgramasHelper::getItem();

require JModuleHelper::getLayoutPath('mod_programas', $params->get('layout', 'default'));