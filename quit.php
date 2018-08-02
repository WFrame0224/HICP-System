<?php
if ( !isset( $_SESSION ) ) {
	session_start();
}

session_destroy();
header( "location:index.php" );
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