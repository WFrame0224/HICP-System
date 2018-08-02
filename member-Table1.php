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

<?php
$relationstring = "[";
$datastring = "[";

for ($i=0; $i<count($row_getrelation); $i++)
{
	$relation = $row_getrelation[$i]['relation'];
	$relationstring = $relationstring."'".$relation."',";
	$data = getsportstime($relation);
	$datastring = $datastring.$data.",";
}

$relationstring = $relationstring."]";
$datastring = $datastring."]";
?>

<!DOCTYPE html>
<html>
<head lang="en">
  <meta charset="UTF-8">
  <title>不同运动项目锻炼时长</title>
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
<div id="member-Table1" style="width: 700px;height:700px;"></div>
<script type="text/javascript">
	/*按照5个成员的格式展现，成员1 成员2 成员3 成员4 成员5*/
var member = ['李**','孙*','李**','张*','李小*','李亚*'];
var memberbalance = <?php echo $relationstring; ?>;
var physical_type = ['平衡训练','跑步','保健运动','步行','摸高运动'];
var balance_data = <?php echo $datastring; ?>;
var run_data = [15, 10, 2, 2, 30];
var healthkeep_data = [15,12,20,25,3];
var walk_data = [5,5,16,20,2];
var hightouch_data =[5,2,0,0,15];
var phyData = [balance_data,run_data,healthkeep_data,walk_data,hightouch_data];

option = {
    tooltip: {
        trigger: 'axis'
    },
    legend: {
        x: 'center',
        data:physical_type
    },
    radar: [
        {
            //平衡运动
            indicator: [
                {text: memberbalance[0], max: 200},
                {text: memberbalance[1], max: 200},
                {text: memberbalance[2], max: 200},
            ],
            center: ['20%','25%'],
            radius: 100
        },
        {
            //跑步运动
            indicator: [
                {text: member[0], max: 40},
                {text: member[1], max: 40},
                {text: member[2], max: 40},
                {text: member[3], max: 40},
                {text: member[3], max: 40}
            ],
            center: ['60%','25%'],
            radius: 100
        },
        {
            //保健运动
            indicator: [
                {text: member[0], max: 30},
                {text: member[1], max: 30},
                {text: member[2], max: 30},
                {text: member[3], max: 30},
                {text: member[4], max: 30}
            ],
            radius: 100,
            center: ['40%','55%'],
        },
        {
            //步行训练
            indicator: [
                {text: member[0], max: 30},
                {text: member[1], max: 30},
                {text: member[2], max: 30},
                {text: member[3], max: 30},
                {text: member[4], max: 30}
            ],
            radius: 100,
            center: ['20%','85%'],
        },
        {
            //摸高运动
            indicator: [
                {text: member[0], max: 20},
                {text: member[1], max: 20},
                {text: member[2], max: 20},
                {text: member[3], max: 20},
                {text: member[4], max: 20}
            ],
            radius: 100,
            center: ['60%','85%'],
        },
    ],
    series: [
        {
            type: 'radar',
             tooltip: {
                trigger: 'item'
            },
            itemStyle: {normal: {areaStyle: {type: 'default'}}},
            data: [
                {
                    value: phyData[0],
                    name: physical_type[0]
                }
            ]
        },
        {
            type: 'radar',
            radarIndex: 1,
            tooltip: {
                trigger: 'item'
            },
            itemStyle: {normal: {areaStyle: {type: 'default'}}},
            data: [
                {
                    value: phyData[1],
                    name: physical_type[1]
                }
            ]
        },
        {
            type: 'radar',
            radarIndex: 2,
            tooltip: {
                trigger: 'item'
            },
            itemStyle: {normal: {areaStyle: {type: 'default'}}},
            data: [
                {
                    value: phyData[2],
                    name: physical_type[2]
                }
            ]
        },
        {
            type: 'radar',
            radarIndex: 3,
            tooltip: {
                trigger: 'item'
            },
            itemStyle: {normal: {areaStyle: {type: 'default'}}},
            data: [
                {
                    value: phyData[3],
                    name: physical_type[3]
                }
            ]
        },
        {
            type: 'radar',
            radarIndex: 4,
            tooltip: {
                trigger: 'item'
            },
            itemStyle: {normal: {areaStyle: {type: 'default'}}},
            data: [
                {
                    value: phyData[4],
                    name: physical_type[4]
                }
            ]
        },
    ]
};
	var mytable = echarts.init(document.getElementById('member-Table1'));
	mytable.setOption(option);
</script>
</body>