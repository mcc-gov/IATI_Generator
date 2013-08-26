<?php
//--------------------------   IATI GENERATOR DEVELOPED BY THE MILLENNIUM CHALLENGE CORPORATION (V1.03a) ----------------------------------

//LOAD REQUIRED SETTINGS AND RESOURCES
require_once('includes/app/config.php');

//CHECK TO MAKE SURE DRIVER IS OKAY
if(mysqli_query($db, $driverQuery3) === TRUE){

//LOOP THROUGH IATI_COUNTRY_CODE
$iatiCountryQuery = mysqli_query($db,"SELECT IATI_COUNTRY_CODE FROM driver WHERE MCCCountryCode <> '---' GROUP BY IATI_COUNTRY_CODE ORDER BY IATI_COUNTRY_CODE ASC");

while($iatiCountryRow = mysqli_fetch_array($iatiCountryQuery))
{  		

//START XML
include('includes/app/xml.php');

//--------------------------   SET IATI ACTIVITIES ATTRIBUTES -----------------------------------------
include('includes/app/activities.php');

//--------------------------   BEGIN IATI ACTIVITY  ---------------------------------------------------
//LOOP THROUGH ALL COUNTRY/FUNDS HIERARCHY 1 
$countryFundQuery = mysqli_query($db,"SELECT FundCode, MCCCountryCode, ProjectCode, ActivityCode, FundName, MCCCountryName, ProjectName, ActivityName, DACCode, DACName, Min(start_date) AS start_date, Min(end_control) AS end_control, Max(end_date) AS end_date, `Status`, IATI_COUNTRY_CODE, IATI_NAME, IATI_LAT, IATI_LON, docTitle, docURL, description, DACRegionCode, DACRegionName FROM driver WHERE MCCCountryCode <> '---' AND IATI_COUNTRY_CODE = '" . $iatiCountryRow['IATI_COUNTRY_CODE'] . "' GROUP BY MCCCountryCode, FundCode ORDER BY MCCCountryCode ASC, FundCode ASC");

while($countryFundRow = mysqli_fetch_array($countryFundQuery))
{  		
//--------------------------   BEGIN IATI COUNTRY/FUND  ---------------------------------------------------
include('includes/app/countryFund.php');

//|||||||||||||||||||   ADD REPORTING ORG DATA   ||||||||||||||||||||||
include('includes/app/countryFund/reportingOrg.php');

//|||||||||||||||||||   ADD IATI IDENTIFIER   ||||||||||||||||||||||
include('includes/app/countryFund/iatiIdentifier.php');

//|||||||||||||||||||   ADD IATI TITLE   ||||||||||||||||||||||
include('includes/app/countryFund/title.php');

//|||||||||||||||||||   ADD ACTIVITY WEBSITE   ||||||||||||||||||||||
//include('includes/app/countryFund/activityWebsite.php');

//|||||||||||||||||||   (ACTIVITY) DESCRIPTION   ||||||||||||||||||||||
include('includes/app/countryFund/description.php');

//|||||||||||||||||||    ACTIVITY STATUS   |||||||||||||||||||||| 
include('includes/app/countryFund/activityStatus.php');

//|||||||||||||||||||   ACTIVITY DATE   ||||||||||||||||||||||
include('includes/app/countryFund/activityDate.php');

//|||||||||||||||||||   CONTACT INFO   ||||||||||||||||||||||
//include('includes/app/countryFund/contactInfo.php');
	
//|||||||||||||||||||   PARTICIPATING ORG   ||||||||||||||||||||||
include('includes/app/countryFund/participatingOrg.php');

//|||||||||||||||||||   RECIPIENT COUNRTY   |||||||||||||||||||||| (Switch for type of funds)
include('includes/app/countryFund/recipientCountry.php');

//|||||||||||||||||||   RECIPIENT REGION   |||||||||||||||||||||| (Switch for type of funds)
//include('includes/app/countryFund/recipientRegion.php');

//|||||||||||||||||||   LOCATION   |||||||||||||||||||||| (Switch for type of funds)
//include('includes/app/countryFund/location.php');

//|||||||||||||||||||   SECTOR   |||||||||||||||||||||| 
//include('includes/app/countryFund/sector.php');

//|||||||||||||||||||   POLICY MARKER   ||||||||||||||||||||||
//include('includes/app/countryFund/policyMarker.php');

//|||||||||||||||||||   COLLABORATION TYPE   ||||||||||||||||||||||
//include('includes/app/countryFund/collaborationType.php');

//|||||||||||||||||||   DEFAULT FINANCE TYPE   ||||||||||||||||||||||
//include('includes/app/countryFund/defaultFinanceType.php');

//|||||||||||||||||||   DEFAULT FLOW TYPE   ||||||||||||||||||||||
//include('includes/app/countryFund/defaultFlowType.php');

//|||||||||||||||||||   DEFAULT AID TYPE   |||||||||||||||||||||| (Switch with types to G01 if Admin)
//include('includes/app/countryFund/defaultAidType.php');

//|||||||||||||||||||   DEFAULT TIED STATUS   ||||||||||||||||||||||
//include('includes/app/countryFund/defaultTiedStatus.php');

//|||||||||||||||||||   BUDGET   ||||||||||||||||||||||
include('includes/app/countryFund/budget.php');

//|||||||||||||||||||   CAPITAL SPEND   ||||||||||||||||||||||
include('includes/app/countryFund/capitalSpend.php');

//|||||||||||||||||||   COUNTRY BUDGET  ||||||||||||||||||||||
include('includes/app/countryFund/countryBudgetItems.php');
	
//|||||||||||||||||||   PLANNED DISBURSEMENT   ||||||||||||||||||||||
include('includes/app/countryFund/plannedDisbursement.php');

//|||||||||||||||||||   TRANSACTION   ||||||||||||||||||||||
//include('includes/app/countryFund/transaction.php');

//|||||||||||||||||||   DOCUMENT LINK   ||||||||||||||||||||||
include('includes/app/countryFund/documentLink.php');
	
//|||||||||||||||||||   RELATED ACTIVITY   ||||||||||||||||||||||
include('includes/app/countryFund/relatedActivity.php');

//|||||||||||||||||||   CONDITIONS   |||||||||||||||||||||| (Compact or Threshhold Only) Else 0
//include('includes/app/countryFund/conditions.php');

//|||||||||||||||||||   RESULTS   |||||||||||||||||||||| (Only for Countries)
//include('includes/app/countryFund/results.php');

//|||||||||||||||||||   LEGACY DATA   |||||||||||||||||||||| (Only for Countries)
//include('includes/app/countryFund/legacyData.php');

//--------------------------------------------------------------------------------------------------------


//LOOP THROUGH ALL PROJECTS HIERARCHY 2
$projectQuery = mysqli_query($db,"SELECT FundCode, MCCCountryCode, ProjectCode, ActivityCode, FundName, MCCCountryName, ProjectName, ActivityName, DACCode, DACName, Min(start_date) AS start_date, Min(end_control) AS end_control, Max(end_date) AS end_date, `Status`, IATI_COUNTRY_CODE, IATI_NAME, IATI_LAT, IATI_LON, docTitle, docURL, description, DACRegionCode, DACRegionName FROM driver WHERE MCCCountryCode = '" . $countryFundRow['MCCCountryCode'] . "' AND FundCode = '" . $countryFundRow['FundCode'] . "' GROUP BY ProjectCode ORDER BY ProjectCode ASC");

while($projectRow = mysqli_fetch_array($projectQuery))
{
  		
//--------------------------   BEGIN IATI PROJECT  ---------------------------------------------------
include('includes/app/project.php');

//|||||||||||||||||||   ADD REPORTING ORG DATA   ||||||||||||||||||||||
include('includes/app/project/reportingOrg.php');

//|||||||||||||||||||   ADD IATI IDENTIFIER   ||||||||||||||||||||||
include('includes/app/project/iatiIdentifier.php');

//|||||||||||||||||||   ADD IATI TITLE   ||||||||||||||||||||||
include('includes/app/project/title.php');

//|||||||||||||||||||   ADD ACTIVITY WEBSITE   ||||||||||||||||||||||
//include('includes/app/project/activityWebsite.php');

//|||||||||||||||||||   (ACTIVITY) DESCRIPTION   ||||||||||||||||||||||
include('includes/app/project/description.php');

//|||||||||||||||||||    ACTIVITY STATUS   |||||||||||||||||||||| 
include('includes/app/project/activityStatus.php');

//|||||||||||||||||||   ACTIVITY DATE   ||||||||||||||||||||||
include('includes/app/project/activityDate.php');

//|||||||||||||||||||   CONTACT INFO   ||||||||||||||||||||||
//include('includes/app/project/contactInfo.php');
	
//|||||||||||||||||||   PARTICIPATING ORG   ||||||||||||||||||||||
include('includes/app/project/participatingOrg.php');

//|||||||||||||||||||   RECIPIENT COUNRTY   |||||||||||||||||||||| (Switch for type of funds)
include('includes/app/project/recipientCountry.php');

//|||||||||||||||||||   RECIPIENT REGION   |||||||||||||||||||||| (Switch for type of funds)
//include('includes/app/project/recipientRegion.php');

//|||||||||||||||||||   LOCATION   |||||||||||||||||||||| (Switch for type of funds)
//include('includes/app/project/location.php');

//|||||||||||||||||||   SECTOR   |||||||||||||||||||||| 
//include('includes/app/project/sector.php');

//|||||||||||||||||||   POLICY MARKER   ||||||||||||||||||||||
//include('includes/app/project/policyMarker.php');

//|||||||||||||||||||   COLLABORATION TYPE   ||||||||||||||||||||||
//include('includes/app/project/collaborationType.php');

//|||||||||||||||||||   DEFAULT FINANCE TYPE   ||||||||||||||||||||||
//include('includes/app/project/defaultFinanceType.php');

//|||||||||||||||||||   DEFAULT FLOW TYPE   ||||||||||||||||||||||
//include('includes/app/project/defaultFlowType.php');

//|||||||||||||||||||   DEFAULT AID TYPE   |||||||||||||||||||||| (Switch with types to G01 if Admin)
//include('includes/app/project/defaultAidType.php');

//|||||||||||||||||||   DEFAULT TIED STATUS   ||||||||||||||||||||||
//include('includes/app/project/defaultTiedStatus.php');

//|||||||||||||||||||   BUDGET   ||||||||||||||||||||||
include('includes/app/project/budget.php');

//|||||||||||||||||||   CAPITAL SPEND   ||||||||||||||||||||||
//include('includes/app/project/capitalSpend.php');

//|||||||||||||||||||   COUNTRY BUDGET  ||||||||||||||||||||||
//include('includes/app/project/countryBudgetItems.php');
	
//|||||||||||||||||||   PLANNED DISBURSEMENT   ||||||||||||||||||||||
include('includes/app/project/plannedDisbursement.php');

//|||||||||||||||||||   TRANSACTION   ||||||||||||||||||||||
//include('includes/app/project/transaction.php');

//|||||||||||||||||||   DOCUMENT LINK   ||||||||||||||||||||||
//include('includes/app/project/documentLink.php');
	
//|||||||||||||||||||   RELATED ACTIVITY   ||||||||||||||||||||||
include('includes/app/project/relatedActivity.php');

//|||||||||||||||||||   CONDITIONS   |||||||||||||||||||||| (Compact or Threshhold Only) Else 0
//include('includes/app/project/conditions.php');

//|||||||||||||||||||   RESULTS   |||||||||||||||||||||| (Only for Countries)
include('includes/app/project/results.php');

//|||||||||||||||||||   LEGACY DATA   |||||||||||||||||||||| (Only for Countries)
//include('includes/app/project/legacyData.php');

//------------------------------------------------------------------------------------------------------

//LOOP THROUGH ALL ACTIVITIES HIERARCHY 3
$activityQuery = mysqli_query($db,"SELECT * FROM driver WHERE MCCCountryCode = '" . $projectRow['MCCCountryCode'] . "' AND FundCode = '" . $projectRow['FundCode'] . "' AND ProjectCode = '" . $projectRow['ProjectCode'] . "' GROUP BY ActivityCode ORDER BY ActivityCode ASC");

while($activityRow = mysqli_fetch_array($activityQuery))
{
  		
//--------------------------   BEGIN IATI ACTIVITY  ---------------------------------------------------
include('includes/app/activity.php');

//|||||||||||||||||||   ADD REPORTING ORG DATA   ||||||||||||||||||||||
include('includes/app/activity/reportingOrg.php');

//|||||||||||||||||||   ADD IATI IDENTIFIER   ||||||||||||||||||||||
include('includes/app/activity/iatiIdentifier.php');

//|||||||||||||||||||   ADD IATI TITLE   ||||||||||||||||||||||
include('includes/app/activity/title.php');

//|||||||||||||||||||   ADD ACTIVITY WEBSITE   ||||||||||||||||||||||
include('includes/app/activity/activityWebsite.php');

//|||||||||||||||||||   (ACTIVITY) DESCRIPTION   ||||||||||||||||||||||
include('includes/app/activity/description.php');

//|||||||||||||||||||    ACTIVITY STATUS   |||||||||||||||||||||| 
include('includes/app/activity/activityStatus.php');

//|||||||||||||||||||   ACTIVITY DATE   ||||||||||||||||||||||
include('includes/app/activity/activityDate.php');

//|||||||||||||||||||   CONTACT INFO   ||||||||||||||||||||||
include('includes/app/activity/contactInfo.php');
	
//|||||||||||||||||||   PARTICIPATING ORG   ||||||||||||||||||||||
include('includes/app/activity/participatingOrg.php');

//|||||||||||||||||||   RECIPIENT COUNRTY   |||||||||||||||||||||| (Switch for type of funds)
include('includes/app/activity/recipientCountry.php');

//|||||||||||||||||||   RECIPIENT REGION   |||||||||||||||||||||| (Switch for type of funds)
//include('includes/app/activity/recipientRegion.php');

//|||||||||||||||||||   LOCATION   |||||||||||||||||||||| (Switch for type of funds)
include('includes/app/activity/location.php');

//|||||||||||||||||||   SECTOR   |||||||||||||||||||||| 
include('includes/app/activity/sector.php');

//|||||||||||||||||||   POLICY MARKER   ||||||||||||||||||||||
//include('includes/app/activity/policyMarker.php');

//|||||||||||||||||||   COLLABORATION TYPE   ||||||||||||||||||||||
include('includes/app/activity/collaborationType.php');

//|||||||||||||||||||   DEFAULT FINANCE TYPE   ||||||||||||||||||||||
include('includes/app/activity/defaultFinanceType.php');

//|||||||||||||||||||   DEFAULT FLOW TYPE   ||||||||||||||||||||||
include('includes/app/activity/defaultFlowType.php');

//|||||||||||||||||||   DEFAULT AID TYPE   |||||||||||||||||||||| (Switch with types to G01 if Admin)
include('includes/app/activity/defaultAidType.php');

//|||||||||||||||||||   DEFAULT TIED STATUS   ||||||||||||||||||||||
include('includes/app/activity/defaultTiedStatus.php');

//|||||||||||||||||||   BUDGET   ||||||||||||||||||||||
//include('includes/app/activity/budget.php');
	
//|||||||||||||||||||   PLANNED DISBURSEMENT   ||||||||||||||||||||||
//include('includes/app/activity/plannedDisbursement.php');

//|||||||||||||||||||   TRANSACTION   ||||||||||||||||||||||
include('includes/app/activity/transaction.php');

//|||||||||||||||||||   DOCUMENT LINK   ||||||||||||||||||||||
//include('includes/app/activity/documentLink.php');
	
//|||||||||||||||||||   RELATED ACTIVITY   ||||||||||||||||||||||
include('includes/app/activity/relatedActivity.php');

//|||||||||||||||||||   CONDITIONS   |||||||||||||||||||||| (Compact or Threshhold Only) Else 0
include('includes/app/activity/conditions.php');

//|||||||||||||||||||   RESULTS   |||||||||||||||||||||| (Only for Countries)
//include('includes/app/activity/results.php');

//|||||||||||||||||||   LEGACY DATA   |||||||||||||||||||||| (Only for Countries)
//include('includes/app/activity/legacyData.php');

//CLOSE HIERARCHY 3 LOOP
}

//CLOSE HIERARCHY 2 LOOP
}

//CLOSE HIERARCHY 1 LOOP
}

//OUTPUT INDIVIDUAL FILES
if($xml->asXML('output/MCC_' . $iatiCountryRow['IATI_COUNTRY_CODE'] . '.xml'))
{
	echo "IATI File Created for " . $iatiCountryRow['IATI_COUNTRY_CODE'] . "<br />";
}else{
	echo "Error Making IATI File for " . $iatiCountryRow['IATI_COUNTRY_CODE'] ;
}

//CLOSE IATI_COUNTRY_CODE LOOP
}

//-------------------------------------------------------------------------------------------------------
/*LOOP THROUGH ALL NON-ACTIVITIES
$activityQuery = mysqli_query($db,"SELECT * FROM driver WHERE MCCCountryCode = '---'");

while($activityRow = mysqli_fetch_array($activityQuery))
{
  		
//--------------------------   BEGIN IATI NON-ACTIVITY  ---------------------------------------------------
include('includes/app/admin.php');

//|||||||||||||||||||   ADD REPORTING ORG DATA   ||||||||||||||||||||||
include('includes/app/admin/reportingOrg.php');

//|||||||||||||||||||   ADD IATI IDENTIFIER   ||||||||||||||||||||||
include('includes/app/admin/iatiIdentifier.php');

//|||||||||||||||||||   ADD IATI TITLE   ||||||||||||||||||||||
include('includes/app/admin/title.php');

//|||||||||||||||||||   ADD ADMIN ACTIVITY WEBSITE   ||||||||||||||||||||||
include('includes/app/admin/activityWebsite.php');

//|||||||||||||||||||   (ACTIVITY) DESCRIPTION   ||||||||||||||||||||||
include('includes/app/admin/description.php');

//|||||||||||||||||||   ACTIVITY DATE   ||||||||||||||||||||||
include('includes/app/admin/activityDate.php');

//|||||||||||||||||||   CONTACT INFO   ||||||||||||||||||||||
include('includes/app/admin/contactInfo.php');

//|||||||||||||||||||   PARTICIPATING ORG   ||||||||||||||||||||||
include('includes/app/activity/participatingOrg.php');

//|||||||||||||||||||   RECIPIENT COUNRTY   |||||||||||||||||||||| (Switch for type of funds)
//include('includes/app/activity/recipientCountry.php');

//|||||||||||||||||||   RECIPIENT REGION   |||||||||||||||||||||| (Switch for type of funds)
include('includes/app/activity/recipientRegion.php');
	
//|||||||||||||||||||   SECTOR   |||||||||||||||||||||| 
include('includes/app/admin/sector.php');

//|||||||||||||||||||   DEFAULT FINANCE TYPE   ||||||||||||||||||||||
include('includes/app/admin/defaultFinanceType.php');

//|||||||||||||||||||   DEFAULT FLOW TYPE   ||||||||||||||||||||||
include('includes/app/admin/defaultFlowType.php');

//|||||||||||||||||||   DEFAULT AID TYPE   |||||||||||||||||||||| 
include('includes/app/admin/defaultAidType.php');

//|||||||||||||||||||   DEFAULT TIED STATUS   ||||||||||||||||||||||
include('includes/app/admin/defaultTiedStatus.php');

//|||||||||||||||||||   TRANSACTION   ||||||||||||||||||||||
include('includes/app/admin/transaction.php');

//|||||||||||||||||||   DOCUMENT LINK   ||||||||||||||||||||||
include('includes/app/admin/documentLink.php');
	
//|||||||||||||||||||   LEGACY DATA   |||||||||||||||||||||| (Only for Countries)
//include('includes/app/admin/legacyData.php');

//CLOSE NON-ACTIVITY LOOP
}
*/
//------------------------------------------------------------------------------------------------------
//OUTPUT

//$xml->addAttribute("maxMem",ceil(memory_get_peak_usage()/1024/1024) . "MB");
//header("Content-Type: text/xml");
//echo $xml->asXML();


}
?>