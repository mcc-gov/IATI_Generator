<?php
//PARENT
$relatedActivity = $activity->addChild("related-activity",htmlentities($projectRow['MCCCountryName'] . "-" . $projectRow['FundName']));
$relatedActivity->addAttribute("type","1");
$relatedActivity->addAttribute("ref","US-18-" . $projectRow['MCCCountryCode'] . "-" . $projectRow['FundCode']);

//CHILDREN
$relatedQuery = mysqli_query($db,"SELECT * FROM driver WHERE MCCCountryCode = '" . $projectRow['MCCCountryCode'] . "' AND FundCode = '" . $projectRow['FundCode'] . "' AND ProjectCode = '" . $projectRow['ProjectCode'] . "' GROUP BY ActivityCode ORDER BY ActivityCode ASC");

while($relatedRow = mysqli_fetch_array($relatedQuery))
{

$relatedActivity = $activity->addChild("related-activity",htmlentities($relatedRow['MCCCountryName'] . "-" . $relatedRow['FundName'] . "-" . $relatedRow['ProjectName'] . "-" . $relatedRow['ActivityName']));
$relatedActivity->addAttribute("type","2");
$relatedActivity->addAttribute("ref","US-18-" . $relatedRow['MCCCountryCode'] . "-" . $relatedRow['FundCode'] . "-" . $relatedRow['ProjectCode'] . "-" . $relatedRow['ActivityCode']);

}

//SIBLINGS
$relatedQuery = mysqli_query($db,"SELECT * FROM driver WHERE MCCCountryCode = '" . $projectRow['MCCCountryCode'] . "' AND FundCode = '" . $projectRow['FundCode'] . "' AND ProjectCode <> '" . $projectRow['ProjectCode'] . "' GROUP BY ProjectCode ORDER BY ProjectCode ASC");

while($relatedRow = mysqli_fetch_array($relatedQuery))
{

$relatedActivity = $activity->addChild("related-activity",htmlentities($relatedRow['MCCCountryName'] . "-" . $relatedRow['FundName'] . "-" . $relatedRow['ProjectName']));
$relatedActivity->addAttribute("type","3");
$relatedActivity->addAttribute("ref","US-18-" . $relatedRow['MCCCountryCode'] . "-" . $relatedRow['FundCode'] . "-" . $relatedRow['ProjectCode']);

}

?>