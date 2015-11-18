<?php
namespace T3WIZARD\T3wizard\Service;

/*
 *  The MIT License (MIT)
 *
 *  Copyright (c) 2015 Zsolt Molnar
 *
 *  Permission is hereby granted, free of charge, to any person obtaining a copy
 *  of this software and associated documentation files (the "Software"), to deal
 *  in the Software without restriction, including without limitation the rights
 *  to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 *  copies of the Software, and to permit persons to whom the Software is
 *  furnished to do so, subject to the following conditions:
 *
 *  The above copyright notice and this permission notice shall be included in
 *  all copies or substantial portions of the Software.
 *
 *  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 *  IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 *  FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 *  AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 *  LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 *  OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 *  THE SOFTWARE.
 */

use TYPO3\CMS\Core\Messaging\FlashMessage;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\VersionNumberUtility;

/**
 * @author Zsolt Molnar <molnar.zsolti@yahoo.com>
 */
class InstallService
{

    /**
     * @var string
     */
    protected $extKey = 't3wizard';

    /**
     * @var string
     */
    protected $messageQueueByIdentifier = '';

    /**
     * Initializes the install service
     */
    public function __construct()
    {
        if (VersionNumberUtility::convertVersionNumberToInteger(TYPO3_version) >= 7000000) {
            $this->messageQueueByIdentifier = 'extbase.flashmessages.tx_extensionmanager_tools_extensionmanagerextensionmanager';
        } else {
            $this->messageQueueByIdentifier = 'core.template.flashMessages';
        }
    }

    /**
     * @param string $extension
     */
    public function generateAdditionalConfiguration($extension = null)
    {
        if ($extension == $this->extKey) {
            $this->createConfigFile();
        }
    }

    /**
     * Creates AdditionalConfiguration.php file inside the typo3conf directory
     *
     * @return void
     */
    public function createConfigFile()
    {
        $configFile = GeneralUtility::getFileAbsFileName("typo3conf/AdditionalConfiguration.php");
        if (file_exists($configFile)) {
            /**
             * Add Flashmessage that there is already an AdditionalConfiguration.php file and we are not going to override this.
             */
            $flashMessage = GeneralUtility::makeInstance(
                'TYPO3\\CMS\\Core\\Messaging\\FlashMessage',
                'There is already an AdditionalConfiguration.php file in the typo3conf directory, please make sure that the settings are correct.'
                . 'An example configuration is located at: "typo3conf/ext/t3wizard/Configuration/PHP/AdditionalConfiguration.php"',
                'AdditionalConfiguration.php file already exists',
                FlashMessage::NOTICE,
                true
            );
            $this->addFlashMessage($flashMessage);
            return;
        }
        $fileContent = GeneralUtility::getUrl(ExtensionManagementUtility::extPath($this->extKey) . '/Configuration/PHP/AdditionalConfiguration.php');
        GeneralUtility::writeFile($configFile, $fileContent, true);

        /**
         * Add Flashmessage that the AdditionalConfiguration.php file was placed in the root directory
         */
        $flashMessage = GeneralUtility::makeInstance(
            'TYPO3\\CMS\\Core\\Messaging\\FlashMessage',
            'For optimal operation an AdditionalConfiguration.php was generated for the website.',
            'AdditionalConfiguration.php was placed in the typo3conf directory.',
            FlashMessage::OK,
            true
        );
        $this->addFlashMessage($flashMessage);
    }

    /**
     * Adds a Flash Message to the Flash Message Queue
     *
     * @param FlashMessage $flashMessage
     */
    public function addFlashMessage(FlashMessage $flashMessage)
    {
        if ($flashMessage) {
            /** @var $flashMessageService \TYPO3\CMS\Core\Messaging\FlashMessageService */
            $flashMessageService = GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Messaging\\FlashMessageService');
            /** @var $flashMessageQueue \TYPO3\CMS\Core\Messaging\FlashMessageQueue */
            $flashMessageQueue = $flashMessageService->getMessageQueueByIdentifier($this->messageQueueByIdentifier);
            $flashMessageQueue->enqueue($flashMessage);
        }
    }
}
