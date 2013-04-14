<?php
/*
 * 处理增加图集的请求，两项操作：将图片信息存入数据库；将图片上传
 */
//先上传图片
$upload = new upload("thumbPic","uploads/thumb",6000000);
$result = $upload->uploadImage();
if( $result == 3 )     //等于3时，上传成功，执行数据库操作：存储缩略图信息，提取其ID
{
	$albumId = 0;     //miniature的id设为0
	//$url = $upload->getNewName();    //获取图片url
	$url = $upload->newName;    //调用类属性，似乎不太好。获取图片url
	$this->PictureModel->InsertPicture($albumId,$url);    //调用PictureModel类的方法
	$num = $this->PictureModel->db->getAffectedNum();     //获取插入的记录数
	if( $num )
	{
		$result = 3;     //插入成功，下一步，获取缩略图ID
		
		$this->PictureModel->ListPicture_url($url);    //获取缩略图的信息
		$row = $this->PictureModel->getPicture();
		$thumbId = $row["picId"];
		
		//下一步，存储图集信息
		$albumName = $_POST["albumName"];     //图集标题
		$topicId = $_POST["topicId"];       //栏目ID
		$this->AlbumModel->InsertAlbum($albumName,$thumbId,$topicId);
		$num = $this->AlbumModel->db->getAffectedNum();     //是否需要在此检测是否成功了？
		if( $num )
		{
			$result = 3;
		}
		else
		{
			$result = 6;       //存储图集信息失败。
		}		
	}
	else
	{
		$result = 5;      //存储缩略图信息失败，即上传图片失败。是否需要删除已经上传的图片？
	}
}