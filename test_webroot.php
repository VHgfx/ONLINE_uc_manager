<?php
define('WEBROOT', str_replace('test_webroot.php','', $_SERVER['URI']));
echo WEBROOT;

