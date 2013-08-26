<?php
$relatedQuery = mysqli_query($db,"SELECT * FROM driver WHERE MCCCountryCode = '" . $countryFundRow['MCCCountryCode'] . "' AND FundCode = '" . $countryFundRow['FundCode'] . "' GROUP BY ProjectCode ORDER BY ProjectCode ASC");

while($relatedRow = mysqli_fetch_array($relatedQuery))
{

$relatedActivity = $activity->addChild("related-activity",htmlentities($relatedRow['MCCCountryName'] . "-" . $relatedRow['FundName'] . "-" . $relatedRow['ProjectName']));
$relatedActivity->addAttribute("type","2");
$relatedActivity->addAttribute("ref","US-18-" . $relatedRow['MCCCountryCode'] . "-" . $relatedRow['FundCode'] . "-" . $relatedRow['ProjectCode']);

}
$relatedQuery = mysqli_query($db,"SELECT * FROM driver WHERE IATI_COUNTRY_CODE = '" . $countryFundRow['IATI_COUNTRY_CODE'] . "' AND (FundCode <> '" . $countryFundRow['FundCode'] . "' AND MCCCountryCode = '" . $countryFundRow['MCCCountryCode'] . "') GROUP BY FundCode ORDER BY FundCode ASC");

while($relatedRow = mysqli_fetch_array($relatedQuery))
{

$relatedActivity = $activity->addChild("related-activity",htmlentities($relatedRow['MCCCountryName'] . "-" . $relatedRow['FundName']));
$relatedActivity->addAttribute("type","3");
$relatedActivity->addAttribute("ref","US-18-" . $relatedRow['MCCCountryCode'] . "-" . $relatedRow['FundCode']);

}
?>