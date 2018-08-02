<!DOCTYPE html>
<html>
<head lang="en">
  <meta charset="UTF-8">
  <title>个人成长运动曲线</title>
  <script src="echarts.js"></script>
<style>
	#growMap {
		margin-left: auto;
		margin-right: auto;
		display: flex; 
		justify-content: center; 
		align-items: center;
	}
</style>
</head>


<body>
<div id="growMap" style="width: 600px;height:600px;"></div>
<script type="text/javascript">
	var option = {
		title: {
			text: '个人运动成长曲线',
			textStyle: {
				fontSize: '24',
			},
			bottom: 0,
			left: 'center',

		},
		tooltip: {
			trigger: 'axis'
		},
		legend: {
			data: ['摸高成绩', '立定跳远']
		},
		toolbox: {
			show: true,
			feature: {
				dataZoom: {},
				dataView: {
					readOnly: false
				},
				magicType: {
					type: ['line', 'bar']
				},
				restore: {},
				saveAsImage: {}
			}
		},
		xAxis: {
			type: 'category',
			name: '日期',
			boundaryGap: false,
			data: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
			axisPointer: {
					type: 'shadow'
			}
		},
		yAxis: [{
			type: 'value',
			name: '摸高高度',
			nameTextStyle:{color:'red'},
			min: 135,
			max: 220,
			interval: 5,
			axisLabel: {
				formatter: '{value} cm'
			}
		},{
			type: 'value',
			name: '立定跳远距离',
			min: 135,
			max: 180,
			interval: 5,
			axisLabel: {
				formatter: '{value} cm'
			},
			nameTextStyle:{color:'#2f4554'}
		}],
		series: [{
				name: '摸高成绩',
				type: 'line',
				smooth: true,
				data: [190, 193, 198, 200, 202, 204, 206, 208, 211, 214, 215, 216],
				markPoint: {
					data: [{
							type: 'max',
							name: '最大值'
						},
						{
							type: 'min',
							name: '最小值'
						}
					]
				},
				markLine: {
					data: [{
						type: 'average',
						name: '平均值'
					}]
				}
			},
			{
				name: '立定跳远',
				type: 'line',
				smooth: true,
				data: [140, 143, 146, 148, 151, 152, 155, 160, 163, 167, 170, 173],
				markPoint: {
					data: [{
							type: 'max',
							name: '最大值'
						},
						{
							type: 'min',
							name: '最小值'
						}
					]
				},
				markLine: {
					data: [{
						type: 'average',
						name: '平均值'
					}]
				}
			}
		]
	};
	var mytable = echarts.init(document.getElementById('growMap'));
	mytable.setOption(option);
</script>
</body>