<?php
if ( !isset( $_SESSION ) ) {
	session_start();
}
$result = $_SESSION[ "result" ];
$success = $_SESSION['success'];

mysql_select_db( $database_sports, $sports );

unset($_SESSION['result']);
unset($_SESSION['success']);
?>


<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>智健生活 | 成员管理</title>
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
	echo "<script>alert('添加成功');</script>";
}
else if ($success == 2)
{
	echo "<script>alert('请添加至少一个成员');</script>";
}
?>
	<div class="admin-content">
		<div class="am-cf am-padding">
			<div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">成员管理</strong> / <small>Member Management</small>
			</div>
		</div>

		<hr/>
		<br/>
		<div class="am-g">
			<form class="am-form am-form-horizontal" method="post" action="AccountMagRes.php">
				<div class="am-u-sm-12" style="margin:15px 0">
					<div class="am-form-group">
						<div class="am-u-sm-3 am-u-sm-offset-1">
							<div class="am-form-group">
								<label for="member-age" class="am-u-sm-3 am-form-label">姓名</label>
								<div class="am-u-sm-9">
									<input type="text" name="name1" id="member-age" placeholder="姓 名">
								</div>
							</div>
						</div>
						<div class="am-u-sm-3">
							<label for="member-role" class="am-u-sm-3 am-form-label">角色</label>
							<div class="am-u-sm-9">
								<select name="relation1" id="ser-role">
									<option value="host" selected="selected">丈夫 | 男主人</option>
									<option value="hostess">妻子 | 女主人</option>
									<option value="father">父亲</option>
									<option value="mother">母亲</option>
									<option value="son">儿子</option>
									<option value="daughter">女儿</option>
								</select>
							</div>
						</div>
						<div class="am-u-sm-3">
							<div class="am-form-group">
								<label for="member-age" class="am-u-sm-3 am-form-label">年龄</label>
								<div class="am-u-sm-9">
									<input type="number" name="age1" id="member-age" placeholder="年龄 / Age(10~90)" min="10" max="90">
								</div>
							</div>
						</div>
						<div class="am-u-sm-2">
							<span class="am-badge am-badge-success">&#8730</span>
							<input type="radio" name="member-select1" checked>
							<p> </p>
							<span class="am-badge am-badge-danger">&#935</span>
							<input type="radio" name="member-select1">
						</div>
					</div>
				</div>
				<br/>
				<div class="am-u-sm-12" style="margin:15px 0">
					<div class="am-form-group">
						<div class="am-u-sm-3 am-u-sm-offset-1">
							<div class="am-form-group">
								<label for="member-age" class="am-u-sm-3 am-form-label">姓名</label>
								<div class="am-u-sm-9">
									<input type="text" name="name2" id="member-age" placeholder="姓 名">
								</div>
							</div>
						</div>
						<div class="am-u-sm-3">
							<label for="member-role" class="am-u-sm-3 am-form-label">角色</label>
							<div class="am-u-sm-9">
								<select name="relation2" id="ser-role">
									<option value="host" selected="selected">丈夫 | 男主人</option>
									<option value="hostess">妻子 | 女主人</option>
									<option value="father">父亲</option>
									<option value="mother">母亲</option>
									<option value="son">儿子</option>
									<option value="daughter">女儿</option>
								</select>
							</div>
						</div>
						<div class="am-u-sm-3">
							<div class="am-form-group">
								<label for="member-age" class="am-u-sm-3 am-form-label">年龄</label>
								<div class="am-u-sm-9">
									<input type="number" name="age2" id="member-age" placeholder="年龄 / Age(10~90)" min="10" max="90">
								</div>
							</div>
						</div>
						<div class="am-u-sm-2">
							<span class="am-badge am-badge-success">&#8730</span>
							<input type="radio" name="member-select2" checked>
							<p> </p>
							<span class="am-badge am-badge-danger">&#935</span>
							<input type="radio" name="member-select2">
						</div>
					</div>
				</div>
				<br/>
				<div class="am-u-sm-12" style="margin:15px 0">
					<div class="am-form-group">
						<div class="am-u-sm-3 am-u-sm-offset-1">
							<div class="am-form-group">
								<label for="member-age" class="am-u-sm-3 am-form-label">姓名</label>
								<div class="am-u-sm-9">
									<input type="text" name="name3" id="member-age" placeholder="姓 名">
								</div>
							</div>
						</div>
						<div class="am-u-sm-3">
							<label for="member-role" class="am-u-sm-3 am-form-label">角色</label>
							<div class="am-u-sm-9">
								<select name="relation3" id="ser-role">
									<option value="host" selected="selected">丈夫 | 男主人</option>
									<option value="hostess">妻子 | 女主人</option>
									<option value="father">父亲</option>
									<option value="mother">母亲</option>
									<option value="son">儿子</option>
									<option value="daughter">女儿</option>
								</select>
							</div>
						</div>
						<div class="am-u-sm-3">
							<div class="am-form-group">
								<label for="member-age" class="am-u-sm-3 am-form-label">年龄</label>
								<div class="am-u-sm-9">
									<input type="number" name="age3" id="member-age" placeholder="年龄 / Age(10~90)" min="10" max="90">
								</div>
							</div>
						</div>
						<div class="am-u-sm-2">
							<span class="am-badge am-badge-success">&#8730</span>
							<input type="radio" name="member-select3" checked>
							<p> </p>
							<span class="am-badge am-badge-danger">&#935</span>
							<input type="radio" name="member-select3">
						</div>
					</div>
				</div>
				<br/>
				<div class="am-u-sm-12" style="margin:15px 0">
					<div class="am-form-group">
						<div class="am-u-sm-3 am-u-sm-offset-1">
							<div class="am-form-group">
								<label for="member-age" class="am-u-sm-3 am-form-label">姓名</label>
								<div class="am-u-sm-9">
									<input type="text" name="name4" id="member-age" placeholder="姓 名">
								</div>
							</div>
						</div>
						<div class="am-u-sm-3">
							<label for="member-role" class="am-u-sm-3 am-form-label">角色</label>
							<div class="am-u-sm-9">
								<select name="relation4" id="ser-role">
									<option value="host" selected="selected">丈夫 | 男主人</option>
									<option value="hostess">妻子 | 女主人</option>
									<option value="father">父亲</option>
									<option value="mother">母亲</option>
									<option value="son">儿子</option>
									<option value="daughter">女儿</option>
								</select>
							</div>
						</div>
						<div class="am-u-sm-3">
							<div class="am-form-group">
								<label for="member-age" class="am-u-sm-3 am-form-label">年龄</label>
								<div class="am-u-sm-9">
									<input type="number" name="age4" id="member-age" placeholder="年龄 / Age(10~90)" min="10" max="90">
								</div>
							</div>
						</div>
						<div class="am-u-sm-2">
							<span class="am-badge am-badge-success">&#8730</span>
							<input type="radio" name="member-select4" checked>
							<p> </p>
							<span class="am-badge am-badge-danger">&#935</span>
							<input type="radio" name="member-select4">
						</div>
					</div>
				</div>
				<br/>
				<div class="am-u-sm-12" style="margin:15px 0">
					<div class="am-form-group">
					<div class="am-u-sm-3 am-u-sm-offset-1">
							<div class="am-form-group">
								<label for="member-age" class="am-u-sm-3 am-form-label">姓名</label>
								<div class="am-u-sm-9">
									<input type="text" name="name5" id="member-age" placeholder="姓 名">
								</div>
							</div>
						</div>
						<div class="am-u-sm-3">
							<label for="member-role" class="am-u-sm-3 am-form-label">角色</label>
							<div class="am-u-sm-9">
								<select name="relation5" id="ser-role">
									<option value="host" selected="selected">丈夫 | 男主人</option>
									<option value="hostess">妻子 | 女主人</option>
									<option value="father">父亲</option>
									<option value="mother">母亲</option>
									<option value="son">儿子</option>
									<option value="daughter">女儿</option>
								</select>
							</div>
						</div>
						<div class="am-u-sm-3">
							<div class="am-form-group">
								<label for="member-age" class="am-u-sm-3 am-form-label">年龄</label>
								<div class="am-u-sm-9">
									<input type="number" name="age5" id="member-age" placeholder="年龄 / Age(10~90)" min="10" max="90">
								</div>
							</div>
						</div>
						<div class="am-u-sm-2">
							<span class="am-badge am-badge-success">&#8730</span>
							<input type="radio" name="member-select5" checked>
							<p> </p>
							<span class="am-badge am-badge-danger">&#935</span>
							<input type="radio" name="member-select5">
						</div>
					</div>

				</div>
				<hr/>
				<div class="am-u-sm-3 am-u-sm-offset-5">
					<div class="am-u-sm-centered">
						<input type="submit" name="" value="保存修改" class="am-btn am-btn-primary">
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/amazeui.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>

</html>