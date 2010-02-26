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
 * This controller is responsible for showing detail views of records from
 * sources, persons, localities, entities, literature, archives
 *
 * @author Torsten Schrade <schradt@uni-mainz.de>
 * @package TYPO3
 * @subpackage hisodat
 */

require_once (t3lib_extMgm::extPath('div') . 'class.tx_div_ff.php');

class tx_hisodat_controllers_detailsView extends tx_lib_controller {

	var $defaultAction = 'defaultAction';

	/* Default action is to show all sources from the selected folders in a paginated singleview
	 * 
	 */
	public function defaultAction() {
		
		$modelClassName = tx_div::makeInstanceClassName('tx_hisodat_models_sources');
		$viewClassName = tx_div::makeInstanceClassName('tx_hisodat_views_detailsView');
		
		// instantiate and fetch the record
		$model = new $modelClassName($this);
		$result = $model->getByUid($this->parameters->get('uid'));
		
		// instantiate the view
		$view = new $viewClassName($this);
		$view->initSmartyTemplate($this->configurations->get('pathToTemplateDirectory'));
		$view->assignTemplateData('result', $result);
		
		// render
		return $view->renderTemplate($this->configurations->get('sources.templateFile'));
	}

	/* This action is executed if we are coming from a (search) result list
	 * 
	 */
	public function showSourceAction() {

		$modelClassName = tx_div::makeInstanceClassName('tx_hisodat_models_sources');
		$viewClassName = tx_div::makeInstanceClassName('tx_hisodat_views_detailsView');

		if (!$this->parameters->get('uid')) return $warning = 'Warnung: Es wurde keine UID zusammen mit dieser Action übergeben';

		// instantiate and fetch the record
		$model = new $modelClassName($this);
		$model->load();

		// get the full record of the current row
		$result = $model->getByUid($this->parameters->get('uid'));
		$result = $result->getHashArray();

		// this bit should be moved to an overiding action in tx_imh!!
		$tx_damlightbox_flex = t3lib_div::xml2array($result['tx_damlightbox_flex']);
		if ($setSpecificDimensions = tx_div_ff::get($tx_damlightbox_flex,'setSpecificDimensions','sLIGHTBOX')) {
			$GLOBALS['TSFE']->register['setSpecificDimensions'] = $setSpecificDimensions;
		}

		/* If this action happens in the context of a former search result list, the model will have loaded the former search result
		 * from the session. It's therefore possible to generate the singleview browser and to set the number for the current hit without
		 * doing any DB querys again. The only drawback to this is that if somebody is calling the page with uid and ation parameters and the
		 * uid happens to be in any leftover result list from the session, the condition will not take effect. This is a marginal problem.
		 * A second great benefit is that all source records are accessible by their uid + action via get without any errors. This action will
		 * mainly be called in the context of a searchresult list. A page with "stable" source views will use another controller.
		 */
		if ($model->getKeyFromList($this->parameters->get('uid')) != -1) {
			$this->configurations->set('currentKey', $model->getKeyFromList($this->parameters->get('uid'))+1);
			// model is passed on to singleview result browser
			$resultBrowser = $this->makeInstance('tx_hisodat_controllers_resultBrowser', $model);
			$resultBrowser->buildSingleBrowserAction('singleBrowser');
		}

		// instantiate the view
		$view = new $viewClassName($this);
		$view->initSmartyTemplate($this->configurations->get('pathToTemplateDirectory'));
		$view->assignTemplateData('result', $result);

		// render
		return $view->renderTemplate($this->configurations->get('sources.templateFile'));
	}

}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/hisodat/controllers/class.tx_hisodat_controllers_detailsView.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/hisodat/controllers/class.tx_hisodat_controllers_detailsView.php']);
}
?>