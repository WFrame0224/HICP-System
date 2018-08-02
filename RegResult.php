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

$colname_finduser = "-1";
if ( isset( $_POST[ 'name' ] ) ) {
	$colname_finduser = $_POST[ 'name' ];
}
mysql_select_db( $database_sports, $sports );
$query_finduser = sprintf( "SELECT name FROM `user` WHERE name = %s", GetSQLValueString( $colname_finduser, "text" ) );
$finduser = mysql_query( $query_finduser, $sports )or die( mysql_error() );
$row_finduser = mysql_fetch_assoc( $finduser );
$totalRows_finduser = mysql_num_rows( $finduser );

error_reporting( E_ALL ^ E_NOTICE );
error_reporting( E_ALL ^ E_DEPRECATED );
?>
<?php
if ( !isset( $_SESSION ) ) {
	session_start();
}

$name = $_POST[ "name" ];
$pwd = $_POST[ "pwd" ];
$pwdconfirm = $_POST[ 'pwdconfirm' ];
$email = $_POST[ "email" ];
$emailpattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/";
$tel = $_POST[ "tel" ];
$telpattern = "/^1[345789]\d{9}$/";
$gender = $_POST[ "gender" ];
$age = $_POST[ "age" ];


function ToLastPage( $result ) {
	$_SESSION[ "LastName" ] = $GLOBALS[ "name" ];
	$_SESSION[ "Lastpwd" ] = $GLOBALS[ "pwd" ];
	$_SESSION[ "Lastpwdconfirm" ] = $GLOBALS[ "pwdconfirm" ];
	$_SESSION[ "LastEmail" ] = $GLOBALS[ "email" ];
	$_SESSION[ "LastTel" ] = $GLOBALS[ "tel" ];
	$_SESSION[ "LastGender" ] = $GLOBALS[ "gender" ];
	$_SESSION[ "LastAge" ] = $GLOBALS[ "age" ];
	$_SESSION[ "result" ] = $result;
	header( "location:register.php" );
}
?>

<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>无标题文档</title>
</head>

<body>
	<?php
	$result = array();
	if ( $totalRows_finduser ) {
		array_push( $result, 1 );
	}
	if ( $name == NULL ) {
		array_push( $result, 2 );
	}
	if ( $pwd == NULL ) {
		array_push( $result, 3 );
	}
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
	if ( $pwd != $pwdconfirm ) {
		array_push( $result, 6 );
	}

	//	for ($i=0; $i<count($result); $i++)
	//	{
	//		echo $result[$i];
	//		echo "<br>";
	//	}

	if ( count( $result ) == 0 ) {
		if ( $age == NULL ) {
			$query_insertuser = sprintf( "insert into user(name,pwd,email,tel,gender,age) values ('$name','$pwd','$email','$tel','$gender',NULL)" );
		} else {
			$age = ( int )$age;
			$query_insertuser = sprintf( "insert into user(name,pwd,email,tel,gender,age) values ('$name','$pwd','$email','$tel','$gender','$age')" );
		}

		if ( !mysql_query( $query_insertuser, $sports ) ) {
			die( mysql_error() );
		} else {
			//			echo "<p>success</p>";
			echo '
			<p>注册成功，3秒后跳转至登录页面</p>
			<p>如果长时间未跳转，请<a href = "login.php">点击这里</a></p>手动跳转';
			header( "Refresh:3;url=login.php" );
		}
	} else {
		ToLastPage( $result );
	}
	?>



</body>

</html>
<?php
mysql_free_result( $finduser );
?>