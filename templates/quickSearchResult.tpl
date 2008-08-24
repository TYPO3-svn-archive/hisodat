{*
------------------------------------
HISODAT QUICKSEARCH RESULT TEMPLATE
------------------------------------

This template displays the result data from a HISODAT quicksearch.

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