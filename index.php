<?php
if ( !isset( $_SESSION ) ) {
	session_start();
}
$username = $_SESSION[ 'MM_Username' ];
?>

<!DOCTYPE html>
<html>

<head lang="en">
	<meta charset="UTF-8">
<!--	<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>-->
	<title>智健生活</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="format-detection" content="telephone=no">
	<meta name="renderer" content="webkit">
	<meta http-equiv="Cache-Control" content="no-siteapp"/>
	<link rel="alternate icon" type="image/png" href="assets/i/favicon.png">
	<link rel="stylesheet" href="assets/css/amazeui.min.css"/>
	<link rel="stylesheet" href="assets/css/myapp.css"/>
	<script src="assets/js/echarts.min.js"></script>
</head>

<body>
	<header class="am-topbar am-topbar-fixed-top">
		<div class="am-container">
			<h1 class="am-topbar-brand">
      <a href="#">智健生活</a>
    </h1>
		


			<div class="am-collapse am-topbar-collapse" id="collapse-head">
				<ul class="am-nav am-nav-pills am-topbar-nav">
					<li class="am-active"><a href="#" class="am-icon-home am-icon-sm"> 首页</a>
					</li>
					<li class="am-dropdown" data-am-dropdown>
						<a class="am-dropdown-toggle" data-am-dropdown-toggle>
            			<span class="am-icon-th"></span>
             运动项目 <span class="am-icon-caret-down"></span>
          </a>
						<ul class="am-dropdown-content">
							<li class="am-dropdown-header">项目</li>
							<li><a href="Admin-UsersGuide-Blance.php">老年人运动</a>
							</li>
							<li><a href="#">成人年运动</a>
							</li>
							<li><a href="#">小朋友运动</a>
							</li>
						</ul>
					</li>
				</ul>

				<?php
				if ( !$username ) {
					echo '
						  <div class="am-topbar-right">
							<a href="register.php">
							<button class="am-btn am-btn-secondary am-topbar-btn am-btn-sm"><span class="am-icon-pencil"></span> 注册</button>
							</a>
						  </div>

						  <div class="am-topbar-right">
							<a href="login.php">
							<button class="am-btn am-btn-primary am-topbar-btn am-btn-sm"><span class="am-icon-user"></span> 登录</button>
							</a>
						  </div>';
				}
				else
				{
					echo '<div class="am-topbar-right">
							<div  class="am-dropdown" data-am-dropdown>
							<a class="am-dropdown-toggle" data-am-dropdown-toggle>
							<button class="am-btn am-btn-secondary am-topbar-btn am-btn-sm"><span class="am-icon-user"></span> '.$username.'</button>
							</a>
							<ul class="am-dropdown-content" style = "font-size:12px">
								<li><a href="Admin-index.php">管理</a>
								</li>
								<li><a href="quit.php">退出</a>
								</li>
						    </ul>
						    </div>
						  </div>
						  ';
				}
				?>

			</div>
		</div>
	</header>

	<div class="get">
		<div class="am-g">
			<div class="am-u-lg-12">
				<h1 class="get-title">智健生活 - 打造家庭健身方案</h1>

				<p>科技，改变生活，引领健康</p>
			</div>
		</div>
	</div>

	<div class="detail">
		<div class="am-g am-container">
			<div class="am-u-lg-12">
				<h2 class="detail-h2">运动信息，随处展现</h2>
			</div>

			<div class="am-u-lg-3 detail-mb">
				<h3 class="detail-h3">
			<i class="am-icon-users"></i>
			家庭健身信息，随时查看
		  </h3>
			

				<ul class="am-list am-list-border">
					<li><a href="#"><i class="am-icon-male am-icon-fw"></i>
				男主人-李**</a>
					</li>
					<li><a href="#"> <i class="am-icon-female am-icon-fw"></i>
			女主人-孙**</a>
					</li>
					<li><a href="#"><i class="am-icon-user am-icon-fw"></i> 爸爸-李**</a>
					</li>
					<li><a href="#"><i class="am-icon-user am-icon-fw"></i> 妈妈-张**</a>
					</li>
					<li><a href="#"><i class="am-icon-child am-icon-fw"></i> 儿子-李**</a>
					</li>
					<li><a href="#"><i class="am-icon-child am-icon-fw"></i> 女儿-李**</a>
					</li>
				</ul>
			</div>
			<div class="am-u-lg-3 detail-mb">
				<h3 class="detail-h3">
			<i class="am-icon-users"></i>
			多种项目，多维督促
			</h3>
			

				<ul class="am-list am-list-border">
					<li><a href="#"><i class="am-icon-th am-icon-fw"></i>
				运动项目</a>
					</li>
					<li><a href="#"> <i class="am-icon-gamepad am-icon-fw"></i>
				运动评估</a>
					</li>
					<li><a href="#"><i class="am-icon-line-chart am-icon-fw"></i> 周期呈现</a>
					</li>
					<li><a href="#"><i class="am-icon-leaf am-icon-fw"></i> 期望效果</a>
					</li>
				</ul>
			</div>
			<div class="am-u-lg-4 am-u-end detail-mb">
				<h3 class="detail-h3">
			<i class="am-icon-bar-chart am-icon-sm"></i>
			炫彩图表，一览无余
		  </h3>
			

				<div id="mypie">
					<script type="text/javascript">
						var myChart = echarts.init( document.getElementById( 'mypie' ) );
						myChart.setOption( {
							title: {
								text: '训练时长',
								textStyle: {
									color: 'rgba(0, 0, 0, 1)'
								}
							},
							backgroundColor: 'rgba(0, 0, 0, 0)',
							visualMap: {
								// 不显示 visualMap 组件，只用于明暗度的映射
								show: false,
								// 映射的最小值为 80
								min: 80,
								// 映射的最大值为 600
								max: 600,
								inRange: {
									// 明暗度的范围是 0 到 1
									colorLightness: [ 0, 1 ]
								}
							},
							series: [ {
								name: '访问来源',
								//绘制类型为饼图
								type: 'pie',
								radius: '55%',
								data: [ {
									value: 235,
									name: '单腿站立'
								}, {
									value: 274,
									name: '时钟练习'
								}, {
									value: 310,
									name: '高抬腿'
								}, {
									value: 335,
									name: '身体画圆'
								}, {
									value: 400,
									name: '错步练习'
								} ],
								//绘制为南丁格尔图
								roseType: 'angle',
								//题注颜色
								label: {
									normal: {
										textStyle: {
											color: 'rgba(0, 0, 0, 01)'
										}
									}
								},
								labelLine: {
									lineStyle: {
										color: 'rgba(0, 0, 0, 1)'
									}
								},
								itemStyle: {
									normal: {
										color: '#149C88',
										shadowBlur: 80,
										shadowColor: 'rgba(0, 0, 0, 1)'
									}
								}
							} ]
						} )
					</script>
				</div>
			</div>

		</div>
	</div>

	<!--家庭成员锻炼信息，以及图表展示-->
	<div class="hope">
		<div class="am-g am-container">
			<div class="am-u-lg-4 am-u-md-6 am-u-sm-12 hope-imge">
				<img src="assets/i/家人.png" alt="" width="140" height="140" data-am-scrollspy="{animation:'slide-left', repeat: false}"/>
			</div>
			<div class="am-u-lg-8 am-u-md-6 am-u-sm-12">
				<h2 class="hope-title">家庭成员健身信息，随时随地了然于胸</h2>
				<p>
					了解父母的锻炼情况，防范于未然，保父母晚年安康<br/> 了解爱人同自己的健身与锻炼情况，随时随地享受科技带来的绿色与健康
					<br/> 了解子女的成长情况，利用科技协助他们健康成长，快乐生活

				</p>
			</div>
		</div>
	</div>

	<div class="am-g am-container">
		<div class="am-u-sm-4 detail-mb">
			<ul class="am-list am-list-border am-list-striped">
				<li>
					<a href="#"><i class="am-icon-male am-icon-fw"></i>
					男主人-李**</a>
					<div class="am-progress am-progress-xs">
						<div class="am-progress-bar" style="width: 40%"></div>
					</div>
				</li>
				<li>
					<a href="#"> <i class="am-icon-female am-icon-fw"></i>
				 女主人-孙**</a>
					<div class="am-progress am-progress-xs">
						<div class="am-progress-bar" style="width: 50%"></div>
					</div>
				</li>
			</ul>
		</div>
		<div class="am-u-sm-4 detail-mb">
			<ul class="am-list am-list-border am-list-striped">
				<li>
					<a href="#"><i class="am-icon-user am-icon-fw"></i>
				爸爸-李**</a>
					<div class="am-progress am-progress-xs">
						<div class="am-progress-bar am-progress-bar-success" style="width: 45%"></div>
					</div>
				</li>
				<li>
					<a href="#"> <i class="am-icon-user am-icon-fw"></i>
				妈妈-张**</a>
					<div class="am-progress am-progress-xs">
						<div class="am-progress-bar am-progress-bar-success" style="width: 50%"></div>
					</div>
				</li>
			</ul>
		</div>
		<div class="am-u-sm-4 am-u-end detail-mb">
			<ul class="am-list am-list-border am-list-striped">
				<li>
					<a href="#"><i class="am-icon-child am-icon-fw"></i>
					儿子-李**</a>
					<div class="am-progress am-progress-xs">
						<div class="am-progress-bar am-progress-bar-warning" style="width: 40%"></div>
					</div>
				</li>
				<li>
					<a href="#"> <i class="am-icon-child am-icon-fw"></i>
				女儿-李**</a>
					<div class="am-progress am-progress-xs">
						<div class="am-progress-bar am-progress-bar-danger" style="width: 20%"></div>
					</div>
				</li>
			</ul>
		</div>
	</div>
	<!---->

	<!--训练项目信息-->
	<div class="hope" style="background: #5195d4">
		<div class="am-g am-container">
			<div class="am-u-lg-4 am-u-md-6 am-u-sm-12 hope-imge">
				<img src="assets/i/健身.png" alt="" width="150" height="150" data-am-scrollspy="{animation:'slide-left', repeat: false}"/>
			</div>
			<div class="am-u-lg-8 am-u-md-6 am-u-sm-12">
				<h2 class="hope-title">多种训练项目，满足您的家庭锻炼需求</h2>
				<p>
					家庭顶梁柱？全方位训练项目，打造一个强壮的身体，足够家人依靠<br/> 家庭女主人？塑性，减肥项目，还您一个美丽纤细的完美身材
					<br/> 家庭长辈？安全，简单的项目，带给您安享晚年的健康身体
					<br/> 小朋友？快快长大，帮你实现哦 ^_^

				</p>
			</div>
		</div>
	</div>
	<iframe id="ObjectTable" src="ObjectTable.php" style="width: 600px;height:600px" scrolling="no" seamless></iframe>
	<br/>
	<!--健身数据信息-->
	<div class="hope" style="background: #7CCD7C">
		<div class="am-g am-container">
			<div class="am-u-lg-4 am-u-md-6 am-u-sm-12 hope-imge">
				<img src="assets/i/数据.png" alt="" width="175" height="175" data-am-scrollspy="{animation:'slide-left', repeat: false}"/>
			</div>
			<div class="am-u-lg-8 am-u-md-6 am-u-sm-12">
				<h2 class="hope-title">运动健身信息，多维度，炫彩呈现</h2>
				<p>
					父母全天候运动信息，全方位呈现，给父母舒心，给您安心<br/> 小帅哥，小仙女的成长轨迹精彩记录，帮助他们快快长大
					<br/> 自己、爱人的运动目标是否实现？运动效果是否达到？

				</p>
			</div>
		</div>
	</div>
	<iframe id="table1" src="DataTable1.php" style="width: 600px;height:650px" scrolling="no" seamless></iframe>
	<iframe id="table2" src="DataTable2.php" style="width: 600px;height:650px" scrolling="no" seamless></iframe>
	<br/>
	<br/>
	<footer class="footer">
		<p>© 2018 研究生电子设计大赛 <a href="#智健小分队">智健小分队</a> (NWPU).</p>
	</footer>

	<!--[if lt IE 9]>
<script src="http://libs.baidu.com/jquery/1.11.1/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<script src="assets/js/polyfill/rem.min.js"></script>
<script src="assets/js/polyfill/respond.min.js"></script>
<script src="assets/js/amazeui.legacy.js"></script>
<![endif]-->

	<!--[if (gte IE 9)|!(IE)]><!-->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/amazeui.min.js"></script>
	<!--<![endif]-->
</body>

</html>