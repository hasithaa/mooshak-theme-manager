<?php
/*
++++++++++++++++++++++++++++++
Mooshak Theme Manager 1.0
a web based software to modify Mooshak's basic HTML view.
 
Copyright (C) january 2011  hasitha aravinda

This program is free software: you can redistribute it and/or modify 
it under the terms of the GNU General Public License as published by
the Free Software Foundation, version 3 of the License.

This program is distributed in the hope that it will be useful,but 
WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY
or FITNESS FOR A PARTICULAR PURPOSE.  
See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along 
with this program.  If not, see <http://www.gnu.org/licenses/>.

by hasitha aravinda. (Email: hasithatw@gmail.com )
*/
?>
<?php
if(!file_exists("config/install.php")){
session_start();
if(isset($_SESSION['user']))  // cheak for user login status...
{
include('main.php');	  // if session sets
}else
{include('login.php');  // if session not set.
}
}else{
session_start();
if(isset($_SESSION['user'])){
session_destroy(); // to distroy if a session exists( somehow.)
}
echo 'Please wait.. page is redirecting to Installation page';
echo ('<meta http-equiv="refresh"	content="2; URL=config/install.php">');
}

?>
