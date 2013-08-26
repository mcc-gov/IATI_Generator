<?php
//CHECK IF COUNTRY-EFFORT HAS A DOCUMENT ASSIGNED
if(!empty($countryFundRow['docURL']))
{
$documentLink = $activity->addChild("document-link");
$documentLink->addAttribute("url",$countryFundRow['docURL']);
$documentLink->addAttribute("format","application/pdf");
	$documentLinklanguage = $documentLink->addChild("language","en");
	$documentLinkCategory = $documentLink->addChild("category");
		$documentLinkCategory->addAttribute("code","A01");
	$documentLinkCategory = $documentLink->addChild("category");
		$documentLinkCategory->addAttribute("code","A02");
	$documentLinkCategory = $documentLink->addChild("category");
		$documentLinkCategory->addAttribute("code","A03");
	$documentLinkCategory = $documentLink->addChild("category");
		$documentLinkCategory->addAttribute("code","A04");
	$documentLinkCategory = $documentLink->addChild("category");
		$documentLinkCategory->addAttribute("code","A05");
	$documentLinkCategory = $documentLink->addChild("category");
		$documentLinkCategory->addAttribute("code","A06");
	$documentLinkCategory = $documentLink->addChild("category");
		$documentLinkCategory->addAttribute("code","A07");
	$documentLinkCategory = $documentLink->addChild("category");
		$documentLinkCategory->addAttribute("code","A10");
	$documentLinkCategory = $documentLink->addChild("category");
		$documentLinkCategory->addAttribute("code","A11");
	$documentLinkTitle = $documentLink->addChild("title",$countryFundRow['docTitle']);

//NO DOCUMENT ASSIGNED
}else{
	$documentQuery = mysqli_query($db,"SELECT * FROM `documents` WHERE `category` LIKE '%A03%' OR `category` LIKE '%A11%'");

	while($documentRow = mysqli_fetch_array($documentQuery))
	{
		$documentLink = $activity->addChild("document-link");
		$documentLink->addAttribute("url",$documentRow['url']);
		$documentLink->addAttribute("format",$documentRow['format']);
			$documentLinklanguage = $documentLink->addChild("language","en");
			//LIST CATEGORIES
			foreach (explode(',', $documentRow['category']) as $cat)
			{
				if (substr($cat, 0, 1) === 'A') 
				{
					$documentLinkCategory = $documentLink->addChild("category");
						$documentLinkCategory->addAttribute("code",$cat);
				}
			}
			$documentLinkTitle = $documentLink->addChild("title",$documentRow['title']);
	}

}
//ALL COUNTRY-EFFORTS
$documentQuery = mysqli_query($db,"SELECT * FROM `documents` WHERE `category` LIKE '%A%' AND `category` NOT LIKE '%A03%' AND `category` NOT LIKE '%A11%'");

while($documentRow = mysqli_fetch_array($documentQuery))
{
	$documentLink = $activity->addChild("document-link");
	$documentLink->addAttribute("url",$documentRow['url']);
	$documentLink->addAttribute("format",$documentRow['format']);
		$documentLinklanguage = $documentLink->addChild("language","en");
		//LIST CATEGORIES
		foreach (explode(',', $documentRow['category']) as $cat)
		{
			if (substr($cat, 0, 1) === 'A') 
			{
				$documentLinkCategory = $documentLink->addChild("category");
					$documentLinkCategory->addAttribute("code",$cat);
			}
		}
		$documentLinkTitle = $documentLink->addChild("title",$documentRow['title']);
}
?>