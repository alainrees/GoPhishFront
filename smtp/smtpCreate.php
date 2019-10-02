<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Phishing Simulation - SMTP Create Config</title>
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/font-awesome.min.css" rel="stylesheet">
	<link href="../css/datepicker3.css" rel="stylesheet">
	<link href="../css/styles.css" rel="stylesheet">
	<link href="../assets/css/animate.css" type="text/css" rel="stylesheet">
	
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
				<li><a href="email/emailCreate.php">
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
				<div class="panel panel-default">
					<div class="panel-heading">Create a SMTP Config</div>
					<div class="panel-body">
						<div class="col-md-6">
								<div class="form-group">
									<label>SMTP Config Name</label>
									<input name="configName" class="form-control" placeholder="Name">
								</div>
								<div class="form-group">
									<label>Interface Type</label>
									<select name ="SMTP_select" class="form-control">
									<option value="SMTP">SMTP</option>
									</select>
								</div>
								<div class="form-group">
									<label>From Address</label>
									<input name="configAddress" placeholder="john@example.com" class="form-control">
								</div>
								<div class="form-group">
									<label>Host</label>
									<input name="configHost" placeholder="smtp.example.com:25" class="form-control">
								</div>
								<div class="form-group">
									<label>Username</label>
									<input name="configUsername" placeholder="Not Required" class="form-control">
								</div>
								<div class="form-group">
									<label>Password</label>
									<input name="configPassword" placeholder="Not Required" class="form-control">
								</div>
								<div class="form-group">
									<label>Ignore Certification Errors</label>
									<select name ="certificate_error" class="form-control">
									<option value="true">Yes</option>
									<option value="false">No</option>
									</select>
								</div>
								<button name="button" class="btn btn-primary">Create new SMTP Configuration</button>
								
								</div>
									</div>
								</div>
							
						</div>
					</div>
				</div><!-- /.panel-->
			</div><!-- /.col-->
		</div><!-- /.row -->
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
	<script src="../js/custom.js"></script>
	<script type="text/javascript">
		$("button").click(function() {
			$.ajax({
				type: "POST",
				url: "../api/v1/api.php",
				dataType: 'json',
				data: JSON.stringify({
					'service': "smtpCreate",
					'name': $("input[name='configName']").val(),
					'interface_type': $("select[name='SMTP_select']").val(),
					'from_address': $("input[name='configAddress']").val(),
					'host': $("input[name='configHost']").val(),
					'username': $("input[name='configUsername']").val(),
					'password': $("input[name='configPassword']").val(),
					'ignore_cert_errors': $("select[name='certificate_error']").val()
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
					if(data['alert_code'] == 'success'){
                        setTimeout(function() {
                        window.location.href = "smtpOverview.php";
                        }, 2500);
                    }
				}
			});
		});
		</script>
	
</body>
</html>
