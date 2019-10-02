<?php 
    session_start();
    if(!isset($_SESSION['loggedIn'])){
    header('Location: login.php');
    exit();
    }
?>
<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
			<ul class="nav menu">
				<li><a href="http://34.241.71.67/index.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
				<li><a href="http://34.241.71.67/charts.php"><em class="fa fa-bar-chart">&nbsp;</em> Statistics</a></li>
				<li class="parent "><a data-toggle="collapse" href="#sub-item-1">
				<em class="fa fa-bell-o">&nbsp;</em> Campaign <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-1">
					<li><a class="" href="http://34.241.71.67/create.php">
						<span class="fa fa-arrow-right">&nbsp;</span> Create a Campaign
					</a></li>
					<li><a class="" href="http://34.241.71.67/overview.php">
						<span class="fa fa-arrow-right">&nbsp;</span> Overview Campaign
					</a></li>
				</ul>
				</li>
				<li class="parent "><a data-toggle="collapse" href="#sub-item-2">
				<em class="fa fa-bullhorn">&nbsp;</em> Email Templates <span data-toggle="collapse" href="#sub-item-2" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-2">
					<li><a class="" href="http://34.241.71.67/email/emailCreate.php">
						<span class="fa fa-arrow-right">&nbsp;</span> Create a Template
					</a></li>
					<li><a class="" href="http://34.241.71.67/email/emailOverview.php">
						<span class="fa fa-arrow-right">&nbsp;</span> Email Templates
					</a></li>
				</ul>
				</li>
				<li class="parent "><a data-toggle="collapse" href="#sub-item-3">
				<em class="fa fa-plane">&nbsp;</em>Landing Templates <span data-toggle="collapse" href="#sub-item-3" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-3">
					<li><a class="" href="http://34.241.71.67/template/landingCreate.php">
						<span class="fa fa-arrow-right">&nbsp;</span> Create a Template
					</a></li>
					<li><a class="" href="http://34.241.71.67/template/landingOverview.php">
						<span class="fa fa-arrow-right">&nbsp;</span> Overview Templates
					</a></li>
				</ul>
				</li>
				<li class="parent "><a data-toggle="collapse" href="#sub-item-4">
				<em class="fa fa-envelope">&nbsp;</em>SMTP Configuration <span data-toggle="collapse" href="#sub-item-4" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-4">
					<li><a class="" href="http://34.241.71.67/smtp/smtpCreate.php">
						<span class="fa fa-arrow-right">&nbsp;</span> Create a SMTP Config
					</a></li>
					<li><a class="" href="http://34.241.71.67/smtp/smtpOverview.php">
						<span class="fa fa-arrow-right">&nbsp;</span> Overview SMTP
					</a></li>
				</ul>
				</li>
                <li class="parent "><a data-toggle="collapse" href="#sub-item-5">
				<em class="fa fa-dot-circle-o">&nbsp;</em>Target Lists <span data-toggle="collapse" href="#sub-item-5" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-5">
					<li><a class="" href="http://34.241.71.67/user/userCreate.php">
						<span class="fa fa-arrow-right">&nbsp;</span> Create Target List
					</a></li>
					<li><a class="" href="http://34.241.71.67/user/userOverview.php">
						<span class="fa fa-arrow-right">&nbsp;</span> Overview Targets
					</a></li>
				</ul>
				</li>

				<li><a href="http://34.241.71.67/logout.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
			</ul>
		</div>
	</div>