<?php
/*
 * 取消对一个用户的关注
 */
$this->UserModel->spliceFriend($friendSrc,$friendDesc);     //取消对某人的关注
$num = $this->UserModel->db->getAffectedNum();          //获取
if( $num>0 )
{
	echo "<script>alert(\"取消对ID为" . $friendDesc . "的用户的关注。\");</script>";
	echo "<script>history.go(-1);</script>";
}
else
{
	echo "未能取消对ID为" . $friendDesc . "的用户的关注。<br />";
}