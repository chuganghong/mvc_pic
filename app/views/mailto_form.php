<?php
/*
 * 发送私信的表单
 */
?>
<form action="<?php echo $_SERVER["SCRIPT_NAME"]; ?>?user/mailto" method="post">
<span>收信人：</span>
<input type="text" name="receiver" id="receiver"/>
<input type="text" name="receiverId" id="receiverId" />
<br />
<textarea name="mailContent"></textarea>
<br />
<input type="submit" value="发送">
<table border="1">
<tr>
	<th>通讯录</th>
</tr>
<?php 
while( $row = $this->UserModel->getUser() )
{
	echo "<tr>";
	$id = $row["userId"];
	echo "<td onclick=\"choseReceiver(this.innerHTML," . $id . ")\">" . $row["userName"] . "</td>";
	//echo "<td><input type=\"checkbox\" name=\"userId[]\" value=\"" . $row["userId"] . "\" /></td>";
	//echo "<td>" . $row["userId"] . "</td>";
	//echo "<td>" . $row["userName"] . "</td>";
	//echo "<td><a href=\"" . $_SERVER["SCRIPT_NAME"] . "?user/spliceFriend&userId=" . $row["userId"] . "\">取消关注</a></td>";
	echo "</tr>";
}
?>

</table>
</form>