<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2008 Torsten Schrade <schradt@uni-mainz.de>
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
 * This controller is respnsible for showing all HISODAT related search forms
 *
 * @author Torsten Schrade <schradt@uni-mainz.de>
 * @package TYPO3
 * @subpackage hisodat
 */


class tx_hisodat_controllers_searchForms extends tx_lib_controller {

	var $defaultAction = 'default';

	/* Decides which search form to instantiate
	 *
	 */
	public function defaultAction() {

		// clear the session from any former search by storing an empty array
		$this->storeToSession('searchResultList');

		// set class names and instantiate
		$modelClassName = tx_div::makeInstanceClassName('tx_hisodat_models_searchForms');
		$model = new $modelClassName($this);

		$viewClassName = tx_div::makeInstanceClassName('tx_hisodat_views_searchForms');
		$view = new $viewClassName($this);

		// Set template path
		$view->initSmartyTemplate($this->configurations->get('pathToTemplateDirectory'));
		// Set target page of the form
		$view->assignTemplateData('destinationPid', $view->setFormDestination($this->configurations->get('destinationPid')));

		$searchType = $this->configurations->get('searchType');

		switch ($searchType) {
			
			case 'quickSearchForm':
				return $view->renderTemplate($this->configurations->get('quickSearchForm.templateFile'));
			break;
			
			case 'standardSearchForm':
				// assign data for display in the form
				$view->assignTemplateData('distinctPersons',$model->getDistinctPersons());
				
				return $view->renderTemplate($this->configurations->get('standardSearchForm.templateFile'));
			break;
			
			case 'expertSearchForm':
				return $view->renderTemplate($this->configurations->get('expertSearchForm.templateFile'));
			break;
			
			default:
				return $view->renderTemplate($this->configurations->get('quickSearchForm.templateFile'));
		}
	}

}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/hisodat/controllers/class.tx_hisodat_controllers_searchForms.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/hisodat/controllers/class.tx_hisodat_controllers_searchForms.php']);
}
?>