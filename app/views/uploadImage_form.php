<?php require("header.html"); ?>
<?php require("menu.php"); ?>

<form enctype="multipart/form-data" action="<?php echo $_SERVER["SCRIPT_NAME"];?>?admin/uploadImage&albumId=<?php echo  $_GET["albumId"];  ?>"  method="post">
<span>选择图片</span>
<input type="file" name="pic" />
<input type="submit" value="upload" />
</form>

<?php require("footer.html"); ?>
