<?php
$hostname = $_SERVER['HTTP_HOST'];

echo '<?xml version="1.0" encoding="UTF-8"?>';

// <sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
// <sitemap>
// <loc>
// http://www.gstatic.com/culturalinstitute/sitemaps/www_google_com_culturalinstitute/sitemap-001.xml
// </loc>
// </sitemap>

echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
echo "<url><loc>http://{$hostname}/world.html</loc></url>";
echo "<url><loc>http://{$hostname}/loan.html</loc></url>";
echo "<url><loc>http://{$hostname}/debt.html</loc></url>";
echo "<url><loc>http://{$hostname}/health.html</loc></url>";
echo "<url><loc>http://{$hostname}/diet.html</loc></url>";
echo "<url><loc>http://{$hostname}/medicine.html</loc></url>";
echo "<url><loc>http://{$hostname}/jobs.html</loc></url>";
echo "<url><loc>http://{$hostname}/sleep.html</loc></url>";
echo "<url><loc>http://{$hostname}/hospital.html</loc></url>";
echo "<url><loc>http://{$hostname}/shopping.html</loc></url>";
echo "<url><loc>http://{$hostname}/vitamins.html</loc></url>";
echo "<url><loc>http://{$hostname}/fitness.html</loc></url>";
echo '</urlset>';