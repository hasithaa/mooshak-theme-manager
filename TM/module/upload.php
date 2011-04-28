<?php
/*
simple file uploader.
++++++++++++++++++++++++++++++
Mooshak Theme Manager 1.0

programmer : Hasitha Aravinda.
email: hasithatw@gmail.com
*/
?>
<?php 
// no direct access
// this is first code block
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME']))
{
//tell people trying to access this file directly goodbye...
exit("This file is restricted from direct access");
}
//Rest of the code in your file comes after this

$Location = "../others/";
if(!file_exists($Location))
mkdir($Location);
?>

<!--  module file uploader -->
<center>
  <p>&nbsp;</p>
  <p><strong>Simple File Uploader</strong></p>
</center>

<table width="500" border="0">
<?php  // file uploading code

$flag_upload = 0;

if($_REQUEST['action1']=='upload')
{	
	$flag_upload = 1;
if ((($_FILES["file"]["type"] == "image/gif")||($_FILES["file"]["type"] == "image/png")||($_FILES["file"]["type"] == "image/jpeg") )&& ($_FILES["file"]["size"] < 200000))  // cheaking conditions
  {
if ($_FILES["file"]["error"] > 0) // if file cant upload. serverside error. no permissions
  {
  echo "<img src='images/cancel.png'><br />";  
  echo "<b>There was an error uploading the file, please try again!</b> <br />";
  echo "Error Code: " . $_FILES["file"]["error"] . "<br />";
  echo('	
	 <form id="form" name="form" method="post" action=' . $PHP_SELF . ' >
  	 <input name="action1" type="hidden" value="" />
     <input type="submit" value="OK" />
     </form>
'); // ok button
   }
else  // file can upload
  {
	  
	if (file_exists($Location . $_FILES["file"]["name"]))  // if file already exits
      {
	  echo "<img src='images/info.png'><br />";  
      echo $_FILES["file"]["name"] . " already exists. ";
	 echo('	
	 <form id="form" name="form" method="post" action=' . $PHP_SELF . ' >
  	 <input name="action1" type="hidden" value="" />
     <input type="submit" value="OK" />
     </form>
'); // ok button
	  
      }
    else // file upload ok
      {
      move_uploaded_file($_FILES["file"]["tmp_name"], $Location . $_FILES["file"]["name"]);
	  echo "<img src='images/ok.png'><br />";
      echo "<b>File Upload Successful</b> <br /><br />";
	  echo "File Details : <br />";   /// displaying file details
	  echo "Stored in: /others/ " . $_FILES["file"]["name"] . "<br />";
	  echo "Upload: " . $_FILES["file"]["name"] . "<br />";
  	  echo "Type: " . $_FILES["file"]["type"] . "<br />";
      echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
	  echo('	
	 <form id="form" name="form" method="post" action=' . $PHP_SELF . ' >
  	 <input name="action1" type="hidden" value="" />
     <input type="submit" value="OK" />
     </form>
'); // ok button
      }

  
  }
  }else {   // file too large or Not in PNG,JPG, or GIF format 
	  echo "<img src='images/info.png'><br />";
	  echo "<b>File is too large or Not a PNG,JPG, or GIF format  file. Upload Abort by Server.</b> <br /><br />";
	  echo "File Details : <br />";
  	  echo "Upload: " . $_FILES["file"]["name"] . "<br />";
      echo "Type: " . $_FILES["file"]["type"] . "<br />";
 	  echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
	  echo('	
	 <form id="form" name="form" method="post" action=' . $PHP_SELF . ' >
  	 <input name="action1" type="hidden" value="" />
     <input type="submit" value="OK" />
     </form>
'); // ok button
	  }
}
?>




<?php  // making form
if($flag_upload == 0) // file select mode.
echo ('<form id="form1" name="form1" enctype="multipart/form-data" method="post" action=' . $PHP_SELF . ' >
  <tr>
    <td align="left">
      <p><strong>restrictions</strong>:<br /><br />
        1) file size should not exceed 200 Kbytes. <br /><br />
        2) PNG,JPG, or GIF formats are only allowed.        </p>
      <p>
        <label for="file">select a file:        </label>
      </p></td>
  </tr>
  <tr><input name="action1" type="hidden" value="upload" />
    <td align="center">
    <input type="file" name="file" id="file"  />
    <input type="submit" name="upload" value=" Upload " /></td>
  </tr>
   </form>');
 
 ?>


 

</table> 


<!-- end of module file uploader -->