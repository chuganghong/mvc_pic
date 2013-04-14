<?php
/*
 * 处理用户发表内容的请求
 */
$this->UserModel->post($userId,$content);
$num = $this->UserModel->db->getAffectedNum();
if( $num>0 )
{
	//echo "SUCESS.<BR />";    //TEST
	echo "<script>alert(\"Sucess\");</script>";
	echo "<script>history.go(-1);</script>";
}
else
{
	//echo "FAILURE.<BR />";    //TEST
	echo "<script>alert(\"Failure\");</script>";
	echo "<script>history.go(-1);</script>";
}