<?php

define('ROOT', realpath(dirname(__FILE__) . '/../'));

require_once implode(DIRECTORY_SEPARATOR, array(ROOT, 'vendor', 'autoload.php'));
require_once implode(DIRECTORY_SEPARATOR, array(ROOT, 'vendor', 'antecedent', 'patchwork', 'Patchwork.php'));
require_once implode(DIRECTORY_SEPARATOR, array(ROOT, 'tests', 'includes', 'wordpress-functions.php'));
require_once implode(DIRECTORY_SEPARATOR, array(ROOT, 'src', 'wp-wodify.php'));