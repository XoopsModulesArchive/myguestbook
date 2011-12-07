<?php
###############################################################################
#                  Narga's Guestbook v.1.0 for Xoops 2.x                      #
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
// $Id: index.php,v 1.2.1 Date: 8/27/2004 2:52 PM, Author: Nguyen Dinh Quan Exp 
include '../../../include/cp_header.php';

function Choice() {
	global $xoopsModule;
    	xoops_cp_header();

    	OpenTable();
    	echo "<a href='index.php?op=managemsg'>"._MI_NAR_GUESTBOOK_ADMIN."</a><br />";
    	echo "<a href='" . XOOPS_URL . '/modules/system/admin.php?fct=preferences&amp;op=showmod&amp;mod=' . $xoopsModule -> getVar( 'mid' ) . "'>"._MI_NAR_GUESTBOOK_CONFIG."</a><br />";
 
    	CloseTable();
    	xoops_cp_footer();
}
function managemsg()
{
	$xoopsDB =& Database::getInstance();
	$myts =& MyTextSanitizer::getInstance();
	xoops_cp_header();
	echo "<h4>"._AM_NAR_GUESTBOOK_ADMIN."</h4>
	<table width='100%' border='0' cellspacing='1' cellpadding='0' class='outer'><tr>
	<th width='10%' align='center'>" ._AM_NAR_NAME."</th>
	<th width='3%' align='center'>" ._AM_NAR_TITLE."</th>
	<th align='center'>" ._AM_NAR_MESSAGE."</th>
	<th width='3%' align='center'>" ._AM_NAR_ACTION."</th></tr>";
	$result = $xoopsDB->query("SELECT id, name, title, message FROM ".$xoopsDB->prefix("myguestbook")." ORDER BY id DESC");
	$class = 'even';
	while (list($id, $name, $title, $message) = $xoopsDB->fetchrow($result)) {
		$name         = $myts->makeTboxData4Show($name);
		$title        = $myts->makeTboxData4Show($title);
		$message      = $myts->makeTboxData4Show($message);
		$check1 = "";
		$check2 = "";
		if( $gender == 1){ $check1 = "selected='selected'"; }else{ $check2 = "selected='selected'"; }
		echo "<tr><td class='$class' width='10%' align='center' valign='middle'>".$name."</td>";
        echo "<td class='$class' width='3%' align='center'>".$title."</td>";
		echo "<td class='$class'>".$message."</td>";
		echo "<td class='$class' width='3%' align='center'><a href='index.php?op=editEntry&amp;id=".$id."'>"._AM_NAR_EDIT."</a><br />--<br /><a href='index.php?op=delEntry&amp;id=".$id."'>"._AM_NAR_DEL."</a></td></tr>";
		$class = ($class == 'odd') ? 'even' : 'odd';
	}
	xoops_cp_footer();
}

function editEntry($id)
{
	$xoopsDB =& Database::getInstance();
	$myts =& MyTextSanitizer::getInstance();
	xoops_cp_header();
	echo "<h4>"._AM_NAR_GUESTBOOK_ADMIN."</h4>";
	$result = $xoopsDB->query("SELECT id, name, title, message, note, email, url, gender, icq, yim, aim, msn, location, company FROM ".$xoopsDB->prefix("myguestbook")." WHERE id=$id");
	list($id, $name, $title, $message, $note, $email, $url, $gender, $icq, $yim, $aim, $msn, $location, $company) = $xoopsDB->fetchrow($result);
	$name         = $myts->makeTboxData4Edit($name);
	$title        = $myts->makeTboxData4Edit($title);
	$message      = $myts->makeTboxData4Edit($message);
	$note         = $myts->makeTboxData4Edit($note);
	$email        = $myts->makeTboxData4Edit($email);
	$url          = $myts->makeTboxData4Edit($url);
	$gender       = $myts->makeTboxData4Edit($gender);
	$icq          = $myts->makeTboxData4Edit($icq);
	$yim          = $myts->makeTboxData4Edit($yim);
	$aim          = $myts->makeTboxData4Edit($aim);
	$msn          = $myts->makeTboxData4Edit($msn);
	$location     = $myts->makeTboxData4Edit($location);
	$company      = $myts->makeTboxData4Edit($company);
	include XOOPS_ROOT_PATH."/class/xoopsformloader.php";
	$form         = new XoopsThemeForm(_AM_NAR_EDITENTRY, "editform", "index.php");
	$formname     = new XoopsFormText(_AM_NAR_NAME, "name", 50, 150, $name);
	$formtitle    = new XoopsFormText(_AM_NAR_TITLE, "title", 50, 50, $title);
	$formemail    = new XoopsFormText(_AM_NAR_EMAIL, "email", 50, 50, $email);
	$formurl      = new XoopsFormText(_AM_NAR_URL, "url", 50, 150, $url);
	$formgender   = new XoopsFormSelect(_AM_NAR_GENDER, "gender", $gender);
	$formgender->addOption("2", _AM_NAR_SELGEN);
	$formgender->addOption("0", _AM_NAR_MALE);
	$formgender->addOption("1", _AM_NAR_FEMALE);
	$formgender->addOption("3", _AM_NAR_OTHER);
	$formicq      = new XoopsFormText(_AM_NAR_ICQ, "icq", 50, 50, $icq);
	$formyim      = new XoopsFormText(_AM_NAR_YIM, "yim", 50, 50, $yim);
	$formaim      = new XoopsFormText(_AM_NAR_AIM, "aim", 50, 50, $aim);
	$formmsn      = new XoopsFormText(_AM_NAR_MSN, "msn", 50, 50, $msn);
	$formlocation      = new XoopsFormText(_AM_NAR_LOCATION, "location", 50, 50, $location);
	$formcompany      = new XoopsFormText(_AM_NAR_COMPANY, "company", 50, 50, $company);
	$formmessage  = new XoopsFormDhtmlTextArea(_AM_NAR_MESSAGE, "message", $message, 10, "100%");
	$formnote     = new XoopsFormDhtmlTextArea(_AM_NAR_NOTE, "note", $note, 10, "100%");
	$id_hidden    = new XoopsFormHidden("id", $id);
	$op_hidden    = new XoopsFormHidden("op", "updateEntry");
	$submit_button = new XoopsFormButton("", "submit", _AM_NAR_SEND, "submit");
	$form->addElement($formname);
	$form->addElement($formtitle);
	$form->addElement($formurl);
	$form->addElement($formemail);
	$form->addElement($formicq);
	$form->addElement($formyim);
	$form->addElement($formaim);
	$form->addElement($formmsn);
	$form->addElement($formlocation);
	$form->addElement($formcompany);
	$form->addElement($formgender);
	$form->addElement($formmessage);
	$form->addElement($formnote);
	$form->addElement($id_hidden);
	$form->addElement($op_hidden);
	$form->addElement($submit_button);
	$form->display();
	xoops_cp_footer();
}

function updateEntry($id, $name, $title, $message, $note, $email, $url, $gender, $icq, $yim, $aim, $msn, $location, $company)
{
	$xoopsDB =& Database::getInstance();
	$myts    =& MyTextSanitizer::getInstance();
	$id      = intval($id);
	$name    = isset($name) ? trim($name) : '';
	$message = isset($message) ? trim($message) : '';
	$note    = isset($note) ? trim($note) : '';
	$email   = isset($email) ? trim($email) : '';
	$url     = isset($url) ? trim($url) : '';
	$gender  = isset($gender) ? trim($gender) : '';
	$icq     = isset($icq) ? trim($icq) : '';
	$yim     = isset($yim) ? trim($yim) : '';
	$aim     = isset($aim) ? trim($aim) : '';
	$msn     = isset($msn) ? trim($msn) : '';
	$location     = isset($location) ? trim($location) : '';
	$company     = isset($company) ? trim($company) : '';
	/*Kiem tra form Name, Title, Message da duoc dien noi dung chua
	if ($name == '' || $message == '' || empty($id) || $email == '') {
		redirect_header("index.php?op=edit_entry&id=$id", 1, _AM_NAR_BESURE);
		exit();
	}
		Khong can thiet trong Admin section*/
	$name      = $myts->makeTboxData4Save($name);
	$message   = $myts->makeTboxData4Save($message);
	$note      = $myts->makeTboxData4Save($note);
	$email     = $myts->makeTboxData4Save($email);
	$url       = $myts->makeTboxData4Save(formatURL($url));
	$gender    = $myts->makeTboxData4Save($gender);
	$icq       = $myts->makeTboxData4Save($icq);
	$yim       = $myts->makeTboxData4Save($yim);
	$aim       = $myts->makeTboxData4Save($aim);
	$msn       = $myts->makeTboxData4Save($msn);
	$location  = $myts->makeTboxData4Save($location);
	$company   = $myts->makeTboxData4Save($company);
	if ($xoopsDB->query("UPDATE ".$xoopsDB->prefix("myguestbook")." SET name='$name', title='$title', message='$message', note='$note', email='$email', url='$url', gender='$gender', icq='$icq', yim='$yim', aim='$aim', msn='$msn', location='$location', company='$company' WHERE id=$id")) {
		redirect_header("index.php?op=managemsg", 1, _AM_NAR_MSGMOD);
	} else {
		redirect_header("index.php?op=managemsg", 1, _AM_NAR_NOTUPDATED);
	}
	exit();
}

function delEntry($id, $del=0)
{
	$xoopsDB =& Database::getInstance();
	if ( $del == 1 ) {
		$sql = sprintf("DELETE FROM %s WHERE id = %u", $xoopsDB->prefix("myguestbook"), $id);
		if ( $xoopsDB->query($sql) ) {
			redirect_header("index.php?op=managemsg", 1, _AM_NAR_MSGDEL);
		} else {
			redirect_header("index.php?op=managemsg", 1, _AM_NAR_NOTUPDATED);
		}
		exit();
	} else {
		xoops_cp_header();
		echo "<h4>"._AM_NAR_GUESTBOOK_CONFIRM."</h4>";
		xoops_confirm(array('op' => 'delEntry', 'id' => $id, 'del' => 1), 'index.php', _AM_NAR_BESUREDATE);
		xoops_cp_footer();
	}
}
$op = '';
foreach ($HTTP_POST_VARS as $k => $v) {
	${$k} = $v;
}

if (isset($HTTP_GET_VARS['op'])) {
	$op = $HTTP_GET_VARS['op'];
	if (isset($HTTP_GET_VARS['id'])) {
		$id = intval($HTTP_GET_VARS['id']);
	}
}
switch ($op) {
case "updateEntry":
	updateEntry($id, $name, $title, $message, $note, $email, $url, $gender, $icq, $yim, $aim, $msn, $location, $company);
	break;
case "delEntry":
	delEntry($id, $del);
	break;
case "editEntry":
	editEntry($id);
	break;
case "managemsg":
	managemsg($id);
	break;
default:
	Choice();
	break; 
}
?>