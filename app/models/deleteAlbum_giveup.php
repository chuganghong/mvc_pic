<?php
/*这个删除功能写得太烂了，简直没有办法修改，也不想再去看。写完这段代码，仅过了几个小时，再去看它，感觉像在理一团乱麻，更别说让别人看。
 * 太麻烦了，要寻求简化方法
 * 处理删除图集的请求
 * 删除图集：1.删除数据库中图集的信息和图集图片的信息。2.删除服务器上该图集的所有文件，包括缩略图和其他图片。
 */
//先删除服务器上的文件，再删除数据库库信息，因为前者依赖后者
//删除图集的封面，先获取缩略图的url
$result = "";
//$picId = $_POST["albumId"];     //是一个二维数组
var_dump($album_thumb);     //test
var_dump($_POST);   //TEST
foreach($album_thumb as $value)
{
    $arr = explode(":",$value);    //对存储图集ID和缩略图ID的值对进行解析
    $albumId[] = $arr[0];     //存储起来，供下面使用
    $thumbId = $arr[1];
	$thumbUrl = $this->PictureModel->ListPicture_picId($thumbId);    //调用类PictureMode方法发送SQL语句
    $row = $this->PictureModel->getPicture() ;     //调用类PictureModel方法获取一张图片的信息，数组
    //是否需要检测文件是否存在？因为当文件不存在的时候，删除操作会出问题。不管它了。删除代码只负责删除，至于它是否存在，那是上传代码的职责。
    
   // if( file_exists($row["url"]) ):
    	
    $url = $_SERVER["DOCUMENT_ROOT"] . "mvc_pic/"  . $row["url"];   //处理不好
    echo '$row["url"]: ' . $row["url"] . "<br />";
    //$url = "mvc_pic/" . $row["url"];   //处理不好
    //$url = "../../" . $row["url"];
    //if( unlink())
    if( file_exists($url) )    //若缩略图存在
    {
         echo $url . "<br />";  //test
    	echo "启动删除缩略图代码<br />";//test
    	if( unlink($url) )     //删除缩略图，并对其成功与否做出处理
         {
    	//return true;     //删除成功
    	     $result = 1;     //删除缩略图文件成功。下一步，删除缩略图的数据库信息
    	     $this->PictureModel->DeletePicturePicId($thumbId);    //删除缩略图的数据信息
    	     $num = $this->PictureModel->db->getAffectedNum();   //获取删除的记录数，以便对是否删除成功做出检测
    	     if( $num )
    	     {
    		     $result = 3;     //删除缩略图数据库信息成功。
    	     }
    	    else
    	    {
    		     $result = 4;      //删除缩略图数据库信息失败
    	    }
         }
         else
         {
    	     $result = 2;     //删除缩略图文件失败
         }
    }
    else   //若缩略图不存在   //与上面的代码重复，考虑重构
    {
    	$this->PictureModel->DeletePicturePicId($thumbId);    //删除缩略图的数据信息
    	$num = $this->PictureModel->db->getAffectedNum();   //获取删除的记录数，以便对是否删除成功做出检测
    	if( $num )
    	{
    		$result = 3;     //删除缩略图数据库信息成功。
    	}
    	else
    	{
    		$result = 4;      //删除缩略图数据库信息失败
    	}
    	
    	
    }
    
    //else:
    
   // $result = 
}
//删除图集的其他图片，先删除文件，再删除数据库信息
//if( $result == 3 )
//{
	foreach( $albumId as $value )
	{
		$this->PictureModel->ListPictue_albumId($value);    //根据图集ID来查询图片信息
		while( $row = $this->PictureModel->getPicture() )    //获取查询结果集中的图片信息
		{
			//$url = $row["url"];     //图片url
			$url = $_SERVER["DOCUMENT_ROOT"] . "mvc_pic/"  . $row["url"];   //处理不好
			if( unlink($url) )       //删除其他图片
			{
				$result =  5;       //删除其他图片成功
		
					//删除其他图片的数据库信息
					//$this->PictureModel->DeletePictureAlbumId($albumId);     //根据图集ID删除图片
			}
			else
			{
				$result = 6;
				break;
					//删除其他图片失败。给$result赋值的目的是对每一次操作进行检测，有必要这样吗？
					//其实，这种方法并不管用。假设一次删除其他图片的操作中，删除图片失败，$result被赋值为6，但是在下一次
					//循环操作中，它又被赋值为其他值，而接收最终结果的代码只能接收到最后的值，所以，必须在此处终止。
			}
			
	    }
		//并需要删除其他图片成功之后再删除其他图片的数据库信息，因为有的图集还没有上传图片
		
		$this->PictureModel->DeletePictureAlbumId($value);     //根据图集ID删除图片
		$num = $this->PictureModel->db->getAffectedNum();   //获取删除的记录数，以便对是否删除成功做出检测
		echo $num . "<br />";
		if( $num )		
		{
			
		}
		else
		{
			$result = 8;     //删除其他图片信息的数据库信息失败
			break;
		}
		
		$result = 7;     //删除其他图片信息的数据库信息成功
		$this->AlbumModel->DeleteAlbum($value);     //删除一个图集
		$num = $this->PictureModel->db->getAffectedNum();   //获取删除的记录数，以便对是否删除成功做出检测
		if( $num )
		{
			$reuslt = 9;     //删除图集数据库信息成功
		}
		else
		{
			$result = 10;     //删除图集数据库信息失败
			break;
		}
	}
//}
/*
if( $result == 3 )   //当删除封面成功时再进行下一步操作
{
	foreach( $albumId as $value )
	{
		$this->PictureModel->ListPictue_albumId($value);    //根据图集ID来查询图片信息
		while( $row = $this->PictureModel->getPicture() )    //获取查询结果集中的图片信息
		{
			//$url = $row["url"];     //图片url
			$url = $_SERVER["DOCUMENT_ROOT"] . "mvc_pic/"  . $row["url"];   //处理不好
			if( unlink($url) )       //删除其他图片
			{
				$result =  5;       //删除其他图片成功
				
				//删除其他图片的数据库信息
				//$this->PictureModel->DeletePictureAlbumId($albumId);     //根据图集ID删除图片
			}
			else
			{
				$result = 6;    
				break; 
				//删除其他图片失败。给$result赋值的目的是对每一次操作进行检测，有必要这样吗？
				//其实，这种方法并不管用。假设一次删除其他图片的操作中，删除图片失败，$result被赋值为6，但是在下一次
				//循环操作中，它又被赋值为其他值，而接收最终结果的代码只能接收到最后的值，所以，必须在此处终止。
			}
		}
		if( $result == 5 )  //若删除其他图片成功，进行一步操作：删除其他图片的数据库信息
		{
			$this->PictureModel->DeletePictureAlbumId($value);     //根据图集ID删除图片
			$num = $this->PictureModle->db->getAffectedNum();   //获取删除的记录数，以便对是否删除成功做出检测
			if( $num )
			{
				$result = 7;     //删除其他图片信息的数据库信息成功
				$this->AlbumModel->DeleteAlbum($value);     //删除一个图集
				$num = $this->PictureModel->db->getAffectedNum();   //获取删除的记录数，以便对是否删除成功做出检测
				if( $num )
				{
					$reuslt = 9;     //删除图集数据库信息成功
				}
				else
				{
					$result = 10;     //删除图集数据库信息失败
					break;
				}
			}
			else
			{
				$result = 8;     //删除其他图片信息的数据库信息失败
				break;
			}
		}		
		
	}
}
*/
