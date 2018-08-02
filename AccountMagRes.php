<?php require_once('Connections/sports.php'); ?>
<?php
if ( !isset( $_SESSION ) ) {
	session_start();
}
$username = $_SESSION[ 'MM_Username' ];

if ($username == NULL)
{
	echo "您未登录，请登录后重试";
	exit();
}

mysql_select_db( $database_sports, $sports );

$name1 = $_POST['name1'];
$relation1 = $_POST[ 'relation1' ];
$age1 = $_POST[ 'age1' ];
$name2 = $_POST['name2'];
$relation2 = $_POST[ 'relation2' ];
$age2 = $_POST[ 'age2' ];
$name3 = $_POST['name3'];
$relation3 = $_POST[ 'relation3' ];
$age3 = $_POST[ 'age3' ];
$name4 = $_POST['name4'];
$relation4 = $_POST[ 'relation4' ];
$age4 = $_POST[ 'age4' ];
$name5 = $_POST['name5'];
$relation5 = $_POST[ 'relation5' ];
$age5 = $_POST[ 'age5' ];

$result = array();
$thenum = 0;

if ( $name1 != NULL ) {
		$age1 = (int)$age1;
		$query_insertuser = sprintf( "insert into relation(user,RelativeName,relation,age) values ('$username','$name1','$relation1','$age1')" );
	if ( !mysql_query( $query_insertuser, $sports ) ) {
		array_push( $result, 1 );
		die( mysql_error() );
	}
	$thenum += 1;
}

if ( $name2 != NULL ) {
		$age2 = (int)$age2;
		$query_insertuser = sprintf( "insert into relation(user,RelativeName,relation,age) values ('$username','$name2','$relation2','$age2')" );
	if ( !mysql_query( $query_insertuser, $sports ) ) {
		array_push( $result, 2 );
		die( mysql_error() );
	}
	$thenum += 1;
}

if ( $name3 != NULL ) {
		$age3 = (int)$age3;
		$query_insertuser = sprintf( "insert into relation(user,RelativeName,relation,age) values ('$username','$name3','$relation3','$age3')" );
	if ( !mysql_query( $query_insertuser, $sports ) ) {
		array_push( $result, 3 );
		die( mysql_error() );
	}
	$thenum += 1;
}

if ( $name4 != NULL ) {
		$age4 = (int)$age4;
		$query_insertuser = sprintf( "insert into relation(user,RelativeName,relation,age) values ('$username','$name4','$relation4','$age4')" );
	if ( !mysql_query( $query_insertuser, $sports ) ) {
		array_push( $result, 4 );
		die( mysql_error() );
	}
	$thenum += 1;
}

if ( $name5 != NULL ) {
		$age5 = (int)$age5;
		$query_insertuser = sprintf( "insert into relation(user,RelativeName,relation,age) values ('$username','$name5','$relation5','$age5')" );
	if ( !mysql_query( $query_insertuser, $sports ) ) {
		array_push( $result, 5 );
		die( mysql_error() );
	}
	$thenum += 1;
}

if (count($result) == 0 && $thenum != 0)
{
	$_SESSION['success'] = 1;
	header( "location:AccountMag.php" );
}
elseif (count($result) == 0 && $thenum == 0)
{
	$_SESSION['success'] = 2;
	$_SESSION['result'] = $result;
	header( "location:AccountMag.php" );
}
else
{
	$_SESSION['result'] = $result;
	header( "location:AccountMag.php" );
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