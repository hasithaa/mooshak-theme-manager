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
sudo /etc/init.d/apache2 restart
```
At this point, Apache and PHP are installed and ready to go.



I’m using ubuntu lucid distribution,
A recent update to the Lucid distribution, however, requires a slight change to /etc/apache2/mods-available/php5.conf to re-enable interpretation in users' home directories, but  previous distributions do not require this change.

Open give file using your favorite text editor. Here I am using gedit.
```
sudo gedit /etc/apache2/mods-available/php5.conf
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
sudo /etc/init.d/apache2 restart
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


Simply replace the `$USERNAME` with the user name of the user you wish to allow PHP access to. Also note that the `<Directory>` section may be repeated as many times as is necessary. Save the file, and restart pache with a `sudo /etc/init.d/apache2 restart` and PHP should only be enabled for the users listed in this file.