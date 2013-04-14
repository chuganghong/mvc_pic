<?php
class PictureModel extends model
{	
	
	function ListPictures($startId,$length)  //发送查询一个图片信息的SQL语句
	{
		$startId = $this->f_input($startId);
		$length = $this->f_input($length);
		//$sql = "SELECT * FROM picture ORDER BY picId LIMIT $startId,$length DESC";//DESC的位置
		$sql = "SELECT * FROM picture WHERE albumId>0 ORDER BY picId DESC LIMIT $startId,$length ";
		$this->db->query($sql);
	}
	
	function ListPictures_album($startId,$length,$albumId)   //获取一个图集的一区间段的图片信息
	{
		$startId = $this->f_input($startId);
		$length = $this->f_input($length);
		$albumId = $this->f_input($albumId);
		$sql = "SELECT * FROM picture WHERE albumId = $albumId ORDER BY picId DESC LIMIT $startId,$length";
		$this->db->query($sql);
	}
	
	//function getPictures($startId,$length)   //获取一张图片的信息数组
	function ListPicture_picId($picId)      //发送查询图片信息的SQL语句，一张图片，根据图片ID查询
	{
		$pic = $this->f_input($picId);
		$sql = "SELECT * FROM picture WHERE picId = $picId";
		$this->db->query($sql);
	}
	
	function getAllPictures()//查询图片总数
	{
		//$sql = "SELECT COUNT(*) FROM picture AS rows";     //查询图片总数。注意它和下面的区别
		$sql = "SELECT COUNT(*) AS rows FROM picture WHERE albumId>0";     //查询图片总数，除缩略图
		$this->db->query($sql);
	}
	
	function ListPicture_url($url)   //根据url来查询图片信息
	{
		$url = $this->f_input($url);     //过滤数据
		$sql = "SELECT * FROM picture WHERE url='$url'";
		$this->db->query($sql);
	}
	
	function ListPictue_albumId($albumId)     //根据图集ID来查询图片信息
	{
		$this->f_input($albumId);    //过滤数据
		$sql = "SELECT * FROM picture WHERE albumId = $albumId";
		$this->db->query($sql);
	}
	
	function getPicture()   //获取一张图片的信息数组  。这个方法应该移入model类中
	{
		//$this->ListPictures($startId,$length);
		$row = $this->db->getRow();
		//$this->db->getRow();
		return $row;   //存储一张图片信息的数组
	}
	
	function InsertPicture($albumId,$url)   //插入图片信息
	{
		$sql = "INSERT INTO picture (albumId,url) VALUES ( $albumId,'$url' )";
		$this->db->query($sql);
	}
	
	function DeletePicturePicId($picId)     //根据图片Id删除图片
	{
		$picId = $this->f_input($picId);
		$sql = "DELETE FROM picture WHERE picId = $picId";
		$this->db->query($sql);
	}
	
	function DeletePictureAlbumId($albumId)     //根据图集ID删除图片
	{
		$albumId = $this->f_input($albumId);
		$sql = "DELETE FROM picture WHERE albumId = $albumId";
		$this->db->query($sql);
	}
	
	function getUserNum($num)   //
	{
		//$num = $this->db->getSelectNum();
		if( $num > 0 )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	
	
	
	
}