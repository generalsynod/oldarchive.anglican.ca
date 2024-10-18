<?
//require('./CaptchasDotNet.php');

$monthHas29Days = true;
$monthHas30Days = true;
$monthHas31Days = true;

if (isset($_POST['month'])) {
	$monthHas29Days = ( checkdate($_POST['month'], 29, $_POST['year']));
	$monthHas30Days = ( checkdate($_POST['month'], 30, $_POST['year']));
	$monthHas31Days = ( checkdate($_POST['month'], 31, $_POST['year']));
}

function moIsSelected($theMonth) {
	if ( $theMonth == $_POST['month']) {
		return " selected";
	}
}

function yearIsSelected($theYear) {
	if ( $theYear == $_POST['year']) {
		return " selected";
	}
}

function dayIsSelected($theDay) {
	if ( $theDay == $_POST['day']) {
		return " selected";
	}
}

function positionIsSelected($thePosition) {
	if ( $thePosition == $_POST['type']) {
		return " selected";
	}
}

function classIfInvalid($fieldName) {
	if ( isset($GLOBALS['invalidFields']) && in_array($fieldName, $GLOBALS['invalidFields']) ) {
		return " error";
	}
	else {
		return null;
	}
}
?>
<script type="text/javascript">
function refreshForm() {
	var theForm = document.getElementById('new\-job\-posting');
	if (theForm && theForm.action) {
		theForm.action = '?action=AddJobPosting';
		theForm.submit();
	}
}
</script>
<!-- TITLE BEGINS -->
<h1 id="pageName"><!-- InstanceBeginEditable name="TITLE" -->Add Job Posting <!-- InstanceEndEditable --></h1> 
<!-- TITLE ENDS -->
<div class="content"><!-- InstanceBeginEditable name="BODY" -->
	<form id="new-job-posting" action="?action=PreviewJobPosting" method="POST">
		<? if ( isset($GLOBALS['invalidFields']) ) { ?>
		<div class="errors">
			<strong>Please check the form</strong><br/>
			<p>Fields that are highlighted red were either left empty and are required, or need to be modified as their current values are invalid.</p>
		</div>
		<? } ?>
		<fieldset>
			<label for="nameOfPoster" class="field-label">Poster's name:</label><input type="text" name="nameOfPoster" value="<?= htmlentities($_POST['nameOfPoster'], ENT_COMPAT, "UTF-8") ?>" class="text-field<?= classIfInvalid('nameOfPoster') ?>" /><br/>
			<label for="emailOfPoster"class="field-label">Poster's e-mail address:</label><input type="text" name="emailOfPoster" value="<?= $_POST['emailOfPoster'] ?>" class="text-field<?= classIfInvalid('emailOfPoster') ?>" /></fieldset>
<fieldset>
			<label for="jobTitle"class="field-label">Job Position title</label><input type="text" name="jobTitle" value="<?= htmlentities($_POST['jobTitle'], ENT_COMPAT, "UTF-8") ?>" class="text-field<?= classIfInvalid('jobTitle') ?>" />
		</fieldset>
		<fieldset>
			<label class="field-label<?= classIfInvalid('expiryDate') ?>">Posting expiry date</label>
			<label for="month">Month</label>
			<select name="month" onchange="refreshForm()">
				<option value="1"<?= moIsSelected(1)?>>January</option>
				<option value="2"<?= moIsSelected(2)?>>February</option>
				<option value="3"<?= moIsSelected(3)?>>March</option>
				<option value="4"<?= moIsSelected(4)?>>April</option>
				<option value="5"<?= moIsSelected(5)?>>May</option>
				<option value="6"<?= moIsSelected(6)?>>June</option>
				<option value="7"<?= moIsSelected(7)?>>July</option>
				<option value="8"<?= moIsSelected(8)?>>August</option>
				<option value="9"<?= moIsSelected(9)?>>September</option>
				<option value="10"<?= moIsSelected(10)?>>October</option>
				<option value="11"<?= moIsSelected(11)?>>November</option>
				<option value="12"<?= moIsSelected(12)?>>December</option>
			</select>
			<label for="day">Day</label>
			<select name="day">
				<? for ($i=1; $i<29; $i++) { ?>
				<option<?= dayIsSelected($i) ?>><?= $i ?></option>
				<? } ?>
				<? if ( $monthHas29Days ) { ?>
				<option<?= dayIsSelected($i)?>>29</option>
				<? } ?>
				<? if ( $monthHas30Days ) { ?>
				<option<?= dayIsSelected($i)?>>30</option>
				<? } ?>
				<? if ( $monthHas31Days ) { ?>
				<option<?= dayIsSelected($i)?>>31</option>
				<? } ?>
			</select>
			<label for="year">Year</label>
			<select name="year" onchange="refreshForm()">
				<? for ($year = date("Y", time()); $year < (date("Y", time()) + 3); $year++) { ?>
				<option<?= yearIsSelected($year) ?>><?= $year ?></option>
				<? } ?>
			</select>
		</fieldset>
		<fieldset>
			<label for="type" class="field-label">Position type</label>
			<select name="type">
				<?
				foreach (JobListingCollection::getPositionTypes() as $positionType) {
				?>
				<option<?= positionIsSelected($positionType)?>><?= $positionType ?></option>
				<?
				}
				?>
			</select>
		</fieldset>
		<fieldset>
			<label for="jobPosting" class="section-label">Job posting</label><textarea name="jobPosting" rows="20" cols="40" class="<?= classIfInvalid('jobPosting') ?>"><?= htmlentities($_POST['jobPosting'], ENT_COMPAT, "UTF-8") ?></textarea>
		</fieldset>
		<fieldset>
			<label for="contactInformation" class="section-label">Contact information</label><textarea name="contactInformation" rows="5" cols="40" class="<?= classIfInvalid('contactInformation') ?>"><?= htmlentities($_POST['contactInformation'], ENT_COMPAT, "UTF-8") ?></textarea><br/>
		</fieldset>
		<input type="submit" value="Submit" class="submit-button" />
	</form>
</div>
<a href="<?= $_SERVER['PHP_SELF'] ?>">Back to job listing</a>