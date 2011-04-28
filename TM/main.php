<?php
/*
main page.
++++++++++++++++++++++++++++++
Mooshak Theme Manager 1.0

programmer : Hasitha Aravinda.
email: hasithatw@gmail.com
*/
?>
<?php  // making session 
session_start();
if($_SESSION["user"]=="admin") // cheak user 
{

}else{ // wrong user, 
echo ("You have no permission to access the page.... <br />");
echo("<a HREF='index.php'> Click here to login </a> <br /> ");
unset($_SESSION["user"]);  // deleting session data (nothing to delete session. this is only safety)
session_destroy();
die("bye....");	 // ending accessing page
}
?>
<?php 
///////////////// variables /////////////////

/////////////////////Theme Menu///////////////////////////////////
$menuTop = '<table border="0" width="150" cellpadding="0" cellspacing="0">
<tr bgcolor="#CCCCCC">
<td width="24"><img src="images/boarder/blueLFT.png" width="25" height="22"></td>
<td width="100" background="images/boarder/blue.png" height="22" align="center"></td>
<td width="25"><img src="images/boarder/blueRHT.png" width="25" height="22"></td>
</tr>
	
<tr bgcolor="#CCCCCC">
<td width="24" bgcolor="#9DB6F4">&nbsp;</td>
<td width="100" bgcolor="#F5F7FE" align="center">';

$menuBot = '</td><td width="25" bgcolor="#9DB6F4">&nbsp;</td></tr>
<tr bgcolor="#CCCCCC">
<td width="24"><img src="images/boarder/blueLFT.png" width="25" height="22"></td>
<td width="100" background="images/boarder/blue.png" height="22" align="center"></td>
<td width="25"><img src="images/boarder/blueRHT.png" width="25" height="22"></td>
</tr>

</table>';
/////////////////////Theme Page///////////////////////////////////
$pageTop = '';

$PageBot = '';



///////////////////////Functions ////////////////////////////////



function addContent($action){   // function for add items in to page.
///////////////// variables /////////////////

/////////////////////Theme Menu///////////////////////////////////
$menuTop = '<table border="0" width="150" cellpadding="0" cellspacing="0">
<tr bgcolor="#CCCCCC">
<td width="24"><img src="images/boarder/blueLFT.png" width="25" height="22"></td>
<td width="100" background="images/boarder/blue.png" height="22" align="center"></td>
<td width="25"><img src="images/boarder/blueRHT.png" width="25" height="22"></td>
</tr>
	
<tr bgcolor="#CCCCCC">
<td width="24" bgcolor="#9DB6F4">&nbsp;</td>
<td width="100" bgcolor="#F5F7FE" align="center">';

$menuBot = '</td><td width="25" bgcolor="#9DB6F4">&nbsp;</td></tr>
<tr bgcolor="#CCCCCC">
<td width="24"><img src="images/boarder/blueLFT.png" width="25" height="22"></td>
<td width="100" background="images/boarder/blue.png" height="22" align="center"></td>
<td width="25"><img src="images/boarder/blueRHT.png" width="25" height="22"></td>
</tr>

</table>';
/////////////////////Theme Page///////////////////////////////////
$pageTop = '';

$PageBot = '';

////////////////////////// pathes////////////////
$modulePath = "module/";
$articlesPath = "articles/";
$pluginPath = "plugin/";
$menuPath = "menu/";

$theme = "";  // 0= no , 1= page ; 2 = menu;
$scfile=  "";

$txthold = array();
$txthold = split("@",$action);
if($txthold[0]=="MOD"){$scfile = $modulePath . $txthold[1]  .".php"; $theme = 1;}
else if($txthold[0]=="ART"){$scfile = $articlesPath . $txthold[1]  .".php"; $theme = 1;}  // REQUEST a article
else if($txthold[0]=="PLG"){$scfile = $pluginPath . $txthold[1]  .".php"; $theme = 0;} // REQUEST a plugin
else if($txthold[0]=="MNU"){$scfile = $menuPath . $txthold[1]  .".php"; $theme = 2;} // REQUEST a module
else if($txthold[0]==""){$scfile = $articlesPath .'welcome.php' ; $theme = 0;}  // default page


	  if(file_exists($scfile))   // if  file exits
	  {
		if($theme==1){echo $pageTop;}else if($theme==2){echo $menuTop;}   // adding top mask of theme
		include($scfile);  
		if($theme==1){echo $pageBot;}else if($theme==2){echo $menuBot;}   // adding bottom mask of the theme
	  }else { // if file not exists , due to wrong configurations .
		if(file_exists($articlesPath .'welcome.php')) { 
		include($articlesPath .'welcome.php');   // default page 
		}
	  }
	   
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Control Pannel</title>
<style type="text/css">
<!--
body {
 background-image:url(images/tile.jpg) margin: 0; /* it's good practice to zero the margin and padding of the body element to account for differing browser defaults */
	padding: 0;
	text-align: center;
	color: #000000;
	font:"Times New Roman", Times, serif;
	font-size:small;
}
.thrColFixHdr #container {
	width: 800px;  /* using 20px less than a full 800px width allows for browser chrome and avoids a horizontal scroll bar */
	background-image:url(images/hzline.png);
	margin: 0 auto; /* the auto margins (in conjunction with a width) center the page */
	border: 1px solid #000000;
	text-align: left; /* this overrides the text-align: center on the body element. */
}
.thrColFixHdr #header {
	background: #9DB6F4;
	padding: 0 10px 0 20px;  /* this padding matches the left alignment of the elements in the divs that appear beneath it. If an image is used in the #header instead of text, you may want to remove the padding. */
}
.thrColFixHdr #header h1 {
	margin: 0; /* zeroing the margin of the last element in the #header div will avoid margin collapse - an unexplainable space between divs. If the div has a border around it, this is not necessary as that also avoids the margin collapse */
	padding: 10px 0; /* using padding instead of margin will allow you to keep the element away from the edges of the div */
}
.thrColFixHdr #sidebar1 {
	float: left; /* since this element is floated, a width must be given */
	width: 150px; /* the actual width of this div, in standards-compliant browsers, or standards mode in Internet Explorer will include the padding and border in addition to the width */
	
	padding-top: 50px;
}
.thrColFixHdr #mainContent {
	margin-left:  170px;
	padding: 10px 10px;
}
.thrColFixHdr #footer {
	padding: 0 10px 0 20px; /* this padding matches the left alignment of the elements in the divs that appear above it. */
	background:#B0BFF4;
}
.thrColFixHdr #footer p {
	margin: 0; /* zeroing the margins of the first element in the footer will avoid the possibility of margin collapse - a space between divs */
	padding: 10px 0; /* padding on this element will create space, just as the the margin would have, without the margin collapse issue */
}
.clearfloat { /* this class should be placed on a div or break element and should be the final element before the close of a container that should fully contain a float */
	clear:both;
	height:0;
	font-size: 1px;
	line-height: 0px;
}
-->
</style>
</head>
<body background="images/tile.jpg" class="thrColFixHdr">
<div id="container">
  <div id="header">
    <table width="751">
      <tr>
        <td><div id="titel">
            <h1>Mooshak Theme Manager</h1>
          </div></td>
        <td align="right" ><div id="titelRight">
            <?php addContent("PLG@fontsize"); ?>
          </div></td>
      </tr>
    </table>
  </div>
  <!-- end of heder -->
  <div id="sidebar1" align="center" >
    <?php 
		addContent("MNU@content");
		addContent("MNU@file");
		addContent("MNU@user");
		addContent("MNU@about");
	?>
    <br/>
  </div>
  <div id="mainContent" align="center" >
    <p>
      <?php addContent($_REQUEST["action"]); ?>
      <br />
    </p>
    <!-- end #mainContent -->
  </div>
  <!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats -->
  <br class="clearfloat" />
  <div id="footer">
    <p>By hasitha aravinda @2010. mail : <a href="mailto:hasithatw@gmail.com">hasithatw@gmail.com </a></p>
    <!-- end #footer -->
  </div>
  <!-- end #container -->
</div>
</body>
</html>