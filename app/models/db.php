<?php
class db
{
	public $con;
	public $result;
	
	function __construct($host,$root,$pwd,$dbname)
	{
		$this->con = mysql_connect($host,$root,$pwd) or die("Could not connect:" . mysql_error());
		mysql_select_db($dbname,$this->con) or die("Could not use" . $dbname . ":" . mysql_error());
		
	}
	
	function query($sql) //发送SQL语句
	{
		mysql_query("SET NAMES UTF8");
		$this->result = mysql_query($sql,$this->con) or die("Query failed:" . mysql_error());
	}
	
	function getRow()
	{
		//mysql_fetch_assoc($this->result);
		
		if( $row = mysql_fetch_assoc($this->result) )
		{
			return $row;
		}
		else
		{
			return false;
		}
		
	}
	
	function getSelectNum()
	{
		$num = mysql_num_rows($this->result);
		return $num;
	}
	
	function getAffectedNum()
	{
		$num = mysql_affected_rows($this->con);
		return $num;
		
	}
}