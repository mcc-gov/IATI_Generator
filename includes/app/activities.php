<?php
//CONSTANT DYNAMIC ATTRIBUTES
$result = mysqli_query($db,"SELECT `key`, `value` FROM constants WHERE `section` = 'iati-activities'");

while($row = mysqli_fetch_array($result))
	{
  		$xml->addAttribute($row[0],$row[1]);
  	}

//SESSION DRIVEN ATTRIBUTES
$xml->addAttribute("generated-datetime",date(DATE_ATOM));
?>