<?php
/*
content Manager Menu.
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

$contentFolder = "menu/" ;  // images paths from root folder. // this variable should follow this nameing convention: menu_name+"Folder"
$appFolder = "./" ;  // application path.
?>


<!--  menu content -->
<table width="150" border="0">
  <tr>
    <td align="center"><strong>Content</strong></td>
  </tr>
  <tr>
    <td align="center"><img src='<?php echo $contentFolder;?>config.png'><br /></td>
  </tr>
  <tr>
    <td><a href='<?php echo $appFolder;?>main.php?action=MOD@save'>Save/Load</a></td>
  </tr>
  <tr>
    <td><a href='<?php echo $appFolder;?>main.php?action=MOD@front'>Front page</a></td>
  </tr>
  <tr>
    <td><a href='<?php echo $appFolder;?>main.php?action=MOD@csseditor' >CSS Editor</a></td>
  </tr>
  <tr>
    <td><a href='<?php echo $appFolder;?>main.php?action=MOD@reset'>Reset Backup</a></td>
  </tr>
  <tr>
    <td><a href='../index.html' target="_blank"  >Load Mooshak</a></td>
  </tr>
</table>
