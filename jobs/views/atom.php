<? foreach( $GLOBALS['jobs']->items as $job) { ?>
	<entry>
	   <title><?= htmlspecialchars($job->jobTitle) ?></title>
	   <link href="https://<?= $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'] ?>?action=JobPosting&amp;id=<?= $job->id ?>"/>
	   <id>https://<?= $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'] ?>?action=JobPosting&amp;id=<?= $job->id ?></id>
	   <updated><?= str_replace("00~", ":00", date("Y-m-d\TH:i:sO~", $job->publishDate)) ?></updated>
	   <content type="xhtml"><div xmlns="https://www.w3.org/1999/xhtml"><strong>Expiry Date:</strong><br/><?= date("M d, Y", $job->expiryDate) ?><br/><br/><strong>Job Posting: </strong><br/><?= htmlspecialchars(convert_special_chars($job->jobPosting)) ?></div></content>
	 </entry>
<? } ?>
