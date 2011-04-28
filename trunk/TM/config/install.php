<?php
/*

installer.
++++++++++++++++++++++++++++++
Mooshak Theme Manager 1.0

programmer : Hasitha Aravinda.
email: hasithatw@gmail.com
*/
?>
<?php
$mode=0;
$flagError = "";

if($_REQUEST["mode"]=="1")  // mode login
{
$mode =1;
}
else if($_REQUEST["mode"]=="2")   // mode login validation
{
$mode =2;		
}else if($_REQUEST["mode"]=="3")   // mode backup.
{
$mode =3;		
}


function msgWelcome(){ // print html taggs related to welcome message
echo '
<center>
  <form id="form" name="form" method="post" action="' . $PHP_SELF . '"  >
    <p>
    <h2 >Welcome to the Installation of Mooshak Theme Manager. Press Next button to continue .</h2 >
    </p>
    <input name="mode" type="hidden" value="1" />
    <input name="" type="submit" value=" Next &gt;&gt;" />
  </form>
</center>
';
}

function msgLogin(){	// print html taggs related to login message
echo '
<p>
<h3 >Step 2:User Registration.</h3 >
</p>
<center>
  <p>
  <h3 >Enter your Login Details here..</h3 >
  </p>
  <form id="form1" name="form1" method="post" action="' . $PHP_SELF . '"   >
    <table width="400" border="0">
      <tr>
        <td width="100"><label>User Name</label></td>
        <td width="200"><input name="valUser" type="text" value="" width="200"/></td>
      </tr>
      <tr>
        <td><label>Password</label></td>
        <td><input name="valPass" type="password" value="" width="200"/></td>
      </tr>
      <tr>
        <td><label>Re Enter Password</label></td>
        <td><input name="valPass2" type="password" value="" width="200" /></td>
      </tr>
      <tr>
        <td height="77" align="right">&nbsp;</td>
        <td><p>
          <h3 >!Note : NO : &amp; , &lt; , &gt; , @ letters in any fields ..</h3 >
          <br />
          <input name="mode" type="hidden" value="2" />
          <input name="save" type="submit" value=" Save &gt;&gt;"  />
          </p></td>
      </tr>
    </table>
  </form>
</center>
';
}

function cheakPass(){
	if(($_REQUEST["valPass"]!="")&&($_REQUEST["valPass2"]!="")&&($_REQUEST["valUser"]!=""))
	{
		if($_REQUEST["valPass"]==$_REQUEST["valPass2"])
		{ // all are ok
			
			$str = 'This is an encoded string of@user@' . $_REQUEST["valUser"]. "@pass@" . $_REQUEST["valPass2"] ;   // he he. a funny way to   encodd a msg.
			$fname = "../data/user.dat";
			$fhandle = fopen($fname,"w");
		fwrite($fhandle,base64_encode($str));
		fclose($fhandle);		
		return 3;	
		}else{
		echo  "<h3 style='color:#F00' >Warning! Password miss match.</h3 ><br/>";	
		return 1;
		}
	}else{
	echo  "<h3 style='color:#F00'>Warning! some Field(s) are empty. </h3><br/>";
	return 1;
	}
}


function backup(){
 	echo '<p><h3>Step 3: Taking Backup.</h3></p>  <center>';
	
	$file  = "../../index.html"; 
	$newfile = "../backup/index.html";
	if (!copy($file, $newfile)) {
	echo "failed to copy  index.html...<br />";
	$flagError = "yes";
	}
	
	if(!file_exists("../backup/styles")){	mkdir($Location);}
	
	if ($handle = opendir("../../styles/")) {
	  // reading form source

	  while (false !== ($file = readdir($handle))) {
		$new = array();
		$new = explode("." , $file ,2);
		if(strnatcasecmp($new[1],"css")==0){  // seperate css files
			
		  $scfile  = "../../styles/" . $file; 
		  $newfile = "../backup/styles/" . $file;

		  if (!copy($scfile, $newfile)) {
		  echo "failed to copy " . $file ."<br />";
		  $flagError = "yes";
		  }
	  	}
	  }
	  closedir($handle);

	}
	
}

function msgFinal(){
if($flagError == ""){
echo "<center> 	 
<p><h2>Congratualation ..</h2></p><p><h3> Mooshak Theme Manager's installation process complete. Type './install.sh --delconfig' in terminal to finish the installation process . <br />login to <a href='../index.php'>Mooshak Theme Manager</a></h3></p></center> ";	
} else {
echo "<center> 	
<p><h3>Some error(s) are detected in backup process ..This will cause to malfunction of Reset module.</h3></p><p><h3> Mooshak Theme Manager's installation process complete. Type './install.sh --delconfig' in terminal to finish the installation process. <br />login to <a href='../index.php'>Mooshak Theme Manager</a></h3></p></center> ";		
}

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Installation</title>
<style type="text/css">
<!--
body {
	padding: 0;
	text-align: center;
	color: #000000;
	font:"Times New Roman", Times, serif;
	font-size:small;
}
.twoColElsRt #container {
	width: 50em;  /* this width will create a container that will fit in an 800px browser window if text is left at browser default font sizes */
	background: #FFFFFF;
	margin: 0 auto; /* the auto margins (in conjunction with a width) center the page */
	border: 1px solid #000000;
	text-align: left; /* this overrides the text-align: center on the body element. */
}
.twoColElsRt #sidebar1 {
	float: right;
	width: 12em; /* since this element is floated, a width must be given */
	background: #69C; /* the background color will be displayed for the length of the content in the column, but no further */
	padding: 15px 0; /* top and bottom padding create visual space within this div */
}
.twoColElsRt #sidebar1 h3, .twoColElsRt #sidebar1 p {
	margin-left: 10px; /* the left and right margin should be given to every element that will be placed in the side columns */
	margin-right: 10px;
}
.twoColElsRt #mainContent {
	margin: 0 13em 0 1.5em; /* the left margin can be given in ems or pixels. It creates the space down the left side of the page. */
}
/* Miscellaneous classes for reuse */
.fltrt { /* this class can be used to float an element right in your page. The floated element must precede the element it should be next to on the page. */
	float: right;
	margin-left: 8px;
}
.fltlft { /* this class can be used to float an element left in your page */
	float: left;
	margin-right: 8px;
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
<body background="../images/tile.jpg" class="twoColElsRt" >
<div id="container">
  <div id="sidebar1">
    <h3 >steps</h3>
    <p>1) Welcome</p>
    <p>2) Enter Login Details</p>
    <p>3) Backup/ Final
      <!-- end #sidebar1 -->
    </p>
  </div>
  <div id="mainContent">
    <h2> Installation of Mooshak Theme Manager</h2>
    <p>&nbsp;</p>
    <p>
      <?php
if(!file_exists("../data/user.dat")){  // if setup already run
    if($mode==0)  /// welcome msg step 1
	{
		msgWelcome();
	}else if($mode==1) // make login form step 2
	{ 
		msgLogin();
	} else if($mode==2){
       $mode = cheakPass();  // login details validation
	   if($mode==3){  // taking backup step 3
			backup();
			msgFinal();
		}else{
			msgLogin();
		}
	}
}else {
echo "<center> 	 
<p><h2>Mooshak Theme Manager installation process seems as complete.</h2> </p>
<p><h3> Type './install.sh --delconfig' in terminal to finish the installation process . <br />login to <a href='../index.php'>Mooshak Theme Manager</a></h3></p></center> ";	

}
	
?>
      <!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats -->
    </p>
    
    <!-- end #mainContent -->
  </div>
  <p><br class="clearfloat" />
  </p>
  <!-- end #container -->
</div>
</body>
</html>
