# we cannot pass multiline values as params of {object} tags in smarty since the params are sent directly to the TSparser which kills the line breaks

		$test = new tx_lib_object(array());
		$test->loadFromSession('lastController');
		debug($test);

# naming conventions
one word extension keys
camelCase
all vars and functions in full writing


# PHP logger

function do_log($text, $loglevel = 'normal') {

    $dateTime = strftime('[%Y-%m-%d %H:%M:%S]  ', time());

    if ($loglevel == 'high') {

        error_log ($dateTime . $text . chr(10), 3, '/web/ard-zdf-medienakademie.de/details.log');

    } else {

        error_log ($dateTime . $text . chr(10), 3, '/web/ard-zdf-medienakademie.de/import.log');

    }

}

# selects the kids of Hilda

SELECT * FROM `tx_caghisodat_ff_attr_pers_rel`
WHERE parent_rel = 6
AND (uid_pers1 = 3 AND rel_pers1 = 3)
OR (uid_pers2 = 3 AND rel_pers2 = 3)
ORDER by uid
LIMIT 0, 30
