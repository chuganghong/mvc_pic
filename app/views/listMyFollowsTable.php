<?php
/*
 * 我关注的人 类
 */
class listMyFollowsTable extends table
{
	function show_table_data()
	{
		while( $row = $this->object->getRow() )
		{
			
			$id = $row["userId"];
			$value = $row["userId"];
				
			$name = "userId[]";
				
			echo "<tr align=\"center\">\n";			
			$this->show_table_checkbox($name,$value);
			echo "<td>" . $row["userId"] . "</td>\n";
			echo "<td>" . $row["userName"] . "</td>\n";
			$this->show_table_operation($id);
			echo "</tr>";
		}
		echo "</table>";
	}
}