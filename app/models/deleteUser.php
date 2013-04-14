<?php
foreach( $userId as $value )
{
	$this->UserModel->deleteUser($value);
	$num = $this->db->getAffectedNum();
	if( $num>0 )
	{
		echo "删除成功。<br />";
	}
	else
	{
		echo "删除失败。<br />";
	}
}