<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Phishing Simulation - Create Landing Page</title>
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
				<li class="active">Landing Template</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Landing Pages</h1>
			</div>
		</div><!--/.row-->
				<div class="panel panel-default">
					<div class="panel-heading">Create a Template</div>
					<div class="panel-body">
						<div class="col-md-6">
								<div class="form-group">
									<label>Landing Page Name</label>
									<input name="landingName" class="form-control" placeholder="Name">
								</div>
								<div class="form-group">
									<label>Capture Credentials and Passwords</label>
									<select name ="capture" class="form-control">
									<option value="true">True</option>
									<option value="false">False</option>
									</select>
								</div>
								<div class="form-group">
									<label>Redirect URL</label>
									<input name="landingUrl" placeholder="URL" class="form-control">
								</div>
								<div class="form-group">
									<label>Template Content - HTML</label>
									<textarea name="landingHTML" class="form-control" rows="3"></textarea>
								</div>
								<button name="button" class="btn btn-primary">Create new Landing Page Template</button>
								
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
				url: "http://34.241.71.67/api/v1/api.php",
				dataType: 'json',
				data: JSON.stringify({
					'service': "landingCreate",
					'name': $("input[name='landingName']").val(),
					'capture': $("select[name='capture']").val(),
					'redirect': $("input[name='landingUrl']").val(),
					'html': $("textarea[name='landingHTML']").val()
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
                        window.location.href = "landingOverview.php";
                        }, 2500);
                    }
				}
			});
		});
		</script>
	
</body>
</html>
