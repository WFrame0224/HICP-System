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
<?php

function getitemnum( $relation ) {
	$username = $GLOBALS[ 'username' ];
	$sports = $GLOBALS[ 'sports' ];

	$query_diffitem = "select distinct item from balance where name='$username' and relation='$relation'";
	$getdiffitem = mysql_query( $query_diffitem, $sports )or die( mysql_errno() );
	$total_diffitem = mysql_num_rows( $getdiffitem );

	$itemnum = $total_diffitem;
	return $itemnum;
}

function getsportsnum( $relation ) {
	$username = $GLOBALS[ 'username' ];
	$sports = $GLOBALS[ 'sports' ];

	$query_leftnum = "select leftNum from balance where name='$username' and relation='$relation'";
	$getleftnum = mysql_query( $query_leftnum, $sports )or die( mysql_errno() );
	$totalrow_leftnum = mysql_num_rows( $getleftnum );

	$total_leftnum = 0;
	for ( $i = 0; $i < $totalrow_leftnum; $i++ ) {
		$total_leftnum = $total_leftnum + mysql_fetch_assoc( $getleftnum )[ 'leftNum' ];
	}

	$query_rightnum = "select rightNum from balance where name='$username' and relation='$relation'";
	$getrightnum = mysql_query( $query_rightnum, $sports )or die( mysql_errno() );
	$totalrow_rightnum = mysql_num_rows( $getrightnum );

	$total_rightnum = 0;
	for ( $i = 0; $i < $totalrow_rightnum; $i++ ) {
		$total_rightnum = $total_rightnum + mysql_fetch_assoc( $getrightnum )[ 'rightNum' ];
	}

	$itemnum = $total_leftnum + $total_rightnum;
	return $itemnum;
}

function getsportstime( $relation ) {
	$username = $GLOBALS[ 'username' ];
	$sports = $GLOBALS[ 'sports' ];

	$query_duration = "select duration from balance where name='$username' and relation='$relation'";
	$getduration = mysql_query( $query_duration, $sports )or die( mysql_errno() );
	$totalrow_duration = mysql_num_rows( $getduration );

	$total_duration = 0;
	for ( $i = 0; $i < $totalrow_duration; $i++ ) {
		$total_duration = $total_duration + mysql_fetch_assoc( $getduration )[ 'duration' ];
	}

	return round( $total_duration / 60, 1 );
}

function familynum() {
	$totalRows_getrelation = $GLOBALS[ 'totalRows_getrelation' ];
	$row_getrelation = $GLOBALS[ 'row_getrelation' ];

	$itemnum = array();
	$sportsnum = array();
	$sportstime = array();
	$totalnum = 0;
	$totaltime = 0;
	for ( $i = 0; $i < $totalRows_getrelation; $i++ ) {
		array_push( $itemnum, getitemnum( $row_getrelation[ $i ][ "relation" ] ) );
		array_push( $sportsnum, getsportsnum( $row_getrelation[ $i ][ "relation" ] ) );
		$totalnum = $totalnum + $sportsnum[ $i ];
		array_push( $sportstime, getsportstime( $row_getrelation[ $i ][ "relation" ] ) );
		$totaltime = $totaltime + $sportstime[ $i ];
	}

	//	echo $itemnum[1];
	$GLOBALS[ 'itemnum' ] = $itemnum;
	$GLOBALS[ 'sportsnum' ] = $sportsnum;
	$GLOBALS[ 'sportstime' ] = $sportstime;
	$GLOBALS[ 'totalnum' ] = $totalnum;
	$GLOBALS[ 'totaltime' ] = $totaltime;
}
?>
<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>智健生活 | 账户主页</title>
	<meta name="keywords" content="index">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="renderer" content="webkit">
	<meta http-equiv="Cache-Control" content="no-siteapp"/>

	<link rel="icon" type="image/png" href="assets/i/favicon.png">
	<link rel="apple-touch-icon-precomposed" href="assets/i/app-icon72x72@2x.png">

	<meta name="apple-mobile-web-app-title" content="Amaze UI"/>
	<link rel="stylesheet" href="assets/css/amazeui.min.css"/>
	<link rel="stylesheet" href="assets/css/admin.css">
	<link rel="stylesheet" href="assets/css/app.css">
	<script src="echarts.js"></script>
</head>

<body data-type="index">

	<?php
	if ( $username == NULL ) {
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
			<p><strong>智健生活</strong>
			</p>
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
						<a href="Admin-index.php" class="nav-link active">
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
					<!--用户管理-->
					<li class="tpl-left-nav-item">
						<a href="javascript:;" class="nav-link tpl-left-nav-link-list">
                            <i class="am-icon-users"></i>
                            <span>用户管理</span>
                        </a>
					
						<ul class="tpl-left-nav-sub-menu" style="display: block;">
							<li>
								<a href="Admin-AccountInfo.php">
                                    <i class="am-icon-angle-right"></i>
                                    <span>账户信息</span>
								</a>
							
								<a href="Admin-AccountMag.php">
                                    <i class="am-icon-angle-right"></i>
                                    <span>成员管理</span>
                                </a>
							
							</li>
						</ul>
					</li>

					<li class="tpl-left-nav-item">
						<a href="javascript:;" class="nav-link tpl-left-nav-link-list">
							<i class="am-icon-table"></i>
							<span>成员运动信息</span>
							<i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right"></i>
						</a>
					
						<ul class="tpl-left-nav-sub-menu" style="display: block;">
							<!--member-A-->
							<?php
							for ( $i = 0; $i < $totalRows_getrelation; $i++ ) {
								echo '
								<li name="member-A" class="tpl-left-nav-item">
									<a href="javascript:;" class="nav-link tpl-left-nav-link-list"><i class="am-icon-fw"></i>
										<i class="am-icon-fw am-icon-user"></i>
										<span>' . $row_getrelation[ $i ][ "relation" ] . '</span>
										<i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right"></i>
									</a>
									<ul class="tpl-left-nav-sub-menu">
										<li>
											<a href="member-DataTable.php?relation=' . $row_getrelation[ $i ][ "relation" ] . '">
												<i class="am-icon-angle-right"></i>
												<span>运动信息文字列表</span>

											</a>
											<a href="member-DataChart.php?relation=' . $row_getrelation[ $i ][ "relation" ] . '">
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
		<!--右侧主要内容-->
		<div class="tpl-content-wrapper">
			<div class="tpl-content-page-title" style="margin-bottom: 2%">
				<strong>智健生活 </strong><small>科技，改变生活，引领健康</small>
			</div>

			<div class="row">
				<!--周期数据统计-->
				<div class="am-u-md-5 am-u-sm-12 row-mb">
					<div class="tpl-portlet">
						<div class="tpl-portlet-title">
							<div class="tpl-caption font-red">
								<i class="am-icon-bar-chart"></i>
								<span> Cloud 动态资料</span>
							</div>
							<div class="actions">
								<ul class="actions-btn">
									<li class="red-on">
										<a href="###"></a>当天
									</li>
									<li class="green">
										<a href="###"></a>本周
									</li>
									<li class="blue">
										<a href="###"></a>本月
									</li>
								</ul>
							</div>
						</div>
						<div class="tpl-scrollable">
							<div class="number-stats">
								<div class="stat-number am-fl am-u-md-6">
									<div class="title am-text-right"> 运动总次数 </div>
									<div class="number am-text-right am-text-warning">
										<?php
										familynum();
										echo $GLOBALS[ 'totalnum' ];
										?>
									</div>
								</div>
								<div class="stat-number am-fr am-u-md-6">
									<div class="title"> 运动总分钟数 </div>
									<div class="number am-text-success">
										<?php echo $GLOBALS['totaltime']; ?>
									</div>
								</div>

							</div>

							<table class="am-table tpl-table">
								<thead>
									<tr class="tpl-table-uppercase">
										<th>成员</th>
										<th>项目种类</th>
										<th>次数</th>
										<th>时长</th>
									</tr>
								</thead>
								<tbody>
									<?php
									for ( $i = 0; $i < $totalRows_getrelation; $i++ ) {
										echo '
									<tr>
										<td>
											<a class="user-name" href="###">
											' . $row_getrelation[ $i ][ "relation" ] . '
											</a>
										</td>
										<td>' . $GLOBALS[ 'itemnum' ][ $i ] . '</td>
										<td>' . $GLOBALS[ 'sportsnum' ][ $i ] . '</td>
										<td class="font-green bold">' . $GLOBALS[ 'sportstime' ][ $i ] . '</td>
									</tr>';
									}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="am-u-md-7 am-u-sm-12 row-mb">
					<div class="tpl-portlet">
						<div class="tpl-portlet-title">
							<div class="tpl-caption font-green ">
								<i class="am-icon-cloud-download"></i>
								<span> Cloud 数据统计</span>
							</div>
							<div class="actions">
								<ul class="actions-btn">
									<li class="red-on">
										<a href="#"></a>当天
									</li>
									<li class="green">
										<a href="#"></a>本周
									</li>
									<li class="blue">
										<a href="#"></a>本月
									</li>
								</ul>
							</div>
						</div>
						<div class="tpl-echarts">
							<div class="title am-text-center"> 不同运动项目锻炼时长 </div>
							<iframe id="table1" src="member-Table1.php" style="width: 100%;height:750px" scrolling="yes" seamless></iframe>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/amazeui.min.js"></script>
	<script src="assets/js/iscroll.js"></script>
	<script src="assets/js/app.js"></script>
</body>

</html>
<?php
mysql_free_result( $getrelation );
?>