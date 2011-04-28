<?php
/*
simple file manager .
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
// tell people trying to access this file directly goodbye...
exit("This file is restricted from direct access");
}
//Rest of the code in your file comes after this

$Location = "../others/";
if(!file_exists($Location))
mkdir($Location);
?>

<!--  module file viwer -->

<center>
  <p>&nbsp;</p>
  <p><strong>Simple File Viewer</strong></p>
</center>

<?php
$flag_delete = 0;  // flag to see module in which mode.


$myFile = $_REQUEST["file"];
if($myFile!="")  // delete mode.
{
	$flag_delete = 1; 
if(!$myFile=="") { // if only file found..
if (file_exists($Location . $myFile))  // if file already exits
{
unlink($Location . $myFile);
echo('	
	 <form id="form" name="form" method="post" action=' . $PHP_SELF . ' >
  	 <input name="file" type="hidden" value="" />
	 <img src="images/trash.png"><br /><b>'.$myFile.' Deleted</b> <br /><br />
     <input type="submit" value="OK" />
     </form>
');// msg of syaing ok.
}else{
echo('	
	 <form id="form" name="form" method="post" action=' . $PHP_SELF . ' >
  	 <input name="file" type="hidden" value="" />
	 <img src="images/info.png"><br /><br /><b>OOpss .. no file found called ' . $myFile .'</b> <br /><br />
     <input type="submit" value="OK" />
     </form>
');// msg of saying there is error 
}
}else{

	
}
}
?>
    
    
<?php
// creating the file list
if($flag_delete == 0)  // file view mode
if ($handle = opendir($Location)) {
	/* reading form ../uploads */
	$val=0; // file counter
echo('<table width="500" border="0" align="center">');
    while (false !== ($file = readdir($handle))) {
		if(!($file=="." || $file==".." )) // avoid . & .. directories..
        { // making forms for files.
		$val = $val + 1;  // counting files

if($val%3==1)
echo('<tr>');
echo('<td><table width="100" style="border: 1px solid #dddddd; margin: 8px; padding: 10px; border-color:#333" align="center"><tr ><td width="100" height="100" align="center" bgcolor="#FFFFFF">
  <a href="'. $Location . $file .'" target="_blank">
  <img src="'. $Location . $file .'" width="100" height="150">
   </a> 
  <tr><td align="center" bgcolor="#3366FF"> '.$file.' </td></tr>
  <tr><td align="center" bgcolor="#3366FF">
  
  
  <form id="form" name="form" method="post" action=' . $PHP_SELF . ' >
  <input name="file" type="hidden" value="'. $file .'" />
  <input type="submit" value="Delete" />
  </form>
  
  
  
  </td></tr></table></td>');

if($val%3==0) // file per row
echo('</tr>');

		}
    }
echo('</table> <br />');	
    closedir($handle);
	if($val==0) // if no file found
	{
		echo('<img src="images/info.png"><br /><br /><b>OOpss .. no file found ..<br /><br />');
	}
}
?>
     
<!-- end of module file viwer -->


