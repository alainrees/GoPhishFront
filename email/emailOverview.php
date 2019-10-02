<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Phishing Simulation - Email Overview</title>
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
					<li class="active">Email Templates</li>
				</ol>
			</div><!--/.row-->
			
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">Email Templates</h1>
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
										<th data-field="subject"  data-sortable="true">Subject</th>
										<th data-field="lastmodified" data-sortable="true">Last Modified</th>
										<th data-field="Action" data-sortable="true">Action</th>
									</tr>
								</thead>
								<?php
								$url = "http://34.241.71.67:3333/api/templates/?api_key=177b4be3a4df720a5498b5a52d0e9107c5e57eada101482b1f181f5207ba9f83";
								$body = file_get_contents($url);
								$data = json_decode($body, true);
								
								foreach ($data as $result) {

									$id = $result["id"];
									$name = $result["name"];
									$subject = $result["subject"];
									$lastmodified = $result["modified_date"];
									$modifiedDate = explode("T", $lastmodified);
									
									echo '<tr><td>'.$id.'</td><td>'.$name.'</td><td>'.$subject.'</td><td>'.$modifiedDate[0].'</td><td><button class="btn btn-default btn-circle margin" type="button" onClick="getEdit('.$id.')"><span class="fa fa-edit"></span></button>&nbsp<button class="btn btn-default btn-circle margin" onClick="deleteEmail('.$id.')" type="button"><span class="fa fa-trash"></span></button></td></tr>';
									}
								?>
							</table>
						</div>
					</div>
				</div>
				
				
				
				
			</div><!--/.row-->
			<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Email Template Edit</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
	  <form>
              <div class="form-group">
                <label for="exampleInputEmail1">Email Template Name</label>
                <input type="text" class="form-control" id="templateName" placeholder="Name">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Email Subject Name</label>
                <input type="text" class="form-control" id="templateSubject" placeholder="Subject">
              </div>
			  <div class="form-group">
                <label for="exampleInputPassword1">Email Text</label>
                <input type="text" class="form-control" id="templateText" placeholder="Text">
			  </div>
			  <div class="form-group">
                <label for="exampleInputPassword1">Email HTML</label>
                <textarea type="textarea" class="form-control" id="templateHTML" placeholder="HTML"></textarea>
              </div>
            </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
	   <button type="button" id="saveTemplate" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
		</div><!--/.main-->
		<script type="text/javascript" src="../assets/js/jquery-3.4.0.min.js"></script>
		<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="../assets/js/bootstrap-notify.js"></script>
		<script type="text/javascript" src="../assets/js/bootstrap-notify.min.js"></script>
		<script src="../js/bootstrap.min.js"></script>
		<script src="../js/chart.min.js"></script>
		<script src="../js/chart-data.js"></script>
		<script src="../js/easypiechart.js"></script>
		<script src="../js/easypiechart-data.js"></script>
		<script src="../js/bootstrap-datepicker.js"></script>
		<script src="../js/bootstrap-table.js"></script>
		<script src="../js/custom.js"></script>
		<script>
		function getEdit($id){
			$.ajax({
				type: "POST",
				url: "/api/v1/api.php",
				dataType: 'json',
				data: JSON.stringify({
					'service': "getTemplate",
					'idTemplate': $id
				}),
				success: function(data) {
					if(data) {
						$('#templateName').val(data['name']);
						$('#templateSubject').val(data['subject']);
						$('#templateText').val(data['text']);
						$('#templateHTML').val(data['html']);
					}
				}
			});
			$("#myModal").modal()
		}
		</script>
		<script>
		function deleteEmail($id) {
			$.ajax({
				type: "POST",
				url: "/api/v1/api.php",
				dataType: 'json',
				data: JSON.stringify({
					'service': "deleteEmail",
					'emailID': $id
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
                        window.location.href = "emailOverview.php";
                        }, 1500);
                    }
				}
			});
		}
		</script>
		
	</body>
</html>
