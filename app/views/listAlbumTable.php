<?php
class listAlbumTable extends table
{
	function show_table_data()
	{
		while( $row = $this->object->getRow() )
		{

			$id = $row["albumId"];
			$value = $id . ":" . $row["thumbId"];

			$name = "album_thumb[]";

			echo "<tr align=\"center\">\n";
			//echo "<td>" . $this->show_table_checkbox($name,$value) . "</td>\n";//为什么会出错？
			$this->show_table_checkbox($name,$value);
			echo "<td>" . $row["albumId"] . "</td>\n";
			echo "<td>" . $row["albumName"] . "</td>\n";
			echo "<td>" . $row["topicName"] . "</td>\n";
			//echo "<td>" . $this->show_table_operation($id) . "</td>\n";
			$this->show_table_operation($id);
			echo "</tr>";
		}
		echo "</table>";
	}
}
