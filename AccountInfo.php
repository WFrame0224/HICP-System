<?php
if ( !isset( $_SESSION ) ) {
	session_start();
}
$result = $_SESSION[ "result" ];
$success = $_SESSION['success'];

unset($_SESSION['result']);
unset($_SESSION['success']);
?>
<?php require_once('Connections/sports.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$colname_getuserinfo = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_getuserinfo = $_SESSION['MM_Username'];
}
mysql_select_db($database_sports, $sports);
$query_getuserinfo = sprintf("SELECT * FROM `user` WHERE name = %s", GetSQLValueString($colname_getuserinfo, "text"));
$getuserinfo = mysql_query($query_getuserinfo, $sports) or die(mysql_error());
$row_getuserinfo = mysql_fetch_assoc($getuserinfo);
$totalRows_getuserinfo = mysql_num_rows($getuserinfo);
?>

<?php
function setvalue($field)
{
	if ($GLOBALS['row_getuserinfo'][$field] != NULL)
	{
//		echo 'value = "'.$row_getuserinfo[$field].'"';
		echo $GLOBALS['row_getuserinfo'][$field];
	}
	else
		echo "";
}

function setsellected($field, $num)
{
	if ($GLOBALS['row_getuserinfo'][$field] == $num)
	{
		echo 'selected="selected"';
	}
	else
		echo "";
}
?>

<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>智健生活 | 账户资料</title>
	<meta name="description" content="这是一个管理页面的用户页面">
	<meta name="keywords" content="user">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta name="renderer" content="webkit">
	<meta http-equiv="Cache-Control" content="no-siteapp"/>
	<meta name="apple-mobile-web-app-title" content="Amaze UI"/>
	<link rel="stylesheet" href="assets/css/amazeui.min.css"/>
	<link rel="stylesheet" href="assets/css/AccountInfo.css">
</head>


<body>
<?php
if ($success == 1)
{
	echo "<script>alert('修改成功');</script>";
}	
?>
	<div class="admin-content">
		<div class="am-cf am-padding">
			<div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">账户资料</strong> / <small>Personal information</small>
			</div>
		</div>

		<hr/><br/><br/>
		<div class="am-g">
			<div class="am-u-sm-6 am-u-sm-offset-3">
				<form class="am-form am-form-horizontal" action="AccountInfoRes.php" method="POST">
					<div class="am-form-group">
						<label for="user-name" class="am-u-sm-3 am-form-label">姓名 / Name</label>
						<div class="am-u-sm-9">
							<input type="text" name="truename" id="user-name" placeholder="姓名 / Name" value = "<?php setvalue('truename') ?>">
						</div>
					</div>

					<div class="am-form-group">
						<label for="user-email" class="am-u-sm-3 am-form-label">电子邮件 / Email</label>
						<div class="am-u-sm-9">
							<input type="email" name="email" id="user-email" placeholder="输入你的电子邮件 / Email" value = "<?php setvalue('email') ?>">
							<?php
							if ( in_array( 4, $result ) ) {
								echo '<p style = "color: #F80004">请检查邮箱格式</p>';
							}
							?>
						</div>
					</div>

					<div class="am-form-group">
						<label for="user-phone" class="am-u-sm-3 am-form-label">电话 / Telephone</label>
						<div class="am-u-sm-9">
							<input type="text" name="tel" id="user-phone" placeholder="输入你的电话号码 / Telephone" value = "<?php setvalue('tel') ?>">
							<?php
							if ( in_array( 5, $result ) ) {
								echo '<p style = "color: #F80004">请输入11位纯数字手机号</p>';
							}
							?>
						</div>
					</div>

					<div class="am-form-group">
						<label for="user-QQ" class="am-u-sm-3 am-form-label">QQ</label>
						<div class="am-u-sm-9">
							<input type="text" name="qq" id="user-QQ" placeholder="输入你的QQ号码" value = "<?php setvalue('qq') ?>">
						</div>
					</div>

					<div class="am-form-group">
						<label for="user-weibo" class="am-u-sm-3 am-form-label">微信 / Wechat</label>
						<div class="am-u-sm-9">
							<input type="text" name="wechat" id="user-weibo" placeholder="输入你的微信 / Wechat" value = "<?php setvalue('wechat') ?>">
						</div>
					</div>
					
					<div class="am-form-group">
						<label for="user-gender" class="am-u-sm-3 am-form-label">性别 / Gender</label>
						<div class="am-u-sm-9">
							<select name="gender">
								<option value = "male" <?php setsellected("gender", "male") ?>>男</option>
								<option value = "female" <?php setsellected("gender", "female") ?>>女</option>
							</select>
						</div>
					</div>
					
					<div class="am-form-group">
						<label for="user-age" class="am-u-sm-3 am-form-label">年龄 / Age</label>
						<div class="am-u-sm-9">
							<input type="text" name="age" id="user-age" placeholder="输入你的年龄 / Age" value = "<?php setvalue('age') ?>">
						</div>
					</div>

					<div class="am-form-group">
						<label for="user-role" class="am-u-sm-3 am-form-label">角色 / Role</label>
						<div class="am-u-sm-9">
							<select name="relation" id="ser-role">
								<option value="host" <?php setsellected("relation", 'host') ?>>丈夫 | 男主人</option>
								<option value="hostess" <?php setsellected("relation",'hostess') ?>>妻子 | 女主人</option>
								<option value="father" <?php setsellected("relation",'father') ?>>父亲</option>
								<option value="mother" <?php setsellected("relation",'mother') ?>>母亲</option>
								<option value="son" <?php setsellected("relation",'son') ?>>儿子</option>
								<option value="daughter" <?php setsellected("relation",'daughter') ?>>女儿</option>
							</select>
						</div>
					</div>

					<div class="am-form-group">
						<div class="am-u-sm-9 am-u-sm-push-3">
							<input type="submit" name="" value="保存修改" class="am-btn am-btn-primary">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>

</html>
<?php
mysql_free_result($getuserinfo);

mysql_free_result($getuser);
?>
