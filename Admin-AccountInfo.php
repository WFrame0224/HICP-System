<?php
if ( !isset( $_SESSION ) ) {
	session_start();
}
$username = $_SESSION[ 'MM_Username' ];
//$username = 'mumu';
?>
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
$query_getrelation = "SELECT * FROM relation WHERE `user` = '$username'";
$getrelation = mysql_query( $query_getrelation, $sports )or die( mysql_error() );
//$row_getrelation = mysql_fetch_assoc( $getrelation );
$row_getrelation = array();
$totalRows_getrelation = mysql_num_rows( $getrelation );
for ( $i = 0; $i < $totalRows_getrelation; $i++ ) {
	array_push( $row_getrelation, mysql_fetch_assoc( $getrelation ) );
}
?>

<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>智健生活 | 用户管理/账户信息</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="stylesheet" href="assets/css/amazeui.min.css" />
    <link rel="stylesheet" href="assets/css/admin.css">
    <link rel="stylesheet" href="assets/css/app.css">
</head>

<body data-type="generalComponents">
<?php
if ($username == NULL)
{
	echo '
	<p>您未登录，请先登录，3秒后跳转至登录页面</p>
	<p>如果长时间未跳转，请<a href = "login.php">点击这里</a></p>手动跳转';
	header( "Refresh:3;url=login.php" );
	exit();
}
?>

<!--导航栏设置-->
<header class="am-topbar am-topbar-inverse admin-header">
	<div class="am-topbar-brand">
		<p>智健生活</p>
	</div>
	<div class="am-icon-list tpl-header-nav-hover-ico am-fl am-margin-right">

	</div>

	<button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only" data-am-collapse="{target: '#topbar-collapse'}"><span class="am-sr-only">导航切换</span> <span class="am-icon-bars"></span></button>

	<div class="am-collapse am-topbar-collapse" id="topbar-collapse">

		<ul class="am-nav am-nav-pills am-topbar-nav am-topbar-right admin-header-list tpl-header-list">
			<li class="am-dropdown" data-am-dropdown data-am-dropdown-toggle>
				<a class="am-dropdown-toggle tpl-header-list-link" href="javascript:;">
					<span class="tpl-header-list-user-nick">
					<?php
					if ($username == NULL)
						echo "请登录";
					else
						echo $username;
					?>
					</span>
				</a>

				<ul class="am-dropdown-content">
					<li><a href="Admin-AccountInfo.php"><span class="am-icon-bell-o"></span> 账户资料</a>
					</li>
					<li><a href="Admin-AccountMag.php"><span class="am-icon-cog"></span> 账户设置</a>
					</li>
					<li><a href="quit.php"><span class="am-icon-power-off"></span> 退出</a>
					</li>
				</ul>
			</li>
			<li class="am-hide-sm-only"><a href="javascript:;" id="admin-fullscreen" class="tpl-header-list-link"><span class="am-icon-arrows-alt"></span> <span class="admin-fullText">开启全屏</span></a>
			</li>
		</ul>
	</div>
</header>

<div class="tpl-page-container tpl-page-header-fixed">

	<!--左侧导航栏-->
	<div class="tpl-left-nav tpl-left-nav-hover">
		<div class="tpl-left-nav-title">
			详细列表
		</div>
		<div class="tpl-left-nav-list">
			<ul class="tpl-left-nav-menu">
				<!--首页-->
				<li class="tpl-left-nav-item">
					<a href="Admin-index.php" class="nav-link">
						<i class="am-icon-home"></i>
						<span>总览</span>
					</a>

				</li>
				<!--运动项目使用教程-->
				<li class="tpl-left-nav-item">
					<a href="javascript:;" class="nav-link tpl-left-nav-link-list">
					<i class="am-icon-forumbee"></i>
					<span>运动项目使用教程</span>
					<i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right tpl-left-nav-more-ico-rotate"></i>
				</a>

					<ul class="tpl-left-nav-sub-menu" style="display: block;">
						<li>
							<a href="Admin-UsersGuide-Blance.php">
							<i class="am-icon-book"></i>
							<span>平衡训练</span>
						</a>

							<a href="Admin-UsersGuide-Blance.php">
							<i class="am-icon-book"></i>
							<span>摸高训练</span>
						</a>

							<a href="Admin-UsersGuide-Blance.php">
							<i class="am-icon-book"></i>
							<span>其他训练</span>
						</a>

						</li>
					</ul>
				</li>
				<!--账户信息-->
				<li class="tpl-left-nav-item">
					<a href="javascript:;" class="nav-link tpl-left-nav-link-list active">
						<i class="am-icon-users"></i>
						<span>用户管理</span>
						<i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right tpl-left-nav-more-ico-rotate"></i>
					</a>
					<ul class="tpl-left-nav-sub-menu" style="display: block;">
						<li>
							<a href="Admin-AccountInfo.php" class="active">
								<i class="am-icon-angle-right"></i>
								<span>账户信息</span>
							</a>
							<a href="Admin-AccountMag.php" >
								<i class="am-icon-angle-right"></i>
								<span>成员管理</span>
							</a>
						</li>
					</ul>
				</li>
				<!--成员运动信息-->
				<li class="tpl-left-nav-item">
					<a href="javascript:;" class="nav-link tpl-left-nav-link-list">
						<i class="am-icon-table"></i>
						<span>成员运动信息</span>
						<i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right"></i>
					</a>
					<ul class="tpl-left-nav-sub-menu" style="display: block;">
						<!--member-A-->
						<?php
							for ( $i = 0; $i < $totalRows_getrelation; $i++ )
							{
								echo '
								<li name="member-A" class="tpl-left-nav-item">
									<a href="javascript:;" class="nav-link tpl-left-nav-link-list"><i class="am-icon-fw"></i>
										<i class="am-icon-fw am-icon-user"></i>
										<span>'.$row_getrelation[ $i ][ "relation" ].'</span>
										<i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right"></i>
									</a>
									<ul class="tpl-left-nav-sub-menu">
										<li>
											<a href="member-DataTable.php?relation='.$row_getrelation[ $i ][ "relation" ].'">
												<i class="am-icon-angle-right"></i>
												<span>运动信息文字列表</span>

											</a>
											<a href="member-DataChart.php?relation='.$row_getrelation[ $i ][ "relation" ].'">
												<i class="am-icon-angle-right"></i>
												<span>运动信息炫彩图表</span>
											</a>
										</li>
									</ul>
								</li>';
							}
							?>
					</ul>
				</li>
			</ul>
		</div>
	</div>
	<!--右侧实体内容-->
	<div class="tpl-content-wrapper">
		<div class="tpl-block">
			<div class="am-g">
				<div class="am-u-sm-12">
					<iframe src="AccountInfo.php" style="width:100%;height:850px" scrolling="no" seamless></iframe>
				</div>
			</div>
		</div>
	</div>
</div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/amazeui.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>

</html>