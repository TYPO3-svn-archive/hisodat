<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2005 Torsten Schrade (t.schrade@connecta.ag)
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
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/
/**
 * HOOK class for backend processing in TCEMAIN - not used yet
 *
 * @author	Torsten Schrade <t.schrade@connecta.ag>
 */



class tx_hisodat_t3lib_tcemain {

	function hook_processDatamap_afterDatabaseOperations(&$hookObjectsArr, &$status, &$table, &$id, &$fieldArray) {

	}

}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/hisodat/configuration/class.tx_hisodat_t3lib_tcemain.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/hisodat/configuration/class.tx_hisodat_t3lib_tcemain.php']);
}

?>