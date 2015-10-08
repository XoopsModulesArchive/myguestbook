<?php
###############################################################################
#                  Narga's Guestbook v.2.0 for Xoops 2.x                      #
#             Writen by  Nguyen Dinh Quan (webmaster@narga.tk)                #
#      [:: Narga Vault :-: The Land Of Dreams ::](http://www.narga.tk)        #
#   ------------------------------------------------------------------------  #
#                                                                             #
#   ------------------------------------------------------------------------  #
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
// $Id: index.php,v 2.0.1 Date: 8/27/2004 2:52 PM, Author: Nguyen Dinh Quan Exp 
include './header.php';
$xoopsOption['template_main'] = 'view_guestbook_messages.html';
include XOOPS_ROOT_PATH."/header.php";
//$part = new MyGuestbookSystem();
function viewmsg($id)
	{
	global $xoopsConfig, $xoopsUser, $xoopsDB, $xoopsTheme, $xoopsLogger, $xoopsModule, $xoopsTpl, $xoopsUserIsAdmin;
	$myts =& MyTextSanitizer::getInstance();
	$xoopsDB =& XoopsDatabaseFactory::getDatabaseConnection();
	$result = $xoopsDB->query("SELECT * FROM ".$xoopsDB->prefix("myguestbook")." WHERE id= $id");
	list($id, $name, $title, $message, $note, $time, $email, $url, $ip, $gender, $icq, $yim, $aim, $msn, $location, $company) = $xoopsDB->fetchrow($result);
//render page
//	$pagenav = new XoopsPageNav(1);
//	$pagenav=new XoopsPageNav($nbmessage, $nbmsgbypage, $limite, "limite", "");
//Assign data to variable
	$name         = $myts->htmlSpecialChars($name);
	$title        = $myts->htmlSpecialChars($title);
//		$html   = !empty($nohtml) ? 0 :1;
		$smiley = !empty($nosmiley) ? 0 :1;
		$xcode  = !empty($noxcode) ? 0 :1;
	$message      = $myts->sanitizeForDisplay($message,$smiley,$xcode);
	$note         = $myts->sanitizeForDisplay($note,$smiley,$xcode);
	$time         = formatTimestamp($time,"d-m-Y");
	$email        = $myts->htmlSpecialChars($email);
	$url          = $myts->htmlSpecialChars($url);
	$ip           = $myts->htmlSpecialChars($ip);
	$gender       = $myts->htmlSpecialChars($gender);

	$facebook          = $myts->htmlSpecialChars($facebook);
	$twitter          = $myts->htmlSpecialChars($twitter);

	$icq          = $myts->htmlSpecialChars($icq);
	$yim          = $myts->htmlSpecialChars($yim);
	$aim          = $myts->htmlSpecialChars($aim);
	$msn          = $myts->htmlSpecialChars($msn);
	$location     = $myts->htmlSpecialChars($location);
	$company      = $myts->htmlSpecialChars($company);
//Assign data to smarty tpl
$xoopsTpl->assign("name", $name);
$xoopsTpl->assign("title", $title);
$xoopsTpl->assign("message", $message);
$xoopsTpl->assign("note", $note);
$xoopsTpl->assign("date", $time);
if ($email !=""){
	$xoopsTpl->assign("email", "<a href='mailto:".$email."'><img src='./images/email.gif' alt='"._NAR_EMAIL."' />");
	}
if ($url !=""){
	$xoopsTpl->assign("url", "<a href='".$url."'><img src='./images/url.gif' alt='"._NAR_URL."' /></a>");
	}
if ($gender == 0){
	$xoopsTpl->assign("gender", "<img src='./images/gender_male.gif' alt='"._NAR_GENDER."' /></a>"); }
   elseif ($gender == 1) {
	$xoopsTpl->assign("gender", "<img src='./images/gender_female.gif' alt='"._NAR_GENDER."' /></a>"); }
    elseif ($gender == 2) {
	$xoopsTpl->assign("gender", "<img src='./images/gender_other.gif' alt='"._NAR_GENDER."' /></a>"); }
    else $xoopsTpl->assign("gender", "");

if ($location !=""){
	$xoopsTpl->assign("location", "$location");
	}
if ($company !=""){
	$xoopsTpl->assign("company", "$company");
	}

if ($facebook !=""){
	$xoopsTpl->assign("facebook", "<a href='http://www.facebook.com/".$facebook."'><img src='./images/facebook.gif' alt='"._NAR_FACEBOOK."' /></a>");
	}
if ($twitter !=""){
	$xoopsTpl->assign("twitter", "<a href=http://twitter.com/#!/".$twitter."'><img src='./images/twitter.gif' alt='"._NAR_TWITTER."' /></a>");
	}



if ($icq !=""){
	$xoopsTpl->assign("icq", "<a href='http://www.icq.com/scripts/search.dll?to=".$icq."'><img src='./images/icq.gif' alt='"._NAR_ICQ."' /></a>");
	}
if ($yim !=""){
	$xoopsTpl->assign("yim", "<a href=http://edit.yahoo.com/config/send_webmesg?.target=".$yim."&.src=pg><img src='./images/yim.gif' alt='"._NAR_YIM."' /></a>");
	}
if ($aim !=""){
	$xoopsTpl->assign("aim", "<a href=aim:goim?screenname=".$aim."&message=Hello+Are+you+there?><img src='./images/aim.gif' alt='"._NAR_AIM."' /></a>");
	}
if ($msn !=""){
	$xoopsTpl->assign("msn", "<a href=http://members.msn.com/?mem=".$msn."><img src='./images/msn.gif' alt='"._NAR_MSN."' /></a>");
	}
if ($note !=""){
	$xoopsTpl->assign("note", $note);
	}
//Check permission
	if ($xoopsUser && $xoopsUser->isAdmin($xoopsModule->mid())) 
		$xoopsTpl->assign("admin_option",  "<p align='right'><img src='./images/ip.gif' alt='".$ip."'><a href='admin/main.php?op=editEntry&id=".$id."'>&nbsp;<img src='./images/edit.gif' alt='"._NAR_EDIT."' border='0' /></a><a href='admin/main.php?op=delEntry&id=".$id."'>&nbsp;<img src='./images/del.gif' alt='"._NAR_DELETEPOST."' border='0' /></a></p>");
//Get number of message
$query = $xoopsDB->query("SELECT COUNT(*) FROM ".$xoopsDB->prefix("myguestbook")." WHERE id>0");
list($numrows) = $xoopsDB->fetchrow($query);
$xoopsTpl->assign('lang_there_is', sprintf(_NAR_THEREIS ,"<b>".$numrows."</b>"));

$xoopsTpl->assign(array(
       		"lang_sign"                          => _NAR_SIGNGUESTBOOK,
       		"lang_edit"                          => _NAR_EDIT,
       		"lang_del"                           => _NAR_DELETEPOST,
       		"lang_copyright"                     => _NAR_COPYRIGHT,
    		"lang_no_partners"                   => _NAR_NOENTRY,
        	"lang_note"                          => _NAR_NOTE,
        	"lang_date"                          => _NAR_DATE,
		    "pagenav"                            => $pagenav
		));
}
//$op = isset($_GET['op']) ? trim($_GET['op']) : '';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
//switch ($op) {
//case "viewmsg":
//	viewmsg($id);
//	break;
//default:
//	Choice();
//	break; }
echo viewmsg($id);
include_once XOOPS_ROOT_PATH.'/footer.php';
?>
