<?php

/*
*	Backup Files
*
* Back up all your files in the 
* base and sub-directories.
*
* @author: Tech Dan
* @website: https://github.com/TechhDan/Zip_Directory/blob/master/zip_directory.php
*
*/ 

$zip = new ZipArchive();
$zip->open('backup.zip', ZipArchive::CREATE);

		### assign files to zip ###
function listFolderFiles($dir) {
	global $zip;
	$ffs = scandir($dir);
	foreach ($ffs as $ff) {
		if ($ff != '.' && $ff != '..' && $ff != 'backup.zip') {
			if (!is_dir($dir.'/'.$ff)) {
				$zip->addFile($dir.'/'.$ff);
				echo ($dir.'/'.$ff. " :<span style='color:green'>Success</span><br>");
			} else {
				listFolderFiles($dir.'/'.$ff);
				// echo ($dir.'/'.$ff . "	<span style='color:red'>Not applicable</span>: this is a folder<br>"); //Leave this, it helped a lot for trouble-shooting!
			}
		}
	}
	return;
}
listFolderFiles('.');
$zip = close();

?>