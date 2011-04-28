<?php
/*
Gamma CSS editor 0.2  
++++++++++++++++++++++++++++++
module for Mooshak Theme Manager 1.0

programmer : Hasitha Aravinda.
email: hasithatw@gmail.com
+++++++++++++++++++++++++++++++


Gamma CSS editor 0.2
a web based software to modify server side CSS files.
Copyright (C) January 2011  hasitha aravinda (Email: hasithatw@gmail.com )

This program is free software: you can redistribute it and/or modify it under the terms of
 the GNU General Public License as published by the Free Software Foundation, version 3 of the License.

This program is distributed in the hope that it will be useful,but WITHOUT ANY WARRANTY; 
without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  
See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program. 
If not, see <http://www.gnu.org/licenses/>.


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
<style type="text/css">
table.sample {
	border-width: medium;
	border-spacing: 5px;
	border-style: groove;
	border-color: gray;
	border-collapse: separate;
	background-color: white;
}
table.sample th {
	border-width: medium;
	padding: 1px;
	border-style: none;
	border-color: gray;
	background-color: white;
	-moz-border-radius: 3px 3px 3px 3px;
}
table.sample td {
	border-width: medium;
	padding: 1px;
	border-style: none;
	border-color: gray;
	background-color: white;
	-moz-border-radius: 3px 3px 3px 3px;
}
</style>
<?php // mode = selector 
$flag_editerMode=0;

if($_REQUEST["mode"]=="0")  // mode = file selection
{
$currentFile = '../styles/' . $_REQUEST["file"];
$flag_editerMode=1;	
}
else if($_REQUEST["mode"]=="1")  // mode editor.
{
$currentFile = $_REQUEST["file"];  
$flag_editerMode=2;		
}
else if($_REQUEST["mode"]=="2")   // mode file save.
{
$currentFile = "";
$flag_editerMode=0;		
}
else if($_REQUEST["mode"]=="3")   // mode file view.
{
$currentFile = '../styles/' . $_REQUEST["file"];
$flag_editerMode=3;		
}
else if($_REQUEST["mode"]=="4")   // file edit from viewer.
{
$currentFile = $_REQUEST["file"];
$flag_editerMode=1;		
}


?>
<script src="assets/jscolor.js" type="text/javascript"></script>
<script>
function changeme(id, style1) {
	var newtext=document.getElementById(style1).value;
	document.getElementById(id).style.cssText = newtext + "position:static;"; // load modified css in to preview.
}
document.getElementById("movableDiv").style.behavior = "url(movable.htc)";
</script>
<?php // mode = editor 
if($flag_editerMode==1){
	
		
//if no style loaded load
	  $lines = file($currentFile);
	  $flag_para = 0;  // a flag: current line in the commented para (1) or not (0)
	  $flag_on_curlyBracket = false;  
	  
	  foreach ($lines as $line_num => $line) {
		 $text= trim($line);  
		 $final="";   
		 
		 for($i=0 ,$j=strlen($text);$i<$j;$i++)  // this code for remove comments in code.
		 {  
		 	if($text[$i]=='{')
			{ $flag_on_curlyBracket = true;
			}else if ($text[$i]=='}')
			{
				$flag_on_curlyBracket = false;
			}
		 
		 
				if(($text[$i]=='/')&&(!$flag_on_curlyBracket)){
					
					if($text[$i+1]=='/')  //to remove line coments 
					{
						break; // gotp next line
					}else if($text[$i+1]=='*') //to remove para coments 
					{
					$flag_para = 1;
					$i++;
					}
				
				}else if(($text[$i]=='*')&&(!$flag_on_curlyBracket)){   // to find end of para comment
					if($text[$i+1]=='/')
					{
					$flag_para = 0;
					$i++;
					}else{
					if($flag_para==0)
					$final .= $text[$i];
					}
				}
				else{
					if($flag_para==0)
					$final .= $text[$i];
				}
		 
		 }

	     $cssstyles .= $final; // making final stylesheet content.
	  }
	 //using strtok we remove the brackets around the css styles
	 $tok = strtok($cssstyles, "{}");
	 
	 //For example, the style: p{color:#000000;} now looks like this p color:#000000;
	  
	 //crete another array in which we will store tokenized string
	 $sarray = array();
	 //set counter
	 $spos = 0;
	 //with this while loop we are basically separating selectors from styles and store those values in the $sarray
	 while ($tok !== false) {
   	  //echo($spos . "-->" . $tok . "<br />");
	  $sarray[$spos] = $tok;
	  $spos++;
	    $tok = strtok("{}");
	 }
	 //if you run print_r($sarray); the result would be:
	 //Array   ( [0] => p [1] => color:#000000;
	 //   [2] => h1 [3] => font-size:18px;color:#666666;
	 //As you can see all selectors are stored in odd number positions of the array and styles in even.
	 //That is an important piece of information that we will use to to go through $sarray and store
	 
	 //all selectors in one array and styles in the other.
	  
	 // To start we need to get the size of $sarray
	 $size = count($sarray);
	  
	 //create selectors and styles arrays
	 $selectors = array();
	 $sstyles = array();
	  
	 //set counters
	 $npos = 0;
	 $sstl = 0;
	  
	 //a simple for loop with modulus operator will help us separate styles from selectors.
	 for($i = 0; $i<$size; $i++){
  if ($i % 2 == 0) {
	    $selectors[$npos] = $sarray[$i];
	    $npos++;   
	  }else{
	   $sstyles[$sstl] = $sarray[$i];
	   $sstl++;
	  }
	 }
	 
} //end of editor mode
?>
<!--  module css editor -->
<center>
  <p>&nbsp;</p>
  <p><strong>Gamma CSS Editor 0.2</strong></p>
</center>
<br />
<?php  // mode = file select 
if($flag_editerMode==0){
 echo '<br /><strong>select a style sheet for edit. </strong><br /><br />';
      
      
if ($handle = opendir('../styles')) {
/* reading form ../styles */
$val=0; // file counter
echo('<table width="500" border="0" align="center">');
    while (false !== ($file = readdir($handle))) {
		if(!($file=="." || $file==".." )) // avoid . & .. directories..
        { 
		$new = array();
		$new = explode("." , $file ,2);
		if(strnatcasecmp($new[1],"css")==0){  // seperate css files
		// making forms for files.
		$val = $val + 1;  // counting files

if($val%3==1)
echo('<tr>');
echo('<td >
<table width="150" cellspacing="5" border="0" align="center" style="border: 1px solid #dddddd; margin: 8px; padding: 10px; border-color:#333">
  
  <tr ><td width="150"height="50" align="center" >  <img src="images/css.png" ></td></tr>
  
  <tr><td width="150"><textarea readonly="readonly" style="width:100px; background:none; " rows="2" > '.$file.'</textarea> </td></tr>
  <tr><td>
  <table>
  <tr><td width="150" align="center" >
  <form id="form" name="form" method="post" action=' . $PHP_SELF . ' >
  <input name="mode" type="hidden" value="3" />
  <input name="file" type="hidden" value="'. $file .'" />
  <input type="submit" value="Open" />
  </form></td><td>
  <form id="form1" name="form" method="post" action=' . $PHP_SELF . ' >
  <input name="mode" type="hidden" value="0" />
  <input name="file" type="hidden" value="'. $file .'" />
  <input type="submit" value="Edit" />
  </form>
  </td></tr></table>
  </td></tr>
  </table>
  </td>');

if($val%3==0)  //controler: files per row 
echo('</tr>');

		}
		}
    }
echo('</table> <br />');	
    closedir($handle);
	if($val==0) // if no file found
	{
		echo('<img src="images/info.png"><br /><br /><b>OOpss .. no files found ..<br /><br />');
	}

} // style

 
	  
}// end of selection mode
?>
<?php  // mode = save    //reconstuct the css file without loosing comments and other informations. 
if($flag_editerMode==2)
{
	
	//if no style loaded load
  $lines = file($currentFile);
  foreach ($lines as $line_num => $line) {

     $cssstyles .= $line;
  }
 //using strtok we remove the brackets around the css styles
 
 $tok = strtok($cssstyles, "{}");
 //For example, the style: p{color:#000000;} now looks like this p color:#000000;
 
 //crete another array in which we will store tokenized string
 $sarray = array();
 //set counter
 $spos = 0;
 //with this while loop we are basically separating selectors from styles and store those values in the $sarray
 while ($tok !== false) {
  $sarray[$spos] = $tok;
  $spos++; 
    $tok = strtok("{}");
 }

    $result = array();
	for($i=0;$i<($spos/2);$i++){
	$word = "text".$i;
	$result[$i]= $_REQUEST[$word]."\n";
	}
	$final ="";
	for($i=0;$i<($spos);$i++)
	{
		if($i%2==1){
		$final .= "\n{\n".$result[$i/2]."}\n";
		}else
		$final .= $sarray[$i] ;
	}
	// saving file
	echo  '<table  width="500" class="sample" border="1">';
	
	$fhandle = fopen($currentFile,"w") or die("\n Error while saving");
	fwrite($fhandle,$final);
	fclose($fhandle);
	//display a file
	echo "Saving file :".$currentFile ." :OK<br />";
	echo '<textarea name="" cols="50" rows="25" readonly="readonly">'.$final.'</textarea></table>';


}
// end of file save.
?>
<?php  // mode = view    
if($flag_editerMode==3)
{
	
	
echo '	<table width="400px"><tr><td >Selected File:  '. $currentFile . '</td>
  <td width="20%">
  <form id="form" name="form" method="post" action=' . $PHP_SELF . ' >
  <input name="mode" type="hidden" value="4" />
  <input name="file" type="hidden" value="'. $currentFile .'" />
  <input type="submit" value="Edit" /></td>
  <td width="20%"><a href="main.php?action=MOD@csseditor"><input type="button" value="Select another File" ></a></td>
  </table> ';
	
echo "<br />";
if(file_exists($currentFile)){   // if file exists gets data from file.
$fhandle = fopen($currentFile,"r");
$msg = fread($fhandle,filesize($currentFile));
fclose($fhandle);

}

echo '<textarea name="" cols="50" rows="25" readonly="readonly">'.$msg.'</textarea></table>';


}
// end of file save.
?>
<?php  // mode = editor 
      if($flag_editerMode==1)
      {
		
		echo  '<form id="form" name="save" method="post" action=' . $PHP_SELF . ' >';
		echo '
		
		<div style=" height: 350px; background:#FFFFFF; position: fixed; border: 1px solid ; bottom: 20px; right: 10px;" >
		  <input name="file" type="hidden" value="'.$currentFile.'"  />
		  <input name="mode" type="hidden" value="1" />
		  <table width="200px" style="border: 1px solid #dddddd; margin: 8px; padding: 10px;  border-color:#333; background-color:#9CF;" >
			<tr><td width=80% ><strong>Gamma CSS Editor 0.2</strong> </td></tr>
			<tr><td >' .$currentFile.'</td></tr>
		  </table>
		   <table width="200px"  >
		  <tr><td width=50%><input type="submit" value="Save File"></td></tr>
		  <tr><td><a href="main.php?action=MOD@csseditor"><input type="button" value="Select another File" ></a></td></tr>
		  </table>
		  <table>
			<tr><td><p></p></td></tr>

			<tr><td>Css Colour Help</td></tr>
			<tr><td><input class="color {hash:true}"></td>
			</tr>
		  </table>
		</div>
		';
	 echo "<table  width='500' ><tr align='left'><td>";
	//	echo "<tr align='left'><td> <b>".$currentFile."</b> </td><td align='center'><input type='submit' value='Save'></td></tr>";
     //   echo '<input name="file" type="hidden" value="'.$currentFile.'"  /><input name="mode" type="hidden" value="1" />';
	 //
	  $fname = "data/sample.html";
	  $sample = "This is a test code";
	  if(file_exists($fname)){   // if file exists gets data from file.
		  $fhandle = fopen($fname,"r");
		  $sample = fread($fhandle,filesize($fname));
		  fclose($fhandle);
		  }
	 
	 for($i=0;$i < $npos;$i++) // reading individual block
	 {
	 $tword =""; 
	 $tok = strtok($sstyles[$i], ";");  //break in to lines.
		 while ($tok !== false) {
		  $tword = $tword . rtrim($tok) . ";\n";  
		  $tok = strtok(";");
		 }
	 echo "<tr align='left'><td>";
	 echo '<div style="border: 1px solid #dddddd; margin: 8px; padding: 10px;  border-color:#333; background-color:#FFF;"><table>';
	 $fuctionCode = '"Sample'.$i.'","text'.$i.'"'; // to make changeme's code.
	 echo "<tr align='left'><td><strong>" .$selectors[$i]. "</strong> <input type='button' value='Refresh Preview' onClick='changeme(".$fuctionCode.")'/></td></tr>";
	 echo "<tr align='left'><td><textarea name='text". $i.  "' id='text". $i.  "' rows='7' cols='30'>". $tword ."</textarea><br /></td><td width='250'  >";
	 echo '<div id="Sample'.$i.'" style="'. $tword .'position:static;">'. $sample .'</div></td></tr>'; // position:static; is used to avoid interference from position.
	 echo '</table></div></td></tr>';

	 } // end of reading individual block
	
echo  '</form></table>';

}
      
	  
?>
<!-- end of module -->
