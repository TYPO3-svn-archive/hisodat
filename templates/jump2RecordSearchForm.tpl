{*
-----------------------------------
HISODAT JUMP 2 RECORD FORM TEMPLATE
-----------------------------------

This template displays the jump2record form

@controller	: class.tx_hisodat_controllers_searchForms.php
@view		: class.tx_hisodat_views_searchForms.php

The following variables are important:

configurations			array		configuration of the controller
data					array		the content object which executes the controller
page					array		the current page
parameters				array		current parameters

*}

<h3>HISODAT JUMP 2 RECORD FORM</h3>

<form action="{$destinationPid}" id="hisodat-jump2record" method="post">
	<fieldset>
		<legend>Zu Datensatz springen</legend>
		<label for="hisodat-jump2record-select">Nummer oder Jahr aufschlagen</label>	
		<select id="hisodat-jump2record-select" name="hisodat[jump2record][select]">
			<option selected="selected" value="1">Nummer aufschlagen</option>
			<option value="2">Jahr aufschlagen</option>
		</select>
		<label for="hisodat-jump2record-input">Springe zu Inschrift</label>								
		<input id="hisodat-jump2record-input" type="text" name="hisodat[jump2record][value]" value="Eingabe" onfocus="if(this.value=='Eingabe')this.value='';" />							
		<label for="hisodat-jump2record-submit" class="skip">Eingabe abschicken</label>
		<input id="hisodat-jump2record-submit" type="submit" class="submit" name="submit" value="Anzeigen" />
		<input id="hisodat-jump2record-action" type="hidden" name="hisodat[action]" value="jump2Record" />
	</fieldset>
</form>