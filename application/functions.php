<?php
function startElement($parser, $name, $attrs) {
    global $rss_channel, $currently_writing, $main;
    switch($name) {
        case "RSS":
        case "RDF:RDF":
        case "ITEMS":
            $currently_writing = "";
            break;
        case "CHANNEL":
            $main = "CHANNEL";
            break;
        case "IMAGE":
            $main = "IMAGE";
            $rss_channel["IMAGE"] = array();
            break;
        case "ITEM":
            $main = "ITEMS";
            break;
        default:
            $currently_writing = $name;
            break;
    }
}

function endElement($parser, $name) {
    global $rss_channel, $currently_writing, $item_counter;
    $currently_writing = "";
    if ($name == "ITEM") {
        $item_counter++;
    }
}

function characterData($parser, $data) {
    global $rss_channel, $currently_writing, $main, $item_counter;
    if ($currently_writing != "") {
    switch($main) {
        case "CHANNEL":
            if (isset($rss_channel[$currently_writing])) {
                $rss_channel[$currently_writing] .= $data;
            } else {
                $rss_channel[$currently_writing] = $data;
            }
            break;
        case "IMAGE":
            if (isset($rss_channel[$main][$currently_writing])) {
                $rss_channel[$main][$currently_writing] .= $data;
            } else {
                $rss_channel[$main][$currently_writing] = $data;
            }
            break;
        case "ITEMS":
            if (isset($rss_channel[$main][$item_counter][$currently_writing])) {
                $rss_channel[$main][$item_counter][$currently_writing] .= $data;
            } else {
                $rss_channel[$main][$item_counter][$currently_writing] = $data;
            }
            break;
        }
    }
}