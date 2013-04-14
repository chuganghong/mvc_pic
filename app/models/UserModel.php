<?php
class UserModel extends model
{
	private $userId;     //登录用户ID
	function ListUsers($startId,$length)
	{
		$startId = $this->f_input($startId);
		$length = $this->f_input($length);
		$sql = "SELECT * FROM user ORDER BY userId DESC LIMIT $startId,$length";
		$this->db->query($sql);
	}
	
	function InsertMail($senderId,$receiverId,$content)     //存储私信内容
	{
		$senderId = $this->f_input($senderId);
		$receiverId = $this->f_input($receiverId);
		$content = $this->f_input($content);
		$sql = "INSERT INTO mail ( senderId,receiverId,mailContent ) VALUES ( $senderId,$receiverId,'$content')";
		$this->db->query($sql);
	}
	
	function ListMails($receiverId)                  //显示收件箱内的信件
	{
		$receiverId = $this->f_input($receiverId);     //收信人ID
		//$sql = "SELECT * FROM mail,user WHERE mail.receiverId=user.userId AND mail.receiverId=$receiverId";
		$sql = "SELECT * FROM mail,user WHERE mail.senderId=user.userId AND mail.receiverId=$receiverId";
		$this->db->query($sql);
	}
	
	function ListFollows($startId,$length,$friendSrc)  //获取myfollows
	{
		$startId = $this->f_input($startId);
		$length = $this->f_input($length);
		$friendSrc = $this->f_input($friendSrc);
		$sql = "SELECT * FROM user,friend WHERE user.userId=friend.friendDesc AND friend.friendSrc=$friendSrc LIMIT $startId,$length";
		$this->db->query($sql);
	}
	
	function ListFans($startId,$length,$friendDesc)    //获取my fans
	{
		$startId = $this->f_input($startId);
		$length = $this->f_input($length);
		$friendDesc = $this->f_input($friendDesc);
		$sql = "SELECT * FROM user,friend WHERE user.userId=friend.friendSrc AND friend.friendDesc=$friendDesc LIMIT $startId,$length";
		$this->db->query($sql);
	}
	
	function getMyFirstPage($userId)     //获取我的首页的日志总数，即我关注的人的日志总数
	{
		$userId = $this->f_input($userId);
		//$sql = "SELECT COUNT(*) AS rows FROM user,friend,content WHERE friend.friendDesc=content.userId=user.userId AND friend.friendSrc=$userId";
		$sql = "SELECT COUNT(*) AS rows FROM user,friend,content WHERE friend.friendDesc=content.userId AND friend.friendSrc=$userId AND friend.friendDesc=user.userId";
		$this->db->query($sql);
	}
	
	function ListMyFirstPage($startId,$length,$userId)    //获取我关注的人的日志
	{
		$startId = $this->f_input($startId);
		$length = $this->f_input($length);
		$userId = $this->f_input($userId);
		//$sql = "SELECT * FROM user,friend,content WHERE friend.friendDesc=content.userId=user.userId AND friend.friendSrc=$userId";
		$sql = "SELECT * FROM user,friend,content WHERE friend.friendDesc=content.userId AND friend.friendSrc=$userId AND friend.friendDesc=user.userId ORDER BY contentId DESC LIMIT $startId,$length";
		$this->db->query($sql);
	}
	
	function getMyPost($userId)    //获取我的日志总数
	{
		$userId = $this->f_input($userId);
		$sql = "SELECT COUNT(*) AS rows FROM content WHERE userId=$userId";
		$this->db->query($sql);
	}
	
	function ListMyPost($startId,$length,$userId)    //获取我的日志
	{
		$startId = $this->f_input($startId);
		$length = $this->f_input($length);
		$userId = $this->f_input($userId);     //获取我的日志
		$sql = "SELECT * FROM content  WHERE userId=$userId ORDER BY contentId DESC LIMIT $startId,$length ";#这条语句费了点儿时间。
		$this->db->query($sql);		
	}
	
	function getMyFans($friendDesc)   //获取my fans
	{
		$friendDesc = $this->f_input($friendDesc);
		$sql = "SELECT * FROM friend WHERE friendDesc = $friendDesc";
		$this->db->query($sql);
	}
	
	function getMyFollows($friendSrc)    //获取我关注的用户
	{
		$friendSrc = $this->f_input($friendSrc);
		$sql = "SELECT * FROM friend WHERE friendSrc = $friendSrc";
		$this->db->query($sql);
	}
	
	function getMyMails($receiverId)     //获取我的收到的信件的总数量
	{
		$receiverId = $this->f_input($receiverId);    //收信人的ID
		$sql = "SELECT COUNT(*) AS rows FROM mail,user WHERE mail.senderId=user.userId AND mail.receiverId=$receiverId";
		$this->db->query($sql);
	}
	
	function spliceFriend($friendSrc,$friendDesc)     //取消对某人的关注
	{
		$friendSrc = $this->f_input($friendSrc);
		$friendDesc = $this->f_input($friendDesc);
		$sql = "DELETE FROM friend WHERE friendSrc=$friendSrc AND friendDesc=$friendDesc";
		$this->db->query($sql);
	}
	
	 //parent类中的interface getRow接口实现了此功能
	function getMail()
	{
		$row = $this->db->getRow();
		return $row;
	}
	
	//parent类中的interface getRow接口实现了此功能
	function getPost()
	{
		$row = $this->db->getRow();
		return $row;
	}
	
	function getAllUsers()
	{
		$sql = "SELECT COUNT(*) AS rows FROM user";
		$this->db->query($sql);
	}
	 //parent类中的interface getRow接口实现了此功能
	function getUser()
	{
		$row = $this->db->getRow();
		return $row;
	}
	
	function ListUser($username,$password)  //发送查询一个用户信息的SQL语句
	{
		$username = $this->f_input($username);
		$password = $this->f_input($password);
		$sql = "SELECT * FROM user WHERE userName='$username' AND userPwd='$password'";
		//$result = $this->db->query($sql);
		$this->db->query($sql);
		//return $result;
	}
	
	//function ListUser_name( $username)
	
	function InsertUser($username,$password)   //插入用户信息
	{
		$username = $this->f_input($username);
		$password = $this->f_input($password);
		$sql = "INSERT INTO user (userName,userPwd) VALUES ( '$username','$password')";
		$this->db->query($sql);
	}
	
	function post($userId,$content)      //用户发表内容
	{
		$userId = $this->f_input($userId);
		$content = $this->f_input($content);
		$sql = "INSERT INTO content (userId,content) VALUES ($userId,'$content')";
		$this->db->query($sql);
	}
	
	function InsertFriend($friendSrc,$friendDesc)     //插入好友关系
	{
		$friendSrc = $this->f_input($friendSrc);    //$friendSrc是被关注的用户
		$friendDesc = $this->f_input($friendDesc);      //$friendDesc是关注其他用户的用户
		$sql = "INSERT INTO friend (friendSrc,friendDesc) VALUES ($friendSrc,$friendDesc)";
		$this->db->query($sql);
	}
	
	function deleteMyPost($contentId)     //删除我的日志
	{
		$contentId = $this->f_input($contentId);
		$sql = "DELETE FROM content WHERE contentId=$contentId";
		$this->db->query($sql);
	}
	
	function deleteUser($userId)     //删除用户
	{
		$userId = $this->f_input($userId);
		$sql = "DELETE FROM user WHERE userId=$userId";
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
	
	function register($username,$password)   //处理注册请求
	{
		$username = $this->f_input($username);
		$password = $this->f_input($password);
	
		$this->InsertUser($username,$password);
		$num = $this->db->getAffectedNum();
		if( $this->getUserNum($num) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function login($username,$password)     //处理登录请求
	{
		$username = $this->f_input($username);
		$password = $this->f_input($password);
	
		$this->ListUser($username,$password);
		$row = $this->db->getRow();
		$this->userId = $row["userId"];		
		$num = $this->db->getSelectNum();
		if( $this->getUserNum($num) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function getUserId()     //获取登录用户的ID
	{
		return $this->userId;
	}
}