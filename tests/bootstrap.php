<?php

define('ROOT', realpath(dirname(__FILE__) . '/../'));

require_once implode(DIRECTORY_SEPARATOR, [ROOT, 'tests', 'includes', 'wordpress-functions.php']);
require_once implode(DIRECTORY_SEPARATOR, [ROOT, 'src', 'wp-wodify.php']);