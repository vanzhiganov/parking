<?php
include("application/config.php");
include("application/functions.php");

$language = (isset($_GET['lang'])) ? $_GET['lang'] : "en";
switch ($language) {
    case 'en':
    case 'ru':
        break;
    default:
        $language = "en";
        break;
}

$keyword = ($_GET['name']);
$keyword = stripslashes($keyword);

$feed = "http://news.google.com/news?q={$keyword}&hl={$language}&ie=UTF-8&output=rss";
if (empty($keyword)) {
    $feed = "http://news.google.com/nwshp?ie=UTF-8&oe=UTF-8&hl={$language}&tab=wn&q=&output=rss";
}

$keyword2 = ucfirst($keyword);
$feed = str_replace (" ", "+", $feed);

if (empty($keyword2)) {
    $keyword2 = "World";
}

$keyword2 = stripslashes($keyword2);

if (empty($title)) {
    $title = "Hot news @" . $_SERVER['HTTP_HOST'];
} else {
    $title = "World @ Hot news";
}

include("counter.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo ucfirst($title); ?> - <?php echo "The Latest $keyword2 News and Information" ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/foundation/5.3.3/css/foundation.min.css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/foundation/5.3.3/css/normalize.min.css" />
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/foundation/5.3.3/js/foundation.min.js"></script>
    <link rel="stylesheet" href="style/parking.css" />
</head>
<body>
    <div class="row">
        <div class="large-12 columns">
            <div id="headbanner">
                <a href="https://www.digitalocean.com/?refcode=8ffe6bd05070"><img src="images/ads/ad_728x90_000001.jpeg" border=0 width=728 height=90 /></a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="large-6 columns">
                <h1><a href="index.php"><?php echo $title; ?></a></h1>
        </div>
        <div class="large-6 columns">
            <form name="NameForm" method="get" action="redirect.php">
                <div class="row collapse">
                    <div class="small-10 columns">
                        <input type="text" value="<?php print($name);?>" name="name" size="20"  placeholder="Keyword" />
                    </div>
                    <div class="small-2 columns">
                        <input type="submit" value="Search" class="button postfix" />
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="large-3 columns ">
            <div class="panel">
                <?php /* a href="#"><img src="http://placehold.it/300x240&text=[img]"/></a */ ?>
                <h5>Popular Searches</h5>
                <div class="section-container vertical-nav" data-section data-options="deep_linking: false; one_up: true">
                    <section class="section">
                        <h5 class="title"><a href="world.html">World</a></h5>
                    </section>
                    <section class="section">
                        <h5 class="title"><a href="loan.html">Loan</a></h5>
                    </section>
                    <section class="section">
                        <h5 class="title"><a href="debt.html">Debt</a></h5>
                    </section>
                    <section class="section">
                        <h5 class="title"><a href="health.html">Health</a></h5>
                    </section>
                    <section class="section">
                        <h5 class="title"><a href="diet.html">Diet</a></h5>
                    </section>
                    <section class="section">
                        <h5 class="title"><a href="medicine.html">Medicine</a></h5>
                    </section>
                    <section class="section">
                        <h5 class="title"><a href="jobs.html">Jobs</a></h5>
                    </section>
                    <section class="section">
                        <h5 class="title"><a href="sleep.html">Sleep</a></h5>
                    </section>
                    <section class="section">
                        <h5 class="title"><a href="hospital.html">Hospital</a></h5>
                    </section>
                    <section class="section">
                        <h5 class="title"><a href="shopping.html">Shopping</a></h5>
                    </section>
                    <section class="section">
                        <h5 class="title"><a href="vitamins.html">Vitamins</a></h5>
                    </section>
                    <section class="section">
                        <h5 class="title"><a href="fitness.html">Fitness</a></h5>
                    </section>
                </div>
            </div>
        </div>

        <div class="large-6 columns">
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

            // output html

            if (isset($rss_channel["ITEMS"])) {
                if (count($rss_channel["ITEMS"]) > 0) {
                    for($i = 0;$i < count($rss_channel["ITEMS"]);$i++) {
                        echo '<div class="row">';
                        if (isset($rss_channel["ITEMS"][$i]["LINK"])) {
                            print ("\n<!-- 1 -->\n<div class=\"itemtitle\"><h1><a href=\"" . $rss_channel["ITEMS"][$i]["LINK"] . "\">" . $rss_channel["ITEMS"][$i]["TITLE"] . "</a></h1></div>");
                        } else {
                            print ("\n<!-- 2 -->\n<div class=\"itemtitle\">" . $rss_channel["ITEMS"][$i]["TITLE"] . "</div>");
                        }
                        print ("\n<!-- 3 -->\n<div class=\"itemdescription\">" . $rss_channel["ITEMS"][$i]["DESCRIPTION"] . "</div><br />");

                        print "<hr/>";
                        echo '</div>';
                    }
                } else {
                    print ("<b>There are no articles in this feed.</b>");
                }
            }
?>

            <?php /* div class="row">
                <div class="large-2 columns small-3"><img src="http://placehold.it/80x80&text=[img]"/></div>
                <div class="large-10 columns">
                    <p><strong>Some Person said:</strong> Bacon ipsum dolor sit amet nulla ham qui sint exercitation eiusmod commodo, chuck duis velit. Aute in reprehenderit, dolore aliqua non est magna in labore pig pork biltong.</p>
                    <ul class="inline-list">
                        <li><a href="">Reply</a></li>
                        <li><a href="">Share</a></li>
                    </ul>
                    <h6>2 Comments</h6>
                    <div class="row">
                        <div class="large-2 columns small-3"><img src="http://placehold.it/50x50&text=[img]"/></div>
                        <div class="large-10 columns"><p>Bacon ipsum dolor sit amet nulla ham qui sint exercitation eiusmod commodo, chuck duis velit. Aute in reprehenderit</p></div>
                    </div>
                    <div class="row">
                        <div class="large-2 columns small-3"><img src="http://placehold.it/50x50&text=[img]"/></div>
                        <div class="large-10 columns"><p>Bacon ipsum dolor sit amet nulla ham qui sint exercitation eiusmod commodo, chuck duis velit. Aute in reprehenderit</p></div>
                    </div>
                </div>
            </div>

            <hr/>

            <div class="row">
                <div class="large-2 columns small-3"><img src="http://placehold.it/80x80&text=[img]"/></div>
                <div class="large-10 columns">
                    <p><strong>Some Person said:</strong> Bacon ipsum dolor sit amet nulla ham qui sint exercitation eiusmod commodo, chuck duis velit. Aute in reprehenderit, dolore aliqua non est magna in labore pig pork biltong.</p>
                    <ul class="inline-list">
                        <li><a href="">Reply</a></li>
                        <li><a href="">Share</a></li>
                    </ul>
                </div>
            </div>

            <hr/>

            <div class="row">
                <div class="large-2 columns small-3"><img src="http://placehold.it/80x80&text=[img]"/></div>
                <div class="large-10 columns">
                    <p><strong>Some Person said:</strong> Bacon ipsum dolor sit amet nulla ham qui sint exercitation eiusmod commodo, chuck duis velit. Aute in reprehenderit, dolore aliqua non est magna in labore pig pork biltong.</p>
                    <ul class="inline-list">
                        <li><a href="">Reply</a></li>
                        <li><a href="">Share</a></li>
                    </ul>
                    <h6>2 Comments</h6>
                    <div class="row">
                        <div class="large-2 columns small-3"><img src="http://placehold.it/50x50&text=[img]"/></div>
                        <div class="large-10 columns"><p>Bacon ipsum dolor sit amet nulla ham qui sint exercitation eiusmod commodo, chuck duis velit. Aute in reprehenderit</p></div>
                    </div>
                </div>
            </div */ ?>
        </div>

        <aside class="large-3 columns hide-for-small">
            <p><img src="http://placehold.it/300x440&text=[ad]"/></p>
            <p><img src="http://placehold.it/300x440&text=[ad]"/></p>
        </aside>
    </div>


    <footer class="row">
        <div class="large-12 columns">
            <hr/>
            <div class="row">
                <!-- div class="large-4 columns">
                    Domain name parking service
                </div -->
                <div class="large-12 columns" id="developed">
                    Developed by <a href="https://github.com/vanzhiganov" target='_blank'><img src='https://avatars1.githubusercontent.com/u/195940?s=32' id='developedbyicon' /> vanzhiganov</a>
                </div>
                <!-- div class="large-4 columns">
                    <ul class="inline-list right">
                        <li><a href="#">Statistics</a></li>
                        <li><a href="#">For domain owners</a></li>
                    </ul>
                </div -->
            </div>
        </div>
    </footer>
</body>
</html>
