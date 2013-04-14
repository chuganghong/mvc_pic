<?php
/*
 * 批量关注
 */
$friendSrc = $_SESSION["userId"];

$friendDescs = $_POST["userId"];     //数组

foreach( $friendDescs as $friendDesc )
{
	$this->UserModel->InsertFriend($friendSrc,$friendDesc);
	$num = $this->UserModel->db->getAffectedNum();
	if( $num >0 )
	{
		echo "关注ID为"  . $friendDesc . "用户成功。<br />";
	}
	else
	{
		echo "关注ID为"  . $friendDesc . "用户失败。<br />";
	}
}