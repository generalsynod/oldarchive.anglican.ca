<?
function classIfPublished(&$job) {
	if ( $job->isPublished ) {
		return " is-published";
	}
	else {
		return " is-not-published";
	}
}
?>
<!-- TITLE BEGINS -->
<h1 id="pageName"><!-- InstanceBeginEditable name="TITLE" -->Admin Job Listing Management <!-- InstanceEndEditable --></h1> 
<!-- TITLE ENDS -->
<div class="content"><!-- InstanceBeginEditable name="BODY" -->
	<p>Positions in Parishes, Dioceses, General Synod of the Anglican Church of Canada and associated institutions are available here. The content of all job ads is wholly the responsibility of the posting organization. The posting institution should be contacted if you have any questions on the position.</p>
	<p>Positions can be posted <a href="?action=AddJobPosting" title="add a job posting">here</a>.</p>
	<div class="menu-bar">
		<div class="menu-bar-section">Sort by: <a href="<?= $_SERVER['PHP_SELF'] ?>">Date</a> <a href="?action=JobListingByType">Job type</a></div>
		<div class="menu-bar-section">Syndication: <a href="?action=Rss">RSS</a> <a href="?action=Atom">Atom</a></div>
	</div>
	<div id="current-jobs" class="job-list">
		<? foreach($GLOBALS['jobs']->items as $job) { ?>
		<div class="job-posting<?= classIfPublished($job) ?>">
			<span class="type"><?= $job->type ?></span>
			<span class="title"><strong><?= convert_special_chars($job->jobTitle) ?></strong></span>
			<span class="date">Posted Until: <?= date("M d Y", $job->expiryDate) ?></span>
			<div class="more-info"><a href="?action=JobPosting&amp;id=<?= $job->id ?>" title="View details">More information about this position</a></div>
			<? if ( $job->isPublished ) { ?>
			<form action="?action=UnpublishJobPosting" method="POST">
				<input type="hidden" name="id" value="<?= $job->id ?>" />
				<input type="submit" value="Unpublish this job posting" />
			</form>
			<? }
			   else { ?>
			<form action="?action=PublishJobPosting" method="POST">
				<input type="hidden" name="id" value="<?= $job->id ?>" />
				<input type="submit" value="Publish this job posting" />
			</form>
			<? } ?>
		</div>
		<? } ?>
	</div>
</div>