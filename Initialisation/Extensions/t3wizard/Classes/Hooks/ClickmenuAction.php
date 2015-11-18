<?php
namespace T3WIZARD\T3wizard\Hooks;

use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Actions for the clickmenu items
 * 1) to clear page cache of a single page
 * 2) to clear page cache of a whole branch
 *
 * The TYPO3 pagetree implementation uses the noun "node" instead of "page".
 * I decided to follow this terminology.
 *
 */
class ClickmenuAction {

	/**
	 * Clear page cache action
	 *
	 * @param array $nodeData
	 * @return string Error message for the BE user
	 */
	public function clearPageCache($nodeData) {
			/* @var $node \TYPO3\CMS\Backend\Tree\Pagetree\PagetreeNode */
		$node = GeneralUtility::makeInstance('TYPO3\\CMS\\Backend\\Tree\\Pagetree\\PagetreeNode', (array) $nodeData);

			// Get uid of page
		$nodeUids = array(
			$node->getId()
		);

		// Clear the cache of the page
		$result = $this->performClearCache($nodeUids);

		return $result;
	}

	/**
	 * Clear branch cache action
	 *
	 * @param array $nodeData
	 * @return string Error message for the BE user
	 */
	public function clearBranchCache($nodeData) {
		$nodeLimit = ($GLOBALS['TYPO3_CONF_VARS']['BE']['pageTree']['preloadLimit']) ? $GLOBALS['TYPO3_CONF_VARS']['BE']['pageTree']['preloadLimit'] : 999;

			/* @var \TYPO3\CMS\Backend\Tree\Pagetree\PagetreeNode $node */
		$node = GeneralUtility::makeInstance('TYPO3\\CMS\\Backend\\Tree\\Pagetree\\PagetreeNode', (array) $nodeData);

			// Get uid of actual page
		$nodeUids = array(
			$node->getId()
		);

			// Get uids of subpages
			/* @var \TYPO3\CMS\Backend\Tree\Pagetree\DataProvider $dataProvider */
		$dataProvider = GeneralUtility::makeInstance('TYPO3\\CMS\\Backend\\Tree\\Pagetree\\DataProvider', $nodeLimit);
		$nodeCollection = $dataProvider->getNodes($node);
		$childNodeUids = $this->transformTreeStructureIntoFlatArray($nodeCollection);

			// Marge actual and child nodes
		$nodeUids = array_merge($nodeUids, $childNodeUids);

			// Clear the page cache of the nodes
		$result = $this->performClearCache($nodeUids);
        $this->clearLangCache($nodeData);
        $this->clearMediumCache($nodeData);
		return $result;
	}
	
	/**
	 * Clear language cache action
	 *
	 * @param array $nodeData
	 * @return string Error message for the BE user
	 */
	public function clearLangCache($nodeData) {
		$this->recursiveDeleteFiles(PATH_site .'typo3temp/Cache/Data/l10n/');
		return $this->clearPageCache($nodeData);
	}	
	
	private function recursiveDeleteFiles($directory) {
		foreach(glob("{$directory}/*") as $file) {
			if(is_dir($file)) { 
				$this->recursiveDeleteFiles($file);
			} else {
				if (file_exists($file)) {
					unlink($file);
				}
			}
		}
		if (file_exists($directory)) {
			rmdir($directory);
		}		
	}	
	
	/**
	 * Clear the localconf and ext_tables
	 *
	 * @param array $nodeData
	 * @return string Error message for the BE user
	 */
	public function clearMediumCache($nodeData) {
		$files = \TYPO3\CMS\Core\Utility\GeneralUtility::getAllFilesAndFoldersInPath(array(), PATH_site .'typo3temp/Cache/Code/cache_core/');
		//remove the needed files
		foreach ($files as $file) {
			if (preg_match(('/ext_localconf_|ext_tables_/'), $file)) {
				unlink($file);
			}
		}
		return $this->clearPageCache($nodeData);
	}	
	/**
	 * Clear the entire cache
	 *
	 * @param array $nodeData
	 * @return string Error message for the BE user
	 */
	public function clearFullCache($nodeData) {
		$this->recursiveDeleteFiles(PATH_site .'typo3temp/Cache/');
		return $this->clearPageCache($nodeData);
	}	

	/**
	 * Recursively transform the node collection from tree structure into a flat array
	 *
	 * @param \TYPO3\CMS\Backend\Tree\TreeNodeCollection $nodeCollection A tree of node
	 * @param integer $level Recursion counter, used internaly
	 * @return array Node uids of all child nodes
	 */
	protected function transformTreeStructureIntoFlatArray($nodeCollection, $level = 0) {
		if ($level > 99) {
			return array();
		}

		$nodeUids = array();
		/** @var \TYPO3\CMS\Backend\Tree\TreeNode $childNode */
		foreach ($nodeCollection as $childNode) {
			$nodeUids[] = $childNode->getId();
			if ($childNode->hasChildNodes()) {
				$nodeUids = array_merge($nodeUids, $this->transformTreeStructureIntoFlatArray($childNode->getChildNodes(), $level + 1));
			} else {
				$nodeUids[] = $childNode->getId();
			}
		}

		return $nodeUids;
	}

	/**
	 * Perform the cache clearing using tcemain
	 *
	 * @param array $nodeUids Node uids where the page cache has to be cleared
	 * @return boolean TRUE, if clearing of cache was successful
	 * @throws string $nodeUids Error message from TCEmain errorLog
	 */
	protected function performClearCache($nodeUids = array()) {
		if (empty($nodeUids)) {
			return TRUE;
		}

		/* @var $dataHandler \TYPO3\CMS\Core\DataHandling\DataHandler */
		$dataHandler = GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\DataHandling\\DataHandler');
		$dataHandler->stripslashes_values = 0;
		$dataHandler->start(array(), array());
		foreach ($nodeUids as $nodeUid) {
			$dataHandler->clear_cacheCmd($nodeUid);
		}

			// Check for errors
		if (count($dataHandler->errorLog)) {
			throw new \Exception(implode(chr(10), $dataHandler->errorLog));
		}

		return TRUE;
	}
}
