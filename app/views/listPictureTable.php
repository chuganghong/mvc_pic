<?php
/*
 * 图片列表类
 */
class listPictureTable extends table
{
	function show_table_data()      //仍然有重复代码，能否进一步抽象？
	{
		echo "<tr>";
		while( $row = $this->object->getRow() )
		{
			$value = $row["picId"] . "->" . $row["url"];
			$name = "picId_url[]";
			$url = $row["url"];
			echo "<td><img style=\"width:250px;height:180px\" src=\"" . $url . "\" /></td>";
			$this->show_table_checkbox($name,$value);
		}
		echo "</tr>";
		echo "</table>";
	}
}