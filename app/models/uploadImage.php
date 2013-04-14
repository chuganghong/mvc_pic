<?php
/*
 * 处理图片上传请求
 */
//$result = ""；        //用来检测是否上传成功了
$uploadfile = "pic";    //<input type="file" name="picture" />
$dir = "uploads";     //保存上传文件的目录。掌握不好，不知道绝对准确的写法是什么样的。
$maxSize = 9000000000;     //这是什么单位？
$upload = new upload($uploadfile,$dir,$maxSize);
$result = $upload->uploadImage();    //调用类方法上传图片
if( $result == 3 )    //图片上传成功
{
	//开始存储图片的数据库信息：url和albumId
	$url = $upload->newName;
	$this->PictureModel->InsertPicture($albumId,$url);   //插入图片信息
	$num = $this->PictureModel->db->getAffectedNum();
	if( $num )
	{
		$result = 5;     //图片信息成功存入数据库。图片上传成功
	}
	else
	{
		$result = 6;       //图片信息未能存入数据库
	}
}
	