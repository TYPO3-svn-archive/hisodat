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
 * Depends on:
 *
 * @author Torsten Schrade <schradt@uni-mainz.de>
 * @package TYPO3
 * @subpackage hisodat
 */


class tx_hisodat_views_common extends tx_lib_smartyView {

	/* Creates a new smarty instance and sets the path to the templates
	 *
	 * @param	string	Path to the smarty templates
	 */
	public function initSmartyTemplate($templatePath) {
		// set the template path
		$this->setTemplatePath($templatePath);
		// make sure smarty extension is installed
        if(t3lib_extMgm::isLoaded('smarty')) {
            require_once(t3lib_extMgm::extPath('smarty').'class.tx_smarty.php');
	        $this->smarty = tx_smarty::newSmartyTemplate();
	        $this->assignDefaultData();
        } else {
        	die('smarty is not available');
        }
	}

	/* Assigns the following important data arrays for convenient access in the smarty template:
	 * cObj->data, parentRecord->data, controller->configurations, controller->parameters
	 *
	 */
	public function assignDefaultData() {
		$this->assignTemplateData('data', $this->controller->context->contentObject->data);
		$this->assignTemplateData('page', $this->controller->context->contentObject->parentRecord['data']);
		$this->assignTemplateData('configurations', $this->controller->configurations->getArrayCopy($this));
		$this->assignTemplateData('parameters', $this->controller->parameters->getArrayCopy($this));
	}

	/* Receives data and assigns it as a "toplevel" smarty variable.
	 * To use a selection is much more convenient than to reveive the whole $view (default behaviour).
	 * Working with multilevel objects in smarty templates is quite uncomfortable and this is made easier here.
	 *
	 * @param	string	The name under which the variable will be assigned for the template
	 * @param	mixed	The variable
	 */
	public function assignTemplateData($smartyVarName, $value) {
		$this->smarty->assign_by_ref($smartyVarName, $value);
	}

	/* Passes the template on to smarty for rendering
	 *
	 * @param	string	The template name
	 *
	 */
	public function renderTemplate($templateFile) {
        return $this->smarty->display($this->pathToTemplates . '/' . $templateFile);
	}

}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/hisodat/views/class.tx_hisodat_views_common.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/hisodat/views/class.tx_hisodat_views_common.php']);
}
?>
