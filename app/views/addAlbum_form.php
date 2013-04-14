<form action="<?php echo $_SERVER["SCRIPT_NAME"]; ?>?admin/addAlbum"  method="post" enctype="multipart/form-data">
选择栏目：
<select name="topicId">
<?php
while( $row = $this->TopicModel->getTopic() )    //此处还是PHP和HTML混在一起
{
?>
    <option value="<?php echo $row["topicId"]; ?>"><?php echo $row["topicName"]; ?></option>
<?php 
}
?>
</select>
<br />
图集标题：
<input type="text" name="albumName" size="50" />
<br />
图集封面：
<input type="file" name="thumbPic" />
<br />
<input type="submit" value="upload" />
</form>

