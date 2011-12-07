Narga's Guestbook MODULES FOR XOOPS PORTAL 2.X
==============================================

*********************************** IMPORTANT NOTES *****************************************
        This software is freeware. You don't have the permission to sell this product to anyone! The copyright in the footer must seeable (only not if you have purchased a Non-Copyright-Version). 
        Also if you changed the Code or use your own Hackz! With remove of the Copyright you agree that you must buy the Non-Copyright-Version. 
        [:: Narga Laboratory ::] don't liable for damages in all ways. 
        Furthermore we must clue that [:: Narga Laboratory ::] and his employees are not responsible for any textcontents.
*********************************************************************************************

Contents:
--------

0. Announcement.
1. Availability
2. Requirements and feature
3. History
4. Step by step to installation
5. Support and Documentation
6. Author & Copyright


Announcement:
-------------

        After 3 months of work and 4 release candidate versions,the [:: Narrga Staffs ::] are pleased to announce the availability of Narga's Guestbook modules for Xoops Portal 2.x !

Availability
------------

        This software is available under the GNU General Public License V2.0.
        You can get the newest version at http://www.narga.tk/
        Available file formats are: *.zip, *.tar.gz and *.rar.

        If you install Vietnamese language package on your system, it's recommended to subscribe to the news mailing list by adding your address under [http://www.narga.tk]

        This way, you will be informed of new updates and security fixes. It is a read only list, and traffic is not greater than a few mail every year.

Requirements:
-------------
        Xoops Portal 2.x forum installed.
        PHP3 (>= 3.0.8) or PHP4
        MySQL (tested with 3.21.x, 3.22.x, 3.23.x and 4.0.x) a web-browser (doh!)
    
        Feature :
                - Allow bbcode and smile.
                - Show YIM, AIM, MSN, ICQ, Email, Homepage in each entry
                - Uses Smarty Templates in the Xoops platform

History:
--------

        - Read the Changes-log.txt file to get detail

Step by step to installation :
-----------------------------

        - unzip file to html/modules/ directory the upload to your server
        - go to the admin control panel to install this modules
        - DO NOT remove the Copyright note ! Thanks !

	If you want a "Sign" link at main menu you can edit the xoops_version.php as:
	add this line
	$modversion['sub'][1]['name'] = _NAR_SIGNGUESTBOOK;
	$modversion['sub'][1]['url'] = "sign.php";
	below
	// Menu
	$modversion['hasMain'] = 1;

Support and Documentation
-------------------------

        The documentation is included in the software package as text and HTML file.
        All the error you have can solve on [:: Narga Vault::] http://www.narga.tk or contact me at webmaster@narga.tk .

Author & Copyright
------------------

    Copyright (C) 2002-2003 Nguyen Dinh Quan - Narga's Guestbook is a produce
    of [:: Narga Laboratory ::] - http://www.nargalab.info
    <webmaster_at_narga.tk>
    webmaster@narga.tk
    http://www.narga.tk

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License (include in this
    folder) as published by the Free Software Foundation; either version
    2 of the License, or (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

Last update : 8/27/2004 11:25 PM by Nguyen Dinh Quan.