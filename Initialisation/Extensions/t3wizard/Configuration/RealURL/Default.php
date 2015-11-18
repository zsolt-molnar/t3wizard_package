<?php

$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['realurl'] = array (
	'_DEFAULT' =>
	array(
        'init' => array (
            'enableCHashCache' => TRUE,
            'appendMissingSlash' => 'ifNotFile',
            'enableUrlDecodeCache' => TRUE,
            'enableUrlEncodeCache' => TRUE,
            'emptyUrlReturnValue' => \TYPO3\CMS\Core\Utility\GeneralUtility::getIndpEnv('TYPO3_SITE_URL'),
			//'postVarSet_failureMode'    => 'redirect_goodUpperDir'
        ),
        'pagePath' => array (
            'type' => 'user',
            'userFunc' => 'EXT:realurl/class.tx_realurl_advanced.php:&tx_realurl_advanced->main',
            'spaceCharacter' => '-',
            'languageGetVar' => 'L'
        ),
		'preVars' =>
		array(
			0 =>
			array(
				'GETvar' => 'L',
				'valueMap' =>
				array(
					'en' => '0'
				),
				'noMatch' => 'bypass',
			),
			1 =>
			array(
				'GETvar' => 'type',
				'valueMap' =>
				array(
				
				),
				'noMatch' => 'bypass',
			),
			array(
				'GETvar' => 'no_cache',
				'valueMap' => array(
					'nc' => 1,
				),
				'noMatch' => 'bypass',
			)
		),
		'postVarSets' => array(
			'_DEFAULT' => array (			
			)
		)
	)
);