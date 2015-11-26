<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<!-- HEADER -->
<head>
	<!-- Setup Important Tags + Load CSS -->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Index</title>
	<meta name="robots" content="index" />
	<meta name="author" content="N/A" />
	<link rel="stylesheet" type="text/css" href="main.css" media="screen" />

	<!-- Load JS Libraries -->
	<script type="text/javascript" src="jquery.js"></script>
	<script type="text/javascript" src="raphael.js"></script>
	<script type="text/javascript" src="g.raphael.js"></script>
	<script type="text/javascript" src="g.bar.js"></script>
	<script type="text/javascript" src="g.line.js"></script>

		<!-- Run JS Scripts -->
	<script type="text/javascript">

		// Setup Global Vars
		var flashBit = 0;
		var setup = 1;

		var timeFile = "timestamp.dat";
		var timeDiv = "time";
		var timeValue = -1;

		var waterPaper = [];
		var waterRectangle = [];
		var waterGraphic = [];
			waterGraphic[0] = 0; // Always Empty For Easy Counting
			waterGraphic[1] = 0;
			waterGraphic[2] = 0;
			waterGraphic[3] = 0;
			waterGraphic[4] = 0;
			waterGraphic[5] = 0;
			waterGraphic[6] = 0;
			waterGraphic[7] = 0;
			waterGraphic[8] = 0;
			waterGraphic[9] = 0;
			waterGraphic[10] = 0;
			waterGraphic[11] = 0;
			waterGraphic[12] = 0;
		var waterValue = [];
			waterValue[0] = 0; // Always Empty For Easy Counting
			waterValue[1] = -1;
			waterValue[2] = -1;
			waterValue[3] = -1;
			waterValue[4] = -1;
			waterValue[5] = -1;
			waterValue[6] = -1;
			waterValue[7] = -1;
			waterValue[8] = -1;
			waterValue[9] = -1;
			waterValue[10] = -1;
			waterValue[11] = -1;
			waterValue[12] = -1;
		var waterValueLast = [];
			waterValueLast[0] = 0; // Always Empty For Easy Counting
			waterValueLast[1] = 0;
			waterValueLast[2] = 0;
			waterValueLast[3] = 0;
			waterValueLast[4] = 0;
			waterValueLast[5] = 0;
			waterValueLast[6] = 0;
			waterValueLast[7] = 0;
			waterValueLast[8] = 0;
			waterValueLast[9] = 0;
			waterValueLast[10] = 0;
			waterValueLast[11] = 0;
			waterValueLast[12] = 0;
		var waterDiv = [];
			waterDiv[0] = ""; // Always Empty For Easy Counting
			waterDiv[1] = "water1";
			waterDiv[2] = "water2";
			waterDiv[3] = "water3";
			waterDiv[4] = "water4";
			waterDiv[5] = "water5";
			waterDiv[6] = "water6";
			waterDiv[7] = "water7";
			waterDiv[8] = "water8";
			waterDiv[9] = "water9";
			waterDiv[10] = "water10";
			waterDiv[11] = "water11";
			waterDiv[12] = "water12";
		var waterLabel = [];
			waterLabel[0] = ""; // Always Empty For Easy Counting
			waterLabel[1] = "waterLabel1";
			waterLabel[2] = "waterLabel2";
			waterLabel[3] = "waterLabel3";
			waterLabel[4] = "waterLabel4";
			waterLabel[5] = "waterLabel5";
			waterLabel[6] = "waterLabel6";
			waterLabel[7] = "waterLabel7";
			waterLabel[8] = "waterLabel8";
			waterLabel[9] = "waterLabel9";
			waterLabel[10] = "waterLabel10";
			waterLabel[11] = "waterLabel11";
			waterLabel[12] = "waterLabel12";
		var waterFile = [];
			waterFile[0] = ""; // Always Empty For Easy Counting
			waterFile[1] = "water1.dat";
			waterFile[2] = "water2.dat";
			waterFile[3] = "water3.dat";
			waterFile[4] = "water4.dat";
			waterFile[5] = "water5.dat";
			waterFile[6] = "water6.dat";
			waterFile[7] = "water7.dat";
			waterFile[8] = "water8.dat";
			waterFile[9] = "water9.dat";
			waterFile[10] = "water10.dat";
			waterFile[11] = "water11.dat";
			waterFile[12] = "water12.dat";
		var waterMax = [];
			waterMax[0] = 0; // Always Empty For Easy Counting
			waterMax[1] = 500;
			waterMax[2] = 500;
			waterMax[3] = 500;
			waterMax[4] = 500;
			waterMax[5] = 200;
			waterMax[6] = 300;
			waterMax[7] = 225;
			waterMax[8] = 275;
			waterMax[9] = 200;
			waterMax[10] = 175;
			waterMax[11] = 500;
			waterMax[12] = 500;

		var photoPaper = [];
		var photoRectangle = [];
		var photoValue = [];
			photoValue[0] = 0;
			photoValue[1] = -1;
			photoValue[2] = -1;
			photoValue[3] = -1;
		var photoValueLast = [];
			photoValueLast[0] = 0;
			photoValueLast[1] = 0;
			photoValueLast[2] = 0;
			photoValueLast[3] = 0;
		var photoFile = [];
			photoFile[0] = "";
			photoFile[1] = "photo1.dat";
			photoFile[2] = "";
			photoFile[3] = "";
		var photoDiv = [];
			photoDiv[0] = "";
			photoDiv[1] = "light1";
			photoDiv[2] = "light2";
			photoDiv[3] = "light3";

		var tempFile = [];
			tempFile[0] = "";
			tempFile[1] = "temp1.dat";
		var tempValue = [];
			tempValue[0] = 0;
			tempValue[1] = -1;
		var tempDiv = [];
			tempDiv[0] = "";
			tempDiv[1] = "temp1";

		var t;
		var containerCanvas;

		var indicatorCircle = [];

		//var tempout = 1;
		var root;
		var root2;


		// Startup Refresh Timer
		window.onload = startRefresh;

		// Refresh mainRefresh
		function startRefresh() {
			document.getElementById("serverOutput").innerHTML += "STARTING UP...";

			// Main Canvas

			document.getElementById("serverOutput").innerHTML += "<br>" + "DRAWING CIRCLES...";

			containerCanvas = Raphael("overlay", 1000, 900);

			for (x = 1; x <= 3; x++) {
				indicatorCircle[x] = [];
				for (y = 1; y <= 4; y++) {
					indicatorCircle[x][y] = containerCanvas.circle((y*143)-68,(x*288)-195,20);
					indicatorCircle[x][y].attr("stroke", "#525252");
					indicatorCircle[x][y].attr("stroke-width", 5);
					indicatorCircle[x][y].attr("fill", "#EEEEEE");
				}
			}

			//indicatorCircle[1][1].click(function () {if (tempout == 2) {tempout = 1;} else if (tempout == 3){tempout = 0;}});

			// Creates Canvas For Water Bars
			document.getElementById("serverOutput").innerHTML += "<br>" + "SETTING UP WATER SENSOR GRAPHICS...";
			for (y = 1; y <= (waterFile.length - 1); y++) {waterPaper[y] = Raphael(waterDiv[y], 140, 140);}

			for (x = 1; x <= (waterFile.length - 1); x++) {
				waterRectangle[x] = [];
				for (y = 1; y <= 13; y++) {
					waterRectangle[x][y] = waterPaper[x].rect(0, 120 - waterGraphic[x], 131, 6, [3]);
					waterRectangle[x][y].attr("stroke-dasharray", ".");
					waterRectangle[x][y].attr("stroke", "#888888");
					waterGraphic[x] = waterGraphic[x] + 10;
				}
			}

			// Creates Canvas For Light/Dark Background
			document.getElementById("serverOutput").innerHTML += "<br>" + "SETTING UP LIGHT/DARK BACKGROUND...";
			for (y = 1; y <= 3; y++) {
				photoPaper[y] = Raphael(photoDiv[y], 577, 150);
				photoRectangle[y] = photoPaper[y].rect(0, 0, 577, 150);
				photoRectangle[y].attr("fill", "#EEEEEE");
			}

			// Set Refresh Rate To One Second
			document.getElementById("serverOutput").innerHTML += "<br>" + "WAITING...";
			setInterval("mainRefresh();", 2000);
		}

		// Code To Be Refreshed
		function mainRefresh() {

			// Setup Text Display and Gather Data
			jQuery.get("arduinoA.dat", function(data) {

				document.getElementById("serverOutput").innerHTML = "-----SERVER DATA-----";

				var unparsedData =[];
				var parsedData = [];

				unparsedData = data.split("\n");

				//document.getElementById("serverOutput").innerHTML += "<br>" + "1: Data = " + data;

				for (x = 0; x < (unparsedData.length); x++) {
					parsedData[x] = [];
					//document.getElementById("serverOutput").innerHTML += "<br>" + "2: X = " + x + " Data = " + unparsedData[x];
					parsedData[x] = unparsedData[x].split(",");
				}

				for (x = 0; x < (parsedData.length); x++) {
					if (parsedData[x][0] == "Water") {
						document.getElementById("serverOutput").innerHTML += "<br>" + "Water #" + parsedData[x][1] + " = " + parsedData[x][2];
						waterValue[parsedData[x][1]] = parsedData[x][2];
					} else if (parsedData[x][0] == "Photo") {
						document.getElementById("serverOutput").innerHTML += "<br>" + "Photo #" + parsedData[x][1] + " = " + parsedData[x][2];
						photoValue[parsedData[x][1]] = parsedData[x][2];
					} else if (parsedData[x][0] == "Temp") {
						document.getElementById("serverOutput").innerHTML += "<br>" + "Temp #" + parsedData[x][1] + " = " + parsedData[x][2];
						tempValue[parsedData[x][1]] = parsedData[x][2];
					} else if (parsedData[x][0] == "Time") {
						document.getElementById("serverOutput").innerHTML += "<br>" + "Time #" + parsedData[x][1] + " = " + parsedData[x][2];
						timeValue = parsedData[x][2];
					}
				}
			});

			if (photoValue[1] != photoValueLast[1]) {
				if (photoValue[1] > 500) {for (y = 1; y <= 3; y++) {photoRectangle[y].animate({fill:"#F3FFBE"}, 2000);}
				} else if (photoValue[1] >= 0) {for (y = 1; y <= 3; y++) {photoRectangle[y].animate({fill:"#C8DFFF"}, 2000);}}
			}
			photoValueLast[1] = photoValue[1];

			// Setup Stylized Water Level Bars
			for (x = 1; x <= (waterFile.length - 1); x++) {
				if (waterValue[x] != waterValueLast[x]) {
					for (y = 1; y <= 13; y++) {
						if (waterValue[x] > (waterMax[x] / 20)) {
							if (waterValue[x] > ((waterMax[x] / 13)*y)) {
								if (waterValue[x] > (waterMax[x] / 1.5)) {waterRectangle[x][y].animate({fill:"#99CCCF"}, 2000);}
								else if (waterValue[x] > (waterMax[x] / 3)) {waterRectangle[x][y].animate({fill:"#CDCF99"}, 2000);}
								else {waterRectangle[x][y].animate({fill:"#CF9999"}, 2000);}
							} else {waterRectangle[x][y].animate({fill:"#EEEEEE"}, 2000);}
						} else if (waterValue[x] >= 0) {
						//	if (flashBit == 0) {waterRectangle[x][y].animate({fill:"#CF9999"}, 500);} else {waterRectangle[x][y].animate({fill:"#EEEEEE"}, 500);}
						} else {waterRectangle[x][y].attr("fill", "#EEEEEE");}
					}
				}
				//if (waterValue[x] >=0 && waterValue[x] <=) {if (flashBit == 0) {waterRectangle[x][y].animate({fill:"#CF9999"}, 500);} else {waterRectangle[x][y].animate({fill:"#EEEEEE"}, 500);}}
				waterValueLast[x] = waterValue[x];
			}

			// Display The Temperature
			//if (tempValue[1] != -1) {indicatorText[1].attr("text", tempValue[1] + "C");}

			//if (tempout == 1) {
			//	indicatorCircle[1][1].animate({"fill": "#35B732"}, 2000);
			//	tempout = 3;
			//} else if (tempout == 0) {
			//	indicatorCircle[1][1].animate({"fill": "#F56161"}, 2000);
			//	tempout = 2;
			//}

			//Tester
			//if (waterValue[2] > 0) {waterValue[2] = waterValue[2] - 10;}
			if (flashBit == 0) {flashBit = 1;} else {flashBit = 0;}

			// When First Run
			if (setup == 1) {
				for (x = 1; x <= 3; x++) {
					for (y = 1; y <= 4; y++) {
						//indicatorCircle[x][y].animate({"fill": "#35B732"}, 2000);
					}
				}
			//	waterValue[2] = 410;
				setup = 0;
			}

		}

	function tester() {$.post('process.php', $('#myform').serialize(), function(data) {$('#results').html(data);});}

	</script>
</head>

<!-- BODY -->
<body>
	<div id="container">
		<div id="center">
			<img id="backgroundFloat-Left" src="float.gif"></img>
			<div id="overlay"></div>
			<div id="water1"></div><div id="waterLabel1"></div>
			<div id="water2"></div><div id="waterLabel2"></div>
			<div id="water3"></div><div id="waterLabel3"></div>
			<div id="water4"></div><div id="waterLabel4"></div>
			<div id="water5"></div><div id="waterLabel5"></div>
			<div id="water6"></div><div id="waterLabel6"></div>
			<div id="water7"></div><div id="waterLabel7"></div>
			<div id="water8"></div><div id="waterLabel8"></div>
			<div id="water9"></div><div id="waterLabel9"></div>
			<div id="water10"></div><div id="waterLabel10"></div>
			<div id="water11"></div><div id="waterLabel11"></div>
			<div id="water12"></div><div id="waterLabel12"></div>
			<div id="light1"></div>
			<div id="light2"></div>
			<div id="light3"></div>
		</div>
		<div id="serverOutput"></div>
		<div id="serverInput">

			<form id="myform" action="" onsubmit="tester(); return false;">
			Command: <input type="text" name="command" />
			</form>

			<div id="results"><div>

		</div>
	</div>
</body>
