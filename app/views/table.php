<?php
/*
	与外部的关系太紧密，我目前无能力将表格封装成好用的类
	将此类声明为抽象类
*/
abstract class table implements display
{
	protected $array_th;      //数组，存储表头信息
	protected $operation;     //存储文字信息，比如“删除”
	protected $object;          //对象
	//protected $name;         //input name
	//protected $value;        input value
	
	
	function __construct($array_th,$operation,$object)
	{
		//不是用户输入，因此不必过滤数据
		$this->array_th = $array_th;
		$this->operation = $operation;
		$this->object = $object;
		//$this->show_table();
	}
	
	function display()
	{
		$this->show_table();
	}
	
	//输出表格
	function show_table()
	{
		$this->show_table_js();
		$this->show_table_start();
		$this->show_table_tr();
		$this->show_is_check();
		
		$this->show_table_th();
		$this->show_table_suffixtr();
		$this->show_table_data();		
	}
	
	//输出表头信息
	function show_table_th()
	{
		//echo "<table border=\"1\">";
		//echo "<tr>";
		foreach( $this->array_th as $th )      //需要在此对$array_th是否是数组进行检测吗？
		{
			echo "<th>" . $th . "</th>";
		}
		//echo "</tr>";
	}
	
	//输出表格开始标签
	function show_table_start()
	{
		echo "<table border=\"1\" width=\"80%\" align=\"center\">";		
	}
	
	function show_table_tr()
	{
		echo "<tr>";
	}
	
	function show_table_suffixtr()
	{
		echo "</tr>";
	}
	
	//输出全选与反选选项。依赖外部的JS，耦合性太强，唯一的办法是，把JS封装到该类内部
	function show_is_check()
	{
		echo "<th>";
		echo "<span onclick=\"check()\">全选/反选</span>";		
		echo "</th>";
	}
	
	function show_table_checkbox($name,$value)    //输出多选框
	{
		echo "<td>";
		echo "<input type=\"checkbox\" name=\"" . $name . "\" value=\"" . $value . "\" />";
		echo "</td>";
	}
	
	function show_table_operation($id)    //输出文字操作部分
	{
		echo "<td>";
		foreach( $this->operation as $key=>$value )
		{
			
			echo "<a href=\"" . $key . $id . "\">" . $value . "</a>";
			echo "&nbsp;";
		}
		echo "</td>";
	}
	
	function show_table_js()     //表格操作的JS代码
	{
		$str = "<script>";
		$str .= "
				function check()
				{
					var boxes=document.getElementsByTagName(\"input\");
					var num=boxes.length;
					for(var i=0;i<num;i++)
					{
						if( boxes[i].type==\"checkbox\" )
						{
							if( boxes[i].checked==true )
							{
								boxes[i].checked=false;
							}
							else
							{
								boxes[i].checked=true;
							}
						}
					}
				}";
		$str .= "</script>";
		echo $str;
	}
	
	//function show_table_data()
	
	//输出数据部分
	abstract function show_table_data();     //因为从数据库取出的数据不确定，此部分变数太大
	//abstract function show_table_checkbox();      //输出多选框
}

