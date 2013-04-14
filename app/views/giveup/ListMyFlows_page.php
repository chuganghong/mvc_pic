<?php
/*
 * listAlbum.php页面的分页符
 */

$cpage = $_GET["cpage"];
$pre_page = $cpage-1;
$next_page = $cpage+1;
if( !isset($_GET["cpage"]) || $_GET["cpage"] == 1 )
{
	

?>
<a href="<?php echo $_SERVER["SCRIPT_NAME"]?>?user/user_index&which=myFlows">上一页</a>
<?php 
}
else
{
?>
<a href="<?php echo $_SERVER["SCRIPT_NAME"]?>?user/user_index&which=myFlows&cpage=<?php echo $pre_page; ?>">上一页</a>

<?php 
}
if( $_GET["cpage"]< $pages )   //$pages是总页数
{
?>
<a href="<?php echo $_SERVER["SCRIPT_NAME"]; ?>?user/user_index&which=myFlows&cpage=<?php echo $next_page; ?>">下一页</a>
<?php 
}
else
{
?>
<a href="<?php echo $_SERVER["SCRIPT_NAME"]; ?>?user/user_index&which=myFlows&cpage=<?php echo $pages; ?>">下一页</a>
<?php
}

echo "跳到";
echo "<select id=\"mySelect\" onchange=\"goToPage()\" >";

for($i=1;$i<=$pages;$i++)
{
	$value = $_SERVER["SCRIPT_NAME"] . "?user/user_index&which=myFlows&cpage=" . $i;
	if( $i == $_GET["cpage"] )
	{
	      echo "<option selected=\"selected\" value=\"" .$value . "\" >第". $i . "页</option>";
	}
	else
	{
		echo "<option  value=\"" .$value . "\" >第". $i . "页</option>";
	}
}
echo "</select>";
?>

<a href="#">每页显示5条（暂无法实现）</a>