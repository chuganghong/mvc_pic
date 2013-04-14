<?php
/*
 * 显示用户列表的表格类
 */
class listUserTable extends table
{
	function show_table_data()      //仍然有重复代码，能否进一步抽象？
	{
		while( $row = $this->object->getRow() )
		{
			$value = $row["userId"];	
			$name = "userId[]";	
			echo "<tr align=\"center\">\n";			
			$this->show_table_checkbox($name,$value);
			echo "<td>" . $row["userId"] . "</td>\n";
			echo "<td>" . $row["userName"] . "</td>\n";			
			$this->show_table_operation($value);
			echo "</tr>";
		}
		echo "</table>";
	}
}