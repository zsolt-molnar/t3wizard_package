<?php

class user_pageNotFound {

	function pageNotFound($param, $ref) {

		$this->redirectManualCsv($param);

		$this->redirectToErrorPage();

		$this->redirectIfBeSysfolder();

		header("HTTP/1.0 404 Not Found");
		exit();
	}

	private function redirectToErrorPage() {
		$static404 = '/typo3conf/ext/t3wizard/Resources/Public/HTML/404.html';

		$redirectPid = $this->getPidToRedirect();
		if ($redirectPid != '') {
			$redirectUrl = '/' . $redirectPid . '/';
		} else {
			$redirectUrl = $static404;
		}

		header("HTTP/1.0 404 Not Found");
		header('Location: http://' . $_SERVER['HTTP_HOST'] . $redirectUrl);

		exit();
	}

	private function getPidToRedirect() {
		$domainName = strip_tags(trim($_SERVER['SERVER_NAME']));

		// GET Root PID by searching for domain records
		$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('pid', 'sys_domain', 'domainName=\''.$domainName.'\'');

		if ($res) {
			$rootPage = array_pop($GLOBALS['TYPO3_DB']->sql_fetch_assoc($res));
		} else {
			$rootPage = 1;
		}

		// GET error page by searching for page title and root PID
		// @statistodo : remplacer la recherche basée sur le title par une recherche basé sur un champ "type de page"
		$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('uid,tx_realurl_pathsegment', 'pages', 'tx_realurl_pathsegment=\'404\' AND pid='.$rootPage);
		while ($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)) {
			return $row['tx_realurl_pathsegment'];
			break;
		}

		return 0;
	}

	protected function redirectManualCsv($param) {
		$redirectionsManualCsv = PATH_site . '/typo3conf/redirections.csv';
		if(file_exists($redirectionsManualCsv)) {
			$data  = sCsv::readFile($redirectionsManualCsv);
			$currentUrlHscDecoded = urldecode($param['currentUrl']);
			//var_dump($currentUrlHscDecoded);
			foreach ($data as $redirection) {
				$redirectionFrom = urldecode($redirection[0]);
				//var_dump($redirectionFrom);
				if($param['currentUrl'] == $redirectionFrom || $currentUrlHscDecoded == $redirectionFrom) {
					$redirectionTo = $redirection[1];
					if (substr($redirectionTo, 0, 4) == 'http') {
						$this->redirectUrl = $redirectionTo;
					} else {
						if($redirectionFrom != '/') {
							$redirectionTo = '/' . $redirectionTo;
						}
						$this->redirectUrl = 'http://' . $_SERVER['HTTP_HOST'] . $redirectionTo;
					}
					header('Location: ' . $this->redirectUrl);
					exit();
				}
			}
		}
	}

	protected function redirectIfBeSysfolder() {
	$pid = (integer)$_GET['id'];
		$bePreview = (integer)$_GET['ADMCMD_view'];
		if ( $pid && $bePreview ) {
			$query = 'select pages.doktype from pages where pages.doktype = 254 and pages.uid = ' . $pid;
			$res = $GLOBALS['TYPO3_DB']->sql_query($query);
			while($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)) {
				$redirectionUrl = 'http://' . $_SERVER['HTTP_HOST'] . '/typo3/db_list.php?&id=' . $pid;
				header('Location: ' . $redirectionUrl);
				exit();
			}
		}
	}
}
?>