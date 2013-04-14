<?php
/*
 *收信箱类
 */
class listMailBoxTable extends table
{
	function show_table_data()
	{
		while( $row = $this->object->getRow() )
		{
		
			$id = "#";
			$value = $row["userId"];
		
			$name = "userId[]";
		
			echo "<tr align=\"center\">\n";			
			$this->show_table_checkbox($name,$value);
			echo "<td>" . $row["userName"] . "</td>\n";
			echo "<td>" . $row["mailContent"] . "</td>\n";	
			echo "<td>" . $row["mailTime"] . "</td>\n";
			$this->show_table_operation($id);
			echo "</tr>";
		}
		echo "</table>";
	}
}