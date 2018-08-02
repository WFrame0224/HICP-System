<?php require_once('Connections/sports.php'); ?>
<?php
$itemdic = array("StandOneLeg"=>"单腿站立",
				"ClockTrain"=>"时钟练习",
				"StepByStep"=>"措步练习",
				"RaiseSameSide"=>"同侧抬起",
				"PaintCircle"=>"身体画圆",
				"HighKnee"=>"高抬腿",
				"SideWalk"=>"侧走练习",
				"BarrierWalk"=>"障碍行走",
				"AdvancedBarrier"=>"障碍进阶");
$itemnumdic = array("StandOneLeg"=>0,
				"ClockTrain"=>1,
				"StepByStep"=>2,
				"RaiseSameSide"=>3,
				"PaintCircle"=>4,
				"HighKnee"=>5,
				"SideWalk"=>6,
				"BarrierWalk"=>7,
				"AdvancedBarrier"=>8);
$item = array("单腿站立","时钟练习","措步练习","同侧抬起","身体画圆","高抬腿","侧走练习","障碍行走","障碍进阶");
$itemeng = array("StandOneLeg",
				"ClockTrain",
				"StepByStep",
				"RaiseSameSide",
				"PaintCircle",
				"HighKnee",
				"SideWalk",
				"BarrierWalk",
				"AdvancedBarrier");

if ( !isset( $_SESSION ) ) {
	session_start();
}
$therelation = $_GET['relation'];
$username = $_SESSION[ 'MM_Username' ];
//$username = 'mumu';
$weekstart = date("Y-m-d",mktime(0, 0 , 0,date("5"),date("20")-date("w")-6,date("Y")));
$weekend = date("Y-m-d",mktime(0, 0 , 0,date("m"),date("d")-date("w"),date("Y")));

$weekstartstring = "'".$weekstart."'";
$datestring = "['日期',";

$datastring = array("['单腿站立',","['时钟练习',","['措步练习',","['同侧抬起',","['身体画圆',","['高抬腿',","['侧走练习',","['障碍行走',","['障碍进阶',",);

mysql_select_db( $database_sports, $sports );
for ($i=0; $i<7; $i++)
{
	$weekday = date("Y-m-d",mktime(0, 0 , 0,date("5"),date("25")-date("w")-6+$i,date("Y")));
	
	$datestring = $datestring."'".$weekday."',";
	for ($j=0; $j<9; $j++)
	{
		$theitem = $itemeng[$j];
		$query_gettheday = "select duration from balance where to_days(time) = to_days('$weekday') and name='$username' and relation='$therelation' and item='$theitem'";
		$gettheday = mysql_query($query_gettheday, $sports) or die(mysql_errno());
		$totalrow_gettheday = mysql_num_rows($gettheday);
		$totaltime = 0;
		for ($k=0; $k<$totalrow_gettheday; $k++)
		{
			$totaltime = $totaltime + mysql_fetch_assoc($gettheday)['duration'];
		}
		$totaltime = round($totaltime/60,1);
		$datastring[$j] = $datastring[$j]."'".$totaltime."',";
	}
}
for ($j=0; $j<9; $j++)
{
	$datastring[$j] = $datastring[$j]."]";
}
$datestring = $datestring."]";

?>

<!DOCTYPE html>
<html>
<head lang="en">
  <meta charset="UTF-8">
  <title>数据信息展示表</title>
  <script src="echarts.js"></script>
<style>
	#phyDetail {
		margin-left: auto;
		margin-right: auto;
		display: flex; 
		justify-content: center; 
		align-items: center;
	}
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
<div id="phyDetail" style="width: 600px;height:600px;"></div>
<script type="text/javascript">
var item = ['单腿站立', '时钟练习', '错步练习', '同侧抬起', '身体画圆', '高抬腿', '侧走练习', '障碍行走', '障碍进阶']

setTimeout(function() {

    option = {
        title: {
            text: '成员运动数据展示',
            textStyle: {
                fontSize: '24',
            },
            bottom:0,
            left:'center',
        },
        legend: {
            data: item,
        },
        tooltip: {
            trigger: 'axis',
            showContent: false,
            axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                type : 'line'        // 默认为直线，可选为：'line' | 'shadow'
            },
        },
        dataset: {
            source: [
//                ['日期', '1~5', '6~10', '11~15', '16~20', '21~25', '25~30',],
				<?php echo $datestring; ?>,
                <?php //echo $datastring[0].",";
				for ($j=0; $j<9; $j++)
				{
					echo $datastring[$j].",";
				}
				?>
            ]
        },
        xAxis: {
            type: 'category',
            name: '日期',
        },
        yAxis: {
            name: '单个项目锻炼时长',
            gridIndex: 0
        },
        grid: {
            top: '55%'
        },
        series: [
			<?php
			for ($i=0; $i<9; $i++)
			{
				echo "
			{
                name:'".$item[$i]."',
                type: 'line',
                smooth: true,
                seriesLayoutBy: 'row',
            },";
			}
			?>	
            {
                type: 'pie',
                id: 'pie',
                radius: '30%',
                center: ['50%', '30%'],
                label: {
                    formatter: '{b}: {@<?php echo $weekstart; ?>} ({d}%)'
                },
                encode: {
                    itemName: '日期',
                    value: <?php echo $weekstartstring; ?>,
                    tooltip: <?php echo $weekstartstring; ?>
                }
            }
        ]
    };

    myChart.on('updateAxisPointer', function(event) {
        var xAxisInfo = event.axesInfo[0];
        if (xAxisInfo) {
            var dimension = xAxisInfo.value + 1;
            myChart.setOption(
                {
                    legend: {
                        data: item
                    },
                    series: {
                        id: 'pie',
                        label: {
                            formatter: '{b}: {@[' + dimension + ']} ({d}%)'
                        },
                        encode: {
                            value: dimension,
                            tooltip: dimension
                        }
                    }
            });
        }
    });

    myChart.setOption(option);

});
var myChart = echarts.init(document.getElementById('phyDetail'));
myChart.setOption(option);
</script>
</body>