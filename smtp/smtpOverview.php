<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Phishing Simulation - SMTP Overview</title>
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<link href="../css/font-awesome.min.css" rel="stylesheet">
		<link href="../css/datepicker3.css" rel="stylesheet">
		<link href="../css/bootstrap-table.css" rel="stylesheet">
		<link href="../css/styles.css" rel="stylesheet">
		
		<!--Theme-->
		<link href="../css/theme-default.css" rel="stylesheet">
		
		<!--Custom Font-->
		<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
		
		<!--[if lt IE 9]>
		<script src="js/html5shiv.js"></script>
		<script src="js/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
	<?php
	include("../assets/header.php")
	?>
				<?php
	include("../header.php")
	?>
			
		<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
			<div class="row">
				<ol class="breadcrumb">
					<li><a href="#">
						<em class="fa fa-home"></em>
					</a></li>
					<li class="active">SMTP Config</li>
				</ol>
			</div><!--/.row-->
			
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">SMTP Configurations</h1>
				</div>
			</div><!--/.row-->		
			
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading">Overview</div>
						<div class="panel-body">
							<table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
								<thead>
									<tr>
										<th data-field="id" data-sortable="true">ID</th>
										<th data-field="name" data-sortable="true">Name</th>
										<th data-field="Interface"  data-sortable="true">Interface Type</th>
										<th data-field="Address" data-sortable="true">From Address</th>
										<th data-field="Host" data-sortable="true">Host</th>
										<th data-field="Username" data-sortable="true">Username</th>
										<th data-field="Password" data-sortable="true">Password</th>
										<th data-field="Ignore" data-sortable="true">Ignore Certifcate Errors</th>
										<th data-field="modified_date" data-sortable="true">Last Modified</th>
										<th data-field="Action" data-sortable="true">Action</th>
									</tr>
								</thead>
								<?php
								$url = "http://127.0.0.1:3333/api/smtp/?api_key=177b4be3a4df720a5498b5a52d0e9107c5e57eada101482b1f181f5207ba9f83";
								$body = file_get_contents($url);
								$data = json_decode($body, true);
								
								foreach ($data as $result) {

									$id = $result["id"];
									$name = $result["name"];
									$interface_type = $result["interface_type"];
									$from_address = $result["from_address"];
									$host = $result["host"];
									$ignore = $result["ignore_cert_errors"];
									$lastmodified = $result["modified_date"];
									$modifiedDate = explode("T", $lastmodified);
									if(array_key_exists('username', $result)){
										$username = $result["username"];
									} else{
										$username = "None";
									}
									if(array_key_exists('password', $result)){
										$password = $result["password"];
									} else{
										$password = "None";
									}
									if($ignore == '1'){
										$ignore = "True";
									} else {
										$ignore = "False";
									}
									echo '<tr><td>'.$id.'</td><td>'.$name.'</td><td>'.$interface_type.'</td><td>'.$from_address.'</td><td>'.$host.'</td><td>'.$username.'</td><td>'.$password.'</td><td>'.$ignore.'</td><td>'.$modifiedDate[0].'</td><td><button class="btn btn-default btn-circle margin" type="button"><span class="fa fa-edit"></span></button>&nbsp<button class="btn btn-default btn-circle margin" onClick="deleteSMTP('.$id.')" type="button"><span class="fa fa-trash"></span></button></td></tr>';
									}
								?>
							</table>
						</div>
					</div>
				</div>
				
				
				
				
			</div><!--/.row-->
		</div><!--/.main-->
		
		<script type="text/javascript" src="../assets/js/jquery-3.4.0.min.js"></script>
		<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="../assets/js/bootstrap-notify.js"></script>
		<script type="text/javascript" src="../assets/js/bootstrap-notify.min.js"></script>
		<script src="../js/chart.min.js"></script>
		<script src="../js/chart-data.js"></script>
		<script src="../js/easypiechart.js"></script>
		<script src="../js/easypiechart-data.js"></script>
		<script src="../js/bootstrap-datepicker.js"></script>
		<script src="../js/bootstrap-table.js"></script>
		<script src="../js/custom.js"></script>

		<script>
		function deleteSMTP($id) {
			$.ajax({
				type: "POST",
				url: "/api/v1/api.php",
				dataType: 'json',
				data: JSON.stringify({
					'service': "deleteSMTP",
					'smtpID': $id
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
                        window.location.href = "smtpOverview.php";
                        }, 1500);
                    }
				}
			});
		}
		</script>
		
	</body>
</html>
