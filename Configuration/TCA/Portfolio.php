<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$GLOBALS['TCA']['tx_trbpiportfolio_domain_model_portfolio'] = array(
	'ctrl' => $GLOBALS['TCA']['tx_trbpiportfolio_domain_model_portfolio']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, description, url, datereleased, logo, images, category',
	),
	'types' => array(
		'1' => array('showitem' => '
				sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title, url, datereleased, description;;;richtext:rte_transform[mode=ts_links],
			--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.images, logo, images,
			--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime,
			--div--;LLL:EXT:lang/locallang_tca.xlf:sys_category.tabs.category, category
		'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(

		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_trbpiportfolio_domain_model_portfolio',
				'foreign_table_where' => 'AND tx_trbpiportfolio_domain_model_portfolio.pid=###CURRENT_PID### AND tx_trbpiportfolio_domain_model_portfolio.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),

		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),

		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),

		'title' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:trb_pi_portfolio/Resources/Private/Language/locallang_db.xlf:portfolio.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'url' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:trb_pi_portfolio/Resources/Private/Language/locallang_db.xlf:portfolio.url',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 256,
				'eval' => 'trim',
				'wizards' => array(
						'_PADDING' => 2,
						'link' => array(
								'type' => 'popup',
								'title' => 'LLL:EXT:cms/locallang_ttc.xml:header_link_formlabel',
								'icon' => 'link_popup.gif',
								'script' => 'browse_links.php?mode=wizard',
								'JSopenParams' => 'height=300,width=500,status=0,menubar=0,scrollbars=1',
						),
				),
				'softref' => 'typolink',
			),
		),






		'description' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:trb_pi_portfolio/Resources/Private/Language/locallang_db.xlf:portfolio.description',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim'
			)
		),
		'datereleased' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:trb_pi_portfolio/Resources/Private/Language/locallang_db.xlf:portfolio.datereleased',
			'config' => array(
				'dbType' => 'date',
				'type' => 'input',
				'size' => 7,
				'eval' => 'date',
				'checkbox' => 0,
				'default' => '0000-00-00'
			),
		),
		'logo' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:trb_pi_portfolio/Resources/Private/Language/locallang_db.xlf:portfolio.logo',
			'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
				'logo',
				array('maxitems' => 1, 'minitems' => 1),
				$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
			),
		),
		'images' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:trb_pi_portfolio/Resources/Private/Language/locallang_db.xlf:portfolio.images',
			'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
				'images',
				array('maxitems' => 10),
				$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
			),
		),
		'category' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:trb_pi_portfolio/Resources/Private/Language/locallang_db.xlf:portfolio.category',
			'config' => array(
				'type' => 'select',
				'renderMode' => 'tree',
				'treeConfig' => array(
					'parentField' => 'parent',
					'appearance' => array(
						'showHeader' => TRUE,
						'allowRecursiveMode' => TRUE,
						'expandAll' => TRUE,
						'maxLevels' => 99,
					),
				),
				'MM' => 'sys_category_record_mm',
				'MM_match_fields' => array(
					'fieldname' => 'category',
					'tablenames' => 'tx_trbpiportfolio_domain_model_portfolio',
				),
				'MM_opposite_field' => 'items',
				'foreign_table' => 'sys_category',
				'foreign_table_where' => ' AND (sys_category.sys_language_uid = 0 OR sys_category.l10n_parent = 0) ORDER BY sys_category.sorting',
				'size' => 10,
				'autoSizeMax' => 20,
				'minitems' => 0,
				'maxitems' => 20,
			)
		),
	),
);
