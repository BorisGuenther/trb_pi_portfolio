<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}


/*
 * PLUGIN
 */
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin($_EXTKEY, 'Portfolio', 'Portfolio');


/*
 * FLEXFORM
 */
$TCA['tt_content']['types']['list']['subtypes_excludelist']['trbpiportfolio_portfolio'] = 'layout,select_key,pages';
$TCA['tt_content']['types']['list']['subtypes_addlist']['trbpiportfolio_portfolio'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('trbpiportfolio_portfolio', 'FILE:EXT:'.$_EXTKEY.'/Configuration/FlexForms/portfolio.xml');


/*
 * TYPOSCRIPT
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'TRB PI Portfolio');


/*
 * TABLE: PORTFOLIO
*/
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_trbpiportfolio_domain_model_portfolio');
$GLOBALS['TCA']['tx_trbpiportfolio_domain_model_portfolio'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:trb_pi_portfolio/Resources/Private/Language/locallang_db.xlf:portfolio',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'title,description,datereleased,logo,images,category,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Portfolio.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/portfolio.gif'
	),
);
