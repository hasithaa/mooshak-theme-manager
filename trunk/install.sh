#!/bin/sh
# the next line restarts using tclsh \
PATH=$PATH:/usr/local/bin:/usr/contrib/bin  ; exec tclsh "$0" "$@"
#
# Mooshak Theme Manager 1.0			December 2010
# 
#			Hasitha Aravinda 		
#			hasithatw@gmail.com
#
#-----------------------------------------------------------------------------
# file: install
# 
## Installation procedure
##

set User	"mooshak"
set rot		"/home/$User/public_html/"
set Data	source.tar
set installed 	""


# checks user for install
proc check_user {} {
global User
global rot
puts -nonewline "Searching $User user             :"
if [ nouser $User ]  {
	puts "fail"
	puts stderr "Installation aborted"
	exit
} else {
	puts "done"
	set rot	"/home/$User/public_html/"
} 

}

# uname is not defined in /etc/passwd ?
proc nouser {uname} {

    return [ catch { exec grep ^${uname}: /etc/passwd } ]
}
# shift argv to the left
proc shift {} {
    global argv
    set argv [ lrange $argv 1 end ]
}

# process a command line argument pair
proc read_arg {name var_ {type ""}} {
    global argv
    upvar $var_ var

    if { [ set var [ lindex $argv 1 ] ] == "" } {
	puts stderr "no $name defined"
	exit 1
    } elseif { ! [ regexp $type $var ] } {
	puts stderr "invalid $name $var"
	exit 1
    } else {
	set argv [ lrange $argv 2 end ]
    }
}

# returns principal group from given user
proc group {} {
    global User 
    
    set groups [ lindex [ split [ exec groups $User ] : ] 1 ]
    return [ string trim [ lindex $groups 0 ] ]
}

# Copy/exact files
proc copy {} {
    global User
    global Data
    global rot
puts -nonewline "File source reading                :"
	if [ file readable $Data ] {
		puts "done"
		puts -nonewline "Files coping                       :"
		if { [catch { exec cp $Data $rot } msg] } {}
	
		if { [ string trim $msg ] != "" } {
			puts "fail"
			puts stderr "Installation aborted"
			puts stderr $msg
			exit
		} else { #file copy - ok
			puts "done"
			cd $rot
			puts -nonewline "Files extracting                   :"
			if { [catch { exec tar -xf $Data } msg] } {
			}
			if { [ string trim $msg ] != "" } {
				puts "fail"
				puts stderr "Installation aborted"
				puts stderr $msg
				exit
			} else { #file extract - ok
				puts "done"
				puts -nonewline "Tempary files deleting             :"
				if { [catch { exec rm $Data  } msg] } {}
				if { [ string trim $msg ] != "" } {
					puts "fail"
					puts stderr "Installation aborted"
					puts stderr $msg
					exit
				} else { #file delete - ok
					puts "done"
				}
			}

		}
	} else {
	puts "fail"
	puts stderr "Installation aborted"
	exit
	}

}

#set Directories
proc makeDir {} {

global User
global rot

puts -nonewline "Creating Directoiry others         :"
if { [ catch {
	cd $rot
	exec mkdir others
	exec chown -R $User.[ group ] "others/"
	exec chmod -R 0777 "others/"
    } msg ] } { }
if { [ string trim $msg ] != "" } {
puts "Fail"
puts stderr $msg
} else { 
puts "done"
}

}

#set permistions
proc permission {} {

global User
global rot

puts -nonewline "Setting file permissions           :"
if { [ catch {
	cd $rot
	exec chmod 755 "TM/"
	exec chown -R $User.[ group ] "TM/"
	exec chmod -R ug+rwx "TM/"
	exec chmod -R 0777 "styles/"
	exec chmod 0777 "index.html"
    } msg ] } { }
if { [ string trim $msg ] != "" } {
puts "Fail"
puts stderr $msg
exit
} else { 
puts "done"
}


}


#remove install.php
proc delcon {} {

global User
global rot

puts -nonewline "Removing installation files        :"
if { [ catch {
	cd "$rot/TM/config/"
	exec rm "install.php"
	cd ..
	exec rmdir "config/"
    } msg ] } { }
if { [ string trim $msg ] != "" } {
puts "Fail"
puts stderr $msg
exit
} else { 
puts "done"
}


}



#set preparing install
proc prepare {} {
global rot
global installed

if { [ file readable "$rot/TM/index.php" ] } {
	set installed "yes"
    } else {    
	set installed "no"
    }

}

# welcome msg
proc welcome {} {
global installed

puts stderr {
Welcome To Mooshak Theme manager files Installation

_________________Process stated_______________
}

check_user
prepare
if { $installed== "yes" } {
puts stderr {"Mooshak Theme manager's files are already installed."
installation action abort....
}
	exit 
}



}

# welcome msg2
proc welcome2 {} {
global installed
global rot

puts stderr {
Welcome To Mooshak Theme manager Installation
Final Step:
_________________Process stated_______________
}

check_user
prepare
if { $installed== "no" } {
puts stderr {"Mooshak Theme manager's files are not installed or missing files."
installation action abort....
}
	exit 
}


if { [ file readable "$rot/TM/config/install.php" ] } {
puts stderr "searching installation files       :done"
    } else {
puts stderr {"Intallation file is missing or already ran delconfig."
installation action abort....
}
	exit 

} 

}

# final installation msg
proc finalMsg {} {
global User
puts stderr {

File installation seems ok 
}


	puts stderr "Access Pluging via http://localhost/~$User/TM/"
	puts stderr ""
	puts stderr "After adding details , run ./install.sh --user $User --delconfig to complete installation"
	puts stderr ""
}

# final installation msg
proc finalMsg2 {} {
global User
puts stderr {

Theme Manager installation seems ok 
}
puts stderr "Access Pluging via http://localhost/~$User/TM/"
	
}



#help function
proc help {} {
global User

puts stderr {

***********************MOOSHAK THEME MANAGER INSTALLATION***********************
by Hasitha Aravinda , mail: hasithatw@gmail.com 

Before installation Mooshak Theme Manager plug-in,
(*) configure PHP settings: user directory("Read readme.txt for instructions"). 

usage: install [ --install | --uninstall | --delconfig | --help ] [ -u|--user <user> ] 

Default user is mooshak. So no need to use "--user mooshak" again and again 

Examples:
1) instalation : ./install.sh --user mooshak --install
2) Delete install.php : ./install.sh --user mooshak --delconfig
3) uninstallation : ./install.sh --user mooshak --uninstall 

Follow follwing steps in installation process

1) configure user directory settings
2) install using --install arguments (see example 1)
3) configure user login details via "http://localhost/~mooshak/TM/"
4) remove installation files using --delconfig. (see example 2)
5) access Plug-in via "http://localhost/~mooshak/TM/"

unstallation process

1) remove files using --uninstall (see example 3)


*********************************End of Help***********************************
}
    
}
#delete configuration files process
proc delconfig {} {  welcome2; delcon; permission; finalMsg2 }

#installation process
proc install {} { welcome; copy ; makeDir; permission ;  finalMsg }

#uninstallation process
proc uninstall {} { 
global installed
global rot
puts stderr {
Welcome To Mooshak Theme manager Uninstallation

_________________Process stated_______________
}

check_user
prepare
if { $installed== "no" } {
	puts stderr {"Mooshak Theme manager's files are not installed or missing files."
Note: uninstallation action may has errors ....
}
	 
}
puts -nonewline "uninstallation                     :"
if { [ catch {
	cd $rot
	set backup "TM-backup.tgz"
	puts stderr "Creating a backup: $backup "
	exec tar czf $backup "TM/" "others/"
	exec rm -R "TM/"
    } msg ] } { }
if { [ string trim $msg ] != "" } {
puts "Fail"
puts stderr $msg
exit
} else { 
puts "done"
}


puts stderr "End of uninstallation process"
}

# proccess command line argument and execute action
proc process {} {
    global argv
    global User

    set action help
    while { $argv != "" } {
	switch -- [ lindex $argv 0 ] {
	    --user		{ read_arg user User {^[a-z][-a-z0-9]+$} }

	    --delconfig		{ set action delconfig 	; shift }
	    
	    --uninstall 	{ set action uninstall	; shift }
	    
	    --install		{ set action install	; shift	}
	    		    
	    --help - default 	{ set action help ; shift }	    
	}
    }

    $action
}

# move to installation directory
cd  [ file dirname [ info script ] ]

## avoid string equal before testing if tclsh is >= 8.3
if { [ string compare [ exec whoami ] root ] == 0 } {
    process
    exit 0
} else {
    puts stderr "You have to be root to install This plug-in"
    exit 1
}

