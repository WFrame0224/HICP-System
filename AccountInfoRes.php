<?php require_once('Connections/sports.php'); ?>
<?php
if ( !isset( $_SESSION ) ) {
	session_start();
}
$username = $_SESSION[ 'MM_Username' ];
if ($username == NULL)
{
	echo '
	<p>您未登录，请先登录，3秒后跳转至登录页面</p>
	<p>如果长时间未跳转，请<a href = "login.php">点击这里</a></p>手动跳转';
	header( "Refresh:3;url=login.php" );
}

mysql_select_db( $database_sports, $sports );

$truename = $_POST[ "truename" ];
$email = $_POST[ "email" ];
$emailpattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/";

$tel = $_POST[ "tel" ];
$telpattern = "/^1[345789]\d{9}$/";

$qq = $_POST[ 'qq' ];
$wechat = $_POST[ 'wechat' ];
$gender = $_POST[ "gender" ];
$age = $_POST[ "age" ];
$relation = $_POST[ 'relation' ];


function ToLastPage( $result ) {
	//	$_SESSION[ "LastName" ] = $GLOBALS[ "name" ];
	//	$_SESSION[ "LastEmail" ] = $GLOBALS[ "email" ];
	//	$_SESSION[ "LastTel" ] = $GLOBALS[ "tel" ];
	//	$_SESSION[ "LastQQ" ] = $GLOBALS[ "qq" ];
	//	$_SESSION[ "LastWechat" ] = $GLOBALS[ "wechat" ];
	//	$_SESSION[ "LastGender" ] = $GLOBALS[ "gender" ];
	//	$_SESSION[ "LastAge" ] = $GLOBALS[ "age" ];
	$_SESSION[ "result" ] = $result;
	header( "location:AccountInfo.php" );
}

$result = array();

if ( $email != NULL ) {
	if ( !preg_match( $emailpattern, $email ) ) {
		array_push( $result, 4 );
	}
}
if ( $tel != NULL ) {
	if ( !preg_match( $telpattern, $tel ) ) {
		array_push( $result, 5 );
	}
}
if ( count( $result ) == 0 ) {
	if ( $age == NULL ) {
		$query_insertuser = sprintf( "update user set truename='$truename',email='$emale',tel='$tel',qq='$qq',wechat='$wechat',gender='$gender',age=NULL,relation='$relation' where name='$username'");
	} else {
		$age = ( int )$age;
		$query_insertuser = sprintf( "update user set truename='$truename',email='$emale',tel='$tel',qq='$qq',wechat='$wechat',gender='$gender',age=$age,relation='$relation' where name='$username'");
	}

	if ( !mysql_query( $query_insertuser, $sports ) ) {
		echo "mysql error";
		die( mysql_error() );
	} else {
		//			echo "<p>success</p>";
		$_SESSION['success'] = 1;
		header( "location:AccountInfo.php" );
	}
} else {
	ToLastPage( $result );
}
?>

<!doctype html>
<html>

<head>
<meta charset="utf-8">
<title>无标题文档</title>
</head>

<body>
</body>

</html>