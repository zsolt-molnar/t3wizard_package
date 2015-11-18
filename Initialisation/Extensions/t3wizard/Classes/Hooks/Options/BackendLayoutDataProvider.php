<?php
namespace T3WIZARD\T3wizard\Hooks\Options;

use \TYPO3\CMS\Backend\View\BackendLayout\BackendLayout;
use \TYPO3\CMS\Backend\View\BackendLayout\DataProviderContext;
use \TYPO3\CMS\Backend\View\BackendLayout\BackendLayoutCollection;
use \TYPO3\CMS\Backend\Utility\BackendUtility;

class BackendLayoutDataProvider implements \TYPO3\CMS\Backend\View\BackendLayout\DataProviderInterface {

    /**
     * Default Backend Layouts for T3Wizard
     * 
     * @var array
     */
    protected $backendLayouts = array(
       /* 'default' => array(
            'title' => 'LLL:EXT:t3wizard/Resources/Private/Language/Backend.xlf:backend_layout.default',
            'config' => '
                backend_layout {
                    colCount = 1
                    rowCount = 2
                    rows {
                        1 {
                            columns {
                                1 {
                                    name = LLL:EXT:t3wizard/Resources/Private/Language/Backend.xlf:backend_layout.default.slider
                                    colPos = 12
                                    colspan = 1
                                }
                            }
                        }						
                        2 {
                            columns {
                                1 {
                                    name = LLL:EXT:t3wizard/Resources/Private/Language/Backend.xlf:backend_layout.default.content
                                    colPos = 0
                                    colspan = 1
                                }								
                            }
                        }
                    }
                }
            ',
            'icon' => 'EXT:t3wizard/Resources/Public/Images/BackendLayouts/default.gif'
        ),
        'oneCol' => array(
            'title' => 'LLL:EXT:t3wizard/Resources/Private/Language/Backend.xlf:backend_layout.oneCol',
            'config' => '
                backend_layout {
                    colCount = 6
                    rowCount = 1
                    rows {
                        1 {
                            columns {
                                1 {
                                    name = LLL:EXT:cms/locallang_ttc.xlf:colPos.I.1
                                    colPos = 0
                                    colspan = 6
                                }
                            }
                        }
                    }
                }
            ',
            'icon' => 'EXT:t3wizard/Resources/Public/Images/BackendLayouts/oneCol.gif'
        ),
        'twoCol' => array(
            'title' => 'LLL:EXT:t3wizard/Resources/Private/Language/Backend.xlf:backend_layout.twoCol',
            'config' => '
                backend_layout {
                    colCount = 6
                    rowCount = 2
                    rows {
                        1 {
                            columns {
                                1 {
                                    name = LLL:EXT:t3wizard/Resources/Private/Language/Backend.xlf:backend_layout.column.topRow
                                    colPos = 12
                                    colspan = 6
                                }
                            }
                        }						
                        2 {
                            columns {
                                1 {
                                    name = LLL:EXT:t3wizard/Resources/Private/Language/Backend.xlf:backend_layout.column.col1
                                    colPos = 10
                                    colspan = 3
                                }
                                2 {
                                    name = LLL:EXT:t3wizard/Resources/Private/Language/Backend.xlf:backend_layout.column.col2
                                    colPos = 11
                                    colspan = 3
                                }								
                            }
                        }
                    }
                }
            ',
            'icon' => 'EXT:t3wizard/Resources/Public/Images/BackendLayouts/twoCol.gif'
        )*/			
    );

    /**
     * @param DataProviderContext $dataProviderContext
     * @param BackendLayoutCollection $backendLayoutCollection
     * @return void
     */
    public function addBackendLayouts(DataProviderContext $dataProviderContext, BackendLayoutCollection $backendLayoutCollection) {
        foreach ($this->backendLayouts as $key => $data) {
            $data['uid'] = $key;
            $backendLayout = $this->createBackendLayout($data);
            $backendLayoutCollection->add($backendLayout);
        }
    }

    /**
     * Gets a backend layout by (regular) identifier.
     *
     * @param string $identifier
     * @param integer $pageId
     * @return NULL|BackendLayout
     */
    public function getBackendLayout($identifier, $pageId){
        $backendLayout = NULL;
        if(array_key_exists($identifier,$this->backendLayouts)) {
            return $this->createBackendLayout($this->backendLayouts[$identifier]);
        }
        return $backendLayout;
    }

    /**
     * Creates a new backend layout using the given record data.
     *
     * @param array $data
     * @return BackendLayout
     */
    protected function createBackendLayout(array $data) {
        $backendLayout = BackendLayout::create($data['uid'], $data['title'], $data['config']);
        $backendLayout->setIconPath($this->getIconPath($data['icon']));
        $backendLayout->setData($data);
        return $backendLayout;
    }

    /**
     * Gets and sanitizes the icon path.
     *
     * @param string $icon Name of the icon file
     * @return string
     */
    protected function getIconPath($icon) {
        $iconPath = '';
        if (!empty($icon)) {
            $iconPath = $icon;
        }
        return $iconPath;
    }

}