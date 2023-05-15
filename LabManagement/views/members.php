<?php 
include 'header.php';
?>

<div id="sidebar-collapse" class="col-sm-2 col-md-2 col-lg-2 sidebar">
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
		<li class="active">
			<a href="#">
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

<div class="col-sm-10 col-sm-offset-2 col-md-10 col-md-offset-2 col-lg-10 col-lg-offset-2 main">	
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="dashboard"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
			<li class="active">Scheduling</li>
		</ol>
		<div class="breadcrumb">
			<button class="btn btn-primary add_student">
				<svg class="glyph stroked plus sign">
					<use xlink:href="#stroked-plus-sign"/>
				</svg>
				Assign Student
			</button>
			<button class="btn btn-primary add_faculty">
				<svg class="glyph stroked plus sign">
					<use xlink:href="#stroked-plus-sign"/>
				</svg>
				Assign Instructor
			</button>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<table class="table table_member">
						<thead>
							<tr>
								<th>ID Number</th>
								<th>Name</th>
								<th>Gender</th>
								<th>Contact</th>
								<th>Department</th>
								<th>Type</th>
								<th>Laboratory</th>
								
								<th>Action</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
	
</div>


<div class="right-sidebar divedit-member">
	<div class="container-fluid">
		<br>
		<br>
		<div class="member-form"></div>
	</div>
</div>



<?php include 'footer.php'; ?>