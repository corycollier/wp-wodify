<?php

define('ROOT', realpath(dirname(__FILE__) . '/../../'));

require_once implode(DIRECTORY_SEPARATOR, array(ROOT, 'vendor', 'antecedent', 'patchwork', 'Patchwork.php'));
require_once implode(DIRECTORY_SEPARATOR, array(ROOT, 'tests', 'phpunit', 'includes', 'wordpress-functions.php'));
require_once implode(DIRECTORY_SEPARATOR, array(ROOT, 'src', 'wp-wodify.php'));