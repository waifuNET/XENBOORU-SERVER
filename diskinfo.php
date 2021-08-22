<?php
require('./cfg.php');
require('./php/disk_functions.php');

$dir_name = dirname($_SERVER['DOCUMENT_ROOT']);
$used_space = format_size(getDirSize2($dir_name));

if($_GET['disk'] == "free"){
    echo floor($_DISK_MAX_SIZE - $used_space);
}
else{
    echo "used space: " . $used_space . '<br />';
    echo "available space: " . ($_DISK_MAX_SIZE - $used_space) . " ГБ" . '<br />';
}

?>