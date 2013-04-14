<?php
/*
 * 处理mailto_form.php页面的发信请求
 */
$this->UserModel->InsertMail($senderId,$receiverId,$content);     //存储私信内容
$num = $this->UserModel->db->getAffectedNum();
if( $num>0 )
{
	echo "<script>alert(\"Sucess\");</script>";
	echo "<script>history.go(-1);</script>";
}
else
{
	echo "<script>alert(\"Failure\");</script>";
	echo "<script>history.go(-1);</script>";
}