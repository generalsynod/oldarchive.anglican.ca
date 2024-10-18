<?
// Do not edit the line of code below
$job = $GLOBALS['job'];

// You may edit the template below to customize the look and feel of the email.
?>
PASSWORD:<?= LYRIS_PASSWORD . "\n" ?>
A new job posting is available at http://www.anglican.ca/jobs :

Position Title: <?= $job->jobTitle . "\n" ?>
Postion type: <?= $job->type . "\n" ?>
View Job on-line at: http://<?= $_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']) ?>/index.php?action=JobPosting&id=<?= $job->id . "\n" ?>
Posted until: <?= date("M d, Y", $job->expiryDate) . "\n" ?>
<? //= $job->jobPosting . "\n" ?>
