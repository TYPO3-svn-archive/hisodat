<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2007 Torsten Schrade <schradt@uni-mainz.de>
*  All rights reserved
*
*  This script is part of the Typo3 project. The Typo3 project is
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
 * This function displays a selector with nested groups. The original code is
 * borrowed from the extension "Digital Asset Management" (tx_dam) author: René
 * Fritz <r.fritz@colorcube.de>
 *
 * @author	Torsten Schrade <schradt@uni-mainz.de>
 */

require_once(PATH_t3lib.'class.t3lib_treeview.php');

/**
 * extend class t3lib_treeview to change function wrapTitle().
 *
 */
class tx_hisodat_tceFunc_selectTreeView extends t3lib_treeview {

	var $TCEforms_itemFormElName = '';
	var $TCEforms_nonSelectableItemsArray = array();

	/**
	 * wraps the record titles in the tree with links or not depending on if
	 * they are in the TCEforms_nonSelectableItemsArray.
	 *
	 * @param	string		$title: the title
	 * @param	array		$v: an array with uid and title of the current item.
	 * @return	string		the wrapped title
	 */
	function wrapTitle($title, $v)	{
		if($v['uid']>0) {
			if (in_array($v['uid'], $this->TCEforms_nonSelectableItemsArray)) {
				return '<a href="#" title="'.$v['description'].'"><span style="color:#999;cursor:default;">'.$title.'</span></a>';
			} else {
				$hrefTitle = $v['description'];
				$aOnClick = 'setFormValueFromBrowseWin(\''.$this->TCEforms_itemFormElName.'\','.$v['uid'].',\''.$title.'\'); return false;';
				return '<a href="#" onclick="'.htmlspecialchars($aOnClick).'" title="'.htmlentities($v['description']).'">'.$title.'</a>';
			}
		} else {
			return $title;
		}
	}

}

/**
 * this class displays a tree selector with nested address groups.
 */
class tx_hisodat_treeview {

	/**
	 * Generation of TCEform elements of the type "select"
	 * This will render a selector box element, or possibly a special
	 * construction with two selector boxes. That depends on configuration.
	 *
	 * @param	array		$PA: the parameter array for the current field
	 * @param	object		$fobj: Reference to the parent object
	 * @return	string		the HTML code for the field
	 */
	function displayCategoryTree($PA, $fobj) {

		$table = $PA['table'];
		$field = $PA['field'];
		$row   = $PA['row'];

		$this->pObj = &$PA['pObj'];

			// Field configuration from TCA:
		$config = $PA['fieldConf']['config'];
			// it seems TCE has a bug and do not work correctly with '1'
		$config['maxitems'] = ($config['maxitems']==2) ? 1 : $config['maxitems'];

			// Getting the selector box items from the system
		$selItems = $this->pObj->addSelectOptionsToItemArray($this->pObj->initItemArray($PA['fieldConf']),$PA['fieldConf'],$this->pObj->setTSconfig($table,$row),$field);
		$selItems = $this->pObj->addItems($selItems,$PA['fieldTSConfig']['addItems.']);
		#if ($config['itemsProcFunc']) $selItems = $this->pObj->procItems($selItems,$PA['fieldTSConfig']['itemsProcFunc.'],$config,$table,$row,$field);

			// Possibly remove some items:
		$removeItems=t3lib_div::trimExplode(',',$PA['fieldTSConfig']['removeItems'],1);

		foreach($selItems as $tk => $p)	{
			if (in_array($p[1],$removeItems))	{
				unset($selItems[$tk]);
			} else if (isset($PA['fieldTSConfig']['altLabels.'][$p[1]])) {
				$selItems[$tk][0]=$this->pObj->sL($PA['fieldTSConfig']['altLabels.'][$p[1]]);
			}

				// Removing doktypes with no access:
			if ($table.'.'.$field == 'pages.doktype')	{
				if (!($GLOBALS['BE_USER']->isAdmin() || t3lib_div::inList($GLOBALS['BE_USER']->groupData['pagetypes_select'],$p[1])))	{
					unset($selItems[$tk]);
				}
			}
		}

			// Creating the label for the "No Matching Value" entry.
		$nMV_label = isset($PA['fieldTSConfig']['noMatchingValue_label']) ? $this->pObj->sL($PA['fieldTSConfig']['noMatchingValue_label']) : '[ '.$this->pObj->getLL('l_noMatchingValue').' ]';
		$nMV_label = @sprintf($nMV_label, $PA['itemFormElValue']);


			// Prepare some values:
		$maxitems = intval($config['maxitems']);
		$minitems = intval($config['minitems']);
		$size = intval($config['size']);
			// If a SINGLE selector box...
		if ($maxitems<=1 && !$config['treeView'])	{

		} else {

			if ($row['sys_language_uid'] && $row['l18n_parent'] ) {
/*
				// the current record is a translation of another record
				$errorMsg = array();

				// get parent group of the translation original
				$origParent = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
					'g2.*',
					'tx_addressgroups_group AS g1, tx_addressgroups_group AS g2',
					'g1.uid = '.$row['l18n_parent'].' AND g2.uid = g1.parent_group'
				);

				if (!empty($origParent)) {
					$item = 'Parent group from the translation original of this record:<br />'.$origParent['title'];
				} else {
					$item = 'The translation original of this record has no parent group assigned.<br />';
				}
				$item = '<div class="typo3-TCEforms-originalLanguageValue">'.$item.'</div>';
*/
			} else { // build tree selector

				// build tree selector
				$item.= '<input type="hidden" name="'.$PA['itemFormElName'].'_mul" value="'.($config['multiple']?1:0).'" />';

					// Set max and min items:
				$maxitems = t3lib_div::intInRange($config['maxitems'],0);
				if (!$maxitems)	$maxitems=100000;
				$minitems = t3lib_div::intInRange($config['minitems'],0);

					// Register the required number of elements:
				$this->pObj->requiredElements[$PA['itemFormElName']] = array($minitems,$maxitems,'imgName'=>$table.'_'.$row['uid'].'_'.$field);


				if($config['treeView'] && $config['foreign_table']) {
					global $TCA, $LANG;

					if($config['treeViewClass'] && is_object($treeViewObj = &t3lib_div::getUserObj($config['treeViewClass'],'user_',false))) {

					} else {
						$treeViewObj = t3lib_div::makeInstance('tx_hisodat_tceFunc_selectTreeView');
					}

//schradt: restrict categories to PIDs if necessary
					#$where   = ' AND sys_language_uid = 0 AND l18n_parent = 0';
					$where = ' '.$this->parseForeignTableWhere($config['foreign_table_where'],$table,$field,$row);
					$orderBy = 'title';

					$treeViewObj->table        = $config['foreign_table'];
					$treeViewObj->init($where, $orderBy);
					$treeViewObj->backPath     = $this->pObj->backPath;
					$treeViewObj->parentField  = $TCA[$config['foreign_table']]['ctrl']['treeParentField'];
					$treeViewObj->expandAll    = 1;
					$treeViewObj->expandFirst  = 1;
					$treeViewObj->fieldArray   = array('uid','title','description'); // those fields will be filled to the array $treeViewObj->tree
					$treeViewObj->ext_IconMode = '1'; // no context menu on icons
					$treeViewObj->title        = $LANG->sL($TCA[$config['foreign_table']]['ctrl']['title']);

					$treeViewObj->TCEforms_itemFormElName = $PA['itemFormElName'];
					if ($table == $config['foreign_table']) {
						$treeViewObj->TCEforms_nonSelectableItemsArray[] = $row['uid'];
					}

						// get default items
					$defItems = array();
					if (is_array($config['items']) && $table == 'tt_content' && $row['CType']=='list' && $row['list_type']=='tx_hisodat_pi1' && $field == 'pi_flexform')	{
						reset ($config['items']);
						while (list($itemName,$itemValue) = each($config['items']))	{
							if ($itemValue[0]) {
								$ITitle = $this->pObj->sL($itemValue[0]);
								$defItems[] = '<a href="#" onclick="setFormValueFromBrowseWin(\'data['.$table.']['.$row['uid'].']['.$field.'][data][sDEF][lDEF][groupSelection][vDEF]\','.$itemValue[1].',\''.$ITitle.'\'); return false;" style="text-decoration:none;">'.$ITitle.'</a>';
							}
						}
					}

						// render tree html
					$treeContent = $treeViewObj->getBrowsableTree();
					$treeItemC   = count($treeViewObj->ids);

					if ($defItems[0]) { // add default items to the tree table. In this case the value [not categorized]
						$treeItemC += count($defItems);
						$treeContent .= '<table border="0" cellpadding="0" cellspacing="0"><tr>
							<td>'.$this->pObj->sL($config['itemsHeader']).'&nbsp;</td><td>'.implode($defItems,'<br />').'</td>
							</tr></table>';
					}

						// find recursive groups or "storagePid" related errors and if there are some, add a message to the $errorMsg array.
					#$errorMsg = $this->findRecursiveCategories($PA,$row,$table,$storagePid,$treeViewObj->ids) ;

					$width = 280; // default width for the field with the group tree
					if ($GLOBALS['CLIENT']['BROWSER'] == 'msie') {
						// to suppress the unneeded horizontal scrollbar IE
						// needs a width of at least 320px
						$width = 320;
					}

					$config['autoSizeMax'] = t3lib_div::intInRange($config['autoSizeMax'],0);
					$height = $config['autoSizeMax'] ? t3lib_div::intInRange($treeItemC+2,t3lib_div::intInRange($size,1),$config['autoSizeMax']) : $size;
						// hardcoded: 16 is the height of the icons
					$height = $height*16;

					$divStyle    = 'position:relative; left:0px; top:0px; height:'.$height.'px; width:'.$width.'px;border:solid 1px;overflow:auto;background:#fff;margin-bottom:5px;';
					$thumbnails  = '<div name="'.$PA['itemFormElName'].'_selTree" style="'.htmlspecialchars($divStyle).'">';
					$thumbnails .= $treeContent;
					$thumbnails .= '</div>';

				} else {

					$sOnChange = 'setFormValueFromBrowseWin(\''.$PA['itemFormElName'].'\',this.options[this.selectedIndex].value,this.options[this.selectedIndex].text); '.implode('',$PA['fieldChangeFunc']);

						// Put together the select form with selected elements:
					$selector_itemListStyle = isset($config['itemListStyle']) ? ' style="'.htmlspecialchars($config['itemListStyle']).'"' : ' style="'.$this->pObj->defaultMultipleSelectorStyle.'"';
					$size = $config['autoSizeMax'] ? t3lib_div::intInRange(count($itemArray)+1,t3lib_div::intInRange($size,1),$config['autoSizeMax']) : $size;
					$thumbnails = '<select style="width:150px;" name="'.$PA['itemFormElName'].'_sel"'.$this->pObj->insertDefStyle('select').($size?' size="'.$size.'"':'').' onchange="'.htmlspecialchars($sOnChange).'"'.$PA['onFocus'].$selector_itemListStyle.'>';
					#$thumbnails = '<select                       name="'.$PA['itemFormElName'].'_sel"'.$this->pObj->insertDefStyle('select').($size?' size="'.$size.'"':'').' onchange="'.htmlspecialchars($sOnChange).'"'.$PA['onFocus'].$selector_itemListStyle.'>';
					foreach($selItems as $p)	{
						$thumbnails.= '<option value="'.htmlspecialchars($p[1]).'">'.htmlspecialchars($p[0]).'</option>';
					}
					$thumbnails.= '</select>';

				}

					// Perform modification of the selected items array:
				$itemArray = t3lib_div::trimExplode(',',$PA['itemFormElValue'],1);
				foreach($itemArray as $tk => $tv) {
					$tvP = explode('|',$tv,2);
					if (in_array($tvP[0],$removeItems) && !$PA['fieldTSConfig']['disableNoMatchingValueElement'])	{
						$tvP[1] = rawurlencode($nMV_label);
					} elseif (isset($PA['fieldTSConfig']['altLabels.'][$tvP[0]])) {
						$tvP[1] = rawurlencode($this->pObj->sL($PA['fieldTSConfig']['altLabels.'][$tvP[0]]));
					} else {
						$tvP[1] = rawurlencode($this->pObj->sL(rawurldecode($tvP[1])));
					}
					$itemArray[$tk]=implode('|',$tvP);
				}

				$params=array(
					'size' => $size,
					'autoSizeMax' => t3lib_div::intInRange($config['autoSizeMax'],0),
					#'style' => isset($config['selectedListStyle']) ? ' style="'.htmlspecialchars($config['selectedListStyle']).'"' : ' style="'.$this->pObj->defaultMultipleSelectorStyle.'"',
					'style' => ' style="width: 150px;"',
					'dontShowMoveIcons' => ($maxitems<=1),
					'maxitems' => $maxitems,
					'info' => '',
					'headers' => array(
						'selector' => $this->pObj->getLL('l_selected').':<br />',
						'items' => $this->pObj->getLL('l_items').':<br />'
					),
					'noBrowser' => 1,
					'thumbnails' => $thumbnails
				);
				$item.= $this->pObj->dbFileIcons($PA['itemFormElName'],'','',$itemArray,'',$params,$PA['onFocus']);
				// Wizards:
				$altItem = '<input type="hidden" name="'.$PA['itemFormElName'].'" value="'.htmlspecialchars($PA['itemFormElValue']).'" />';
				$item = $this->pObj->renderWizards(array($item,$altItem),$config['wizards'],$table,$row,$field,$PA,$PA['itemFormElName'],$specConf);
			}
		}

		#return $this->NA_Items.implode($errorMsg,chr(10)).$item;
		return $this->NA_Items.$item;

	}

	/**
	 * detects recursive groups and returns an error message if recursive groups where found
	 *
	 * @param	array		$PA: the paramter array
	 * @param	array		$row: the current row
	 * @param	array		$table: current table
	 * @param	integer		$storagePid: the StoragePid (pid of the group folder)
	 * @param	array		$treeIds: array with the ids of the groups in the tree
	 * @return	array		error messages
	 */
	function findRecursiveCategories ($PA,$row,$table,$storagePid,$treeIds) {
		$errorMsg = array();
		if ($table == 'tt_content' && $row['CType']=='list' && $row['list_type']=='tx_hisodat_pi1') { // = tt_content element which inserts plugin tx_addressgroups_pi1
			$cfgArr = t3lib_div::xml2array($row['pi_flexform']);
			if (is_array($cfgArr) && is_array($cfgArr['data']['sDEF']['lDEF']) && $cfgArr['data']['sDEF']['lDEF']['groupSelection']) {
				$rcList = $this->compareGroupVals ($treeIds,$cfgArr['data']['sDEF']['lDEF']['groupSelection']['vDEF']);
			}
		} elseif ($table == 'tx_hisodat_sources' || $table == 'tx_hisodat_categories') {
			if ($table == 'tx_hisodat_categories' && $row['pid'] == $storagePid && intval($row['uid']) && !in_array($row['uid'],$treeIds))	{ // if the selected group is not empty and not in the array of tree-uids it seems to be part of a chain of recursive groups
				$recursionMsg = 'RECURSIVE GROUPS DETECTED!! <br />This record is part of a chain of recursive groups. The affected groups will not be displayed in the group tree.  You should remove the parent group of this record to prevent this.';
			}
			if ($table == 'tx_hisodat_sources' && $row['tx_hisodat_categories']) { // find recursive groups in the tt_address db-record
				$rcList = $this->compareGroupVals ($treeIds,$row['tx_hisodat_categories']);
			}
			// in case of localized records this doesn't work
			if ($storagePid && $row['pid'] != $storagePid && $table == 'tx_hisodat_categories') { // if a storagePid is defined but the current group is not stored in storagePid
				$errorMsg[] = '<p style="padding:10px;"><img src="gfx/icon_warning.gif" class="absmiddle" alt="" height="16" width="18"><strong style="color:red;"> Warning:</strong><br />tt_address is configured to display groups only from the "General record storage page" (GRSP). The current group is not located in the GRSP and will so not be displayed. To solve this you should either define a GRSP or disable "Use StoragePid" in the extension manager.</p>';
			}
		}
		if (strlen($rcList)) {
			$recursionMsg = 'RECURSIVE GROUPS DETECTED!! <br />This record has the following recursive groups assigned: '.$rcList.'<br />Recursive groups will not be shown in the group tree and will therefore not be selectable. ';

			if ($table == 'tx_hisodat_categories') {
				$recursionMsg .= 'To solve this problem mark these groups in the left select field, click on "edit group" and clear the field "parent group" of the recursive group.';
			} else {
				$recursionMsg .= 'To solve this problem you should clear the field "parent group" of the recursive group.';
			}
		}
		if ($recursionMsg) $errorMsg[] = '<table class="warningbox" border="0" cellpadding="0" cellspacing="0"><tbody><tr><td><img src="gfx/icon_fatalerror.gif" class="absmiddle" alt="" height="16" width="18">'.$recursionMsg.'</td></tr></tbody></table>';
		return $errorMsg;
	}

	/**
	 * This function compares the selected groups ($catString) with the groups from the group tree ($treeIds).
	 * If there are groups selected that are not present in the array $treeIds it assumes that those groups are
	 * parts of a chain of recursive groups returns their uids.
	 *
	 * @param	array		$treeIds: array with the ids of the groups in the tree
	 * @param	string		$catString: the selected groups in a string (format: uid|title,uid|title,...)
	 * @return	string		list of recursive groups
	 */
	function compareGroupVals ($treeIds,$catString) {
		$recursiveGroups = array();
		$showncats = implode($treeIds,','); // the displayed groups (tree)
		$catvals = explode(',',$catString); // groups of the current record (left field)
		foreach ($catvals as $k) {
			$c = explode('|',$k);
			if(!t3lib_div::inList($showncats,$c[0])) {
				$recursiveGroups[]=$c;
			}
		}
		if ($recursiveGroups[0])  {
			$rcArr = array();
			foreach ($recursiveGroups as $key => $cat) {
				if ($cat[0]) $rcArr[] = $cat[1].' ('.$cat[0].')'; // format result: title (uid)
			}
			$rcList = implode($rcArr,', ');
		}
		return $rcList;
	}

	/**
	 * Function to get markers parsed in a field of the type USER. See t3lib_BEfunc::exec_foreign_table_where_query()
	 *
	 * @param	array		$fTWHERE: the foreign_table_where string from TCA
	 * @param	string		$row: current row in pagetree
	 * @return	string		parsed foreign_table_where string
	 */
	function parseForeignTableWhere ($fTWHERE,$table,$field,$row) {

		$TSconfig = array();
		$TSconfig = t3lib_BEfunc::getTCEFORM_TSconfig($table,$row);

		// override from PageTSConfig
		if ($TSconfig[$field]['config.']['foreign_table_where']) {
			$fTWHERE = $TSconfig[$field]['config']['foreign_table_where'];
		}

		$fTWHERE = str_replace('###CURRENT_PID###',intval($TSconfig['_CURRENT_PID']),$fTWHERE);
		$fTWHERE = str_replace('###THIS_UID###',intval($TSconfig['_THIS_UID']),$fTWHERE);
		$fTWHERE = str_replace('###THIS_CID###',intval($TSconfig['_THIS_CID']),$fTWHERE);
		$fTWHERE = str_replace('###STORAGE_PID###',intval($TSconfig['_STORAGE_PID']),$fTWHERE);
		$fTWHERE = str_replace('###SITEROOT###',intval($TSconfig['_SITEROOT']),$fTWHERE);
		$fTWHERE = str_replace('###PAGE_TSCONFIG_ID###',intval($TSconfig[$field]['PAGE_TSCONFIG_ID']),$fTWHERE);
		$fTWHERE = str_replace('###PAGE_TSCONFIG_IDLIST###',$GLOBALS['TYPO3_DB']->cleanIntList($TSconfig[$field]['PAGE_TSCONFIG_IDLIST']),$fTWHERE);
		$fTWHERE = str_replace('###PAGE_TSCONFIG_STR###',$GLOBALS['TYPO3_DB']->quoteStr($TSconfig[$field]['PAGE_TSCONFIG_STR'], 'tx_hisodat_categories'),$fTWHERE);

		return($fTWHERE);
	}

	function displayEntities($PA, $fobj) {

		$table = $PA['table'];
		$field = $PA['field'];
		$row   = $PA['row'];

		// ATTENTION: when doing this irre editing stops working
		#t3lib_div::debug($PA);

		$items = 'test';

		return $items;

	}

}


if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/hisodat/configuration/class.tx_hisodat_treeview.php'])    {
    include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/hisodat/configuration/class.tx_hisodat_treeview.php']);
}
?>
