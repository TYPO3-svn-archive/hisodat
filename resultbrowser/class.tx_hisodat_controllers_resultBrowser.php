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
 * Creates resultbrowsers for HISODAT list- and singleview.
 *
 * @author Torsten Schrade <schradt@uni-mainz.de>
 * @package TYPO3
 * @subpackage hisodat
 */

class tx_hisodat_controllers_resultBrowser extends tx_lib_controller {

	var $defaultAction = 'buildListBrowser';

	/* HISODAT extends the lib/div result browser controller with its own controller. This to make it possible to influence the template output.
	 *
	 * @param 	string		$browserKey is the name under which the resultBrowser will be stored in the calling controller
	 * @param	string		$totalResultCountKey is the full number of results that was stored in the calling controllers register by its model
	 *
	 * @return	string		HTML snippet from the phpViewTemplate Engine of lib/div
	 */
	public function buildListBrowserAction($browserKey = 'browserKey', $totalResultCountKey = 'totalResultCountKey') {

		$modelClassName = tx_div::makeInstanceClassName('tx_lib_resultBrowser_model');
		$viewClassName = tx_div::makeInstanceClassName('tx_lib_resultBrowser_view');

		// check if the number of total results is smaller than the one given in resultsPerView; if yes no browser is returned since there is nothing to browse ;)
		$totalResultCount = $this->controller->configurations->get('totalResultCount');
		$resultsPerView = $this->controller->configurations->get('resultBrowser.resultsPerView');
		if (!$this->controller->configurations->get('resultBrowser.alwaysShowBrowser')) {
			if ($totalResultCount <= $resultsPerView) return;
		}

		// configuration of the result browser
		if (is_array($this->controller->configurations->get('resultBrowser.'))) {
			foreach ($this->controller->configurations->get('resultBrowser.') as $key => $value) {
				$this->controller->configurations->set($key, $value);
			}
		}

		// clean up the parameters array - only action and offset are needed for the result browser
		$parameterArray = $this->controller->parameters->getArrayCopy();
		foreach ($parameterArray as $key => $value) {
			if ($key != 'action' && $key != 'offset') unset($parameterArray[$key]);
		}
		$this->controller->parameters->exchangeArray($parameterArray);

		// instantiate model
		$model = new $modelClassName($this->controller);

		// instantiate view
		$view = new $viewClassName($model);
		$view->controller($this->controller);
		$view->set('browserKey', $browserKey);
		$view->setPathToTemplateDirectory($this->controller->configurations->get('resultBrowser.templateDirectory'));

		return $this->controller->configurations->set($browserKey, $view->render($this->controller->configurations->get('resultBrowser.templateFile')));
	}


	public function buildSingleBrowserAction($browserKey = 'browserKey') {

		$modelClassName = tx_div::makeInstanceClassName('tx_hisodat_models_resultBrowser');
		$viewClassName = tx_div::makeInstanceClassName('tx_hisodat_views_resultBrowser');

		// if there is only one row return without generating the browser
		$totalResultCount = $this->controller->configurations->get('totalResultCount');
		if ($totalResultCount < 2 && !$this->controller->configurations->get('resultBrowser.alwaysShowBrowser')) return;

		$model = new $modelClassName($this);
		$model->controller($this->controller);
		$model->set('searchResultList', $this->get('searchResultList'));
		$model->loadBrowser();

		$view = new $viewClassName($model);
		$view->controller($this->controller);
		$view->set('browserKey', $browserKey);
		$view->setPathToTemplateDirectory($this->controller->configurations->get('resultBrowser.templateDirectory'));

		return $this->controller->configurations->set($browserKey, $view->render($this->controller->configurations->get('resultBrowser.templateFile')));
	}
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/hisodat/resultbrowser/class.tx_hisodat_controllers_resultBrowser.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/hisodat/resultbrowser/class.tx_hisodat_controllers_resultBrowser.php']);
}
?>
