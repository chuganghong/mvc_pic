<?php
/*
 * 处理删除图片请求，这段代码冗余，因为在删除图集的代码中出现过。
 * 删除图片：1.先删除图片文件2.再删除图片的数据库信息
 */
foreach( $picId_url as $value )
{
    $arr = explode("->",$value);     //解析图片ID和url
    $picId = $arr[0];     //图片ID
    $url = $arr[1];     //图片url
    $url = $_SERVER["DOCUMENT_ROOT"] . "mvc_pic/" .$url;
    var_dump($url);    //test
    if( unlink($url) )     //删除图片
    {
    	echo "删除图片" . $url . "成功。<br />";
    	$this->PictureModel->DeletePicturePicId($picId);     //根据图片Id删除图片
    	$rows = $this->PictureModel->db->getAffectedNum();     //获取删除的记录数
    	if( $rows )    //成功，为删除的记录数；失败，返回-1.对此，我没有掌握。
    	{
    		//echo "删除图片 " . $ulr . "的数据库信息成功。<br />";
    		echo "<script>alert(\"删除图片 " . $url . "的数据库信息成功。\");
    			  history.go(-1);</script>";
    	}
    	else
    	{
    		echo "删除图片  " . $url . "的数据库信息失败。<br />";
    		echo "<script>setTimeout(\"history.go(-1)\",5000)</script>";
    	}
    }
    else 
    {
    	echo "删除图片" . $url . "失败。<br />";
    }
}