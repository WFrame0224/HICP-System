<?php
$item = array('fjdkls','fjdsl','fjkdsl');
$value = array(5,10,5);
$itemstring = "";
$valuestring = "";

for ($i = 0; $i < count($item); $i ++)
{
	$itemstring = $itemstring."'".$item[$i]."',";
}
$itemstring = "[".$itemstring."]";

for ($i = 0; $i < count($value); $i ++)
{
	$valuestring = $valuestring.$value[$i].",";
}
$valuestring = "[".$valuestring."]";

echo $valuestring;

//echo "<script>alert('fdsfds');</script";

?>

<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<script src="echarts.js"></script>
	<title>无标题文档</title>
</head>

<body>
	<div id="main" style="width: 600px;height:400px;"></div>
	<script type="text/javascript">
        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('main'));

        // 指定图表的配置项和数据
        var option = {
            title: {
                text: 'ECharts 入门示例'
            },
            tooltip: {},
            legend: {
                data:['销量']
            },
            xAxis: {
                data: <?php echo $itemstring ?>
            },
            yAxis: {},
            series: [{
                name: '销量',
                type: 'bar',
                data: <?php echo $valuestring ?>
            }]
        };

        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
//		alert('fdsfds');
    </script>
</body>

</html>