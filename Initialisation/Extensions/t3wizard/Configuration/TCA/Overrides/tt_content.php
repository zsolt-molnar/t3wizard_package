<?php
defined('TYPO3_MODE') or die();

$additionalColumns = [
	'css_class' => [
		'exclude' => true,
		'label' => 'LLL:EXT:t3wizard/Resources/Private/Language/locallang_db.xlf:css_class',
		'config' => [
			'type' => 'select',
			'renderType' => 'selectSingle',
			'items' => [
				['LLL:EXT:t3wizard/Resources/Private/Language/locallang_db.xlf:css_class.label.0', 0],
				['LLL:EXT:t3wizard/Resources/Private/Language/locallang_db.xlf:css_class.label.1', 1],
				['LLL:EXT:t3wizard/Resources/Private/Language/locallang_db.xlf:css_class.label.2', 2]
			],
			'default' => 0
		]
	],
];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', $additionalColumns);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('tt_content', 'css_class', '', 'after:layout');
//\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('tt_content', '--div--;Ascoma,css_class');