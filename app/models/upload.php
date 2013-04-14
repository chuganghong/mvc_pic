<?php
/*
 * 图片上传类
 * 通过测试，可以使用
 */
class upload
{
	private $tmp_name;     //文件在服务器的临时名称
	private $name;          //文件在客户端的名称
	private $type;          //文件的MIME
	private $size;          //文件大小
	private $maxSize;       //允许上传的文件的最大大小
	private $dir;           //存储上传文件的目录
	public $newName;       //上传后的新文件名
	
	
	function __construct($uploadfile,$dir,$maxSize)   //$uploadfile是包上传框的name属性
	{
		$file = $_FILES[$uploadfile];     //简化书写
		$this->tmp_name = $file["tmp_name"];
		$this->name = $file["name"];
		$this->type = $file["type"];
		$this->size = $file["size"];
		$this->dir = $dir;
		$this->maxSize = $maxSize;
	}
	
	//创建目录
	function createDir()      //存储文件的目录
	{
		if( !file_exists($this->dir) )
		{
			mkdir($this->dir);     //新建目录。如何处理创建不成功的情况
		}
		else
		{
			if( !is_dir($this->dir) )      //不是目录
			{
				echo "It is not a dir<br />";  //test
				unlink($this->dir);   //当把一个文件去掉后缀后，虽能检测出不是目录，但仍能阻止mkdir()的执行
				mkdir($this->dir);
			}
		}
	}
	
	//检测文件大小是否合法
	function isSize()
	{
		if( $this->size > $this->maxSize )    //若上传文件的大小大于最大限制
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	
	//检测是否是允许上传的文件
	function isType()
	{
		$type = array("image/jpeg","image/jpg","image/png","image/gif","image/bmp");  //允许上传的文件类型
		if( in_array($this->type,$type) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//获取文件后缀。没有后缀的情况是否应该处理
	function getSuffix()
	{
		$pos = strrpos($this->name,".");    //逆向查找点首次出现的位置，即是倒数第一次出现的位置，也就是最后出现的位置
		if( $pos !== false )
		{
			$suffix = substr($this->name,$pos);
		}
		return $suffix;
	}
	
	//文件的新名字包括路径
	function getNewName()
	{
		$newName = $this->dir . "/";
		$newName .= date("YmdHis") . rand().rand();
		$newName .= $this->getSuffix();
		$this->newName = $newName;
		//return $this->newName;		
	}
	
	//上传单个图片
	function uploadImage()
	{
		if( $this->isType() )
		{
			if( $this->isSize() )
			{
				$this->createDir();     //处理上传目录
				$this->getNewName();     //新文件名
				$bool = move_uploaded_file($this->tmp_name,$this->newName);    //关键步骤，
				if( $bool )
				{
					return 3;       //上传成功。
				}
				else
				{
					return 4;        //上传失败
				}
			}
			else
			{
				return 2;     //文件太大了
			}
		}
		else
		{
			return 1;    //文件不是图片
		}
	}
}