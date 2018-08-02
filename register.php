<?php
error_reporting( E_ALL ^ E_NOTICE );
error_reporting( E_ALL ^ E_DEPRECATED );
?>
<?php
session_start();
$name = $_SESSION[ "LastName" ];
$pwd = $_SESSION[ "Lastpwd" ];
$email = $_SESSION[ "LastEmail" ];
$tel = $_SESSION[ "LastTel" ];
$gender = $_SESSION[ "LastGender" ];
$age = $_SESSION[ "LastAge" ];
$result = $_SESSION[ "result" ];
$pwdconfirm = $_SESSION["Lastpwdconfirm"];
session_destroy();
?>
<!DOCTYPE html>
<html>

<head lang="en">
	<meta charset="UTF-8">
	<title>智健生活 | 注册</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="format-detection" content="telephone=no">
	<meta name="renderer" content="webkit">
	<meta http-equiv="Cache-Control" content="no-siteapp"/>
	<link rel="alternate icon" type="image/png" href="assets/i/favicon.png">
	<link rel="stylesheet" href="assets/css/amazeui.min.css"/>
	<link rel="stylesheet" href="assets/css/myapp.css"/>
</head>

<body>

	<header class="am-topbar am-topbar-fixed-top">
		<div class="am-container">
			<h1 class="am-topbar-brand">
      <a href="index.php" class="am-icon-home am-icon-sm"> 智健生活</a>
    </h1>

			<div class="am-collapse am-topbar-collapse" id="collapse-head">

				<div class="am-topbar-right">
					<a href="login.php"><button class="am-btn am-btn-secondary am-topbar-btn am-btn-sm"><span class="am-icon-pencil"></span>登录</button></a>
				</div>
			</div>
		</div>
	</header>

	<div class="get" style="padding: 30px">
		<div class="am-g">
			<div class="am-u-lg-12">
				<h1 class="get-title">智健生活</h1>
				<p>家庭智能健身教练<br/>健身陪护，私人订制</p>
			</div>
		</div>
	</div>

	<div class="am-g">
		<div class="am-u-lg-6 am-u-md-8 am-u-sm-centered" style="width: 450px">
			<br/>
			<form name="form" method="POST" class="am-form" action="RegResult.php">
				<label><span style="color: red">*</span>用户名:</label>
				<input type="text" name="name" id="name" value="<?php echo $name ?>">
				<?php
				if ( in_array( 1, $result ) ) {
					echo '<p style = "color: #F80004">用户已存在</p>';
				} else if ( in_array( 2, $result ) ) {
					echo '<p style = "color: #F80004">请输入用户名</p>';
				}
				?>
				<br>
				<label><span style="color: red">*</span>密码:</label>
				<input type="password" name="pwd" id="pwd" value="<?php echo $pwd ?>">
				<?php
				if ( in_array( 3, $result ) ) {
					echo '<p style = "color: #F80004">请输入密码</p>';
				} else if ( in_array( 6, $result ) ) {
					echo '<p style = "color: #F80004">两次输入密码不相同</p>';
				}
				?>
				<br>
				<label><span style="color: red">*</span>确认密码:</label>
				<input type="password" name="pwdconfirm" id="pwdconfirm" value="<?php echo $pwdconfirm ?>">
				<?php
				if ( in_array( 3, $result ) ) {
					echo '<p style = "color: #F80004">请输入密码</p>';
				} else if ( in_array( 6, $result ) ) {
					echo '<p style = "color: #F80004">两次输入密码不相同</p>';
				}
				?>
				<br>
				<label>邮箱:</label>
				<input type="text" name="email" id="email" value="<?php echo $email ?>">
				<?php
				if ( in_array( 4, $result ) ) {
					echo '<p style = "color: #F80004">请检查邮箱格式</p>';
				}
				?>
				<br>
				<label>手机:</label>
				<input type="text" name="tel" id="tel" value="<?php echo $tel ?>">
				<?php
				if ( in_array( 5, $result ) ) {
					echo '<p style = "color: #F80004">请输入11位纯数字手机号</p>';
				}
				?>
				<br/>
				<label>性别:</label>
				<select name="gender">
					<option value="male">男</option>
					<option value="female">女</option>
				</select>
				<br/>
				<label>年龄:</label>
				<input type="text" name="age" id="age" value="<?php echo $age ?>">
				<br/>
				<div class="am-cf">
					<input type="submit" name="" value="注 册" class="am-btn am-btn-primary am-btn-sm am-fl">
				</div>
			</form>
		</div>
		<br/>
	</div>
	<footer class="footer">
		<p>© 2018 研究生电子设计大赛 <a href="#智健小分队">智健小分队</a> (NWPU).</p>
	</footer>

</body>

</html>