<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Phishing Simulation - Campaign</title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/font-awesome.min.css" rel="stylesheet">
		<link href="css/datepicker3.css" rel="stylesheet">
		<link href="css/bootstrap-table.css" rel="stylesheet">
		<link href="css/styles.css" rel="stylesheet">
		
		<!--Theme-->
		<link href="css/theme-default.css" rel="stylesheet">
		
		<!--Custom Font-->
		<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
		
		<!--[if lt IE 9]>
		<script src="js/html5shiv.js"></script>
		<script src="js/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
	<?php
	include("./assets/header.php")
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
					<li class="active">Campaigns</li>
				</ol>
			</div><!--/.row-->
			
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">Campaigns</h1>
				</div>
			</div><!--/.row-->		
			
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading">Overview Campaign</div>
						<div class="panel-body">
							<table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
								<thead>
									<tr>
										<th data-field="id" data-sortable="true">ID</th>
										<th data-field="name" data-sortable="true">Name</th>
										<th data-field="eName" data-sortable="true">Email Template Name</th>
										<th data-field="tName" data-sortable="true">Landing Page Name</th>
										<th data-field="host" data-sortable="true">SMTP Host</th>
										<th data-field="status" data-sortable="true">Status</th>
										<th data-field="created_date" data-sortable="true">Created Date</th>
										<th data-field="launched_date" data-sortable="true">Launch Date</th>
										<th data-field="send_date" data-sortable="true">Send Date</th>
										<th data-field="CompleteD_date" data-sortable="true">Completed Date</th>
										<th data-field="Action" data-sortable="true">Action</th>
									</tr>
								</thead>
								<?php
								$url = "http://34.241.71.67:3333/api/campaigns/?api_key=177b4be3a4df720a5498b5a52d0e9107c5e57eada101482b1f181f5207ba9f83";
								$body = file_get_contents($url);
								$data = json_decode($body, true);
								
								foreach ($data as $result) {

									$id = $result["id"];
									$name = $result["name"];
									$eName = $result['template']['name'];
									$tName = $result['page']['name'];
									$smtp = $result['smtp']['name'];
									$status = $result["status"];
									$created_date = $result["created_date"];
									$launch_date = $result["launch_date"];
									$send_by_date = $result["send_by_date"];
									$completed_date = $result["completed_date"];
									$created_final_date = explode("T", $created_date);
									$launch_final_date = explode("T", $launch_date);
									$send_final_date = explode("T", $send_by_date);
									$completed_final_date = explode("T", $completed_date);

									if($completed_final_date[0] == "0001-01-01"){
										$completed_final_date[0] = "Not Completed";
									}
									if($send_final_date[0] == "0001-01-01"){
										$send_final_date[0] = "Nothing";
									}
									echo '<tr><td>'.$id.'</td><td>'.$name.'</td><td>'.$eName.'</td><td>'.$tName.'</td><td>'.$smtp.'</td><td>'.$status.'</td><td>'.$created_final_date[0].'</td><td>'.$launch_final_date[0].'</td><td>'.$send_final_date[0].'</td><td>'.$completed_final_date[0].'</td><td><button class="btn btn-default btn-circle margin" onClick="myFunction('.$id.')" type="button" id="delete" name="delete"><span class="fa fa-trash"></span></button></td></tr>';
									}
								?>
							</table>
						</div>
					</div>
				</div>
				
				
				
				
			</div><!--/.row-->
		</div><!--/.main-->
		
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
		<script src="js/bootstrap-table.js"></script>
		<script src="js/custom.js"></script>
		<script>
		function getEdit($id){
			$("#myModal").modal()
		}
		</script>
		<script>
		function myFunction($id) {
			$.ajax({
				type: "POST",
				url: "/api/v1/api.php",
				dataType: 'json',
				data: JSON.stringify({
					'service': "deleteCampaign",
					'campaignID': $id
				}),
				success: function(data) {
					if(data) {
						$.notify({
						title: '<strong>Server Response</strong>',
						icon: 'glyphicon glyphicon-flag',
						message: data['response']
						},{
						type: data['alert_code'],
						animate: {
								enter: 'animated fadeInUp',
							exit: 'animated fadeOutRight'
						},
						placement: {
							from: "top",
							align: "right"
						},
						offset: 20,
						spacing: 10,
						z_index: 1031,
						});
					}
					if(data['alert_code'] == 'info'){
                        setTimeout(function() {
                        window.location.href = "overview.php";
                        }, 1500);
                    }
				}
			});
		}
		</script>
		
	</body>
</html>
