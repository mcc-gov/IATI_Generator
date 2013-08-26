<?php
if(!empty($activityRow['docURL']))
{

$documentLink = $activity->addChild("document-link");
$documentLink->addAttribute("url",$activityRow['docURL']);
$documentLink->addAttribute("format","application/pdf");
	$documentLinklanguage = $documentLink->addChild("language","en");
	$documentLinkCategory = $documentLink->addChild("category");
		$documentLinkCategory->addAttribute("code","A02");
	$documentLinkCategory = $documentLink->addChild("category");
		$documentLinkCategory->addAttribute("code","A03");
	$documentLinkTitle = $documentLink->addChild("title",$activityRow['docTitle']);

}

$documentLink = $activity->addChild("document-link");
$documentLink->addAttribute("url","http://www.mcc.gov/documents/guidance/guidance-2012001109601-common-indicators.pdf");
$documentLink->addAttribute("format","application/pdf");
	$documentLinklanguage = $documentLink->addChild("language","en");
	$documentLinkCategory = $documentLink->addChild("category");
		$documentLinkCategory->addAttribute("code","A01");
	$documentLinkCategory = $documentLink->addChild("category");
		$documentLinkCategory->addAttribute("code","A08");
	$documentLinkTitle = $documentLink->addChild("title","Guidance on Common Indicators");
?>