<?php
namespace T3WIZARD\T3wizard\Hooks\Backend;

class PreHeaderRender {

    /**
     * @param array $params
     * @param \TYPO3\CMS\Backend\Template\DocumentTemplate $documentTemplate
     */
    public function addStyles(&$params, &$documentTemplate){
        $backendCssFile = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('t3wizard') . 'Resources/Public/Css/Backend/backend.css';
        $params['pageRenderer']->addCssFile($backendCssFile);
    }

}