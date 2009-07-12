{*
-----------------------------------
HISODAT SEARCH RESULT LIST TEMPLATE
-----------------------------------

This template displays the result data from a HISODAT searchquery.

@controller	: class.tx_hisodat_controllers_searchResultList.php
@model		: class.tx_hisodat_models_sources.php
@view		: class.tx_hisodat_views_searchResultList.php

The following variables are important:

configurations			array		configuration of the controller (includes result browser)
data					array		the content object which executes the controller
page					array		the current page
parameters				array		all current parameters
result					object 		The list with results from the db query

*}

{if isset($parameters.offset)}{assign var="offset" value="&hisodat[offset]=`$parameters.offset`"}{/if}

<h3 class="hisodat-resultinfo">Ihre Suche hat {$configurations.totalResultCount} Treffer ergeben.
{if ($configurations.totalResultCount > 10 && $parameters.offset > 0 && $parameters.offset+10 < $configurations.totalResultCount)}
 Sie sehen die Treffer: <span>{$parameters.offset+1} bis {$parameters.offset+10}</span>.
{elseif ($parameters.offset ne 0 && $parameters.offset+10 > $configurations.totalResultCount)}
 Sie sehen die Treffer: <span>{$parameters.offset+1} bis {$configurations.totalResultCount}</span>.
{elseif ($configurations.totalResultCount > 10 && $parameters.offset eq 0)}
 Sie sehen die Treffer: <span>1 bis 10</span>.
{elseif ($configurations.totalResultCount < 11 && $configurations.totalResultCount > 1)}
 Sie sehen die Treffer: <span>1 bis {$configurations.totalResultCount}</span>.
{/if}
</h3>

{if ($configurations.totalResultCount > 1)}<p class="hisodat-resultinfo">Die Treffer sind aufsteigend nach Jahr datiert.</p>{/if}
{$configurations.listBrowser}

{foreach from=$result item=source}

<h4 class="hisodat-resulttitle">{link parameter="`$configurations.singlePid`" additionalParams="&hisodat[uid]=`$source.uid`&hisodat[action]=showSource`$offset`" title="Im Detail anzeigen"}{$source.rowcount}) {$source.signature}: {$source.short} {/link}</h4>
<p class="hisodat-resultshort">{$source.short|truncate:200:"..."} {link parameter="`$configurations.singlePid`" additionalParams="&hisodat[uid]=`$source.uid`&hisodat[action]=showSource`$offset`" title="Im Detail anzeigen"}[Details]{/link}</p>

{/foreach}

{if ($configurations.totalResultCount > 10)}{$configurations.listBrowser}{/if}