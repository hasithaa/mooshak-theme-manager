<?php
/*
save and load..
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

?>

<!--  module file uploader -->
<center>
  <p>&nbsp;</p>
  <p><strong>Save &amp; Load Front Page.</strong></p>
</center>

<table width="500" border="0">
<?php  // file uploading code

$flag_upload = 0;

if($_REQUEST['action2']=='upload')
{	
	$flag_upload = 1;
if (($_FILES["file"]["type"] == "text/html")&& ($_FILES["file"]["size"] < 200000))  // cheaking conditions
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
	 
      move_uploaded_file($_FILES["file"]["tmp_name"], "../index.html" );
	  echo "<img src='images/ok.png'><br />";
      echo "<b>File is Loaded</b> <br /><br />";
	  echo "File Details : <br />";   /// displaying file details
	  echo "Stored in: /index.html " . $_FILES["file"]["name"] . "<br />";
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

  
  
  }else {   // file too large or Not a html file
	  echo "<img src='images/info.png'><br />";
	  echo "<b>File is too large or Not a HTML file. Upload Abort by Server.</b> <br /><br />";
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




<?php  // making Load form
if($flag_upload == 0) { // file select mode.
echo ('<form id="form1" name="form1" enctype="multipart/form-data" method="post" action=' . $PHP_SELF . ' >
  <tr>
    <td align="left">
      <p><strong>Load your own front page. </strong>:<br /><br />
        (*) file size should not exceed 200 Kbytes and should be in HTML formal. <br /><br />
        (*) Make sure that Add a link to access Mooshak Login.<br />example URL &quot; &frasl;~mooshak&frasl;cgi-bin&frasl;execute &quot;  
		</p>
      <p>
        <label for="file">select a file:        </label>
      </p></td>
  </tr>
  <tr><input name="action2" type="hidden" value="upload" />
    <td align="center">
    <input type="file" name="file" id="file"  />
    <input type="submit" name="upload" value=" Load " /></td>
  </tr>
   </form>');
 
  // making save form

echo ('<tr> <td align="left">
      <p><strong>Save Front page. </strong>:<br /><br />
         <br /><br />
        Right-click the link and choose "Save Link As..." to save the document to your computer  
		</p>
		<a href="../index.html" target="_blank">Right-click Me</a></td></tr>
		<tr><td>
     ');
 
}
 ?>


 

</table> 


<!-- end of module file uploader -->