<?
header("Content-type: application/rss+xml; charset=windows-1252");
echo '<?xml version="1.0" encoding="windows-1252" ?>';
?>
<rss version="2.0" 
    xmlns:dc="http://purl.org/dc/elements/1.1/"
    xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
    xmlns:admin="http://webns.net/mvcb/"
    xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
    xmlns:content="http://purl.org/rss/1.0/modules/content/"
	xmlns:atom="http://www.w3.org/2005/Atom">
	<channel>
		<title><?= htmlspecialchars(FEED_TITLE) ?></title>
		<link>http://<?= $_SERVER['SERVER_NAME'] ?></link>
		<description><?= FEED_DESCRIPTION ?></description>
		<dc:language>en</dc:language>
		<dc:creator><?= ADMIN_EMAIL ?></dc:creator>
		<dc:date><?= str_replace("00~", ":00", date("Y-m-d\TH:i:sO~")) ?></dc:date>
		<admin:generatorAgent rdf:resource="http://www.systemapex.com/"/>
		<admin:errorReportsTo rdf:resource="mailto:info@systemapex.com"/>
		<atom:link href="http://<?= $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'] ?>?action=Rss" rel="self" type="application/rss+xml" />
		<?=  $theView ?>
	</channel>
</rss>
