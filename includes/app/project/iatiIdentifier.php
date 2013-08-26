<?php
$iatiIdentifier = $activity->addChild("iati-identifier","US-18-" . htmlentities($projectRow['MCCCountryCode'] . "-" . $projectRow['FundCode'] . "-" . $projectRow['ProjectCode']));
?>