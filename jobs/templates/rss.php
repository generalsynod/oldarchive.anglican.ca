<?
header("Content-type: application/rss+xml; charset=windows-1252");
echo '<?xml version="1.0" encoding="windows-1252" ?>';
?>
<rss version="2.0" 
    xmlns:dc="https://purl.org/dc/elements/1.1/"
    xmlns:sy="https://purl.org/rss/1.0/modules/syndication/"
    xmlns:admin="https://webns.net/mvcb/"
    xmlns:rdf="https://www.w3.org/1999/02/22-rdf-syntax-ns#"
    xmlns:content="https://purl.org/rss/1.0/modules/content/"
	xmlns:atom="https://www.w3.org/2005/Atom">
	<channel>
		<title><?= htmlspecialchars(FEED_TITLE) ?></title>
		<link>https://<?= $_SERVER['SERVER_NAME'] ?></link>
		<description><?= FEED_DESCRIPTION ?></description>
		<dc:language>en</dc:language>
		<dc:creator><?= ADMIN_EMAIL ?></dc:creator>
		<dc:date><?= str_replace("00~", ":00", date("Y-m-d\TH:i:sO~")) ?></dc:date>
		<admin:generatorAgent rdf:resource="https://www.systemapex.com/"/>
		<admin:errorReportsTo rdf:resource="mailto:info@systemapex.com"/>
		<atom:link href="https://<?= $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'] ?>?action=Rss" rel="self" type="application/rss+xml" />
		<?=  $theView ?>
	</channel>
</rss>
