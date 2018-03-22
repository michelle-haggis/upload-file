<?php

if(isset($_POST['Upload'])){
$filename = $_FILES["myFile"]["name"];
	$file_basename = substr($filename, 0, strripos($filename, '.')); // get file extention
	$file_ext = substr($filename, strripos($filename, '.')); // get file name
	$filesize = $_FILES["myFile"]["size"];
	$allowed_file_types = array('.docx','.pdf', '.jpg' ,'.jpeg','.png');	

	if (in_array($file_ext,$allowed_file_type) && ($filesize < 500000))
	{	
		// Rename file
		$newfilename = md5($file_basename) . $file_ext;
		if (file_exists("upload/" . $newfilename))
		{
			// file already exists error
			echo "You have already uploaded this file.";
		}
		else
		{		
			move_uploaded_file($_FILES["myFile"]["tmp_name"], "upload/" . $newfilename);
			echo "File uploaded successfully.";		
		}
	}
	elseif (empty($file_basename))
	{	
		// file selection error
		echo "Please select a file to upload.";
	} 
	elseif ($filesize > 500000)
	{	
		// file size error
		echo "The file you are trying to upload is too large.";
	}
	else
	{
		// file type error
		echo "Only these file typs are allowed for upload: " . implode(', ',$allowed_file_types);
		unlink($_FILES["myFile"]["tmp_name"]);
	}
}
?>

<form action="" method="post" enctype="multipart/form-data">
  Select image to upload:
  <input type="file" name="myFile">
  <input type="submit" value="Upload">
</form>
