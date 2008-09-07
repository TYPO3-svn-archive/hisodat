{*
-----------------------------
HISODAT DETAILS VIEW TEMPLATE
-----------------------------

This template displays the record from listview in single view

@controller	: class.tx_hisodat_controllers_detailsView.php
@model		: class.tx_hisodat_models_sources.php
@view		: class.tx_hisodat_views_detailsViewSources.php

The following variables are important:

configurations			array		configuration of the controller
data					array		the content object which executes the controller
page					array		the current page
parameters				array		current parameters
result					array 		The record from the db query

*}

<h3>HISODAT DETAILS VIEW SOURCES</h3>

{if ($configurations.totalResultCount > 1 && isset($configurations.singleBrowser))}
<h3 class="hisodat-resultinfo">Ihre Suche hat {$configurations.totalResultCount} Treffer ergeben. Sie sehen den Treffer Nummer {$configurations.currentKey}</h3>
{/if}
{$configurations.singleBrowser}
<div id="hisodat-source-{$row.signature}" class="hisodat-source">
	<h3 id="hisodat-source-signature">{$result.signature}</h3>
	<p id="hisodat-source-signature_add">{$result.signature_add}</p>
	<p id="hisodat-source-date_comment">{$result.date_comment}</p>

	<div class="hisodat-source-intro">
		{$result.short|format}
	</div>
	{if $result.sourcetext ne ""}
	<div class="hisodat-source-sourcetext">
		{$result.sourcetext|format}
	</div>
	{/if}
	<div class="hisodat-source-description">
		{$result.description|format}
	</div>
</div>