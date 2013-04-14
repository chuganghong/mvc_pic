<?php
/*
 * 显示我的日志，相当于微博中的我的微博
 * 仍然有重复代码
*/
$array_th = array(
		"ID",
		"日志内容",
		"发布时间",
		"操作"
);
$pre = $_SERVER["SCRIPT_NAME"]. "?user/deleteMyPost&contentId=";
$operation = array($pre=>"删除");
$object = $this->UserModel;
$table = "listMyPostTable";
$url = $_SERVER["SCRIPT_NAME"] . "?user/user_index&which=myPost";
$action = $_SERVER["SCRIPT_NAME"] . "?user/deleteMyPosts";
$method="post";
$submitValue = "删除";
$tableList = new tableList($array_th,$operation,$object,$table,$url,$action,$method,$submitValue,$pages);
$tableList->show_list();






/*
<table border="1" width="80%">

while( $row = $this->UserModel->getPost() )
{
?>
	<tr>
		<td><?php echo $row["content"]; ?></td>
		<td><?php echo $row["post"]; ?></td>
		<td><a href="<?php echo $_SERVER["SCRIPT_NAME"]; ?>?user/deleteMyPost&contentId=<?php echo $row["contentId"]; ?>">删除</a></td>
	</tr>
<?php
}
?>
</table>
*/