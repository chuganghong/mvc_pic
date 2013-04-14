<?php
/*
 * 显示用户首页的类
 */
class firstPageUserTable extends table
{
	function show_table_data()
	{
		while( $row = $this->object->getRow() )
		{
		
			//$id = $row["contentId"];
			//$value = $row["contentId"];
		
			//$name = "contentId[]";
		
			echo "<tr align=\"center\">\n";
			//$this->show_table_checkbox($name,$value);
			echo "<td>" . $row["userName"] . "</td>\n";
			echo "<td>" . $row["content"] . "</td>\n";
			echo "<td>" . $row["post"] . "</td>\n";
			//$this->show_table_operation($id);
			echo "</tr>";
		}
		echo "</table>";
	}
	
	
	//输出表格。覆盖父类的方法
	function show_table()
	{
		//$this->show_table_js();
		$this->show_table_start();
		$this->show_table_tr();
		//$this->show_is_check();
	
		$this->show_table_th();
		$this->show_table_suffixtr();
		$this->show_table_data();
		//$this->show_table_operation($id);
	}
}