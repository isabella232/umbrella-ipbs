<!DOCTYPE html>
<html style="height: 100%;">

<head>
    <meta charset="utf-8">
    <title></title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/velocity/1.2.3/velocity.js"></script>
    <script src="assets/scripts/animate.js"></script>
    <!--<link rel="stylesheet" type="text/css" href="assets/css/stylesheet.css">-->
    <link rel="stylesheet" type="text/css" href="assets/css/map.css">
</head>

<body style="min-height: 100%;">
	<div id="map-container">
		<div id="legend">
			<span class="tv">TV <span class="visuallyhidden">stations are blue</span></span>
			<span class="fm">FM <span class="visuallyhidden">stations are orange</span></span>
			<span class="am">AM <span class="visuallyhidden">stations are yellow</span></span>
		</div>
		<?php echo file_get_contents( dirname( __FILE__ ) . "/assets/images/map.svg" ); ?>
	</div>
</body>

</html>
