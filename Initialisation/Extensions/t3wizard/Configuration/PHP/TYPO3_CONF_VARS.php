<?php

if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

// IP locking
$GLOBALS['TYPO3_CONF_VARS']['BE']['IPmaskList'] = '*';
$GLOBALS['TYPO3_CONF_VARS']['BE']['lockIP'] = 0;
$GLOBALS['TYPO3_CONF_VARS']['BE']['enabledBeUserIPLock'] = 0;

/**
 * Development environment
 * TYPO3_CONTEXT Development
 */
if(\TYPO3\CMS\Core\Utility\GeneralUtility::getApplicationContext()->isDevelopment()) {

	// dB config
	/*$GLOBALS['TYPO3_CONF_VARS']['DB']['host'] = '192.168.0.208';
	$GLOBALS['TYPO3_CONF_VARS']['DB']['database'] = 'hotspot';
	$GLOBALS['TYPO3_CONF_VARS']['DB']['username'] = 'user';
	$GLOBALS['TYPO3_CONF_VARS']['DB']['password'] = 'user';*/

	// Installtool password
	$GLOBALS['TYPO3_CONF_VARS']['BE']['installToolPassword'] = '$P$CTlGgFZKRYuykcIlRBjH1XAu/IJyQN0';

	// PHP errors
	$GLOBALS['TYPO3_CONF_VARS']['SYS']['displayErrors'] = 1;
	//$GLOBALS['TYPO3_CONF_VARS']['SYS']['devIPmask'] = ',192.168.83.*';
}

/**
 * Production environment
 * TYPO3_CONTEXT Production
 */
if(\TYPO3\CMS\Core\Utility\GeneralUtility::getApplicationContext()->isProduction()) {

	// dB config
	/*$GLOBALS['TYPO3_CONF_VARS']['DB']['host'] = '';
	$GLOBALS['TYPO3_CONF_VARS']['DB']['database'] = '';
	$GLOBALS['TYPO3_CONF_VARS']['DB']['username'] = '';
	$GLOBALS['TYPO3_CONF_VARS']['DB']['password'] = '';*/

	// Installtool password
	$GLOBALS['TYPO3_CONF_VARS']['BE']['installToolPassword'] = '$P$CTlGgFZKRYuykcIlRBjH1XAu/IJyQN0';
}

// Name of the base-site. This title shows up in the root of the tree structure if you're an 'admin' backend user.
$GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'] = 'T3Wizard';

// String: This default email address is used when no other "from" address is set for a TYPO3-generated email. You can specify an email address only (ex. info@example.org).
$GLOBALS['TYPO3_CONF_VARS']['MAIL']['defaultMailFromAddress'] = 'noreply@T3Wizard.com';

// String: This default name is used when no other "from" name is set for a TYPO3-generated email.
$GLOBALS['TYPO3_CONF_VARS']['MAIL']['defaultMailFromName'] = 'T3Wizard';

// Comma-list of fields from the 'pages'-table. These fields are added to the select query for fields in the rootline.
//$GLOBALS['TYPO3_CONF_VARS']['FE']['addRootLineFields'] = ',nav_title,description';

// Integer (-1, 0, 1, 2)
// -1 : total shutdown for maintenance purposes
// 0 : normal operation, everyone can login (default)
// 1 : only admins can login
// 2 : only admins and regular CLI users can login
$GLOBALS['TYPO3_CONF_VARS']['BE']['adminOnly'] = 0;

// How TYPO3 should handle requests for non-existing/accessible pages.
// empty (default) : The next visible page upwards in the page tree is shown.
// 'true' or '1' : An error message is shown.
// String : Static HTML file to show (reads content and outputs with correct headers), e.g. 'notfound.html' or 'http://www.example.org/errors/notfound.html'.
// Prefix "REDIRECT:" : If prefixed with "REDIRECT:" it will redirect to the URL/script after the prefix.
// Prefix "READFILE:" : If prefixed with "READFILE" then it will expect the remaining string to be a HTML file which will be read and outputted directly after having the marker "###CURRENT_URL###" substituted with REQUEST_URI and ###REASON### with reason text, for example: "READFILE:fileadmin/notfound.html".
// Prefix "USER_FUNCTION:" : If prefixed with "USER_FUNCTION:" a user function is called, e.g. "USER_FUNCTION:fileadmin/class.user_notfound.php:user_notFound->pageNotFound" where the file must contain a class "user_notFound" with a method "pageNotFound" inside with two parameters $param and $ref.
// Install RealUrl before activating this user function
$GLOBALS['TYPO3_CONF_VARS']['FE']['pageNotFound_handling'] = 'USER_FUNCTION:typo3conf/ext/t3wizard/Classes/UserFunction/class.user_pageNotFoundHandling.php:user_pageNotFound->pageNotFound';

//preconfigure Mask
$GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['mask'] = 'a:4:{s:4:"json";s:76:"typo3conf/ext/t3wizard/Resources/Private/Templates/Extensions/Mask/mask.json";s:7:"content";s:75:"typo3conf/ext/t3wizard/Resources/Private/Templates/Extensions/Mask/Content/";s:7:"preview";s:64:"typo3conf/ext/t3wizard/Resources/Public/Extensions/Mask/Preview/";s:7:"backend";s:75:"typo3conf/ext/t3wizard/Resources/Private/Templates/Extensions/Mask/Backend/";}';