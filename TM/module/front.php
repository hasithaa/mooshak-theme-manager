<?php
/*
Front page Editor 1.0 .
A Module.
Self Executable and No Outside execution. 
++++++++++++++++++++++++++++++
Mooshak Theme Manager 1.0

programmer : Hasitha Aravinda.
email: hasithatw@gmail.com
date: 18/12/2010
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
 
 
$Location = "others/";  // for front HTML use
$loca = "../others/";   // for php use..

?>

<?php // JAVA Scripts ?>
<script type="text/javascript" src="assets/ckeditor/ckeditor.js"></script>
<SCRIPT type="text/javascript">

 function changePicture()     // to chabge image dynamicaly.
 {
 var selection = document.form2.imagemenu.selectedIndex; //grabs what user selected
 if(document.form2.imagemenu.options[selection].value == "Mooshak Logo")
 {		document.form2.pic.src = "images/mooshak.gif"
 }else
 {
	 document.form2.pic.src = "<?php echo $loca;?>"  + document.form2.imagemenu.options[selection].value; //adds 'selection' to grab 'value'
 }
 }
 
 function set()				// to set hidden field valued to makesure that redirect using or not 
 {
 if(document.form2.cheak1.checked){
 document.form2.redirect.value = "ok";
 }else{
 document.form2.redirect.value = "";
 }
 }
</script>


<!--  start of module  -->
<center>
  <p>&nbsp;</p>
  <p><strong>Front Page Manager</strong></p>
</center>

<?php   // post data processing.
$flag_saved=0;  // flag to indicate whether in post message(1) mode or editor mode(0).

if($_REQUEST[imagemenu]!=""){   // if data are posted...
$flag_saved=1;
if($_REQUEST[imagemenu] == "Mooshak Logo")
 {	 //$file  = "images/Mooshak.gif"; 
	 $imgfile = 'icons/mooshak.gif';
 }else if($_REQUEST[imagemenu] == "None")
 {	 
  //$file  = ""; 
  $imgfile = '';
 }else{

	$imgfile = $Location . $_REQUEST[imagemenu];
}

// saving html file containg front data.
$fname = "data/front.html";
$fhandle = fopen($fname,"w");
fwrite($fhandle,$_REQUEST['txt_welcome']);
fclose($fhandle);

$rediect_meta ="";  // for meta tag : to redirect
if($_REQUEST["redirect"]=="ok"){
	$time = abs($_REQUEST['time']);
	if ($time=="" || $time<0 ){$time = 0;}
	$rediect_meta = "<meta http-equiv='refresh' content='". $time ."; URL=cgi-bin/execute'> ";
}
$imgdata = "";
if(!$imgfile==""){$imgdata = "<img src='" . $imgfile . "'> " ;}

// saving index.html file
$myFile = "../index.html";
//chmod($myFile,777); //set chmod 
$fh = fopen($myFile, 'w') or die("can't open file");
$stringData = "<html><head>  
<link rel='stylesheet' href='styles/base.css' type='text/css'>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'> " . $rediect_meta . "
</head>
<body>

<p>
<center>
<p>
<table width='50%' cellspacing='10' cellpadding='10' Id='Base'>
<tr><td>
". $imgdata .    $_REQUEST['txt_welcome'] . "


</td></tr>
</table>

</body>
</html>";

fwrite($fh, $stringData);   // writing index.html
fclose($fh);
echo('	
	 <form id="form" name="form" method="post" action=' . $PHP_SELF . ' >
  	 <input name="imagemenu" type="hidden" value="" />
	 <img src="images/ok.png"><br /><b> File is created </b> <br />
     <input type="submit" value="OK" />
     </form>
');
//chmod($myFile,654); //reset chmod 

}
// end of post execution mode.
?>



<?php // in editor mode.
if ($flag_saved==0)

{
// loading the data from the saved data file.
//reading html data.
$msg = "<b>Welcome to the Mooshak</b>";   // default msg. if file is not loaded
$fname = "data/front.html";
if(file_exists("data/front.html")){   // if file exists gets data from file.
$fhandle = fopen($fname,"r");
$msg = fread($fhandle,filesize($fname));
fclose($fhandle);
}

// making editor structure.
echo('
<form name="form2" method="post" action="'. $PHP_SELF .'" style="display:block;">
              <p>&nbsp;</p>
        <table width="500" border="0"  >
                <tr>
                  <td><strong>Select  a Logo:</strong></td>                  
                  <td width="73" align="center"><input type="submit" name="but_save" id="but_save" value="Save page" ></td>
                </tr>
                <tr>
                  <td height="55" align="center">
                    <p>Select an Welcome Image
                      <select name="imagemenu" id="jumpMenu" onChange="changePicture()">
                        <option>Mooshak Logo</option>
						<option>None</option>
						');
                                          
// creating the files list of uploads.
if ($handle = opendir($loca)) {
	/* reading form uploads */
    while (false !== ($file = readdir($handle))) {
		if(!($file=="." || $file==".." ))
        echo "<option>" . $file . "</option>";
    }
    closedir($handle);
}

echo('</select></p></td>
      <td align="center"><p>&nbsp;</p></td>
      </tr>
      <tr>
      <td height="123" align="center"><img src="images//mooshak.gif"  name="pic" border="0" ></td>
      <td>&nbsp;</td>
      </tr>
	  <tr>
      <td><p> 
           
             <input type="checkbox" name="cheak1" value="" checked onClick="set()"/>
             Redirect front page after 
			 <input name="redirect" type="hidden" value="ok" />
             <input type="text" name="time" id="time" value="10" />
           seconds
           <br />
           </p>
        <p>
          <input type="image" name="imageField" id="imageField" src="images/info.png" /> 
        </p>
        <p> if you are  not using &quot;Auto Redirect&quot; method, make sure that Enter a URL code (&quot;cgi-bin/execute&quot;) in welcome Message are for access to the Mooshak login. </p>
        <p>(see FAQ for more information.) </p>
        <p><br />
        </p></td>
      <td>&nbsp;</td>
      </tr>
      </table>
      <table>
      <tr>
         <td>           <strong>Enter Welcome Message here.</strong>
      </tr>
         <tr><!-- loading message -->
         <td height="300" width=500 align="center"><textarea name="txt_welcome" id="txt_welcome" cols="50" rows="20" >'. $msg .' </textarea>
		 <script>
		 CKEDITOR.replace( "txt_welcome" );
		 </script>
		 </td>
      </tr>
      </table>
      
      </form> 
');


}
// end of edotor mode.
?>

   
<!-- end of module -->
