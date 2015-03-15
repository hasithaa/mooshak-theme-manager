# Mooshak Theme Manager 1.0 #

_Copyright (C) January 2011  hasitha aravinda (Email: hasithatw@gmail.com )_

  1. [Copyright Notice](ReleaseNote#Copyright_Notice.md)
  1. [Introduction](ReleaseNote#Introduction.md)
  1. [Requirements](ReleaseNote#Requirements.md)
  1. [Configuration](ReleaseNote#Configuration.md)
  1. [Installation / Uninstallation ](ReleaseNote#Installation.md)
  1. [Running](ReleaseNote#Running.md)
  1. [Directory structure](ReleaseNote#Directory_structure.md)
  1. [Modules and plug-ins](ReleaseNote#Modules_and_plug-ins.md)



## Copyright Notice ##

Mooshak Theme Manager 1.0
a web based software to modify Mooshak's basic HTML view.
Copyright (C) January 2011  hasitha aravinda (Email: hasithatw@gmail.com )

This program is free software: you can redistribute it and/or modify it under the terms of  the GNU General Public License as published by the Free Software Foundation, version 3 of the License.

This program is distributed in the hope that it will be useful,but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program. If not, see http://www.gnu.org/licenses/ .


## Introduction ##

Thank you for downloading this application and hopefully you will find it of benefit to you.

This is a plug-in for Mooshak 1.5.
This system allows to administrator of the mooshak to add new Texts, Colorful backgrounds, and images to Mooshak's welcome web page. Also he/she can change the web interface of the mooshak ,editing the CSS files. This plug-in provides lot of feature to edit mooshak contents.






## Requirements ##

To install Mooshak Theme manager you must have a Linux server with the following packages installed

  * Tcl 8.3 or greater
  * Apache 1.2 or greater
  * Mooshak 1.5 (if you have working copy of mooshak, above Requirements are already satisfied)
  * PHP 5.0 or greater
  * a Web browser (recommended browser is Mozila firefox 3.x)



## Configuration ##
#### _important before installation_ ####



To install Mooshak Theme manager you must have to configure PHP for user directory (public\_html).  following tutorial tells how to configure it.

> ### How to run PHP files from ~/public\_html/ using Ubuntu. ###

Make user that you have installed php5 in your system. If not execute following commands in terminal.
```
sudo apt-get install php5
sudo a2enmod php5
```
first line install the php5 and second line enables PHP in apache server. Then restart apache using,
```
sudo /etc/init.d/apache2 restart
```
At this point, Apache and PHP are installed and ready to go.



I’m using ubuntu lucid distribution,
A recent update to the Lucid distribution, however, requires a slight change to /etc/apache2/mods-available/php5.conf to re-enable interpretation in users' home directories, but  previous distributions do not require this change.

Open give file using your favorite text editor. Here I am using gedit.
```
sudo gedit /etc/apache2/mods-available/php5.conf
```
Comment out (or remove) the following lines:
```
    <IfModule mod_userdir.c>
        <Directory /home/*/public_html>
            php_admin_value engine Off
        </Directory>
    </IfModule>
```
After doing this change, restart apache using,
```
sudo /etc/init.d/apache2 restart
```
At this point, PHP should be successfully installed and working.

But this method will enable PHP for all user directories. For security reason this method is not a good practice. One thing can do is enable only for one user directory. To do this, follow this procedure.

Do not edit `/etc/apache2/mods-available/php5.conf` file and create a file (as root) called `/etc/apache2/conf.d/php-in-homedirs.conf` with the following contents:
```
    <IfModule mod_userdir.c>
        <Directory /home/$USERNAME/public_html>
            php_admin_value engine On
        </Directory>
    </IfModule>
```


Simply replace the `$USERNAME` with the user name of the user you wish to allow PHP access to. Also note that the `<Directory>` section may be repeated as many times as is necessary. Save the file, and restart pache with a `sudo /etc/init.d/apache2 restart` and PHP should only be enabled for the users listed in this file.






## Installation ##

In installation process there are several steps. Follow following steps in installation process

1) configure user directory settings.
(see [Configuration](ReleaseNote#Configuration.md))
2) install using --install arguments

> i) get the root permission
```
$sudo su
```
> ii) unpack the MTM1\_0.tar
```
$tar xf MTM1_0.tar 
```

> iii) change in to  Final  directory
```
$cd Final
```
> iv) run install.sh file to install
```
$./install  --install 
```

to get help just type in terminal.
```
 $./install.sh 
```

usage of install :
```
 $./install [ --install | --uninstall | --delconfig ] [ -u|--user <user> ] 
```

Default user is mooshak. So no need to use "--user mooshak" again and again

Examples:
> instalation :
```
./install.sh --user mooshak --install
```
Delete install.php :
```
 ./install.sh --user mooshak --delconfig
```
uninstallation :
```
 ./install.sh --user mooshak --uninstall 
```

3) configure user login details via "http://your.machine/~mooshak/TM/"
> (recommended browser is Mozila firefox 3.x , if your browsing using same machine , your.machine is localhost or 127.0.0.1 )

4) remove installation files using --delconfig. (see second example)

5) access Plug-in via "http://your.machine/~mooshak/TM/"


#### Un-Installation ####

If you later decide to remove the Mooshak Theme Manager installation , follow following process

Un-installation process

1) remove files using --uninstall (see third example)


#### _Note_ ####

_If you have already a Mooshak installation in the user directory you specified then the install script will prevent installation to avoid damaging your data._










## Running ##


To start using Mooshak just open your favorite browser with the URL.

(if your browsing using same machine , your.machine is localhost or 127.0.0.1 . recommended browser is Mozila firefox 3.x; chromium is not recommended ; because found some compatibility issues in chromium browser )

> http://your.machine/~mooshak/TM/

(assuming you used the Mooshak default user; otherwise change the user name to the one you have chosen).







## Directory structure ##



  * articles
store articles in php mode. article gives information about program

  * assets
store other open source packages which are used in MTM

  * backup
to store backup files

  * config
store installation files.

  * data
store data of MTM.

  * images
store images

  * menu
store menus and their data (images etc.). Menus used to open the programs and articles

  * module
store modules and their data. Modules are the programs that used to edit contents.

  * plugin
store plugins and their data (images etc.) . Plugin are used to improve quality of the software






## Modules and plug-ins ##


  * Gamma CSS editor 0.2  (module/csseditor.php) author Hasitha aravinda
> a web based software to modify server side CSS files.

  * Front page Manager (module/front.php)
> a web based software to edit front.html page of the mooshak. it includes ckeditor(a The text editor for Internet) as supporting software.

  * Reset (module/reset.php)
> allows to reset backuped data of mooshak.

  * save and load (module/save.php)
> allows to download current index.html file of mooshak and allows to upload pre-designed index.html in to mooshak server.

  * File Uploader (module/upload.php)
> allows to uoload image files (only jpg,  gif and png are allowed and should be less than 200 KB ) and they are stored in /~mooshak/others/

  * File viewer (module/viewer.php)
> show a small view of uploaded images and allows to delete them and enlarge them.

  * Font resizer 0.1  (plugin/fontsize.php) author Hasitha aravinda
> this is client side application , which allows to resize font size in web pages.