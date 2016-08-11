<?php
include("../application/config.php");
include("../application/functions.php");

$keyword = ($_GET['name']);
$keyword = stripslashes($keyword);

if (empty($title)) {
	$title = $_SERVER['HTTP_HOST'];
}

$feed = "http://news.google.com/news?q=$keyword&ie=UTF-8&output=rss";
if (empty($keyword)) {
	$feed = "http://news.google.com/nwshp?ie=UTF-8&oe=UTF-8&hl=en&tab=wn&q=&output=rss";
}

$keyword2 = ucfirst($keyword);
$feed = str_replace (" ", "+", $feed);

if (empty($keyword2)) {
    $keyword2 = "World";
}

$keyword2 = stripslashes($keyword2);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo ucfirst($title); ?> - <?php echo "The Latest $keyword2 News and Information" ?></title>
    <link rel="stylesheet" href="/style/style.css" />
</head>
<body>
<div id="container">
	<div id="content">

<script type="text/javascript"><!--
google_ad_client = "<?php echo $adsense_publisher_id; ?>";
google_ad_width = 728;
google_ad_height = 15;
google_ad_format = "728x15_0ads_al";
//2007-08-22: QuickMinisite
google_ad_channel = "2820869829";
google_color_border = "FFFFFF";
google_color_bg = "FFFFFF";
google_color_link = "<?php echo $link_color; ?>";
google_color_text = "000000";
google_color_url = "008000";
//-->
</script>
<script type="text/javascript"
  src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>








<div id="title">
			<h1><div id="ttext"><a href="index.php"><?php echo $title; ?></a></div></h1>
			<form name="NameForm" method="get" action="redirect.php">
			<fieldset>
			<div id="search">
				
				<div class="box"><input type="text" value="<?php print($name);?>" name="name" size="20" /></div>
<input type="submit" class="go" value="Search" />
 			</div>
			</fieldset>
			</form>
		</div>
		
		
		<script type="text/javascript"><!--
google_ad_client = "<?php echo $adsense_publisher_id; ?>";
google_ad_width = 728;
google_ad_height = 90;
google_ad_format = "728x90_as";
google_ad_type = "text_image";
//2007-08-22: QuickMinisite
google_ad_channel = "2820869829";
google_color_border = "FFFFFF";
google_color_bg = "FFFFFF";
google_color_link = "<?php echo $link_color; ?>";
google_color_text = "<?php echo $text_color; ?>";
google_color_url = "<?php echo $text_color; ?>";
//-->
</script>
<script type="text/javascript"
  src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
		<div id="main">
			<div id="left">




<?php

set_time_limit(0);

$file = "$feed";

$rss_channel = array();
$currently_writing = "";
$main = "";
$item_counter = 0;

$xml_parser = xml_parser_create();
xml_set_element_handler($xml_parser, "startElement", "endElement");
xml_set_character_data_handler($xml_parser, "characterData");
if (!($fp = fopen($file, "r"))) {
	die("could not open XML input");
}

while ($data = fread($fp, 4096)) {
	if (!xml_parse($xml_parser, $data, feof($fp))) {
		die(sprintf("XML error: %s at line %d",
					xml_error_string(xml_get_error_code($xml_parser)),
					xml_get_current_line_number($xml_parser)));
	}
}
xml_parser_free($xml_parser);

// output HTML


if (isset($rss_channel["ITEMS"])) {
	if (count($rss_channel["ITEMS"]) > 0) {
		for($i = 0;$i < count($rss_channel["ITEMS"]);$i++) {
			if (isset($rss_channel["ITEMS"][$i]["LINK"])) {
			print ("\n<div class=\"itemtitle\"><h1><a href=\"" . $rss_channel["ITEMS"][$i]["LINK"] . "\">" . $rss_channel["ITEMS"][$i]["TITLE"] . "</a></h1></div>");
			} else {
			print ("\n<div class=\"itemtitle\">" . $rss_channel["ITEMS"][$i]["TITLE"] . "</div>");
			}
			 print ("<div class=\"itemdescription\">" . $rss_channel["ITEMS"][$i]["DESCRIPTION"] . "</div><br />"); 		}
	} else {
		print ("<b>There are no articles in this feed.</b>");
	}
}
?>


			</div>
			<div id="right">
				<h1>Popular Searches</h1>
				<div id="list">
<?php include("searches.php"); ?>
				</div>
				
				
				<h1>Related Links</h1>
				<div id="list2">
<script type="text/javascript"><!--
google_ad_client = "<?php echo $adsense_publisher_id; ?>";
google_ad_width = 160;
google_ad_height = 600;
google_ad_format = "160x600_as";
google_ad_type = "text_image";
//2007-08-22: QuickMinisite
google_ad_channel = "2820869829";
google_color_border = "FFFFFF";
google_color_bg = "FFFFFF";
google_color_link = "<?php echo $link_color; ?>";
google_color_text = "<?php echo $text_color; ?>";
google_color_url = "<?php echo $text_color; ?>";
//-->
</script>
<script type="text/javascript"
  src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
				</div>


			</div>
			<p class="clear" />
		</div>

	</div>
	<p class="clear" />
		<div id="footer">
			<div class="bar">
				Copyright &copy; <?php echo date("Y"); ?> <?php echo ucfirst($title); ?>
			</div>
		</div>
</div>
</body>
</html>
