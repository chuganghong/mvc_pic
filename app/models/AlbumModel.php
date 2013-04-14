<?php
class AlbumModel extends model
{	
	
	function ListAlbums($startId,$length)  //发送查询一个图片信息的SQL语句
	{
		$startId = $this->f_input($startId);
		$length = $this->f_input($length);   //过滤数据
		echo "ListAlbums<br />";   //test
		//$sql = "SELECT * FROM album ORDER BY albumId LIMIT $startId,$length DESC";//DESC的位置
		$sql = "SELECT * FROM album LEFT JOIN topic on album.topicId=topic.topicId ORDER BY albumId DESC LIMIT $startId,$length";
		//为了给表格类提供合适的数据，对此语句做修改。有没有更好的解耦方法？
		//$sql = "SELECT album.albumId,album.albumName,topic.topicName FROM album LEFT JOIN topic on album.topicId=topic.topicId";
		//若选取了合适的数据，表格类使用时需要慎重安排数据顺序，若是对外封闭，表格类如何能知道数据的顺序呢？还是不封闭了，慢慢找更好的解决办法。
		$this->db->query($sql);
	}
	
	//function getPictures($startId,$length)   //获取一张图片的信息数组
	function getalbums()   //获取一个图集的信息数组。此方法似乎没有存在的必要
	{
		//$this->ListPictures($startId,$length);
		$row = $this->db->getRow();
		//$this->db->getRow();
		return $row;   
	}
	
	function getAllAlbums()     //获取所有图集的记录数
	{
		$sql = "SELECT COUNT(*) AS rows FROM album";
		$this->db->query($sql);

	}
	
	function getPicOfAlbum($albumId)      //获取一个图集的图片数量
	{
		$albumId = $this->f_input($albumId);     //过滤数据
		$sql = "SELECT COUNT(*) AS rows FROM picture WHERE albumId=$albumId";
		$this->db->query($sql);
	}
	
	function InsertAlbum($albumName,$thumbId,$topicId)   //插入图集信息
	{
		$albumName = $this->f_input($albumName);
		$thumbId = $this->f_input($thumbId);
		$topicId = $this->f_input($topicId);//过滤数据
		$sql = "INSERT INTO album (albumName,thumbId,topicId) VALUES ( '$albumName',$thumbId,$topicId )";
		$this->db->query($sql);
	}
	
	function DeleteAlbum($albumId)     //删除一个图集
	{
		$albumId = $this->f_input($albumId);
		$sql = "DELETE FROM album WHERE albumId = $albumId";
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