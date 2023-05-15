<?php 
include 'header.php';
?>
<div id="sidebar-collapse" class="col-sm-3 col-lg-2 col-md-2 sidebar">
	<br>
	<ul class="nav menu">
		<li class="">
			<a href="dashboard">
				<svg class="glyph stroked dashboard-dial">
					<use xlink:href="#stroked-dashboard-dial"></use>
				</svg>
				Dashboard
			</a>
		</li>
		<?php if($_SESSION['admin_type'] == 1){ ?>
		<li>
			<a href="members">
				<svg class="glyph stroked male user ">
					<use xlink:href="#stroked-male-user"/>
				</svg>
				Scheduling
			</a>
		</li>
		<li>
			<a href="room">
				<svg class="glyph stroked app-window">
					<use xlink:href="#stroked-app-window"></use>
				</svg>
				Laboratories
			</a>
		</li>
		<li>
			<a href="user">
				<svg class="glyph stroked female user">
					<use xlink:href="#stroked-female-user"/>
				</svg>
				User
			</a>
		</li>
		<?php 
			}
			($_SESSION['admin_type'] == 1) ? include('include_history.php') : false;
		 ?>
	</ul>
</div>

<div class="col-sm-9 col-lg-10 col-md-10 col-lg-offset-2 col-md-offset-2 col-sm-offset-3 main">

	<div class="row">
		<ol class="breadcrumb">
			<li><a href="dashboard"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
			<li class="active">User Profile</li>
		</ol>
		<div class="breadcrumb">
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-body">
				
					<table class="table table-bordered">
						<tr>
							<td>Name</td>
							<td><?php echo $_SESSION['admin_name'];?></td>
						</tr>
						<tr>
							<td>Username</td>
							<td><?php echo $_SESSION['admin_username'];?></td>
						</tr>
						<tr>
							<td>User type</td>
							<td><?php echo ($_SESSION['admin_type'] == 1) ? 'Administrator' : 'Staff';?></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include 'footer.php'; ?>