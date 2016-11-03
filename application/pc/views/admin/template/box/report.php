<style type="text/css">
/* IN PAGE ANALYTICS */
#page-analtyics {
    clear: left;
}
#page-analtyics .metric {
    background: #fefefe; /* Old browsers */
        background: -moz-linear-gradient(top, #fefefe 0%, #f2f3f2 100%); /* FF3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#fefefe), color-stop(100%,#f2f3f2)); /* Chrome,Safari4+ */
        background: -webkit-linear-gradient(top, #fefefe 0%,#f2f3f2 100%); /* Chrome10+,Safari5.1+ */
        background: -o-linear-gradient(top, #fefefe 0%,#f2f3f2 100%); /* Opera 11.10+ */
        background: -ms-linear-gradient(top, #fefefe 0%,#f2f3f2 100%); /* IE10+ */
        background: linear-gradient(top, #fefefe 0%,#f2f3f2 100%); /* W3C */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fefefe', endColorstr='#f2f3f2',GradientType=0 ); /* IE6-9 */
    border: 1px solid #ccc;
    float: left;
    font-size: 12px;
    margin: -4px 0 1em -1px;
    padding: 10px;
    width: 105px;
}
#page-analtyics .metric:hover {
    background: #fff;
    border-bottom-color: #b1b1b1;
}
#page-analtyics .metric .legend {
    background-color: #058DC7;
    border-radius: 5px;
        -moz-border-radius: 5px;
        -webkit-border-radius: 5px;
    font-size: 0;
    margin-right: 5px;
    padding: 10px 5px 0;
}
#page-analtyics .metric strong {
    font-size: 16px;
    font-weight: bold;
}
#page-analtyics .range {
    color: #686868;
    font-size: 11px;
    margin-bottom: 7px;
    width: 100%;
}
.report header{padding:10px; background:#8175c7;font-size:15px;color:#fff;width:900px;text-transform:uppercase;font-weight:600;margin-top:20px}
</style>
<?php
$ga_profile_id  = $adminConfig->info->report_projectid;
$this->gapi->requestReportData($ga_profile_id, array('date'),array('pageviews','visits'), 'date', null,$begin,$end,1,30);    
$results = $this->gapi->getResults();

?>
<header><?=$lang=="en" ? "Report" : " Thống kê truy cập"?></header>
<div class="formAnalytics">
<form action="<?=base_url()?>admin" method="post">
Begin: <input id="dp1" name="date_begin" type="text" value="" />
&nbsp;&nbsp; End: <input id="dp2" name="date_end" type="text" value="" />
&nbsp;&nbsp;<input class="go" type="submit" value="go" name="go" />
</div>
</div>
<!-- Create an empty div that will be filled using the Google Charts API and the data pulled from Google -->
<div id="chart"></div>
<p>Total Visits: <?php echo $this->gapi->getVisits() ?></p>
<!-- Include the Google Charts API -->
<script type="text/javascript" src="<?=asset_url()?>javascript/jsapi.js"></script>

<!-- Create a new chart and plot the pageviews for each day -->
<script type="text/javascript">

  google.load("visualization", "1", {packages:["corechart"]});
  google.setOnLoadCallback(drawChart);
  function drawChart() {
    var data = new google.visualization.DataTable();

    <!-- Create the data table -->
    data.addColumn('string', 'Day');
    data.addColumn('number', 'Viewers');

    <!-- Fill the chart with the data pulled from Analtyics. Each row matches the order setup by the columns: day then pageviews -->
    data.addRows([
      <?php
      foreach($results as $result) {
          echo '["'.date('M j',strtotime($result->getDate())).'", '.$result->getVisits().'],';
      }
	   ?>
    ]);

    var chart = new google.visualization.AreaChart(document.getElementById('chart'));
    chart.draw(data, {width: 920, height: 200, title: '<?=$begin.' - '.$end?>',
                      colors:['#058dc7','#e6f4fa'],
                      areaOpacity: 0.1,
                      hAxis: {textPosition: 'in', showTextEvery: 5, slantedText: false, textStyle: { color: '#058dc7', fontSize: 10 } },
                      pointSize: 5,
                      legend: 'none',
                      chartArea:{left:0,top:30,width:"100%",height:"100%"}
    });
  }
</script>