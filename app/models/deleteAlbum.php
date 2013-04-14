<?php
/*
 * 怎么简单就怎写，仍然是实现删除功能
 * 用面向过程的方法，很快就实现了删除功能。面向对象方法用得不好，会导致代码写得很烂，不容易调试。
 * 刚才我试图用面向对象写的那段实现删除功能的代码，思路混乱，用了很多其他类的方法，与其他代码的关联性太大，要读懂它，需要看其他的另外的代码。这样很不好。
 * 而现在这段面向过程的写法，基本上靠自己就能实现功能。
 */
//$album_thumb = $_POST["album_thumb"];     //图集ID和缩略图ID的组合值
//$arr = explode(":",$album_thumb);     //解析图集ID和缩略图ID组成的值对
var_dump($_POST);   //TEST


if( empty($album_thumb) )
{
	exit();
}

$con = mysql_connect("localhost","root","") or die("Could not connect:" . mysql_error());
mysql_select_db("picture",$con) or die("Can\'t use picture:" . mysql_error());


//删除缩略图，要先获取其URL
foreach( $album_thumb as $value )
{
	$arr = explode(":",$value);    ///解析图集ID和缩略图ID组成的值对
	$albumId[] = $arr[0];    //图集ID
	$thumbId[] = $arr[1];    //缩略图ID
}

//获取缩略图URL，再删除缩略图
foreach( $thumbId as $value )
{
	$sql = "SELECT * FROM picture WHERE picId=$value";
	mysql_query("SET NAMES UTF8");
	$result = mysql_query($sql,$con) or die("Line 25: " . mysql_error());
	$row = mysql_fetch_assoc($result);
	$url = $_SERVER["DOCUMENT_ROOT"] . "mvc_pic/" . $row["url"];
	if( unlink($url) )
	{
		echo "删除缩略图成功。<br/ >";
		
	}
	else
	{
		echo "删除缩略图失败。<br />";
	}
	
	//删除缩略图图的数据库信息
	$sql = "DELETE FROM picture WHERE picId=$value";
	mysql_query($sql,$con) or die("Line 40:" . mysql_error());
	//检测是否删除成功了
	$num = mysql_affected_rows($con);
	if($num)
	{
		echo "删除缩略图的数据库信息成功。<br />";
	
	}
	else
	{
		echo "删除缩略图的数据库信息失败。<br />";
	}
}


//再删除图集中的其他图片：根据图集ID来删除
foreach( $albumId as $value )
{
	//应该在输出数据库信息之前把图片先删除，获取图片URL
	$sql = "SELECT * FROM picture WHERE albumId=$value";
	$result = mysql_query($sql,$con) or die("Line 61: " . mysql_error());
	while( $row = mysql_fetch_assoc($result) )
	{
		$url = $_SERVER["DOCUMENT_ROOT"] . "mvc_pic/" . $row["url"];
		if( unlink($url) )
		{
			echo "删除其他图片成功。<br />";
		}
		else
		{
			echo "删除其他图片信息失败。<br />";
		}
	}
	//删除其他图片的数据库信息
	$sql = "DELETE FROM picture WHERE albumId=$value";
	mysql_query($sql,$con) or die("Line 85:" . mysql_error());
	$num = mysql_affected_rows($con);
	if( $num )
	{
		echo "删除其他图片的数据库信息成功。<br />";
	}
	else
	{
		echo "删除其他图片的数据库信息失败。<br />";
	}
	
	$sql = "DELETE FROM album WHERE albumId=$value";
	mysql_query($sql,$con) or die("Line 59:" . mysql_error());
	//检测是否删除成功
	$num = mysql_affected_rows($con);
	if($num)
	{
		echo "删除图集的数据库信息成功。<br />";
	}
	else
	{
		echo "删除图集的数据库信息失败。<br />";
	}
}