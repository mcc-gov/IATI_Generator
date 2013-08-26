<?php
$sector = $activity->addChild("sector",htmlentities($activityRow['DACName']));
$sector->addAttribute("percentage","100");
$sector->addAttribute("vocabulary","DAC");
$sector->addAttribute("code",$activityRow['DACCode']);
?>