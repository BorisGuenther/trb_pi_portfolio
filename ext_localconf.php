<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}


/*
 * PLUGIN
*/
#\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin('TRB.'.$_EXTKEY, 'Portfolio', array('Portfolio' => 'list, slider, detail'), array('Portfolio' => 'list, slider, detail'));
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin('TRB.'.$_EXTKEY, 'Portfolio', array('Portfolio' => 'list, slider, detail'));
