<?php
/*
Main Menu.
++++++++++++++++++++++++++++++
Mooshak Theme Manager 1.0

programmer : Hasitha Aravinda.
email: hasithatw@gmail.com
*/
?>
<?php // logout 
// no direct access
// this is first code block
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME']))
{
// tell people trying to access this file directly goodbye...
exit("This file is restricted from direct access");
}
//Rest of the code in your file comes after this
?>

<?php

$aboutFolder = "menu/" ;  // images paths from root folder. // this variable should follow this nameing convention: menu_name+"Folder"
$appFolder = "./" ;  // application path.
?>

<!--  menu about -->
<table width="150" border="0">
  <tr>
    <td align="center"><strong>About</strong></td>
  </tr>
  <tr>
    <td align="center"><img src="<?php echo $aboutFolder;?>frontpage.png"></td>
  </tr>
  <tr>
    <td><a href='<?php echo $appFolder;?>main.php?action=ART@software'>About Plug-in</a></td>
  </tr>
  <tr>
    <td><a href='<?php echo $appFolder;?>main.php?action=ART@me'>About Programmer</a></td>
  </tr>
  <tr>
    <td><a href='<?php echo $appFolder;?>main.php?action=ART@faq'  >FAQ</a></td>
  </tr>
  <tr>
    <td></td>
  </tr>
  
</table> 

