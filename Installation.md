## Installation ##

In installation process there are several steps. Follow following steps in installation process

**1) configure user directory settings.**

(see [Configuration](Configuration#.md))


**2) install using --install arguments**

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

**3) configure user login details via "http://your.machine/~mooshak/TM/"**

(recommended browser is Mozila firefox 3.x , if your browsing using same machine , your.machine is localhost or 127.0.0.1 )

**4) remove installation files using --delconfig. (see second example)**

**5) access Plug-in via "http://your.machine/~mooshak/TM/"**


#### Un-Installation ####

If you later decide to remove the Mooshak Theme Manager installation , follow following process

Un-installation process

1) remove files using --uninstall (see third example)


#### _Note_ ####

_If you have already a Mooshak installation in the user directory you specified then the install script will prevent installation to avoid damaging your data._