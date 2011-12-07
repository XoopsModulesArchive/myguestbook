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
// $Id: index.php,v 1.2 Date: 22/06/2003, Author: Nguyen Dinh Quan Exp $
$start = $_GET ['start'];
include "./header.php";
$xoopsOption['template_main'] = 'guestbook_index.html';
include XOOPS_ROOT_PATH."/header.php";
$part = new MyGuestbookSystem();
if (! isset($start)){
	$start=0;
}
if ( !$start or $start == 0 and $xoopsModuleConfig['num_messages'] != 0) {
	$init = 0;
} elseif ( $start != 0 and $xoopsModuleConfig['num_messages'] != 0) {
	$init = $start;
}
//Get number of message
$query = $xoopsDB->query("SELECT COUNT(*) FROM ".$xoopsDB->prefix("myguestbook")." WHERE id>0");
list($numrows) = $xoopsDB->fetchrow($query);
$xoopsTpl->assign('lang_there_is', sprintf(_NAR_THEREIS ,"<b>".$numrows."</b>"));

//render page
	if ( $xoopsModuleConfig['num_messages'] != 0 ) {
	$nav = new XoopsPageNav($numrows,$xoopsModuleConfig['num_messages'],$start);
	$pagenav = $nav->renderNav();
}
if( $xoopsModuleConfig['num_messages'] != 0 ) {
	$total_entry = $part->getAllMessages("id>0",true,$xoopsModuleConfig['num_messages'],$init,$xoopsModuleConfig['order']);
}else{
	$total_entry = $part->getAllMessages("id>0",true,$xoopsModuleConfig['num_messages'],$xoopsModuleConfig['order']);
}

foreach ( $total_entry as $part_obj ) {
	$array_total_entry[] = array(
			"id"                   =>  $part_obj->getVar("id"),
			"name"                 =>  $part_obj->getVar("name"),
			"title"                =>  $part_obj->getVar("title"),
			"message"              =>  $part_obj->getVar("message"),
			"note"                 =>  $part_obj->getVar("note"),
			"time"                 =>  $part_obj->getVar("time"),
			"email"                =>  $part_obj->getVar("email"),
			"url"                  =>  $part_obj->getVar("url"),
			"ip"                   =>  $part_obj->getVar("ip"),
			"gender"               =>  $part_obj->getVar("gender"),
			"icq"                  =>  $part_obj->getVar("icq"),
			"yim"                  =>  $part_obj->getVar("yim"),
			"aim"                  =>  $part_obj->getVar("aim"),
			"msn"                  =>  $part_obj->getVar("msn"),
			"location"             =>  $part_obj->getVar("location"),
			"company"              =>  $part_obj->getVar("company")
			);
}
$count_msg = count($array_total_entry);
for ( $i = 0; $i < $count_msg; $i++ ) {
	$entry[$i]['id']           = $array_total_entry[$i]['id'];
	$entry[$i]['name']         = $array_total_entry[$i]['name'];
	$entry[$i]['title']        = $array_total_entry[$i]['title'];
	$entry[$i]['message']      = $array_total_entry[$i]['message'];
	$entry[$i]['note']         = $array_total_entry[$i]['note'];
if ($xoopsModuleConfig['date'] =0){
	$entry[$i]['date']         = formatTimestamp($array_total_entry[$i]['time'],"d-m-Y");
} else 	$entry[$i]['date']         = formatTimestamp($array_total_entry[$i]['time'],"m-d-Y");

	if ($array_total_entry[$i]['location'] !=""){
switch ($array_total_entry[$i]['location'])
	{
		case "vietnam":
		case "Vietnam":
		case "Viet Nam":
		case "VIETNAM":
		case "VIET NAM":
			$entry[$i]['location']  ="<img src='images/vn.gif' alt='".$array_total_entry[$i]["location"]."'>";
		break;
	default: $entry[$i]['location']  = $array_total_entry[$i]['location'];
	}} else $entry[$i]['location']  = $array_total_entry[$i]['location'];

	if ($array_total_entry[$i]['company'] !=""){
switch ($array_total_entry[$i]['company'])
	{
		case "[:: Narga Vault ::]":
		case "Narga Vault":
		case "narga vault":
		case "Viet Nam":
		case "[:: Narga Laboratory ::]":
		case "Narga Laboratory":
			$entry[$i]['company']        = "<a href='http://www.narga.info' target = '_blank'>[:: Narga Laboratory ::]</a>";
		break;
		default: $entry[$i]['company']  = $array_total_entry[$i]['company'];
	}} else $entry[$i]['company']  = $array_total_entry[$i]['company'];;

    if ($array_total_entry[$i]['email'] !=""){
	$entry[$i]['email']        = "<a href='mailto:".$array_total_entry[$i]['email']."'><img src='./images/email.gif' alt='"._NAR_EMAIL."' /></a>";
	}

    if ($array_total_entry[$i]['url'] !=""){
	$entry[$i]['url']          = "<a href='".$array_total_entry[$i]['url']."' target = '_blank'><img src='./images/url.gif' alt='"._NAR_URL."' /></a>";
	}
	$entry[$i]['ip']           = $array_total_entry[$i]['ip'];

if ($xoopsModuleConfig['allowicons'] !=0){
	switch ($array_total_entry[$i]['gender'])
	{
		case "0";
			$entry[$i]['gender']       = "<img src='./images/gender_male.gif' alt='"._NAR_GENDER."' /></a>";
		break;
		case "1";
			$entry[$i]['gender']       = "<img src='./images/gender_female.gif' alt='"._NAR_GENDER."' /></a>";
		break;
		case "2";
			$entry[$i]['gender']       = "<img src='./images/gender_other.gif' alt='"._NAR_GENDER."' /></a>";
		break;
		case "3";
			$entry[$i]['gender']       = "";
		break;
	}} else $entry[$i]['gender']       = "";

if ($array_total_entry[$i]['icq'] !=""){
	$entry[$i]['icq']          = "<a href='http://wwp.icq.com/scripts/search.dll?to=".$array_total_entry[$i]['icq']."'><img src='./images/icq.gif' alt='"._NAR_ICQ."' /></a>";
}

if ($array_total_entry[$i]['yim'] !=""){
	$entry[$i]['yim']          = "<a href=http://edit.yahoo.com/config/send_webmesg?.target=".$array_total_entry[$i]['yim']."&.src=pg><img src='./images/yim.gif' alt='"._NAR_YIM."' /></a>";
}
if ($array_total_entry[$i]['aim'] !=""){
	$entry[$i]['aim']          = "<a href=aim:goim?screenname=".$array_total_entry[$i]['aim']."&message=Hello+Are+you+there?><img src='./images/aim.gif' alt='"._NAR_AIM."' /></a>";
}
if ($array_total_entry[$i]['msn'] !=""){
	$entry[$i]['msn']          = "<a href=http://members.msn.com/?mem=".$array_total_entry[$i]['msn']."><img src='./images/msn.gif' alt='"._NAR_MSN."' /></a>";
}
	if ($xoopsUser && $xoopsUser->isAdmin($xoopsModule->mid())) {
		$entry[$i]['admin_option']  = "<p align='right'><img src='images/ip.gif' alt='".$array_total_entry[$i]["ip"]."'><a href='admin/index.php?op=editEntry&id=".$array_total_entry[$i]["id"]."'>&nbsp;<img src='images/edit.gif' alt='"._NAR_EDIT."' border='0' /></a><a href='admin/index.php?op=delEntry&id=".$array_total_entry[$i]["id"]."'>&nbsp;<img src='images/del.gif' alt='"._NAR_DELETEPOST."' border='0' /></a></p>";
	}

	$xoopsTpl->append("total_entry", $entry[$i]);
}

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
include_once XOOPS_ROOT_PATH.'/footer.php';
?>