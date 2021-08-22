<?php
function formatBytes($bytes, $precision = 2) { 
    $units = array('B', 'KB', 'MB', 'GB', 'TB'); 

    $bytes = max($bytes, 0); 
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
    $pow = min($pow, count($units) - 1); 

    // Uncomment one of the following alternatives
    // $bytes /= pow(1024, $pow);
    $bytes /= (1 << (10 * $pow)); 

    return round($bytes, $precision) . ' ' . $units[$pow]; 
} 

function getDirSize2($dir_name){

    $dir_size = 0;
    if (!is_dir($dir_name)) return $dir_size;
    
    $ite=new RecursiveDirectoryIterator($dir_name);
    foreach (new RecursiveIteratorIterator($ite) as $filename=>$cur)
        $dir_size+=$cur->getSize();

    return $dir_size;    
}

function format_size($size){

    $mod = 1024;
    $units = array('Б', 'КБ', 'МБ', 'ГБ', 'ТБ', 'ПБ');   
    for ($i = 0; $size > $mod; $i++)   
        $size /= $mod;

    return round($size, 2) . " " . $units[$i];
}
?>