<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}
	// Adds JavaScript and LLL for clickmenu to the BE
if (is_object($TYPO3backend)) {

	/** @var \TYPO3\CMS\Core\Page\PageRenderer $pageRenderer */
	$pageRenderer = $GLOBALS['TBE_TEMPLATE']->getPageRenderer();

	$jsPath = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('t3wizard') . 'Resources/Public/JavaScript/CacheHook/';
	$pageRenderer->addJsFile($jsPath . 'ClearCacheClickmenuActions.js');

	$langPath = 'LLL:EXT:t3wizard/Resources/Private/Language/CacheHook.xlf:';
	$pageRenderer->addInlineLanguageLabel(
		't3wizard_clearPageCacheSuccess',
		$GLOBALS['LANG']->sL($langPath . 'clearPageCacheSuccess', TRUE)
	);
	$pageRenderer->addInlineLanguageLabel(
		't3wizard_clearPageCacheError',
		$GLOBALS['LANG']->sL($langPath . 'clearPageCacheError', TRUE)
	);
	$pageRenderer->addInlineLanguageLabel(
		't3wizard_clearBranchCacheSuccess',
		$GLOBALS['LANG']->sL($langPath . 'clearBranchCacheSuccess', TRUE)
	);
	$pageRenderer->addInlineLanguageLabel(
		't3wizard_clearBranchCacheError',
		$GLOBALS['LANG']->sL($langPath . 'clearBranchCacheError', TRUE)
	);
	$pageRenderer->addInlineLanguageLabel(
		't3wizard_clearCacheError',
		$GLOBALS['LANG']->sL($langPath . 'clearCacheError', TRUE)
	);	
	$pageRenderer->addInlineLanguageLabel(
		't3wizard_clearCacheSuccess',
		$GLOBALS['LANG']->sL($langPath . 'clearCacheSuccess', TRUE)	
	);
}
