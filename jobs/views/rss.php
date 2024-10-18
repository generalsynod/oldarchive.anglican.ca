<? foreach( $GLOBALS['jobs']->items as $job) { ?>
	<item>
		<title><?= htmlspecialchars($job->jobTitle) ?></title>
		<dc:creator><?= $job->emailOfPoster ?></dc:creator>
		<category><?= $job->type ?></category>
		<dc:date><?= str_replace("00~", ":00", date("Y-m-d\TH:i:sO~", $job->publishDate)) ?></dc:date>
		<link>http://<?= $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'] ?>?action=JobPosting&amp;id=<?= $job->id ?></link>
		<guid isPermaLink="false">http://<?= $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'] ?>?action=JobPosting&amp;id=<?= $job->id ?></guid>
		<description><![CDATA[<strong>Expiry Date:</strong><br/><?= date("M d, Y", $job->expiryDate) ?><br/><br/><strong>Job Posting: </strong><br/><?= convert_special_chars($job->jobPosting) ?>]]></description>
	</item>
<? } ?>
