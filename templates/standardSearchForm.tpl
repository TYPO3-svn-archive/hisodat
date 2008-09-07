{*
------------------------------------
HISODAT STANDARD SEARCHFORM TEMPLATE
------------------------------------

This template displays the expert searchform

@controller	: class.tx_hisodat_controllers_searchForms.php
@view		: class.tx_hisodat_views_searchForms.php

The following variables are important:

configurations			array		configuration of the controller
data					array		the content object which executes the controller
page					array		the current page
parameters				array		current parameters

*}

<h3>STANDARD SEARCHFORM</h3>

<div id="imh-standardsearch">
	<form action="{$destinationPid}" method="post" id="hisodat-standardsearch">
		<fieldset id="fulltext">
			<legend>Volltextsuche</legend>
			<ol>
				<li class="imh-search-rules">
					<a href="#">[Tipps]
					<span>Durch Komma oder Leerzeichen getrennte Worte werden mit ODER verknüpft. Kombinieren können Sie Suchworte mit "UND".
					Ein Sternchen (*) hinter einem Wortteil sucht nach allen Formen des Wortes. Um nach exakten Wortfolgen zu suchen, setzen
					Sie den gesamten Suchausdruck in Anführungszeichen. Dies gilt auch für die Suche nach Jahreszahlen im Text.</span>
					</a>
				</li>
				<li class="imh-standardsearch-field">
					<label for="imh-standardsearch-fulltext">Suchbegriffe:</label>
					<input id="imh-standardsearch-fulltext" type="text" name="hisodat[searchstring]" />
				</li>
			</ol>
		</fieldset>
		<fieldset id="datestartend">
			<legend>Zeitliche Eingrenzung (Jahreszahlen)</legend>
			<ol>
				<li class="imh-search-rules">
					<a href="#">[Tipps]
					<span>Sie können die Suchergebnisse Ihrer Volltextsuche durch die Angabe von Jahreszahlen im Format (JJJJ) einschränken. Falls
					Sie keine Suchbegriffe sondern nur Jahreszahlen angeben, werden Ihnen alle Inschriften angezeigt, deren Datierung für den angegebenen Zeitraum
					gültig ist. Es ist auch möglich nur eines der beiden Felder zu benutzen um alle Inschriften vor bzw. nach einem bestimmten Datum
					anzuzeigen.</span>
					</a>
				</li>
				<li id="datestart" class="imh-standardsearch-field">
					<label for="imh-standardsearch-datestart">Von:</label>
					<input type="text" id="imh-standardsearch-datestart" name="hisodat[date_start]" />
				</li>
				<li id="dateend" class="imh-standardsearch-field">
					<label for="imh-standardsearch-dateend">Bis:</label>
					<input type="text" id="imh-standardsearch-dateend" name="hisodat[date_end]" />
				</li>
			</ol>
		</fieldset>
		<div>
			<label for="imh-standardsearch-submit" class="skip">Suchanfrage abschicken:</label>
			<input id="imh-standardsearch-submit" class="submit" name="submit" type="submit" value="Suchanfrage abschicken" />
			<input id="imh-standardsearch-action" type="hidden" name="hisodat[action]" value="standardSearch" />
		</div>
	</form>
</div>