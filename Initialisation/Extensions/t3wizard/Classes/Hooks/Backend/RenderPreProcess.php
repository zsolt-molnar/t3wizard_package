<?php
namespace T3WIZARD\T3wizard\Hooks\Backend;

class RenderPreProcess {

    /**
     * @param array $params
     * @param \TYPO3\CMS\Backend\Controller\BackendController $backendController
     */
    public function addStyles(&$params, &$backendController){
        $backendCssFile = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('t3wizard') . 'Resources/Public/Css/Backend/backend.css';
        $backendController->addCssFile('t3wizard',$backendCssFile);
    }

}