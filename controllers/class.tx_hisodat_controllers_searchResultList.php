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
 * This controller is responsible for showing search results from
 * sources, persons, localities, entities, literature, archives as lists.
 *
 * @author Torsten Schrade <schradt@uni-mainz.de>
 * @package TYPO3
 * @subpackage hisodat
 */

class tx_hisodat_controllers_searchResultList extends tx_lib_controller {

	var $defaultAction = 'default';

	public function defaultAction() {
		
		// clean the session
		$this->storeToSession('searchResultList');
		
		// allow template override from FF
		if ($FFtemplateFile = $this->configurations->get('listTemplateFile')) {
			$templateFile = substr($FFtemplateFile, strrpos($FFtemplateFile, '/')+1);
			$this->configurations->set('defaultSearchResult.', array('templateFile' => $templateFile));
			$this->configurations->set('pathToTemplateDirectory', t3lib_div::dirname($FFtemplateFile).'/');
		}
		
		$view = $this->_prepareData();
		
		// render template
		return $view->renderTemplate($this->configurations->get('defaultSearchResult.templateFile'));
	}

	/* This action is called by the quicksearch form of the searchform controller and does a fulltext search.
	 *
	 */
	public function quickSearchAction() {
		$view = $this->_prepareData();
		return $view->renderTemplate($this->configurations->get('quickSearchResult.templateFile'));
	}

	/* This action is called by the standard search form of the searchform controller and does a fulltext search AND/OR a search
	 * by further parameters.
	 */
	public function standardSearchAction() {
		$view = $this->_prepareData();
		return $view->renderTemplate($this->configurations->get('standardSearchResult.templateFile'));
	}

	public function expertSearchAction() {
		die('Not yet implemented');
	}

	/* This action is not called directly but from the result browser of the details view to show the result list again.
	 * The result list will be loaded from the session by the model.
	 */
	public function showResultListAction() {
		$view = $this->_prepareData();
		return $view->renderTemplate($this->configurations->get('standardSearchResult.templateFile'));
	}

	/* Common function to load the model and prepare the view for all actions of this controller.
	 *
	 */
	private function _prepareData() {

		$modelClassName = tx_div::makeInstanceClassName('tx_hisodat_models_sources');
		$viewClassName = tx_div::makeInstanceClassName('tx_hisodat_views_searchResultList');

		// instantiate the model
		$model = new $modelClassName($this);
		$model->load();

#		debug($model);
#		die();

		//question: why do I have to call the action and not just "build" ??
		$resultBrowser = $this->makeInstance('tx_hisodat_controllers_resultBrowser', $model);
		$resultBrowser->buildListBrowserAction('listBrowser');

		// intantiate the view
		$view = new $viewClassName($this);
		$view->initSmartyTemplate($this->configurations->get('pathToTemplateDirectory'));
		$view->assignTemplateData('result', $model->get('searchResultList'));

		return $view;
	}

}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/hisodat/controllers/class.tx_hisodat_controllers_searchResultList.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/hisodat/controllers/class.tx_hisodat_controllers_searchResultList.php']);
}
?>