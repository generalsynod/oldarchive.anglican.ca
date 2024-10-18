<?
require_once('controller.php');
require_once('jobposting.php');
require_once('joblistingcollection.php');
require_once('CaptchasDotNet.php');

define("ACTION_DEFAULT", null);
define("ACTION_JOBLISTINGBYTYPE", "JobListingByType");
define("ACTION_JOBPOSTING", "JobPosting");
define("ACTION_ADDJOBPOSTING", "AddJobPosting");
define("ACTION_PREVIEWJOBPOSTING", "PreviewJobPosting");
define("ACTION_SUBMITJOBPOSTING", "SubmitJobPosting");
define("ACTION_REVIEWJOBPOSTING", "ReviewJobPosting");
define("ACTION_PUBLISHJOBPOSTING", "PublishJobPosting");
define("ACTION_UNPUBLISHJOBPOSTING", "UnpublishJobPosting");
define("ACTION_RSS", "Rss");
define("ACTION_ATOM", "Atom");
define("ACTION_ERROR", "ERROR");

class DefaultController extends Controller {
	function customTemplate($action) {
		if ( $action == ACTION_RSS ) {
			return "rss";
		}
		elseif ( $action == ACTION_ATOM ) {
			return "atom";
		}
		else {
			return "default";
		}
	}
	
	function viewForAction($action) {
		switch($action) {
			case ACTION_ADDJOBPOSTING:
				return ACTION_ADDJOBPOSTING;
			case ACTION_JOBLISTINGBYTYPE:
				return "default";
			case ACTION_JOBPOSTING:
				return ACTION_JOBPOSTING;
			case ACTION_SUBMITJOBPOSTING:
				return ACTION_SUBMITJOBPOSTING;
			case ACTION_PREVIEWJOBPOSTING:
				return ACTION_PREVIEWJOBPOSTING;
			case ACTION_RSS:
				return ACTION_RSS;
			case ACTION_ATOM:
				return ACTION_ATOM;
			default:
				return "error";
		}
	}
	
	function DefaultController($action) {
		$_POST = stripslashes_array($_POST);
		
		switch($action) {
			case ACTION_JOBPOSTING:
				$this->jobPostingActionHandler($action);
				break;
			case ACTION_JOBLISTINGBYTYPE:
				$this->jobListingByTypeActionHandler();
				break;
			case ACTION_DEFAULT:
				$this->defaultActionHandler();
				break;
			case ACTION_SUBMITJOBPOSTING:
				$this->submitJobPostingActionHandler($action);
				break;
			case ACTION_PREVIEWJOBPOSTING:
				$this->previewJobPostingActionHandler($action);
				break;
			case ACTION_RSS:
				$this->defaultActionHandler();
				break;
			case ACTION_ATOM:
				$this->defaultActionHandler();
				break;
			default:
				break;
		}
		Controller::Controller($action);
	}
	
	function defaultActionHandler() {		
		$GLOBALS['jobs'] = new JobListingCollection();
	}
	
	function jobListingByTypeActionHandler() {
		$GLOBALS['jobs'] = new JobListingCollection("type");
	}
	
	function jobPostingActionHandler(&$action) {
		if ( !isset($_GET['id']) ) {
			die("The 'id' querystring parameter is required for the action ". ACTION_JOBPOSTING . ".");
		}
		if ( ctype_digit($_GET['id']) ) {
			$GLOBALS['job'] = JobListingCollection::getJobPostingById($_GET['id']);
			if ( !$GLOBALS['job'] ) {
				$action = ACTION_ERROR;
			}
		}
		else {
			die("The 'id' querystring parameter failed input validation.");
		}
	}	

	function previewJobPostingActionHandler(&$action) {
		$GLOBALS['job'] = new JobPosting	($_POST['type'],
											$_POST['nameOfPoster'],
											$_POST['emailOfPoster'],
											$_POST['jobTitle'],
											mktime(0, 0, 0, $_POST['month'], $_POST['day'], $_POST['year']),
											$_POST['jobPosting'],
											$_POST['contactInformation']);

		if ( !$GLOBALS['job']->isValid($refToInvalidFields) ) {
			$GLOBALS['invalidFields'] = &$refToInvalidFields;
			$action = ACTION_ADDJOBPOSTING;
		}
	}
	
	function submitJobPostingActionHandler(&$action) {
		$this->previewJobPostingActionHandler($action);
		
		$captchas = new CaptchasDotNet (CAPTCHA_USERNAME, CAPTCHA_PASSWORD);
		
		// otherwise.
		if ( CAPTCHA_ENABLED && !$captchas->validate ($_REQUEST['random']) )
		{
			$GLOBALS['errorWithCaptcha'] = true;
			$action = ACTION_PREVIEWJOBPOSTING;
		}
		// Check, that the right CAPTCHA password has been entered and
		// return an error message otherwise.
		elseif ( CAPTCHA_ENABLED && !$captchas->verify ($_REQUEST['password']) )
		{
			$GLOBALS['errorWithCaptcha'] = true;
			$action = ACTION_PREVIEWJOBPOSTING;
		}
		// Return a success message
		else
		{
			//echo 'Your message was verified to be entered by a human and is "' . $message . '"';
			if ( $GLOBALS['job']->save() ) {
				$nameOfTemplateFile = PATH_TO_TEMPLATES . "/newpostemail.php";
				
				if (file_exists($nameOfTemplateFile)) {			
					ob_start();
					eval("?>" . file_get_contents($nameOfTemplateFile));
					$emailBody = ob_get_clean();
					mail(ADMIN_EMAIL, ADMIN_NEW_POST_SUBJECT, $emailBody);
				}		
			}
			else {
				$action = ACTION_ADDJOBPOSTING;
			}
		}	
	}
}
?>