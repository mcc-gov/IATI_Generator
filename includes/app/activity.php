<?php
$activity = $xml->addChild("iati-activity");

//CONSTANT DYNAMIC ATTRIBUTES
$result = mysqli_query($db,"SELECT `key`, `value` FROM constants WHERE `section` = 'iati-activity'");

while($row = mysqli_fetch_array($result))
	{
  		$activity->addAttribute($row[0],$row[1]);
  	}

//SESSION DRIVEN ATTRIBUTE
$activity->addAttribute("last-updated-datetime",$constants['maxDate'] . "T00:00:00-04:00");
$activity->addAttribute("hierarchy","3");
?>