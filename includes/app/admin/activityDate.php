<?php
//Planned Start Date
//$activityDate1 = $activity->addChild("activity-date","ISODATE");
//$activityDate1->addAttribute("type","start-planned");
//$activityDate1->addAttribute("iso-date","ISODATE");

//Actual Start Date
$activityDate2 = $activity->addChild("activity-date",$activityRow['start_date']);
$activityDate2->addAttribute("type","start-actual");
$activityDate2->addAttribute("iso-date",$activityRow['start_date']);

//Planned End Date
//$activityDate3 = $activity->addChild("activity-date","ISODATE");
//$activityDate3->addAttribute("type","end-planned");
//$activityDate3->addAttribute("iso-date","ISODATE");

//Actual End Date
$activityDate4 = $activity->addChild("activity-date",$activityRow['end_date']);
$activityDate4->addAttribute("type","end-actual");
$activityDate4->addAttribute("iso-date",$activityRow['end_date']);

?>