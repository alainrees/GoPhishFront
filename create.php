<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Phishing Simulation - Campaign</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	
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
				<li class="active">Campaign</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Campaign</h1>
			</div>
		</div><!--/.row-->
				<div class="panel panel-default">
					<div class="panel-heading">Create a Campaign</div>
					<div class="panel-body">
						<div class="col-md-6">
								<div class="form-group">
									<label>Campaign name</label>
									<input name="nameCampaign" class="form-control" placeholder="Name">
								</div>
								<div class="form-group">
									<label>Email Template</label>
									<select name="eTemplate"class="form-control">
									<?php 
									$url = "http://34.241.71.67:3333/api/templates/?api_key=177b4be3a4df720a5498b5a52d0e9107c5e57eada101482b1f181f5207ba9f83";
									$body = file_get_contents($url);
									$data = json_decode($body, true);
									foreach($data as $item) {
										echo "<option value='". $item['name'] ."'>". $item['name'] . "</option>";
									}
									?>
									</select>
								</div>
								<div class="form-group">
									<label>Landing Page Template</label>
									<select name="lTemplate" class="form-control">
									<?php 
									$url = "http://34.241.71.67:3333/api/pages/?api_key=177b4be3a4df720a5498b5a52d0e9107c5e57eada101482b1f181f5207ba9f83";
									$body = file_get_contents($url);
									$data = json_decode($body, true);
									foreach($data as $item) {
										echo "<option value='". $item['name'] ."'>". $item['name'] . "</option>";
									}
									?>
									</select>
								</div>
								<div class="form-group">
									<label>SMTP Configuration</label>
									<select name="smtpConfig" class="form-control">
									<?php 
									$url = "http://34.241.71.67:3333/api/smtp/?api_key=177b4be3a4df720a5498b5a52d0e9107c5e57eada101482b1f181f5207ba9f83";
									$body = file_get_contents($url);
									$data = json_decode($body, true);
									foreach($data as $item) {
										echo "<option value='". $item['name'] ."'>". $item['name'] . "</option>";
									}
									?>
									</select>
								</div>
								<div class="form-group">
									<label>Launch Date</label>
									<input name="launchDate" class="form-control" placeholder="01-01-2019">
								</div>
								<button type="submit" class="btn btn-primary">Create new Campaign</button>
								</div>
								<div class="col-md-6">
								<div class="form-group">
									<label>Target Group</label>
									<select name="tGroup" class="form-control">
									<?php 
									$url = "http://34.241.71.67:3333/api/groups/?api_key=177b4be3a4df720a5498b5a52d0e9107c5e57eada101482b1f181f5207ba9f83";
									$body = file_get_contents($url);
									$data = json_decode($body, true);
									foreach($data as $item) {
										echo "<option value='". $item['name'] ."'>". $item['name'] . "</option>";
									}
									?>
									</select>
								</div>
									<div class="form-group">
										<label>Dripfeed Mode</label>
										<select name="dDays" class="form-control">
											<option>3 days</option>
											<option>7 days</option>
											<option>14 days</option>
										</select>
									</div>
</div>
								</div>
						</div>
					</div>
				</div><!-- /.panel-->
			</div><!-- /.col-->
		</div><!-- /.row -->
	</div><!--/.main-->
	<script type="text/javascript" src="assets/js/jquery-3.4.0.min.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap-notify.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap-notify.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>

	<script type="text/javascript">
		$("button").click(function() {
			$.ajax({
				type: "POST",
				url: "api/v1/api.php",
				dataType: 'json',
				data: JSON.stringify({
					'service': "addCampaign",
					'nameCampaign': $("input[name='nameCampaign']").val(),
					'emailTemplate': $("select[name='eTemplate']").val(),
					'landingTemplate': $("select[name='lTemplate']").val(),
					'smtpConfig': $("select[name='smtpConfig']").val(),
					'launch_date': $("input[name='launchDate']").val(),
					'targetGroup': $("select[name='tGroup']").val(),
					'dripfeed': $("select[name='dDays']").val()
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
                        window.location.href = "overview.php";
                        }, 2500);
                    }
				}
			});
		});
		</script>
	
</body>
</html>
