<?php
//PARENT
$relatedActivity = $activity->addChild("related-activity",htmlentities($activityRow['MCCCountryName'] . "-" . $activityRow['FundName'] . "-" . $activityRow['ProjectName']));
$relatedActivity->addAttribute("type","1");
$relatedActivity->addAttribute("ref","US-18-" . $activityRow['MCCCountryCode'] . "-" . $activityRow['FundCode'] . "-" . $activityRow['ProjectCode']);
//SIBLINGS
$relatedQuery = mysqli_query($db,"SELECT * FROM driver WHERE `MCCCountryCode` = '" . $activityRow['MCCCountryCode'] . "' AND `FundCode` = '" . $activityRow['FundCode'] . "' AND `ProjectCode` = '" . $activityRow['ProjectCode'] . "' AND `ActivityCode` <> '" . $activityRow['ActivityCode'] . "'");

while($relatedRow = mysqli_fetch_array($relatedQuery))
{

$relatedActivity = $activity->addChild("related-activity",htmlentities($relatedRow['MCCCountryName'] . "-" . $relatedRow['FundName'] . "-" . $relatedRow['ProjectName'] . "-" . $relatedRow['ActivityName']));
$relatedActivity->addAttribute("type","3");
$relatedActivity->addAttribute("ref","US-18-" . $relatedRow['MCCCountryCode'] . "-" . $relatedRow['FundCode'] . "-" . $relatedRow['ProjectCode'] . "-" . $relatedRow['ActivityCode']);

}
?>