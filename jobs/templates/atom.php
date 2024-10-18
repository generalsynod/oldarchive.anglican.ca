<?
header("Content-type: application/atom+xml; charset=windows-1252");
echo '<?xml version="1.0" encoding="windows-1252" ?>';
?>
<feed xmlns="https://www.w3.org/2005/Atom">
	<title><?= htmlspecialchars(FEED_TITLE) ?></title>
	<subtitle><?= FEED_DESCRIPTION ?></subtitle>
	<link href="https://<?= $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'] ?>?action=Atom" rel="self" type="application/rss+xml"/>
	<updated><?= str_replace("00~", ":00", date("Y-m-d\TH:i:sO~")) ?></updated>
 	<author>
   		<name><?= $_SERVER['SERVER_NAME'] ?></name>
   		<email><?= ADMIN_EMAIL ?></email>
 	</author>
 	<id>https://<?= $_SERVER['SERVER_NAME'] ?>/</id>
	<?= $theView ?>
</feed>
