<?
$job = &$GLOBALS['job'];
?>
<!-- TITLE BEGINS -->
<h1 id="pageName"><!-- InstanceBeginEditable name="TITLE" -->Job Posting <!-- InstanceEndEditable --></h1> 
<!-- TITLE ENDS -->
<div class="content"><!-- InstanceBeginEditable name="BODY" -->
	<div class="job-posting">
		<span class="type"><?= $job->type ?></span>
		<span class="title"><strong><?= $job->jobTitle ?></strong></span>
		<!--span class="poster-name"><?= $job->nameOfPoster ?></span-->
		<!--span class="poster-email"><?= $job->emailOfPoster ?></span-->
		<div class="details"><?= $job->jobPosting ?></div>
		<span class="contact-information"><?= $job->contactInformation ?></span>
	</div>
    <div class="date">Posted until: <?= date("M d Y", $job->expiryDate) ?></div>
	<div class="job-navigation"><a href="<?= $_SERVER['PHP_SELF'] ?>">Return to the position list</a></div>
</div>