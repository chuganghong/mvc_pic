<?php
$this->UserModel->deleteMyPost($contentId);     //删除我的日志
$num = $this->UserModel->db->getAffectedNum();     //获取删除的记录数量
if( $num>0 )
{
	//echo "删除成功。<br />";   //test
	echo "<script>alert(\"删除成功\");</script>";
	//Header("Location:" . $_SERVER["SCRIPT_NAME"] . "?user/user_index&which=myPost");
	echo "<script>history.go(-1);</script>";
}
else
{
	echo "删除失败。<br />";    //test
	echo "<script>history.go(-1);</script>";
}