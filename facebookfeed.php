<?
/*
Plugin Name: Instant Articles FB Feed Generator
Description: Custom XML Generator for custom CMSs, ready to use as soon as you fill in your db credentials and db articles tables, especially customized for greek language which produces ASCII characters making XML useless and full of errors
Version: 0.0.1
Author: Yiannis M. Phatskool
License: GPLv2 or later
*/

$link = mysql_connect('localhost', 'DB_USER_GOES_HERE', 'DB_PASS_GOES_HERE');//Fill in these two values
mysql_set_charset('utf8',$link);
if (!$link) {
    die('Not connected : ' . mysql_error());
}

$db_selected = mysql_select_db('DB_NAME_GOES_HERE', $link);//Fill in this value
if (!$db_selected) {
    die ('Can\'t use db : ' . mysql_error());
} 

$data = mysql_query("SELECT * FROM `article_table_goes_here` WHERE `active_column_if_exists_goes_here`='1' AND `noindex_if_exists_goes_here`='0' ORDER BY `id` DESC LIMIT 0,50") //DB Query Select  Article DB Table,  If there is a column where active articles are set you can put it on WHERE, if there is a noindex column put it on AND, Order is by id but you can change it too if you want, limit is 50 articles, offset is 0
		or die(mysql_error());
ob_start();

$output = '<rss version="2.0" xmlns:content="http://purl.org/rss/2.0/modules/content/" encoding="UTF-8">' . "\n";
$channelstart = '<channel>';
$pageinfo = '<title>TITLE OF WEBSITE</title><link>https://yourlink.com</link><description>WEBSITES DESCRIPTION</description>';
$channelend= '</channel>';
$buildtime = new DateTime('now');

echo $output;
echo $channelstart;
echo $pageinfo;

while($info = mysql_fetch_array( $data )) {
	
$datetime = new DateTime($info['date']);//instead of date, use your table's date column
$lastmod = $datetime->format('Y-m-d\TH:i:sP');
$content = $info['text'];//instead of text, use your table's article main content column
$description = $info['description'];//instead of description, use your table's short description/excerpt column
$content = str_replace(
  array('«', '»','\'','"','&quot;','&nbsp;','“','”','&','amp;'),
  array('', '','','','','','','','','και'),
  $content);//if you use another language, you can replace 'και' with your language's 'and' meaning
  $description = str_replace(
  array('«', '»','\'','"','&quot;','&nbsp;','“','”','&','amp;'),
  array('', '','','','','','','','','και'),
  $description);//if you use another language, you can replace 'και' with your language's 'and' meaning
$content= str_replace('/&(?!#?[a-z0-9]+;)/', '&amp;', $content);
$description= str_replace('/&(?!#?[a-z0-9]+;)/', '&amp;', $description);
$title = $info['title'];//instead of title, use your table's title column
?>

<item>
	<title><? echo $title;?></title>
	<link>https://yourlink.com/<? echo $info['id']; ?>/<? echo $info['slug']; ?></link><!--Instead of id and slug use your table's id and slug column-->
	<content:encoded><![CDATA[<? echo html_entity_decode(strip_tags($content))?>]]></content:encoded>
	<description><![CDATA[<? echo html_entity_decode(strip_tags($description));?>]]></description>
	<pubDate><?echo $datetime->format('c')?></pubDate>
</item>

<?
} 
?>
<? echo $channelend;
$buildtime = new DateTime('now');
echo "<lastBuildDate> ".$buildtime->format('c').'</lastBuildDate>';
?>
</rss>

<?

$htmlStr = ob_get_contents();

ob_end_clean(); 

file_put_contents('facebook.xml', $htmlStr); //generated file will be facebook.xml located in the same folder
?>