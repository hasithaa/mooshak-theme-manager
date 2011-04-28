<?php
/*
user module .
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


$action=$_REQUEST['action'];
if ($action=="logout"){
unset($_SESSION["user"]);
session_destroy();
echo ('<meta http-equiv="refresh"	content="0; URL=index.php">');
}
?>
<?php

$userFolder = "menu/" ;  // images paths from root folder. // this variable should follow this nameing convention: menu_name+"Folder"
$appFolder = "./" ;  // application path.
?>

<!--  menu user -->
<?php  // making log out form
echo('
<table width="150" border="0">
<form id="form1" name="form1" method="post" action=' . $PHP_SELF . ' >
  <tr>
    <td align="center"><strong>User</strong><br /></td>
  </tr>
  <tr>
    <td align="center">hi '. $_SESSION["userName"] . ' </td>
  </tr>
  <tr><input name="action" type="hidden" value="logout" />
    <td align="center"><img src="'. $userFolder.'users.png" /></td>
  </tr>
  <tr>
    <td align="center"  ><input name="logout" type="submit" value="Logout" /></td>
  </tr>
  </form>
</table> ');
?>

