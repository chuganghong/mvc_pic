<?php
class TopicModel extends model
{	
	
	function ListTopic($topicId)  //发送查询一个栏目信息的SQL语句
	{
		$sql = "SELECT * FROM topic WHERE topicId='$topicId'";
		$this->db->query($sql);
	}
	
	function ListTopics($start,$length)  //查询多个栏目信息的SQL语句
	{
		$sql = "SELECT * FROM topic ORDER BY topicId DESC LIMIT $start,$length";
		$this->db->query($sql);
	}
	function AllTopic()   //获取所有的栏目信息
	{
		$sql = "SELECT * FROM topic;";
		$this->db->query($sql);
	}
	
	function getTopic()    //获取一个栏目的信息
	{
		$row = $this->db->getRow();
		return $row;
	}
	
	function DeleteTopic($topicId)    //删除一个栏目信息的SQL语句
	{
		$sql = "DELETE FROM topic WHERE topicId=$topicId";
		$this->db->query($sql);
	}
	
	function TopicExists($topicName)   //是否存在某个栏目
	{
		$topicName = $this->f_input($topicName);
		$sql = "SELECT * FROM topic WHERE topicName='$topicName'";
		$this->db->query($sql);
		$num = $this->db->getSelectNum();
		return $num;
	}
	
	function InsertTopic($topicName)   //插入栏目信息
	{
		$topicName = $this->f_input($topicName);   //调用方法过滤数据
		$sql = "INSERT INTO topic (topicName) VALUES ( '$topicName' )";
		$this->db->query($sql);
		$num = $this->db->getAffectedNum();  //调用db类方法获取插入的记录数
		return $num;      //成功获取则返回记录数，失败返回-1.mysql_affected_rows()
	}
	
	function getTopicNum($num)   //
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