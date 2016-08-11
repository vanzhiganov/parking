<?php
$name = $_GET['name'];
if (empty($name)) {
		header( 'Location: index.php' ) ;
} else {
		$name = urlencode($name);

		header('Location: /'.urlencode($name).'.html');
		exit();
}
