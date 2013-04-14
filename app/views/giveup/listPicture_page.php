<?php
/*
 * 图片列表页的分页
 * mvc_pic中出现了多次分页代码，应该将其封装。
 * 在这里，我处于练习的目的，再次写分页代码
 * $pages是总页数
 * 之所以把最下面的大段代码换成现在的代码，是因为“上一页”和“下一页”连在一起，我无法解决，无奈，只能换做之前能够得到正确效果的代码。
 * 用PHP输出HTML会带来副作用吗？
 */
$cpage = $_GET["cpage"];
$pre_page = $cpage-1;
$next_page = $cpage+1;

if( !isset($cpage) || $cpage==1 )
{
?>
<a href="<?php echo $_SERVER["SCRIPT_NAME"]; ?>?admin/admin_index&which=ListPicture&cpage=1 ">上一页</a>
<?php
}
else
{
?>
<a href="<?php echo $_SERVER["SCRIPT_NAME"]; ?>?admin/admin_index&which=ListPicture&cpage=<?php echo $pre_page; ?>">上一页</a>
<?php
}
if( $cpage<$pages )
{
?>
<a href="<?php echo $_SERVER["SCRIPT_NAME"]; ?>?admin/admin_index&which=ListPicture&cpage=<?php echo $next_page; ?>">下一页</a>
<?php
}
else
{
?>
<a href="<?php echo $_SERVER["SCRIPT_NAME"]; ?>?admin/admin_index&which=ListPicture&cpage=<?php echo $pages; ?>">下一页</a>
<?php
}
 echo " 跳转到";
echo "<select onchange=\"goToPage()\" id=\"mySelect\">";
for($i=1;$i<=$pages;$i++)
{
    $value = $_SERVER["SCRIPT_NAME"] . "?admin/admin_index&which=ListPicture&cpage=" . $i;
    if( $cpage == $i )
    {
 	     echo "<option value=\"" . $value . "\" selected=\"selected\" >";
    }
 	else
 	{
 		 echo "<option value=\"" . $value . "\" >";
 	}
 	echo "第" . $i . "页";
 	echo "</option>";
}
echo "</select>";

/*
if( !isset($cpage) || $cpage==1 )
{
	echo "<a href=\"" . $_SERVER["SCRIPT_NAME"] ."?admin/admin_index&which=ListPicture&cpage=1\">";
	echo " 上一页  ";
	echo "</a>\n";
	echo " ";
}
else
{
	echo "<a href=\"" . $_SERVER["SCRIPT_NAME"] . "?admin/admin_index&which=ListPicture&cpage=" . $pre_page . "\">";
	echo " 上一页  ";
	echo "</a>\n";
	echo " ";
}
if( $cpage<$pages )
{
	echo "<a href=\"" . $_SERVER["SCRIPT_NAME"] . "?admin/admin_index&which=ListPicture&cpage=" . $next_page . "\">";
	echo "  下一页  ";
	echo "</a>\n";
	echo " ";
}
else
{
	echo "   <a href=\"" . $_SERVER["SCRIPT_NAME"] . "?admin/admin_index&which=ListPicture&cpage=" . $pages . "\">";
	echo "  下一页  ";
	echo "</a>\n";
	echo " ";
}
 echo " 跳转到";
echo "<select onchange=\"goToPage()\" id=\"mySelect\">";
for($i=1;$i<=$pages;$i++)
{
    $value = $_SERVER["SCRIPT_NAME"] . "?admin/admin_index&which=ListPicture&cpage=" . $i;
 	echo "<option value=\"" . $value . "\">";
 	echo "第" . $i . "页";
 	echo "</option>";
}
echo "</select>";
*/
 
    
