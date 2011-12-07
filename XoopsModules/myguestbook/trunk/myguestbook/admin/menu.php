<?php
###############################################################################
#                  Narga's Guestbook v.2.0 for Xoops 2.x                      #
#             Writen by  Nguyen Dinh Quan (webmaster@narga.tk)                #
#      .: Narga Vault :-: The Land Of Dreams :.(http://www.narga.tk)          #
#   ------------------------------------------------------------------------- #
#                                                                             #
#   ------------------------------------------------------------------------- #
#   This program is free software; you can redistribute it and/or modify      #
#   it under the terms of the GNU General Public License as published by      #
#   the Free Software Foundation; either version 2 of the License, or         #
#   (at your option) any later version.                                       #
#                                                                             #
#   This program is distributed in the hope that it will be useful,           #
#   but WITHOUT ANY WARRANTY; without even the implied warranty of            #
#   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the             #
#   GNU General Public License for more details.                              #
#                                                                             #
#   You should have received a copy of the GNU General Public License         #
#   along with this program; if not, write to the Free Software               #
#   Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA  #
#   ------------------------------------------------------------------------  #
###############################################################################
// $Id: menu.php,v 2.0 Date: 05/12/2011, Author: Nguyen Dinh Quan Exp 

defined("XOOPS_ROOT_PATH") or die("XOOPS root path not defined");

$dirname = basename(dirname(dirname(__FILE__)));
$module_handler = xoops_gethandler('module');
$module = $module_handler->getByDirname($dirname);
$pathIcon32 = $module->getInfo('icons32');

xoops_loadLanguage('admin', $dirname);

$i = 0;

// Index
$adminmenu[$i]['title'] = _MI_NAR_GUESTBOOK_ADMIN0;
$adminmenu[$i]['link'] = "admin/index.php";
$adminmenu[$i]["icon"] = '../../'.$pathIcon32.'/home.png';
$i++;

$adminmenu[$i]['title'] = _MI_NAR_GUESTBOOK_ADMIN;
$adminmenu[$i]['link'] = "admin/main.php?op=managemsg";
$adminmenu[$i]["icon"] = '../../'.$pathIcon32.'/manage.png';

$i++;
$adminmenu[$i]['title'] = _MI_NAR_GUESTBOOK_ABOUT;
$adminmenu[$i]['link'] =  "admin/about.php";
$adminmenu[$i]["icon"] = '../../'.$pathIcon32.'/about.png';