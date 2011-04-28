<?php
/*
Login page.
++++++++++++++++++++++++++++++
Mooshak Theme Manager 1.0

programmer : Hasitha Aravinda.
email: hasithatw@gmail.com
*/

?>
<?php   // cheaking user name and password
$login = "";
$name = $_REQUEST["valUser"];
$pass = $_REQUEST["valPass"];
if($name!=""){
$fname = "data/user.dat";
$fhandle = fopen($fname,"r");
$msg = base64_decode(fread($fhandle,filesize($fname)));
fclose($fhandle);
$details = array();
$details = split("@",$msg);

if($name == $details[2])
{
if($pass==$details[4]){ // if login success
session_start();  //start session 
$_SESSION["userName"]=$name;
$_SESSION["user"]="admin"; //setting session varibales
$login = "ok";

}else{ // if login fail
$login = "fail";
}
}else{ // if login fail
$login = "fail";
}

}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome To the Mooshak Theme Manager</title>
<style type="text/css">
<!--
body {
	color: #000000;
}
</style>
</head>
<body background="images/tile.jpg" >
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<center>
  <table border="1" bordercolor="#000000">
    <tr>
      <td><table width="650" bgcolor="#FFFFFF">
          <tr>
            <td width="295" height="300" align="center"><?php
if ($login == "ok")
{
echo("<meta http-equiv='refresh' content='1; URL=index.php'>"); // rederecting page after 1 second.
die("pls wait.. pages are loading...");
} else if($login == "fail") {
echo('<img src="images/cancel.png"> <br />Login Fail.... cheak user name and password again..');  // error msg.
}
?>
              <?php  // making login form
    echo("  <form id='form1' name='form1' method='post' action=" . $PHP_SELF . " >
        <table width='279' border='0'>
  <tr>
    <td width='82'><img src='images/users.png'></td>
    <td width='141'>Enter login Details </td>
  </tr>
  <tr>
    <td width='82'><label>User Name </label></td>
    <td width='141'><input name='valUser' type='text' value='' width='140'/></td>
  </tr>
  <tr>
    <td><label>Password  </label></td>
    <td><input name='valPass' type='password' value='' width='140'/></td>
  </tr>
  <tr>
    <td height='77' align='right'><img src='images/security_f2.png'></td>
    <td><p>
      <input type='submit' name='Login' id='Login' value='Login' />
    </p></td>
  </tr>
</table>
</form>");  // making login form

?></td>
            <td width="19"><img src="images/bg_page.png"></td>
            <td width="320" height="300" ><table width="290" height="221" border="0">
                <tr>
                  <td width="260" height="20" align="center"><p><strong>Welcome to the </strong><br />
                      <strong> Mooshak Theme Manager</strong></p></td>
                </tr>
                <tr>
                  <td align="justify"><p>This is an open source plug-in for Mooshak 1.5 version. This plug-in  allows to   Mooshak administrator to change user interface of the Mooshak very   easily.</p>
                    <p>This plug-in requires user authentication.  Enter user name and password to Login to the system.</p>
                    <p>If you are not the administrator of the system, <a href="../index.html">click me</a> to redirect to the<strong> Mooshak</strong>.</p></td>
                </tr>
              </table></td>
          </tr>
        </table></td>
    </tr>
  </table>
</center>
</body>
</html>