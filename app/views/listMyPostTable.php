<?php
/*
 * 显示我的日志
 */
class listMyPostTable extends table
{
	function show_table_data()
	{
		while( $row = $this->object->getRow() )
		{
		
			$id = $row["contentId"];
			$value = $row["contentId"];
		
			$name = "contentId[]";
		
			echo "<tr align=\"center\">\n";
			$this->show_table_checkbox($name,$value);
			echo "<td>" . $row["contentId"] . "</td>\n";
			echo "<td>" . $row["content"] . "</td>\n";
			echo "<td>" . $row["post"] . "</td>\n";
			$this->show_table_operation($id);
			echo "</tr>";
		}
		echo "</table>";
	}
}