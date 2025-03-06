<?php
// URL of the CBN circulars page
$url = "https://www.cbn.gov.ng/Documents/circulars.html";

// Function to fetch website content using cURL
function fetchWebsiteContent($url) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $html = curl_exec($ch);
    curl_close($ch);
    return $html;
}

// Fetch the webpage content
$html = fetchWebsiteContent($url);

// Load HTML into DOMDocument
$dom = new DOMDocument();
libxml_use_internal_errors(true); // Suppress HTML parsing warnings
$dom->loadHTML($html);
libxml_clear_errors();

// Create DOMXPath
$xpath = new DOMXPath($dom);

// Extract all <div> elements
$nodes = $xpath->query("//div");

// Store extracted data
$data = [];

foreach ($nodes as $node) {
    $text = trim($node->nodeValue);

    if (!empty($text)) { // Remove incorrect `$link` check
        $data[] = [
            "text" => $text
        ];
    }
}

// Convert to JSON and save to file
$json = json_encode($data, JSON_PRETTY_PRINT);
file_put_contents('cbn_circulars.json', $json); // Corrected filename

// Output success message
echo "✅ Divs extracted and saved to cbn_circulars.json";
?>
