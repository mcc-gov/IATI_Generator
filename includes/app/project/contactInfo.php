<?php
$contactInfo = $activity->addChild("contact-info");
	
//CONSTANT DYNAMIC ATTRIBUTES
$result = mysqli_query($db,"SELECT `key`, `value` FROM constants WHERE `section` = 'contact-info'");

while($row = mysqli_fetch_array($result))
	{
  		$contactInfo->addChild($row[0],$row[1]);
  	}
?>