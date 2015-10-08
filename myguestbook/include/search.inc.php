<?php
function myguestbook_search ($queryarray, $andor, $limit, $offset, $userid)
{
	global $xoopsDB;
		$sql = "SELECT id,name,title,time FROM ".$xoopsDB->prefix("myguestbook")." WHERE id >= 0";
//	if ( $userid != 0 )
//	{
//		$sql .= " AND submitter=$userid";
//	}
	
	// because count() returns 1 even if a supplied variable
	// is not an array, we must check if $querryarray is really an array
	if (is_array ($queryarray) && $count = count ($queryarray))
	{
		$sql .= " AND ((title LIKE '%$queryarray[0]%' OR message LIKE '%$queryarray[0]%' OR note LIKE '%$queryarray[0]%')";
		for ($i=1; $i < $count; $i++)
		{
			$sql .= " $andor ";
			$sql .= "(title LIKE '%$queryarray[$i]%' OR message LIKE '%$queryarray[0]%' OR note LIKE '%$queryarray[$i]%')";
		}
		$sql .= ") ";
	}
	
	$sql .= "ORDER BY time DESC";
	$result = $xoopsDB->query ($sql, $limit, $offset);
	$ret = array();
	$i = 0;
	
 	while ($myrow = $xoopsDB->fetchArray ($result))
	{
		$ret[$i]['image'] = "images/icon.gif";
		$ret[$i]['link'] = "viewmsg.php?op=viewmsg&id=".$myrow['id'];
		$ret[$i]['title'] = $myrow['name'] . ": " . $myrow['title'];
		$ret[$i]['time'] = $myrow['time'];
		$ret[$i]['uid'] = 0;//$myrow['submitter'];
		$i++;
	}

	return $ret;
}
?>
