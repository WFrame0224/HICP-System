<?php require_once('Connections/sports.php'); ?>
<?php
if ( !function_exists( "GetSQLValueString" ) ) {
	function GetSQLValueString( $theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "" ) {
		if ( PHP_VERSION < 6 ) {
			$theValue = get_magic_quotes_gpc() ? stripslashes( $theValue ) : $theValue;
		}

		$theValue = function_exists( "mysql_real_escape_string" ) ? mysql_real_escape_string( $theValue ) : mysql_escape_string( $theValue );

		switch ( $theType ) {
			case "text":
				$theValue = ( $theValue != "" ) ? "'" . $theValue . "'": "NULL";
				break;
			case "long":
			case "int":
				$theValue = ( $theValue != "" ) ? intval( $theValue ) : "NULL";
				break;
			case "double":
				$theValue = ( $theValue != "" ) ? doubleval( $theValue ) : "NULL";
				break;
			case "date":
				$theValue = ( $theValue != "" ) ? "'" . $theValue . "'": "NULL";
				break;
			case "defined":
				$theValue = ( $theValue != "" ) ? $theDefinedValue : $theNotDefinedValue;
				break;
		}
		return $theValue;
	}
}

mysql_select_db( $database_sports, $sports );
$query_login = "SELECT * FROM `user`";
$login = mysql_query( $query_login, $sports )or die( mysql_error() );
$row_login = mysql_fetch_assoc( $login );
$totalRows_login = mysql_num_rows( $login );
?>
<?php
// *** Validate request to login to this site.
if ( !isset( $_SESSION ) ) {
	session_start();
}

$loginFormAction = $_SERVER[ 'PHP_SELF' ];
if ( isset( $_GET[ 'accesscheck' ] ) ) {
	$_SESSION[ 'PrevUrl' ] = $_GET[ 'accesscheck' ];
}

if ( isset( $_POST[ 'name' ] ) ) {
	$loginUsername = $_POST[ 'name' ];
	$password = $_POST[ 'pwd' ];
	$MM_fldUserAuthorization = "";
	$MM_redirectLoginSuccess = "Admin-index.php";
	$MM_redirectLoginFailed = "login.php";
	$MM_redirecttoReferrer = false;
	mysql_select_db( $database_sports, $sports );

	$LoginRS__query = sprintf( "SELECT name, pwd FROM `user` WHERE name=%s AND pwd=%s",
		GetSQLValueString( $loginUsername, "text" ), GetSQLValueString( $password, "text" ) );

	$LoginRS = mysql_query( $LoginRS__query, $sports )or die( mysql_error() );
	$loginFoundUser = mysql_num_rows( $LoginRS );
	if ( $loginFoundUser ) {
		$loginStrGroup = "";

		if ( PHP_VERSION >= 5.1 ) {
			session_regenerate_id( true );
		} else {
			session_regenerate_id();
		}
		//declare two session variables and assign them
		$_SESSION[ 'MM_Username' ] = $loginUsername;
		$_SESSION[ 'MM_UserGroup' ] = $loginStrGroup;

		if ( isset( $_SESSION[ 'PrevUrl' ] ) && false ) {
			$MM_redirectLoginSuccess = $_SESSION[ 'PrevUrl' ];
		}
		header( "Location: " . $MM_redirectLoginSuccess );
	} else {
		header( "Location: " . $MM_redirectLoginFailed );
	}
}
?>
<!DOCTYPE html>
<html>

<head lang="en">
	<meta charset="UTF-8">
	<title>智健生活 | 登录</title>
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
					<a href="register.php"><button class="am-btn am-btn-secondary am-topbar-btn am-btn-sm"><span class="am-icon-pencil"></span>注册</button></a>
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
		<div class="am-u-lg-6 am-u-md-8 am-u-sm-centered">

			<br/>
			<form ACTION="<?php echo $loginFormAction; ?>" method="POST" name="login" class="am-form">
				<label for="name">用户名:</label>
				<input type="text" name="name" id="name" value="">
				<br>
				<label for="password">密码:</label>
				<input type="password" name="pwd" id="pwd" value="">
				<br>
				<label for="remember-me">
        <input id="remember-me" type="checkbox">
        记住密码
      </label>
			
				<br/>
				<br/>
				<div class="am-cf">
					<input type="submit" name="" value="登 录" class="am-btn am-btn-primary am-btn-sm am-fl">
					<input type="submit" name="" value="忘记密码 ^_^? " class="am-btn am-btn-default am-btn-sm am-fr">
				</div>
			</form>
			<hr>
			<!--    <p>© 2014 AllMobilize, Inc. Licensed under MIT license.</p>-->
		</div>
	</div>
</body>
<footer class="footer">
	<p>© 2018 研究生电子设计大赛 <a href="#智健小分队">智健小分队</a> (NWPU).</p>
</footer>

</html>
<?php
mysql_free_result( $login );
?>