<?php
$recipientRegion = $activity->addChild("recipient-region",htmlentities($activityRow['DACRegionName']));
$recipientRegion->addAttribute("code",$activityRow['DACRegionCode']);
$recipientRegion->addAttribute("percentage","100");
?>