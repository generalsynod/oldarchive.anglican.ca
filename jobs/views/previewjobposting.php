<?
//require_once('CaptchasDotNet.php');

$job = &$GLOBALS['job'];
?>
<!-- TITLE BEGINS -->
<h1 id="pageName"><!-- InstanceBeginEditable name="TITLE" -->Job Posting Preview<!-- InstanceEndEditable --></h1> 
<!-- TITLE ENDS -->
<div class="content"><!-- InstanceBeginEditable name="BODY" -->
	<div class="job-posting">
		<span class="type"><strong><?= $job->type ?></strong></span>
		<span class="title"><?= convert_special_chars($job->jobTitle) ?></span>
		<span class="date"><?= date("M d Y", $job->expiryDate) ?></span>
		<span class="poster-name"><?= convert_special_chars($job->nameOfPoster) ?></span>
		<span class="poster-email"><?= $job->emailOfPoster ?></span>
		<div class="details"><?= convert_special_chars($job->jobPosting) ?></div>
		<span class="contact-information"><?= convert_special_chars($job->contactInformation) ?></span>
	</div>
	<?
	if ( isset($GLOBALS['errorWithCaptcha']) && $GLOBALS['errorWithCaptcha'] ) {
	?>
	<div class="errors">
		<strong>Please re-type the characters shown in the captcha image</strong><br/>
		<p>Either you did not type the characters into the password box or the characters you entered do not match those in the image. Please try again.</p>
	</div>
	<?
	}
	?>
	<div style="text-align: center; overflow: hidden">
		<form action="?action=AddJobPosting" method="POST" style="float: left">
			<input type="hidden" name="type" value="<?= $_POST['type'] ?>">
			<input type="hidden" name="nameOfPoster" value="<?= htmlentities($_POST['nameOfPoster'], ENT_COMPAT, PAGE_CHARSET) ?>" />
			<input type="hidden" name="emailOfPoster" value="<?= $_POST['emailOfPoster'] ?>" />
			<input type="hidden" name="jobTitle" value="<?= htmlentities($_POST['jobTitle'], ENT_COMPAT, PAGE_CHARSET) ?>" />
			<input type="hidden" name="month" value="<?= $_POST['month'] ?>" />
			<input type="hidden" name="day" value="<?= $_POST['day'] ?>" />
			<input type="hidden" name="year" value="<?= $_POST['year'] ?>" />
			<input type="hidden" name="jobPosting" value="<?= htmlentities($_POST['jobPosting'], ENT_COMPAT, PAGE_CHARSET) ?>" />
			<input type="hidden" name="contactInformation" value="<?= htmlentities($_POST['contactInformation'], ENT_COMPAT, PAGE_CHARSET) ?>" />
			<input type="submit" value="Do not publish this job posting and go back to the form"/>
		</form>
		<form action="?action=SubmitJobPosting" method="POST" style="float: right">
			<input type="hidden" name="type" value="<?= $_POST['type'] ?>">
			<input type="hidden" name="nameOfPoster" value="<?= htmlentities($_POST['nameOfPoster'], ENT_COMPAT, PAGE_CHARSET) ?>" />
			<input type="hidden" name="emailOfPoster" value="<?= $_POST['emailOfPoster'] ?>" />
			<input type="hidden" name="jobTitle" value="<?= htmlentities($_POST['jobTitle'], ENT_COMPAT, PAGE_CHARSET) ?>" />
			<input type="hidden" name="month" value="<?= $_POST['month'] ?>" />
			<input type="hidden" name="day" value="<?= $_POST['day'] ?>" />
			<input type="hidden" name="year" value="<?= $_POST['year'] ?>" />
			<input type="hidden" name="jobPosting" value="<?= htmlentities($_POST['jobPosting'], ENT_COMPAT, PAGE_CHARSET) ?>" />
			<input type="hidden" name="contactInformation" value="<?= htmlentities($_POST['contactInformation'], ENT_COMPAT, PAGE_CHARSET) ?>" />
			<input type="submit" value="Publish this job posting, the preview looks fine" /><br/>
			<?
			if (CAPTCHA_ENABLED) {
				$captchas = new CaptchasDotNet(CAPTCHA_USERNAME, CAPTCHA_PASSWORD);
			?>
			<label for="password" class="field-label">Please enter the characters shown in the image</label>
			<input type="hidden" name="random" value="<?= $captchas->random () ?>" />
			<input name="password" size="6" /><br /><br />
			<?= $captchas->image () ?>
          	<br /><a href="<?= $captchas->audio_url () ?>">Phonetic spelling (mp3)</a><br />
			<? } ?>
		</form>
	</div>
</div>
