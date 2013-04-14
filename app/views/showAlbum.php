<?php
/*
 * 显示一个图集的图片
 */
$pre_page = $_GET["cpage"]-1;
$next_page = $_GET["cpage"]+1;
?>
<form action="<?php echo $_SERVER["SCRIPT_NAME"]; ?>?admin/deletePicture"  method="post">
<table border="1" width="80%" align="center">
<td></td>
<?
for( $i=0;$i<$sum=4;$i++)
{
    echo "<tr>";
	$n = 0;
    do
	{
	   $row_pic = $this->PictureModel->getPicture();
	   echo "<td>";	   
	   echo "<img style=\"width:250px;height:180px\" src=\"" . $row_pic["url"] . "\" />";
       $value = $row_pic["picId"] . "->" . $row_pic["url"];
	   echo "<input type=\"checkbox\" value=\"" . $value . "\" name=\"picId_url[]\" />";	   
	   $n++;
	   echo "</td>";
	}while($n<5);
	echo "</tr>";
}
/*
下面这段代码不能实现预想效果。关键是在条件不满足的时候，mysql_fetch_assoc()又执行了一次，但却没有输出。于是在下一行的输出中，就跳过了一些图片。
for( $i=0;$i<$sum=5;$i++)
{
    echo "<tr>";
	$n = 0;
	 while( $row_pic = ($this->PictureModel->getPicture()) )
//while( $row_pic = (this->PictureModel->getPicture()) ) //获取一个图集的信息数组)
    {
	   
	   if( $n == $sum )
	   {
	        break;
	   }
	   echo "<td>";	   
	   echo "<img style=\"width:250px;height:180px\" src=\"" . $row_pic["url"] . "\" />";
       $value = $row_pic["picId"] . "->" . $row_pic["url"];
	   echo "<input type=\"checkbox\" value=\"" . $value . "\" name=\"picId_url[]\" />";	   
	   $n++;
	   echo "</td>";
	}
	echo "</tr>";
}
*/
echo "<tr align=\"center\">";
echo "<td>";
echo "<span onclick=\"check()\">全选</span>";
echo "<span onclick=\"uncheck()\">  反选</span>"; 
echo "  <input type=\"submit\" value=\"删除\" />";  
echo "</td>";
echo "<td colspan=\"4\">"; 
if( !isset($_GET["cpage"]) || $_GET["cpage"]== 1 )
{
?>
<a href="<?php echo $_SERVER["SCRIPT_NAME"];?>?admin/showAlbum&cpage=1&albumId=<?php echo $_GET["albumId"]; ?>">
上一页</a>
<?php 
}
else
{

?>
 <a href="<?php echo $_SERVER["SCRIPT_NAME"];?>?admin/showAlbum&cpage=<?php echo $pre_page; ?>&albumId=<?php echo $_GET["albumId"]; ?>">
      上一页</a>
<?php 
}
if( $_GET["cpage"] < $pages )
{
	

?>
<a href="<?php echo $_SERVER["SCRIPT_NAME"];?>?admin/showAlbum&cpage=<?php echo $next_page; ?>&albumId=<?php echo $_GET["albumId"]; ?>">
下一页</a>
<?php 
}
else 
{

?>

<a href="<?php echo $_SERVER["SCRIPT_NAME"];?>?admin/showAlbum&cpage=<?php echo $pages; ?>&albumId=<?php echo $_GET["albumId"]; ?>">
下一页</a>
<?php 
}
?>
跳转到
<select onchange="goToPage()" id="mySelect">
<?php 
for($i=1;$i<=$pages;$i++)
{
    $value = $_SERVER["SCRIPT_NAME"] . "?admin/showAlbum&cpage=" . $i . "&albumId=" . $_GET["albumId"];
    if( $i == $_GET["cpage"] )
    {
         echo "<option selected = \"selected\" value=\"" . $value . "\">第" . $i . "页</option>";
    }
    else
    {
    	echo "<option  value=\"" . $value . "\">第" . $i . "页</option>";
    }
}
?>
</select>
</td>
</tr>
</table>
</form>
