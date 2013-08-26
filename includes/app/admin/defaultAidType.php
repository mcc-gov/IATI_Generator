<?php
//AID TYPE SELECTOR
$aidTypeCode = "C01";
if(($activityRow['FundName'] == "Admin") or ($activityRow['FundName'] == "Audit Fund"))
{
$aidTypeCode = "G01";
}
$defaultAidType = $activity->addChild("default-aid-type");
$defaultAidType->addAttribute("code",$aidTypeCode);
?>