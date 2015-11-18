<?php
namespace T3WIZARD\T3wizard\Xclass\Backend\View;

class LogoView extends \TYPO3\CMS\Backend\View\LogoView {
    
	/**
	 * renders the actual logo code
	 *
	 * @return string Logo html code snippet to use in the backend
	 */
	public function render() {

        if(!$GLOBALS['TBE_STYLES']['logo']) {  
            return parent::render();
        }

		// Overwrite with custom logo
		if ($GLOBALS['TBE_STYLES']['logo']) {
			$imgInfo = @getimagesize(\TYPO3\CMS\Core\Utility\GeneralUtility::resolveBackPath((PATH_typo3 . $GLOBALS['TBE_STYLES']['logo']), 3));
			$imgUrl = $GLOBALS['TBE_STYLES']['logo'];
		}

		// High-res?
		$width = $imgInfo[0];
		$height = $imgInfo[1];

		if (strpos($imgUrl, '@2x.')) {
			$width = $width/2;
			$height = $height/2;
		}

		$logoTag = '<img src="' . $imgUrl . '" width="' . $width . '" height="' . $height . '" title="'. $GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'] . '" alt="" />'
                 . '<span class="typo3-sitename">'. $GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'] . '</span>';       
		return '<a href="http://'.$GLOBALS['_SERVER']['HTTP_HOST'].'/" target="_blank">' . $logoTag . '</a>';
	}

}