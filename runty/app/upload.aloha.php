<?php 

/**
 * Easy example script to store uploaded files
 * in the filesystem, make sure that the folder is writeable.
 * Please don't use this example file in productive environment 
 * It is just used to illustrate the upload funtionality and it may 
 * contain security issues.
 */

class upload {
	public function writeFile($rawContent) {
        $uploaddir = '../../uploads/';
        $uploaddir_http = '/uploads/';

		$headers = getallheaders();
		$filename = $headers['X-File-Name'];
		$filecontent = $rawContent;
		$filecontent = substr($filecontent, (strpos($filecontent, ',')+1));
		$filecontent = base64_decode($filecontent);

		$fp = fopen($uploaddir.$filename, 'w');
		fwrite($fp, $filecontent);
		fclose($fp);

		//return dirname($_SERVER['SCRIPT_NAME']) . '/' . $filename;
		return $uploaddir_http.$filename;
	}
}

$file = new upload();
echo $file->writeFile($HTTP_RAW_POST_DATA);
?>