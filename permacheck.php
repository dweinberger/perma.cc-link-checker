<?php

// This is a basic program for checking a list of page titles and perma.cc links
// It's done badly because I am a terrible hobbyist programmer.
//
// Perma.cc API documentation is here: https://perma.cc/docs/developer
//
// This program assumes there's a file with the page title and one perma link per line.
// E.g. The Rand Corporation: The Think Tank That Controls America  https://perma.cc/B5LR-88CF
//
// I offer it under the MIT open source license.
// 
// David Weinberger
// david@weinberger.org
// Nov. 23, 2018


// Read that text file into an array
$lines = file('links-and-titles.txt');


for ($i = 0;  $i < count($lines); $i++){ 
	$line = $lines[$i];
	// divide into title and permalink
	$p1 = strpos($line, "https"); // find the beginning of the perma link
	$fullperma = substr($line, $p1); // get the full perma link
	$origtitle = substr($line, 0,$p1); // get the title
	$origtitle = rtrim($origtitle);  // trim the spaces from the end of the title
	
  	// get the distinctive part of the perma link: the stuff after https://perma.cc/ 
	$permacode = strrchr($fullperma,"/"); // find the last forward slash
	$permacode = substr($permacode,1,strlen($permacode)); // get what's after that slash
	$permacode = rtrim($permacode); // trim any spaces from the end
	
	// create the url that will fetch this perma link
	$apiurl = "https://api.perma.cc/v1/public/archives/" . $permacode . "/";
	
	// fetch the data about this perma link
	$onelink = file_get_contents($apiurl);
	// echo $onelink;  // this would print the full json
	// decode the json
	$j = json_decode($onelink, true);
	// Did you get any json, or just null?
	if ($j == null){
		// hmm. This might be a private perma link. Or some other error
		echo "<p>-- $permacode failed. Private? $permaccode</p>";	
	}
	// otherwise, you got something, so write some  of the data into the page
	else {
	echo "<b>" . $j["guid"] . '</b><blockquote>' . $j["title"] . '<br>' . $origtitle . "<br>" . $j["url"] . "</blockquote>";
	}
}


// finish by noting how many files have been read
echo "<h2>Read " . count($lines) . "</h2>";

?>