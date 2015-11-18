<?php

/***************************************************************
 * Extension Manager/Repository config file for ext: "t3wizard_package"
 *
 * Auto generated by Extension Builder 2015-11-02
 *
 * Manual updates:
 * Only the data in the array - anything else is removed by next write.
 * "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array(
	'title' => 'T3Wizard Package',
	'description' => 'This package delivers a fully configured TYPO3 website with page tree, pre-installed extensions and some useful configurations. Provides a bootstrap based frontend with additional content elements like slider,accordion,etc.',
	'category' => 'distribution',
	'author' => 'Zsolt Molnar',
	'author_email' => 'molnar.zsolti@yahoo.com',
	'state' => 'alpha',
	'internal' => '',
	'uploadfolder' => '0',
	'createDirs' => '',
	'clearCacheOnLoad' => 0,
	'version' => '0.0.1',
	'constraints' => array(
		'depends' => array(
			'typo3' 		=> '7.6.0-7.6.99',
			't3wizard' 		=> '0.1.1-1.0.0',
			'femanager' 	=> '1.5.2-1.99.99',
			'mask' 			=> '1.1.0 - 1.99.99',
			'news' 			=> '4.0.0-4.99.99',
			'realurl' 		=> '1.13.5-1.99.99',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
);