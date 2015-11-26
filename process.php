<?php
	print "POSTED: <b>".$_POST['command']."</b>";

	// Open the file in write mode
	$handle = fopen("writetest.txt","w+");

	// If successful
	if ($handle) {
		// Write to that handle the username submitted in the form and the date
		fwrite($handle,$_POST["command"]);

		// Close the file
		fclose($handle);
	}
?>
