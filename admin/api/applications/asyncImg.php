<?php
ob_start();
session_start();
require_once '../../data/config.php';
require_once '../../include/php_image_magician.php';
	require_once '../../include/functions.php';
if(isset($_SESSION['wf_id']) && strlen($_SESSION['wf_id']) > 0) // login check
{
	header('Content-Type: application/json');
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$type = $_GET['type']; 
		if ($type == 'save') {
		 
			$uploadedFile = $_FILES['app_image'];
			$uploadFileTempName = $uploadedFile['tmp_name'];
			$uploadFileOrgName = $uploadedFile['name'];
			$uploadPath = UPLOAD_PATH_APPLICATION;

			$fileNewNameWithExt = uploadImage($uploadFileTempName, $uploadFileOrgName, $uploadPath);

		}

		$filename=$fileNewNameWithExt;

		$folderName = UPLOAD_PATH_APPLICATION;
		$folderNameThumb = UPLOAD_PATH_APPLICATION . 'thumb/' ;
		$filepath = $folderName . $filename;

		//$test = UPLOAD_PATH_APPLICATION.$image;
		//$test1 = UPLOAD_PATH_APPLICATION.'thumb/'.$image;

		chmod($folderName, 0755);
		chmod($folderNameThumb, 0755)
		;
//		$dir = UPLOAD_PATH_APPLICATION;
//		$dirContents = scandir($dir);
//
//		foreach($dirContents as $image)
//		{
//				exec('/usr/bin/convert ' .UPLOAD_PATH_APPLICATION.$image.' -resize 800x800 '.UPLOAD_PATH_APPLICATION.$image );
//				exec('/usr/bin/convert ' .UPLOAD_PATH_APPLICATION.$image.' -resize 200x200 '.UPLOAD_PATH_APPLICATION.'thumb/'.$image );
//
//		}

		/*	Purpose: Open image
     *	Usage:	 resize('filename.type')
     * 	Params:	 filename.type - the filename to open
     */
		$magicianObj = new imageLib($filepath);

		/*	Purpose: Resize image
		 *	Usage:	 resizeImage([width], [height])
		 * 	Params:	 width - the new width to resize to
		 *			 height - the new height to resize to
		 */
		$magicianObj -> resizeImage(600, 600);

		/*	Purpose: Save image
		 *	Usage:	 saveImage('[filename.type]', [quality])
		 * 	Params:	 filename.type - the filename and file type to save as
		  * 			 quality - (optional) 0-100 (100 being the highest (default))
		 *				Only applies to jpg & png only
		 */
		$magicianObj -> saveImage($folderName . $filename, 100);

		$magicianObj = new imageLib($filepath);
		$magicianObj -> resizeImage(200, 200);
		$magicianObj -> saveImage($folderNameThumb . $filename, 100);



		echo json_encode($fileNewNameWithExt);
	
		exit;
	}
}
else
{
	header('Location: ../index.php?mo=&errmsg=1');
}





?>