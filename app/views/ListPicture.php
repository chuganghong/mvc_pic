<?php 
/*
 * 仍然有重复代码
 */
$array_th = array();
$operation = array();
$object = $this->PictureModel;
$table = "listPictureTable";
$url = $_SERVER["SCRIPT_NAME"] . "?admin/admin_index&which=ListPicture";
$action = $_SERVER["SCRIPT_NAME"] . "?admin/deletePicture";
$method="post";
$submitValue = "删除";
$tableList = new tableList($array_th,$operation,$object,$table,$url,$action,$method,$submitValue,$pages);
$tableList->show_list();












/*
$array_th = array();
$operation = array();
$object = $this->PictureModel;
$table = new listPictureTable($array_th,$operation,$object);
//$table->show_table();
//分页
$url = $_SERVER["SCRIPT_NAME"] . "?admin/admin_index&which=ListPicture";
$page = new page($url,$pages);

$action = $_SERVER["SCRIPT_NAME"] . "?admin/deletePicture";
$method="post";
$submitValue = "删除";
$content = array($table,$page);
$form = new form($action,$method,$submitValue,$other="",$content);



<form action="<?php echo $_SERVER["SCRIPT_NAME"];?>?admin/deletePicture" method="post">
<table border="1" width="80%" align="center">
<?php
for($i=0;$i<$sum=4;$i++)
{
	$n=0;
	echo "<tr>";
	do
	{
		$row = $this->PictureModel->getPicture();
		echo "<td>";
		$url = $row["url"];
		echo "<img style=\"width:250px;height:180px\" src=\"" . $url . "\" />";
		echo "<br />";
		echo "<input type=\"checkbox\"  value=\"" . $row["picId"] . "->" . $row["url"] . "\"  name = \"picId_url[]\" />";
		echo "</td>";
		$n++;
	}while($n<5);
	echo "</tr>";
	
	/*
	while( $row = $this->PictureModel->getPicture() )
    {
	//echo $row["url"] . "<br />";
        //if( $n >= $sum )
        if($n==$sum)
        {
            break;
        }			
	    echo "<td>";
	    $url = $row["url"];
	    echo "<img style=\"width:250px;height:180px\" src=\"" . $url . "\" />";
		echo "<br />";
		echo "<input type=\"checkbox\"  value=\"" . $row["picId"] . "->" . $row["url"] . "\"  name = \"picId_url[]\" />";
	    echo "</td>";
		$n++;
	}
	echo "</tr>";
	



<tr align="center">
<td>
<span onclick="check()">全选</span>
<span onclick = "uncheck()">反选</span>
<input type="submit" value="删除" />
</td>
<td colspan="3">
<?php $url = $_SERVER["SCRIPT_NAME"] . "?admin/admin_index&which=ListPicture"; $page = new page($url,$pages);$page->show_page();//分页?>
</td>
</tr>
</table>
</form>
*/
