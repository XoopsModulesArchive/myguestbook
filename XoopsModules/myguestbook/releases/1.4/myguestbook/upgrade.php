<?php

include '../../mainfile.php';

include "./header.php";
include XOOPS_ROOT_PATH."/header.php";

if (isset($HTTP_POST_VARS['submit'])) {
	echo '<div align="center"><b><font color="#FF0000">Upgraded to Narga\'s Guestbook v1.4.<br>Do not forget do delete this file from your server!</div></b></font>';

	if (!$xoopsDB->queryFromFile('./sql/1.2-1.4.sql')) {
		echo 'File 1.2-1.4.sql not found!';
	}
	echo $xoopsLogger->dumpQueries();
include_once XOOPS_ROOT_PATH.'/footer.php';

} else {
	echo '<div align="center"><br><br><br><div align="center"><b><font color="#FF0000">Backup your database first !</div></b></font> Then press the button below to upgrade to Narga\'s Guestbook v1.4<br><br />
<form action="upgrade.php" method="post">
<input type="submit" name="submit" value="SUBMIT" />
</form></div>';
}
include_once XOOPS_ROOT_PATH.'/footer.php';

?>