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
// $Id: functions.php,v 2.0 Date: 05/12/2011, Author: Nguyen Dinh Quan Exp $
include_once XOOPS_ROOT_PATH."/kernel/object.php";

class MyGuestbookSystem extends XoopsObject
{
	var $db;

    // constructor
	function MyGuestbookSystem($id=null)
	{
		$this->db =& XoopsDatabaseFactory::getDatabaseConnection();
		$this->initVar("id", XOBJ_DTYPE_INT, null, false);
		$this->initVar("name", XOBJ_DTYPE_TXTBOX, null, true);
		$this->initVar("title", XOBJ_DTYPE_TXTBOX, null, true);
		$this->initVar("message", XOBJ_DTYPE_TXTAREA, null, true);
		$this->initVar("note", XOBJ_DTYPE_TXTBOX, null, true);
		$this->initVar("time", XOBJ_DTYPE_STIME, null, true);
		$this->initVar("email", XOBJ_DTYPE_EMAIL, null, true);
		$this->initVar("url", XOBJ_DTYPE_URL, null, true);
		$this->initVar("ip", XOBJ_DTYPE_TXTBOX, null, true);
		$this->initVar("gender", XOBJ_DTYPE_INT, null, true, 1);

		$this->initVar("facebook", XOBJ_DTYPE_INT, null, true, 100);
		$this->initVar("twitter", XOBJ_DTYPE_INT, null, true, 100);

		$this->initVar("icq", XOBJ_DTYPE_INT, null, true, 100);
		$this->initVar("yim", XOBJ_DTYPE_TXTBOX, null, true,100);
		$this->initVar("aim", XOBJ_DTYPE_TXTBOX, null, true,100);
		$this->initVar("msn", XOBJ_DTYPE_TXTBOX, null, true,100);
		$this->initVar("location", XOBJ_DTYPE_TXTBOX, null, true);
		$this->initVar("company", XOBJ_DTYPE_TXTBOX, null, true);
		if ( !empty($id) ) {
			if ( is_array($id) ) {
				$this->assignVars($id);
			} else {
				$this->load(intval($id));
			}
		}
	}

	function load($id)
	{
		$sql = "SELECT * FROM ".$this->db->prefix("myguestbook")." WHERE id=$id and time > 0";
		$myrow = $this->db->fetchArray($this->db->query($sql));
		$this->assignVars($myrow);
	}
function genderMySelBox($title,$order="",$preset_id=0, $none=0, $sel_name="", $onchange="")
	{
		if ( $sel_name == "" ) {
			$sel_name = $this->id;
		}
		$myts =& MyTextSanitizer::getInstance();
		echo "<select name='".$sel_name."'";
		if ( $onchange != "" ) {
			echo " onchange='".$onchange."'";
		}
		echo ">\n";
		$sql = "SELECT ".$this->id.", ".$title." FROM ".$this->table." WHERE ".$this->pid."=0";
		if ( $order != "" ) {
			$sql .= " ORDER BY $order";
		}
		$result = $this->db->query($sql);
		if ( $none ) {
			echo "<option value='0'>----</option>\n";
		}
		while ( list($catid, $name) = $this->db->fetchRow($result) ) {
			$sel = "";
			if ( $catid == $preset_id ) {
				$sel = " selected='selected'";
			}
			echo "<option value='$catid'$sel>$name</option>\n";
			$sel = "";
			$arr = $this->getChildTreeArray($catid);
			foreach ( $arr as $option ) {
				$option['prefix'] = str_replace(".","--",$option['prefix']);
				$catpath = $option['prefix']."&nbsp;".$myts->makeTboxData4Show($option[$title]);
				if ( $option[$this->id] == $preset_id ) {
					$sel = " selected='selected'";
				}
				echo "<option value='".$option[$this->id]."'$sel>$catpath</option>\n";
				$sel = "";
			}
		}
		echo "</select>\n";
	}
	
	function getAllMessages($criteria=array(), $asobject=false, $limit=0, $start=0, $order="")
	{
		$db =& XoopsDatabaseFactory::getDatabaseConnection();
		$ret = array();
		$where_query = "";
		if ( is_array($criteria) && count($criteria) > 0 ) {
			$where_query = " WHERE";
			foreach ( $criteria as $c ) {
				$where_query .= " $c AND";
			}
			$where_query = substr($where_query, 0, -4);
		} elseif ( !is_array($criteria) ) {
			$where_query = " WHERE ".$criteria;
		}
		if ( !$asobject ) {
			$sql = "SELECT id FROM ".$db->prefix("myguestbook")."".$where_query." ORDER BY time $order";
			$result = $db->query($sql,intval($limit),intval($start));
			while ( $myrow = $db->fetchArray($result) ) {
				$ret[] = $myrow['id'];
			}
		} else {
			$sql = "SELECT * FROM ".$db->prefix("myguestbook")."".$where_query." ORDER BY time $order";
			$result = $db->query($sql,intval($limit),intval($start));
			while ( $myrow = $db->fetchArray($result) ) {
				$ret[] = new MyGuestbookSystem($myrow);
			}
				if ( $order != "" ) {
			$sql .= " ORDER BY $order";
		}

		}
		return $ret;
	}

}
?>
