<?php
$org = $activity->addChild("reporting-org","Millennium Challenge Corporation");

//CONSTANT DYNAMIC ATTRIBUTES
$result = mysqli_query($db,"SELECT `key`, `value` FROM constants WHERE `section` = 'reporting-org'");

while($row = mysqli_fetch_array($result))
	{
  		$org->addAttribute($row[0],$row[1]);
  	}
?>