<form action="<?php echo $_SERVER["SCRIPT_NAME"];?>?user/addFriends" method="post">
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
	echo "<td><a href=\"" . $_SERVER["SCRIPT_NAME"] . "?user/addFriend&userId=" . $row["userId"] . "\">关注</a></td>";
	echo "</tr>";
}
?>
	<tr align="center">
       <td colspan="1"><input type="submit" value="关注" /></td>
       <td colspan="5">
           <?php $url = $_SERVER["SCRIPT_NAME"] . "?user/user_index&which=addFriend"; $page = new page($url,$pages);$page->show_page();//分页?>
       </td>
   </tr>
</table>
