<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Phishing Simulation - Statistics</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<link href="css/bootstrap-table.css" rel="stylesheet">
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
<?php
	include("assets/header.php")
	?>
	<?php
	include("header.php")
	?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Statistics</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Statistics</h1>
			</div>
		</div><!--/.row-->
		<div class="row">
			<div class="col-xs-6 col-md-3">
			<select id="campaignName" name="campaignName"class="form-control">
									<?php 
									$url = "http://34.241.71.67:3333/api/campaigns/?api_key=177b4be3a4df720a5498b5a52d0e9107c5e57eada101482b1f181f5207ba9f83";
									$body = file_get_contents($url);
									$data = json_decode($body, true);
									if (empty($data)) {
										echo "<option>No Campaign Running</option>";
									} else{
									foreach($data as $item) {
										echo "<option value=". $item['id'] .">". $item['name'] . "</option>";
									}
								}
									?>
									</select>
									</br>
				</div>
			</div>
		<div class="row">
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
					<div class="easypiechart" name="easypiechart-teal" id="easypiechart-teal" data-percent="1" ><span id="totalSent" class="percent">0</span></div>
							<div class="text-muted">Total Emails sent</div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
					<div class="easypiechart" id="easypiechart-blue" data-percent="1" ><span id="totalOpened" class="percent">0</span></div>
						<div class="text-muted">Total Emails Opened</div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
					<div class="easypiechart" id="easypiechart-orange" data-percent="1" ><span id="totalClicked" class="percent">0</span></div>
						<div class="text-muted">Total Emails Clicked On</div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
					<div class="easypiechart" id="easypiechart-red" data-percent="1" ><span id="totalSubmit" class="percent">0</span></div>
						<div class="text-muted">Total Submitted Data</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->	
		
		<div class="row">
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						General Overview
						<ul class="pull-right panel-settings panel-button-tab-right">
							<li class="dropdown"><a class="pull-right dropdown-toggle" data-toggle="dropdown" href="#">
								<em class="fa fa-cogs"></em>
							</a>
							</li>
						</ul>
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
					<div class="panel-body">
							<table id="statTable" name="statTable" class="table table-bordered table-hover specialCollapse">
								<thead>
									<tr>
										<th class="text-center" data-field="id">ID</th>
										<th class="text-center" data-field="fname">First Name</th>
										<th class="text-center" data-field="lname">Last Name</th>
										<th class="text-center" data-field="email">Email Address</th>
										<th class="text-center" data-field="sendDate">Send Date</th>
										<th data-field="status" class="text-center">Status</th>
									</tr>
								</thead>
								<tbody id="tBody">
							</tbody>
							</table>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						Total Campaign Summary
						<ul class="pull-right panel-settings panel-button-tab-right">
							<li class="dropdown"><a class="pull-right dropdown-toggle" data-toggle="dropdown" href="#">
								<em class="fa fa-cogs"></em>
							</a>
								<ul class="dropdown-menu dropdown-menu-right">
									<li>
										<ul class="dropdown-settings">
											<li><a href="#">
												<em class="fa fa-cog"></em> Settings 1
											</a></li>
											<li class="divider"></li>
											<li><a href="#">
												<em class="fa fa-cog"></em> Settings 2
											</a></li>
											<li class="divider"></li>
											<li><a href="#">
												<em class="fa fa-cog"></em> Settings 3
											</a></li>
										</ul>
									</li>
								</ul>
							</li>
						</ul>
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
					<div class="panel-body">
						<div class="canvas-wrapper">
							<canvas class="chart" id="doughnut-chart" ></canvas>
						</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->
	</div>	<!--/.main-->
	  
	<script type="text/javascript" src="assets/js/jquery-3.4.0.min.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap-notify.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap-notify.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
	<script type="text/javascript">
	var chart;
	var MyChart;
    $( document ).ready(function() {
		$("table tbody").empty();
		id = $("#campaignName").val();
		$.getJSON( "http://34.241.71.67:3333/api/campaigns/" + id + "/results?api_key=177b4be3a4df720a5498b5a52d0e9107c5e57eada101482b1f181f5207ba9f83", function(data) {
			results = data['results'];
			results.forEach((x) => {
			// x is the element
			fname = x.first_name;
			lname = x.last_name;
			resultID = x.id;
			sendDate = x.send_date;
			sendFinalDate = sendDate.split("T");
			email = x.email;
			status = x.status;
			$("table tbody").append("<tr><td>"+ resultID + "</td><td>"+ fname + "</td><td>"+ lname + "</td><td>"+ email + "</td><td>"+ sendFinalDate[0] + "</td><td>"+ status + "</td></tr>");
			});
		});
		$.getJSON( "http://34.241.71.67:3333/api/campaigns/" + id + "/summary?api_key=177b4be3a4df720a5498b5a52d0e9107c5e57eada101482b1f181f5207ba9f83", function(data) {
			stats = data['stats'];
			total = stats.total;
			sent = stats.sent;
			opened = stats.opened;
			clicked = stats.clicked;
			submittedData = stats.submitted_data;
			reported = stats.email_reported;
			error = stats.error;
			$('#easypiechart-teal').data('easyPieChart').update(sent);
			$('#easypiechart-blue').data('easyPieChart').update(opened);
			$('#easypiechart-orange').data('easyPieChart').update(clicked);
			$('#easypiechart-red').data('easyPieChart').update(submittedData);
			$("#totalSent").text(sent);
			$("#totalOpened").text(opened);
			$("#totalClicked").text(clicked);
			$("#totalSubmit").text(submittedData);
			
			var readyChart = [
			{
				value: total,
				color: "#30a5ff",
				highlight: "#7376df",
				label: "Total Campaign Emails Associated"
			},
			{
				value: sent,
				color: "#5c42f4",
				highlight: "#7376df",
				label: "Total Campaign Emails Sent"
			},
			{
				value: opened,
				color: "#41f4b8",
				highlight: "#999999",
				label: "Total Campaign Emails Opened"
			},
			{
				value: clicked,
				color:"#41f47a",
				highlight: "#cccccc",
				label: "Total Campaign Links Clicked On"
			},
			{
				value: submittedData,
				color: "#4167f4",
				highlight: "#eeeeee",
				label: "Total Campaign Submitted Data"
			},
			{
				value: reported,
				color: "#f4c441",
				highlight: "#eeeeee",
				label: "Total Campaign Emails Reported"
			},
			{
				value: error,
				color: "#f45e41",
				highlight: "#eeeeee",
				label: "Total Campaign Email Errors"
			}
		];
			chart = document.getElementById("doughnut-chart").getContext("2d");
			MyChart = new Chart(chart).Doughnut(readyChart, {
			responsive: true,
			segmentShowStroke: false
			});
			window.myDoughnut = MyChart;
		});
    });
    $('#campaignName').change(function() {
		$("table tbody").empty();
		id = $(this).val();
		$.getJSON( "http://34.241.71.67:3333/api/campaigns/" + id + "/results?api_key=177b4be3a4df720a5498b5a52d0e9107c5e57eada101482b1f181f5207ba9f83", function(data) {
			results = data['results'];
			results.forEach((x) => {
			// x is the element
			fname = x.first_name;
			lname = x.last_name;
			resultID = x.id;
			sendDate = x.send_date;
			sendFinalDate = sendDate.split("T");
			email = x.email;
			status = x.status;
			$("table tbody").append("<tr><td>"+ resultID + "</td><td>"+ fname + "</td><td>"+ lname + "</td><td>"+ email + "</td><td>"+ sendFinalDate[0] + "</td><td>"+ status + "</td></tr>");
			});
		});
		$.getJSON( "http://34.241.71.67:3333/api/campaigns/" + id + "/summary?api_key=177b4be3a4df720a5498b5a52d0e9107c5e57eada101482b1f181f5207ba9f83", function(data) {
			stats = data['stats'];
			total = stats.total;
			sent = stats.sent;
			opened = stats.opened;
			clicked = stats.clicked;
			submittedData = stats.submitted_data;
			reported = stats.email_reported;
			error = stats.error;
			$('#easypiechart-teal').data('easyPieChart').update(sent);
			$('#easypiechart-blue').data('easyPieChart').update(opened);
			$('#easypiechart-orange').data('easyPieChart').update(clicked);
			$('#easypiechart-red').data('easyPieChart').update(submittedData);
			$("#totalSent").text(sent);
			$("#totalOpened").text(opened);
			$("#totalClicked").text(clicked);
			$("#totalSubmit").text(submittedData);

			var changeChart = [
			{
				value: total,
				color: "#30a5ff",
				highlight: "#7376df",
				label: "Total Campaign Emails Associated"
			},
			{
				value: sent,
				color: "#5c42f4",
				highlight: "#7376df",
				label: "Total Campaign Emails Sent"
			},
			{
				value: opened,
				color: "#41f4b8",
				highlight: "#999999",
				label: "Total Campaign Emails Opened"
			},
			{
				value: clicked,
				color:"#41f47a",
				highlight: "#cccccc",
				label: "Total Campaign Links Clicked On"
			},
			{
				value: submittedData,
				color: "#4167f4",
				highlight: "#eeeeee",
				label: "Total Campaign Submitted Data"
			},
			{
				value: reported,
				color: "#f4c441",
				highlight: "#eeeeee",
				label: "Total Campaign Emails Reported"
			},
			{
				value: error,
				color: "#f45e41",
				highlight: "#eeeeee",
				label: "Total Campaign Email Errors"
			}
		];
		MyChart.destroy();
			MyChart = new Chart(chart).Doughnut(changeChart, {
			responsive: true,
			segmentShowStroke: false
			});
			window.myDoughnut = MyChart;
		});
  });
    </script>
</body>
</html>
