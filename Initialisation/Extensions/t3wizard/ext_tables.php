<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'T3Wizard');

/***************
 * BackendLayoutDataProvider
 */
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['BackendLayoutDataProvider'][$_EXTKEY] = 'T3WIZARD\T3wizard\Hooks\Options\BackendLayoutDataProvider';


/***************
 * DataHandler Hook
 */
//$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][$_EXTKEY] = 'T3WIZARD\T3wizard\Hooks\DataHandler';

/***************
 * Backend Styling
 */
if (TYPO3_MODE == 'BE' && \TYPO3\CMS\Core\Utility\VersionNumberUtility::convertVersionNumberToInteger(TYPO3_version) < 7000000) {
    $settings = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]);
    if(!isset($settings['Logo'])){
        $settings['Logo'] = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Images/Backend/toplogo.png';
    }
    if(!isset($settings['LoginLogo'])){
        $settings['LoginLogo'] = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Images/Backend/logo.png';
    }
    $GLOBALS['TBE_STYLES']['logo'] = $settings['Logo'];
    $GLOBALS['TBE_STYLES']['logo_login'] = $settings['LoginLogo'];
    $GLOBALS['TBE_STYLES']['htmlTemplates']['EXT:backend/Resources/Private/Templates/login.html'] = 'EXT:t3wizard/Resources/Private/Templates/Backend/Login.html';
    unset($settings);
	

		// register Ext.Direct provider
	$extPath = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('t3wizard');
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerExtDirectComponent(
		'TYPO3.T3wizard.ClickmenuAction',
		$extPath . 'Classes/Hooks/ClickmenuAction.php:T3WIZARD\\T3wizard\\Hooks\\ClickmenuAction'
	);

		// Include JS in backend 
	$GLOBALS['TYPO3_CONF_VARS']['typo3/backend.php']['additionalBackendItems'][] = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('t3wizard', 'Classes/Scripts/RegisterJavaScriptForPagetreeAction.php');

		// Add items of the context menu to the default userTS configuration
	$GLOBALS['TYPO3_CONF_VARS']['BE']['defaultUserTSconfig'] .= '
		options.contextMenu.table.pages.items {
			900 {
				1010 = DIVIDER

				1020 = ITEM
				1020 {
					name = clearPageCache
					label = LLL:EXT:t3wizard/Resources/Private/Language/CacheHook.xlf:clearPageCache
					spriteIcon = actions-system-cache-clear-impact-low
					callbackAction = clearPageCache
				}
			}
			1000 {
				410 = DIVIDER

				420 = ITEM
				420 {
					name = clearBranchCache
					label = LLL:EXT:t3wizard/Resources/Private/Language/CacheHook.xlf:clearBranchCache
					spriteIcon = actions-system-cache-clear-impact-low
					callbackAction = clearBranchCache
				}
				421 = ITEM
				421 {
					name = clearLangCache
					label = LLL:EXT:t3wizard/Resources/Private/Language/CacheHook.xlf:clearLangCache
					spriteIcon = actions-system-cache-clear-impact-low
					callbackAction = clearLangCache
				}
				422 = ITEM
				422 {
					name = clearMediumCache
					label = LLL:EXT:t3wizard/Resources/Private/Language/CacheHook.xlf:clearMediumCache
					spriteIcon = actions-system-cache-clear-impact-low
					callbackAction = clearMediumCache
				}					
			}
		}
	';	
}
