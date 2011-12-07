<?php
###############################################################################
#                  Narga's Guestbook v.1.0 for Xoops 2.x                      #
#             Writen by  Nguyen Dinh Quan (webmaster@narga.tk)                #
#      :: Narga Vault :-: The Land Of Dreams ::(http://www.narga.tk)          #
#   ------------------------------------------------------------------------- #
#       A produce of [:: Narga Laboratory ::] (http://www.nargalab.info)      #
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
// $Id: sign.php,v 1.2.1 Date: 8/30/2004 10:37 PM, Author: Nguyen Dinh Quan Exp $
include_once "header.php";
if ( empty($HTTP_POST_VARS['submit']) ) {
	$xoopsOption['template_main'] = 'myguestbook_sign.html';
	include XOOPS_ROOT_PATH."/header.php";
	include_once XOOPS_ROOT_PATH."/class/xoopsformloader.php";
//Get the user database
	$company_v = "";
	$name_v = !empty($xoopsUser) ? $xoopsUser->getVar("uname", "E") : "";
	$email_v = !empty($xoopsUser) ? $xoopsUser->getVar("email", "E") : "";
	$url_v = !empty($xoopsUser) ? $xoopsUser->getVar("url", "E") : "";
	$icq_v = !empty($xoopsUser) ? $xoopsUser->getVar("user_icq", "E") : "";
	$msn_v = !empty($xoopsUser) ? $xoopsUser->getVar("user_msnm", "E") : "";
	$aim_v = !empty($xoopsUser) ? $xoopsUser->getVar("user_aim", "E") : "";
	$yim_v = !empty($xoopsUser) ? $xoopsUser->getVar("user_yim", "E") : "";
	$location_v = !empty($xoopsUser) ? $xoopsUser->getVar("user_from", "E") : "";
	$message_v = "";
	$title_v = "";
	//Make form type
	$name_text = new XoopsFormText(_NAR_NAME, "usersName", 50, 100, $name_v);
	$email_text = new XoopsFormText(_NAR_EMAIL, "usersEmail", 50, 100, $email_v);
	$gender_select = new XoopsFormSelect(_NAR_SELGEN, "userGender",3);
	$gender_select->addOptionArray(array("3"=>_NAR_SELGEN,"0"=>_NAR_MALE,"1"=>_NAR_FEMALE,"2"=>_NAR_OTHER));
	$url_text = new XoopsFormText(_NAR_URL, "usersSite", 50, 100, $url_v);
	$icq_text = new XoopsFormText(_NAR_ICQ, "usersICQ", 50, 100, $icq_v);
	$msn_text = new XoopsFormText(_NAR_MSN, "usersMSN", 50, 100, $msn_v);
	$aim_text = new XoopsFormText(_NAR_AIM, "usersAIM", 50, 100, $aim_v);
	$yim_text = new XoopsFormText(_NAR_YIM, "usersYIM", 50, 100, $yim_v);
	$company_text = new XoopsFormText(_NAR_COMPANY, "usersCompanyName", 50, 100, $company_v);
	$location_text = new XoopsFormText(_NAR_LOCATION, "usersCompanyLocation", 50, 100, $location_v);
	$title_text = new XoopsFormText(_NAR_TITLE, "usersTitle", 50, 100, $title_v);
	$message_textarea = new XoopsFormDhtmlTextArea(_NAR_MESSAGE, "usersMessage", $message_v);
	$submit_button = new XoopsFormButton("", "submit", _NAR_SEND, "submit");
	$myguestbook_form = new XoopsThemeForm(_NAR_SIGNGUESTBOOK, "myguestbookform", "sign.php");
//Fill data to form text
	$myguestbook_form->addElement($name_text, true);
	$myguestbook_form->addElement($gender_select,3);
	$myguestbook_form->addElement($email_text, true);
	$myguestbook_form->addElement($url_text);
	$myguestbook_form->addElement($icq_text);
	$myguestbook_form->addElement($msn_text);
	$myguestbook_form->addElement($aim_text);
	$myguestbook_form->addElement($yim_text);
	$myguestbook_form->addElement($company_text);
	$myguestbook_form->addElement($location_text);
	$myguestbook_form->addElement($title_text);
	$myguestbook_form->addElement($message_textarea, true);
	$myguestbook_form->addElement($submit_button);
	$myguestbook_form->assign($xoopsTpl);
	//Assign data to smarty tpl
	$xoopsTpl->assign('lang_index', _NAR_BACKGUESTBOOK);
	$xoopsTpl->assign('lang_info', _NAR_DESC);
	$xoopsTpl->assign('lang_copyright', _NAR_COPYRIGHT);
	$xoopsTpl->assign('lang_writing', _NAR_SIGNGUESTBOOK);
	$xoopsTpl->assign('lang_gender', _NAR_GENDER);
	$xoopsTpl->assign('lang_title', _NAR_TITLE);
	$xoopsTpl->assign('lang_cancel', _CANCEL);
	$xoopsTpl->assign('lang_nameenter', _NAR_NAMEENTER);
	$xoopsTpl->assign('lang_msenter', _NAR_MSENTER);
	include XOOPS_ROOT_PATH."/footer.php";
} else {
	extract($HTTP_POST_VARS);
	extract($HTTP_POST_VARS);
	$myts =& MyTextSanitizer::getInstance();
	$name_text = $myts->stripSlashesGPC($usersName);
	$title_text = $myts->stripSlashesGPC($usersTitle);
	$message_textarea = $myts->stripSlashesGPC($usersMessage);
	$date=time();
	$email = $myts->stripSlashesGPC($usersEmail);
	$url_text = $myts->stripSlashesGPC($usersSite);
	$ip=$GLOBALS['REMOTE_ADDR'];
	$gender_select = $myts->stripSlashesGPC($userGender);
	$icq_text = $myts->stripSlashesGPC($usersICQ);
	$aim_text = $myts->stripSlashesGPC($usersAIM);
	$yim_text = $myts->stripSlashesGPC($usersYIM);
	$msn_text = $myts->stripSlashesGPC($usersMSN);
	$location_text = $myts->stripSlashesGPC($usersCompanyLocation);
	$company_text = $myts->stripSlashesGPC($usersCompanyName);
//Insert info to database
	$sqlinsert="INSERT INTO ".$xoopsDB->prefix("myguestbook")." (name,title,message,time,email,url,ip,gender,icq,yim,aim,msn,location,company) VALUES ('".$name_text."','".$title_text."','".$message_textarea."','".$date."','".$email."','".$url_text."','".$ip."','".$gender_select."','".$icq_text."','".$yim_text."','".$aim_text."','".$msn_text."','".$location_text."','".$company_text."')";
	if ( $xoopsModuleConfig['sendmail'] == 1 ) 
	{
	$subject = $xoopsConfig['sitename']." - "._NAR_NEWMESSAGE;
	$xoopsMailer =& getMailer();
	$xoopsMailer->useMail();
	$xoopsMailer->setToEmails($xoopsConfig['adminmail']);
	$xoopsMailer->setFromEmail($email);
	$xoopsMailer->setFromName($xoopsConfig['sitename']);
	$xoopsMailer->setSubject($subject, "-", $conf_subject);
	$xoopsMailer->setBody($message_textarea);
	$xoopsMailer->send();
	}
	if ( !$result = $xoopsDB->query($sqlinsert) ) 
			{
				echo _NAR_ERRORINSERT;
			}
					redirect_header("index.php",2,_NAR_RECEIVED);
	exit();
}
include_once XOOPS_ROOT_PATH.'/footer.php';
?>