Mooshak Theme Manager 1.0
Copyright (C) January 2011  hasitha aravinda (Email: hasithatw@gmail.com )

	M     M	  TTTTTTTTT    M     M	      111          000
	MM   MM       T        MM   MM	      1 1         0   0
	M M M M       T        M M M M		1        0     0
	M  M  M       T        M  M  M 		1        0     0
	M     M       T        M     M		1   ..    0   0
	M     M       T        M     M		1   ..     000


Readme.txt includes

1) Copyright Notice   
2) Introduction
3) Requirements
4) Configuration
5) Installation / uninstallation 
6) Running
7) Directory structure
8) Modules and plugins



1) Copyright Notice    
===========================================================================================
Mooshak Theme Manager 1.0
a web based software to modify Mooshak's basic HTML view.
Copyright (C) January 2011  hasitha aravinda (Email: hasithatw@gmail.com )

This program is free software: you can redistribute it and/or modify it under the terms of
 the GNU General Public License as published by the Free Software Foundation, version 3 of the License.

This program is distributed in the hope that it will be useful,but WITHOUT ANY WARRANTY; 
without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  
See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program. 
If not, see <http://www.gnu.org/licenses/>.

===========================================================================================





2) Introduction
===========================================================================================
Thank you for downloading this application and hopefully you will find it of benefit to you.

This is a plug-in for Mooshak 1.5.
This system allows to administrator of the mooshak to add new Texts, Colorful backgrounds, 
and images to Mooshak's welcome web page. Also he/she can change the web interface of the 
mooshak ,editing the CSS files. This plug-in provides lot of feature to edit mooshak contents.

===========================================================================================




3) Requirements
===========================================================================================
To install Mooshak Theme manager you must have a Linux server with the following
 packages installed 

	 *) Tcl 8.3 or greater 
	 *) Apache 1.2 or greater
	 *) Mooshak 1.5 (if you have working copy of mooshak, above Requirements are already satisfied)
	 *) PHP 5.0 or greater
	 *) a Web browser (recommended browser is Mozila firefox 3.x , chromium is not recommended ; because found some compatibility issues in chromium browser )

===========================================================================================






4) Configuration. <important before instalation>
===========================================================================================
To install Mooshak Theme manager you must have to configure PHP for user directory (public_html)

follow following tutorial to configure  it. 

	****How to run PHP files from ~/public_html/ using Ubuntu.****

Make user that you have installed php5 in your system. If not execute following commands in terminal.

sudo apt-get install php5
sudo a2enmod php5

first line install the php5 and second line enables PHP in apache server. Then restart apache using,

sudo /etc/init.d/apache2 restart

At this point, Apache and PHP are installed and ready to go.



I’m using ubuntu lucid distribution, 
A recent update to the Lucid distribution, however, requires a slight change to /etc/apache2/mods-available/php5.conf to re-enable interpretation in users' home directories, but  previous distributions do not require this change.

Open give file using your favorite text editor. Here I am using gedit.

sudo gedit /etc/apache2/mods-available/php5.conf

Comment out (or remove) the following lines: 
    <IfModule mod_userdir.c>
        <Directory /home/*/public_html>
            php_admin_value engine Off
        </Directory>
    </IfModule>

After doing this change, restart apache using,

sudo /etc/init.d/apache2 restart

At this point, PHP should be successfully installed and working.

But this method will enable PHP for all user directories. For security reason this method is not a good practice. One thing can do is enable only for one user directory. To do this, follow this procedure.

Do not edit /etc/apache2/mods-available/php5.conf file and create a file (as root) called /etc/apache2/conf.d/php-in-homedirs.conf with the following contents: 
    <IfModule mod_userdir.c>
        <Directory /home/$USERNAME/public_html>
            php_admin_value engine On
        </Directory>
    </IfModule>

Simply replace the $USERNAME with the user name of the user you wish to allow PHP access to. Also note that the <Directory> section may be repeated as many times as is necessary. Save the file, and restart Apache with a sudo /etc/init.d/apache2 restart and PHP should only be enabled for the users listed in this file.

===========================================================================================






5) Installation    
===========================================================================================
In installation process there are several steps. Follow follwing steps in installation process

1) configure user directory settings. 
(see (4) configurations )
2) install using --install arguments 

	i) get the root permission 
	 	$sudo su
	ii) unpack the MTM1_0.tar 
	 	$tar xf MTM1_0.tar 

	iii) change in to  Final  directory 
		$cd Final
	iv) run install.sh file to install 
		$./install  --install 

{ to get help just type $./install.sh in terminal. }

usage of install : install [ --install | --uninstall | --delconfig ] [ -u|--user <user> ] 

Default user is mooshak. So no need to use "--user mooshak" again and again 

Examples:
*) instalation : ./install.sh --user mooshak --install
*) Delete install.php : ./install.sh --user mooshak --delconfig
*) uninstallation : ./install.sh --user mooshak --uninstall 


3) configure user login details via "http://your.machine/~mooshak/TM/"
  (recommended browser is Mozila firefox 3.x , if your browsing using same machine , your.machine is localhost or 127.0.0.1 )

4) remove installation files using --delconfig. (see example 2)

5) access Plug-in via "http://your.machine/~mooshak/TM/"


****************************end of installation process**********************************

If you later decide to remove the Mooshak Theme Manager installation , follow following process

Un-installation process

1) remove files using --uninstall (see example 3)


****************************end of uninstallation process**********************************


If you have already a Mooshak installation in the user directory you specified
then the install script will prevent installation to avoid damaging your data.



===========================================================================================







6) Running
===========================================================================================

To start using Mooshak just open your favorite browser with the URL.

(if your browsing using same machine , your.machine is localhost or 127.0.0.1 )
(recommended browser is Mozila firefox 3.x; chromium is not recommended ; because found some compatibility issues in chromium browser )    

	http://your.machine/~mooshak/TM/ 

(assuming you used the Mooshak default user; othewise change the user
name to the one you have choosen).
===========================================================================================






7) Directory structure
===========================================================================================


	articles	store articles in php mode. article gives infomation about program
	assets		store other open source packages which are used in MTM 
	backup		to store backup files
	config		store installation files.
	data		store data of MTM. 
	images		store images
	menu		store menus and thire data (images etc.). menus used to open the programs and articles
	module		store modules and thire data (images etc.). modules are the programs that used to edit contents.
	plugin		store plugins and thire data (images etc.) . plugin are used to improve quality of the software

===========================================================================================





8) Modules and plugins
===========================================================================================

Gamma CSS editor 0.2  (module/csseditor.php) author Hasitha aravinda
	a web based software to modify server side CSS files.

Front page Manager (module/front.php)
	a web based software to edit front.html page of the mooshak. it includes ckeditor(a The text editor for Internet) as supporting software. 

Reset (module/reset.php)
	allows to reset backuped data of mooshak.

save and load (module/save.php)
	allows to download current index.html file of mooshak and allows to upload pre-designed index.html in to mooshak server.

File Uploader (module/upload.php)
	allows to uoload image files (only jpg,  gif and png are allowed and should be less than 200 KB ) and they are stored in /~mooshak/others/

File viewer (module/viewer.php)
	show a small view of uploaded images and allows to delete them and enlarge them.

Font resizer 0.1  (plugin/fontsize.php) author Hasitha aravinda		
	this is client side application , which allows to resize font size in web pages.

===========================================================================================





