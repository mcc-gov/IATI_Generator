<?php
if($activityRow['FundName'] == "Admin")
{
$docList = array();
$docList['2007 Annual Report'] = "http://www.mcc.gov/documents/reports/mcc-2007-annualreport.pdf";
$docList['2008 Annual Report'] = "http://www.mcc.gov/documents/reports/mcc-2008-annualreport.pdf";
$docList['2009 Annual Report'] = "http://www.mcc.gov/documents/reports/report-2010001002007-annual-web.pdf";
$docList['2010 Annual Report'] = "http://www.mcc.gov/documents/reports/report-2011001049801-2010annual.pdf";
$docList['2011 Annual Report'] = "http://www.mcc.gov/documents/reports/2012-001-0966-02-MCC_2011_annual_report.pdf";
$docList['2012 Annual Report'] = "http://www.mcc.gov/documents/reports/report-2012-001-1242-01-annual-report-2012_1.pdf";

foreach($docList as $docKey => $docValue)
{
$documentLink = $activity->addChild("document-link");
$documentLink->addAttribute("url",$docValue);
$documentLink->addAttribute("format","application/pdf");
	$documentLinklanguage = $documentLink->addChild("language","en");
	$documentLinkCategory = $documentLink->addChild("category");
		$documentLinkCategory->addAttribute("code","B01");
	$documentLinkTitle = $documentLink->addChild("title",$docKey);
	
}
}
else if($activityRow['FundName'] == "Audit Fund")
{
	
$docList = array();
$docList['Performance Accountability Report, Fiscal Year 2005'] = "http://www.mcc.gov/documents/reports/report-fy2005-par.pdf";
$docList['Performance Accountability Report, Fiscal Year 2006'] = "http://www.mcc.gov/documents/reports/report-fy2006a-par.pdf";
$docList['Performance Accountability Report, Fiscal Year 2007'] = "http://www.mcc.gov/documents/reports/report-fy2007-par.pdf";
$docList['Performance Accountability Report, Fiscal Year 2008'] = "http://www.mcc.gov/documents/reports/mcc-2008-par.pdf";
$docList['Agency Financial Report, Fiscal Year 2009'] = "http://www.mcc.gov/documents/reports/report-fy2009-afr.pdf";
$docList['Agency Financial Report, Fiscal Year 2010'] = "http://www.mcc.gov/documents/reports/report-fy2010-afr.pdf";
$docList['Agency Financial Report, Fiscal Year 2011'] = "http://www.mcc.gov/documents/reports/report-fy2011-afr.pdf";


foreach($docList as $docKey => $docValue)
{
$documentLink = $activity->addChild("document-link");
$documentLink->addAttribute("url",$docValue);
$documentLink->addAttribute("format","application/pdf");
	$documentLinklanguage = $documentLink->addChild("language","en");
	$documentLinkCategory = $documentLink->addChild("category");
		$documentLinkCategory->addAttribute("code","B06");
	$documentLinkTitle = $documentLink->addChild("title",$docKey);
	
}
}
else
{
$documentLink = $activity->addChild("document-link");
$documentLink->addAttribute("url","http://www.mcc.gov/documents/guidance/guidance-2012001109601-common-indicators.pdf");
$documentLink->addAttribute("format","application/pdf");
	$documentLinklanguage = $documentLink->addChild("language","en");
	$documentLinkCategory = $documentLink->addChild("category");
		$documentLinkCategory->addAttribute("code","A01");
	$documentLinkTitle = $documentLink->addChild("title","Guidance on Common Indicators");
}
?>