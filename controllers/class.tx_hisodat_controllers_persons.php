<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2009 Torsten Schrade <schradt@uni-mainz.de>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*  A copy is found in the textfile GPL.txt and important notices to the license
*  from the author is found in LICENSE.txt distributed with these scripts.
*
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/
/**
 * This controller is responsible for managing everything concerned with tx_hisodat_persons
 *
 * @author Torsten Schrade <schradt@uni-mainz.de>
 * @package TYPO3
 * @subpackage hisodat
 */

require_once (t3lib_extMgm::extPath('div') . 'class.tx_div_ff.php');

class tx_hisodat_controllers_persons extends tx_lib_controller {

	var $defaultAction = 'default';

	/* Default action is to show all available persons in an alphabetic list with source signatures appended
	 * 
	 */
	public function defaultAction() {
		return $warning = '<p>Warnung tx_hisodat_controllers_persons: Der Aufruf erfolgte ohne Actionparameter!</p>';
	}

	/* Show a single person with all details
	 * 
	 */
	public function showPersonAction() {

		$modelClassName = tx_div::makeInstanceClassName('tx_hisodat_models_persons');
		$viewClassName = tx_div::makeInstanceClassName('tx_hisodat_views_persons');

		die('PERSON VIEW NOT YET READY');
	}

}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/hisodat/controllers/class.tx_hisodat_controllers_persons.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/hisodat/controllers/class.tx_hisodat_controllers_persons.php']);
}
?>