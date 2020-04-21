<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css">


        <!-- Styles -->

    <body>
	<div class="container">
	    <h4 class="text-center">Please Select Date</h4>
	    <div class="row">

		<div class="col-md-4">
		    <div class="form-group">
			<input type="text" id="start" class="form-control date">
		    </div>
		</div>
		<div class="col-md-4">
		    <div class="form-group">
			<input type="text" id="end" class="form-control date">
		    </div>
		</div>
		<div class="col-md-4">
		    <div class="form-group">
			<button class="btn btn-success">Get Graph</button>
		    </div>
		</div>

	    </div>
	</div>
	<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
	<script type="text/javascript">
$("button").on('click', function () {
    var start = $("#start").val();
    var end = $("#end").val();
    if (start != '' || end != '') {
	var url = "https://api.nasa.gov/neo/rest/v1/feed?start_date=" + start + "&end_date=" + end + "&api_key=1eTSLKLl6Z0CaluHXx1JnCiAo64EcJBnfkdXgHiz";
	$.ajax({url: url, async: false,
	    success: function (result) {
		console.log(result.near_earth_objects);
		var data = [];
		$.each(result.near_earth_objects, function (key, value) {
		    var obj = {};
		    obj.label = key,
			    obj.y = value.length;
		    data.push(obj);
		});
		$(".chartContainer").CanvasJSChart({
		    title: {
			text: "No Of Asteroids Per Day"
		    },
		    axisY: {
			title: "No Of Asteroids",
			includeZero: false
		    },
		    axisX: {
			interval: 1
		    },
		    data: [
			{
			    type: "line", //try changing to column, area
			    toolTipContent: "{label}: {y} no of asteroids",
			    dataPoints: data
			}
		    ]
		});
	    }});
    } else {
	alert("Please Select Start and End Date");
    }
});

$('.date').datepicker({
    format: 'yyyy-mm-dd'
});
	</script>
    </head>
<body>
    <div class="chartContainer" style="height: 300px; width: 100%;"></div>
</body>
</html>
