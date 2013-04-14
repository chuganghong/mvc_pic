<?php 
/*
 * 收件箱
 */
$array_th = array(
		"发信人",
		"信件内容",
		"发送时间",
		"操作"
);
$pre_1 = "#";
$pre_2 = "##";
$operation = array($pre_1=>"查看信件",$pre_2=>"删除");
$object = $this->UserModel;
$table = "listMailBoxTable";
$url = $_SERVER["SCRIPT_NAME"] . "?user/user_index&which=mailBox";
$action = $_SERVER["SCRIPT_NAME"] . "?admin/deleteAlbum";
$method="post";
$submitValue = "删除";
$tableList = new tableList($array_th,$operation,$object,$table,$url,$action,$method,$submitValue,$pages);
$tableList->show_list();








/*
<table border="1">
<?php
while( $row = $this->UserModel->getMail() )
{
	echo "<tr>";
	echo "<td>" . $row["userName"] . "</td>";
	echo "<td>" .$row["mailContent"] . "</td>";    //test
	echo "<td>" . $row["mailTime"] . "</td>";
	echo "</tr>";
}
?>
</table>
*/