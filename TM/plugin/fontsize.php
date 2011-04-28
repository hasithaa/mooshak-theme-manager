<?php
/*
font resizer 0.1  
++++++++++++++++++++++++++++++
plugin for Mooshak Theme Manager 1.0

programmer : Hasitha Aravinda.
email: hasithatw@gmail.com
+++++++++++++++++++++++++++++++


Font resizer 0.1 
a client side web based plugin, allows resize webpage's font size.
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
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME']))
{
// tell people trying to access this file directly goodbye...
exit("This file is restricted from direct access");
}
//Rest of the code in your file comes after this

?>
<?php
/*
Installation: 
include this php file in to your web application. 

Configuration:
only change the $fontsizeFolder variable; it should include images paths from root folder.

if you see broken links in this plugin ; it shold be wrong configuration of $fontsizeFolder variable.

give me your suggestions; mail me : hasithatw@gmail.com    

*/
?>



<script>
// java script for text size changer buttons.

var tgs = new Array( 'div','td','tr','textarea');

//Specify spectrum of different font sizes:
var szs = new Array( 'xx-small','x-small','small','medium','large','x-large','xx-large' );
var startSz = <?php 
if(isset($_COOKIE["FontSize"]))  // if  cokkie is set
{echo $_COOKIE["FontSize"]; 
}
else
{
echo "3";  // default value.
}
?>

function ts( trgt,inc ) {
	if (!document.getElementById) return
	var d = document,cEl = null,sz = startSz,i,j,cTags;
	sz += inc;
	
	if ( sz < 0 ) {sz = 0;}   // make sure that not going beyond the array limits.
	if ( sz > 6 ){ sz = 6;}
	
	startSz = sz;
	document.cookie = "FontSize=" + sz ;
	if ( !( cEl = d.getElementById( trgt ) ) ) cEl = d.getElementsByTagName( trgt )[ 0 ];
	cEl.style.fontSize = szs[ sz ];
	for ( i = 0 ; i < tgs.length ; i++ ) {
		cTags = cEl.getElementsByTagName( tgs[ i ] );
		for ( j = 0 ; j < cTags.length ; j++ ) cTags[ j ].style.fontSize = szs[ sz ];
	}
}


</script>



<?php
// this variable should follow this nameing convention: plugin_name+"Folder"
$fontsizeFolder = "plugin/" ;  // images paths from root folder. 
?>

<script>ts("body",0);  // calling ts to set previous font size.
</script>
<a href="javascript:ts('body',1)"><img src="<?php echo $fontsizeFolder;?>fontIn.jpg" border="0" /> </a>
<a href="javascript:ts('body',-1)"> <img src="<?php echo $fontsizeFolder;?>fontDe.jpg" border="0" /></a> 

