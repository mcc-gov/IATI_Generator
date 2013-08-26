<?php
$iatiIdentifier = $activity->addChild("iati-identifier","US-18-" . htmlentities($activityRow['MCCCountryCode'] . "-" . $activityRow['FundCode'] . "-" . $activityRow['ProjectCode'] . "-" . $activityRow['ActivityCode']));
?>