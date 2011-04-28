<?php
/*
File Reseter.
++++++++++++++++++++++++++++++
Mooshak Theme Manager 1.0

programmer : Hasitha Aravinda.
email: hasithatw@gmail.com
*/
?>
<?php 
// no direct access
// this is first code block
//if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME']))
//{
// tell people trying to access this file directly goodbye...
//exit("This file is restricted from direct access");
//}
//Rest of the code in your file comes after this

?>

<!--  module Reset  -->
<center>
  <p>&nbsp;</p>
  <p><strong>Reset Original setting</strong></p>
</center>
<br />

<table width="500" border="0">
<?php  // file reset code
$flag_reset=0;
if($_REQUEST['reset']=='ok')
{
echo "<img src='images/info.png'><br />"; 
$flag_reset=1;

// reset process
$file  = "backup/index.html"; 
$newfile = "../index.html";
if (!copy($file, $newfile)) {
echo "failed to copy  index.html...<br />";
}else{
echo "original index.html copied <br />";
}


	if ($handle = opendir("backup/styles/")) {
	  // reading form backup

	  while (false !== ($file = readdir($handle))) {
		$new = array();
		$new = explode("." , $file ,2);
		if(strnatcasecmp($new[1],"css")==0){  // seperate css files
			
		  $scfile  = "backup/styles/" . $file; 
		  $newfile = "../styles/" .$file;
		  
		  if (!copy($scfile, $newfile)) {
		  echo "failed to copy " . $file . "<br />";
		  }else{ echo $file . " copied <br /> ";}
	  	}
	  }
	  closedir($handle);

	}



///////////////////////////////////////////
echo('<form id="form" name="form" method="post" action="main.php" >
  	 <input name="action" type="hidden" value="showWelcome" />
     <input type="submit" value="OK" />
     </form>
'); // ok button

}
?>

  
<?php
if($flag_reset==0)
echo ('
  <tr>
  <td width="249" align="left">
      <p>&nbsp;</p>
        Following Changes will apply..</p>
      <p><br />
        1) Reset Front page.<br/>2) Reset Css files. </p>
      <p><strong>Are you sure?</strong></p></td>
  </tr>
  <tr>
  <td align="right">
  <form id="form1" name="form1" enctype="multipart/form-data" method="post" action=' . $PHP_SELF . ' >
  <input name="reset" type="hidden" value="ok" />
  <input type="submit" name="upload" value=" Yes , Reset Data " />
  </form> </td><td width="241" align="left">
  <form id="form2" name="form2" enctype="multipart/form-data" method="post" action="main.php" >
  <input name="action" type="hidden" value="showWelcome" />
  <input type="submit" name="upload" value=" No , Don&lsquo;t reset data" />
  </form>
  ');
?>
  </td>
  </tr>
   
 

 

</table> 

