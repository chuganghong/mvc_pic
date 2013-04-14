<?php 
/*
 * 仍然有重复代码，难道我应该再次将其封装成一个类吗？若这样做，没有什么好处。
 */
//$className = __CLASS__;
var_dump($className);   //test
if( $className=="admin" )
{
	//$pre = "?user/addFriend&userId=";
	$pre="#";
	$operation = array($pre=>"删除");
	$url = $_SERVER["SCRIPT_NAME"] . "?admin/admin_index&which=ListUser";
	$action = $_SERVER["SCRIPT_NAME"] . "?admin/deleteUser";
	$submitValue = "删除";
}
else if( $className=="user")
{
	$pre = "?user/addFriend&userId=";
	$operation = array($pre=>"关注");
	$url = $_SERVER["SCRIPT_NAME"] . "?user/user_index&which=addFriend";
	$action = $_SERVER["SCRIPT_NAME"] . "?user/addFriends";
	$submitValue = "关注";
}




$array_th = array(
		"ID",
		"用户名",
		"操作"
);

$object = $this->UserModel;
$table = "listUserTable";



$method="post";




$tableList = new tableList($array_th,$operation,$object,$table,$url,$action,$method,$submitValue,$pages);
$tableList->show_list();












/*
 * 仍然有重复代码
 
$array_th = array(
		"ID",
		"用户名",
		"操作"
);
$pre = "#";
$operation = array($pre=>"删除");
$object = $this->UserModel;
$table = new listUserTable($array_th,$operation,$object);
//$table->show_table();
//分页
$url = $_SERVER["SCRIPT_NAME"] . "?admin/admin_index&which=ListUser";
$page = new page($url,$pages);

$action = $_SERVER["SCRIPT_NAME"] . "?admin/deleteUser";
$method="post";
$submitValue = "删除";
$content = array($table,$page);
$form = new form($action,$method,$submitValue,$other="",$content);







<form action="<?php echo $_SERVER["SCRIPT_NAME"];?>?admin/deleteUser" method="post">
<table border="1" width="80%" align="center">
	<tr>
		<th><span onclick="check()">全选</span>
             <span onclick="uncheck()">反选</span>
         </th>
		<th>ID</th>
		<th>用户名</th>
		<th>操作</th>
	</tr>
<?php
while( $row = $this->UserModel->getUser() )
{
	echo "<tr align=\"center\">";
	echo "<td><input type=\"checkbox\" name=\"userId[]\" value=\"" . $row["userId"] . "\" /></td>";
	echo "<td>" . $row["userId"] . "</td>";
	echo "<td>" . $row["userName"] . "</td>";
	echo "<td>删除</td>";
	echo "</tr>";
}
?>
	<tr align="center">
       <td colspan="1"><input type="submit" value="删除" /></td>
       <td colspan="5">
           <?php $url = $_SERVER["SCRIPT_NAME"] . "?admin/admin_index&which=ListUser"; $page = new page($url,$pages);$page->show_page();//分页?>
       </td>
   </tr>
</table>
*/