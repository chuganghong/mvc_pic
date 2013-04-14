<?php
/*
 * 显示我的首页，显示我关注的人的日志
  * 仍然有重复代码
  * 分页符为何会出现在表格的上方？
  * 这一页没有用form
*/
$array_th = array(
		"发布者",
		"日志标题",
		"发布时间",
		"操作"
);
$operation = array();
$object = $this->UserModel;
$table = new firstPageUserTable($array_th,$operation,$object);


$table->display();    //输出表格

$url = $_SERVER["SCRIPT_NAME"] . "?user/user_index&which=firstPage";
$page = new page($url,$pages);
$page->display();     //输出分页符。分页符为何会出现在表格的上方？








//$action = $_SERVER["SCRIPT_NAME"] . "?user/deleteMyPosts";
//$method="post";
//$submitValue = "删除";
//$tableList = new tableList($array_th,$operation,$object,$table,$url,$action,$method,$submitValue,$pages);
//$tableList->show_list();


/*
<table border="1" width="80%">

while( $row = $this->UserModel->getPost() )
{
?>
	<tr>
		<td><?php echo $row["userName"]; ?></td>
		<td><?php echo $row["content"]; ?></td>
		<td><?php echo $row["post"]; ?></td>
	</tr>
<?php
}
?>
</table>
*/