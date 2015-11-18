<?php
namespace T3WIZARD\T3wizard\ViewHelpers;

class ExplodeViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

    /**
     * @param string $data
     * @param string $as
     * @param string $delimiter
     * @return string
     */
    public function render($data,$as = "items", $delimiter = LF) {
        if($data){            
            $items = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode($delimiter, $data);
            $this->templateVariableContainer->add($as, $items);        
            $content = $this->renderChildren();            
            $this->templateVariableContainer->remove($as); 
        }
        return $content;
    }

}