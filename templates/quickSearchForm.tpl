{*
---------------------------------
HISODAT QUICKSEARCH FORM TEMPLATE
---------------------------------

This template displays the quicksearch form

@controller	: class.tx_hisodat_controllers_searchForms.php
@view		: class.tx_hisodat_views_searchForms.php

The following variables are important:

configurations			array		configuration of the controller
data					array		the content object which executes the controller
page					array		the current page
parameters				array		current parameters

*}

<h3>HISODAT QUICKSEARCH FORM</h3>

<form action="{$destinationPid}" method="post" id="hisodat-quicksearch">
	<fieldset>
		<legend>Volltextsuche</legend>
		<label for="hisodat-quicksearch-field">Suchbegriff eingeben</label>
		<input id="hisodat-quicksearch-field" type="text" name="hisodat[searchstring]" />
		<label for="hisodat-quicksearch-button">Suche abschicken</label>
		<input id="hisodat-quicksearch-button" type="submit" value="Los" />
		<input id="hisodat-quicksearch-action" type="hidden" name="hisodat[action]" value="quickSearch" />
	</fieldset>
</form>