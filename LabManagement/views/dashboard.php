<?php 
	include 'header.php';
?>
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 col-md-2 sidebar">
		<br>
		<ul class="nav menu">
			<li class="active">
				<a href="#">
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
<center>
	<div class="row-fluid">
		<div class="col-md-12 main">
			<div class="col-sm-9 col-lg-10 col-md-10 col-lg-offset-2 col-md-offset-2 col-sm-offset-3">
				<h1 class="animated bounce">Computer Laboratory Utilization System</h1>
			</div>
		</div>	
	</div>
</center>
<?php include 'footer.php'; ?>
<script type="text/javascript">
	$(document).ready(function() {
		$('#calendar').fullCalendar({
	      header: {
	        left: 'prev,next today',
	        center: 'title',
	        right: 'month,agendaWeek,agendaDay'
	      },
	      buttonText: {
	        today: 'today',
	        month: 'month',
	        week: 'week',
	        day: 'day'
	      },
	      events: {
	      	url: '../class/display/display',
	      	type: "POST",
	      	data: {
	      		key: "load_reservations_json"
	      	}
	      },
	      editable: false,
	      droppable: false
	    });
	});
</script>
<script>

$.ajax({
	type: "POST",
	url: "../class/display/display",
	data: {
			key: "chart_inventory"
		}
	})
.done(function(data){
	console.log(data);
	var provider = JSON.parse(data);
	var chart = AmCharts.makeChart("inventory", {
  "type": "pie",
  "startDuration": 0,
   "theme": "light",
  "addClassNames": true,
  "legend":{
   	"position":"right",
    "marginRight":100,
    "autoMargins":false
  },
  "innerRadius": "30%",
  "defs": {
    "filter": [{
      "id": "shadow",
      "width": "200%",
      "height": "200%",
      "feOffset": {
        "result": "offOut",
        "in": "SourceAlpha",
        "dx": 0,
        "dy": 0
      },
      "feGaussianBlur": {
        "result": "blurOut",
        "in": "offOut",
        "stdDeviation": 5
      },
      "feBlend": {
        "in": "SourceGraphic",
        "in2": "blurOut",
        "mode": "normal"
      }
    }]
  },
  "dataProvider": provider ,
  "valueField": "litres",
  "titleField": "country",
  "export": {
    "enabled": true
  }
});

chart.addListener("init", handleInit);

chart.addListener("rollOverSlice", function(e) {
  handleRollOver(e);
});

function handleInit(){
  chart.legend.addListener("rollOverItem", handleRollOver);
}

function handleRollOver(e){
  var wedge = e.dataItem.wedge.node;
  wedge.parentNode.appendChild(wedge);
}
});

</script>