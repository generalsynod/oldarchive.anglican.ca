<?
/**
 * 
 */
define("ADMIN_EMAIL", "jdymond@national.anglican.ca");
define("FEED_TITLE", "Anglican.ca Job Listing");
define("FEED_DESCRIPTION", "Current job opportunities");
define("ADMIN_NEW_POST_SUBJECT", "New job posted at anglican.ca");
define("PAGE_CHARSET", "ISO-8859-1");

/**
 * Lyris configuration
 */
//define("LYRIS_EMAIL", "acc-jobs@lists.national.anglican.ca");
define("LYRIS_MAIL_SERVER", "lists.national.anglican.ca");
define("LYRIS_EMAIL", "acc-jobs@lists.national.anglican.ca");
define("LYRIS_SUBJECT", "A new job posting is available at www.anglican.ca/jobs");
define("LYRIS_PASSWORD", "qatar1");

/**
 * Captchas.net registration
 */
define("CAPTCHA_ENABLED", false); // Set to true to enable captchas
define("CAPTCHA_USERNAME", "demo");
define("CAPTCHA_PASSWORD", "secret");

/**
 * Types of job positions. New positions may be added by appending a the new type
 * to this list.
 */
$POSITION_TYPES = array(
		"parish/local",
		"diocesan",
		"national office"
);

/**
 * Database configuration settings
 */
define("DBHOST", "127.0.0.1");
define("DBNAME", "accnews_jobs");
define("DBUSER", "accnews_jobsuser");
define("DBPASS", "W7dwDQ2q");
define("DBADMINUSER", "accnews_jobsadmi");
define("DBADMINPASS", "87gh36A");

/**
 * Paths to files relative to the base directory of the application
 * and not necessarily the web site root folder.
 */
define("PATH_TO_VIEWS", "./views");
define("PATH_TO_TEMPLATES", "./templates");
?>
