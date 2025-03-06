<?php

// Google Gemini API key (Replace with your actual API key)
$apiKey = "AIzaSyD41s6w7PTJO0Au0Hg3H8ICNQ716zjW9mc";  // Replace this with your actual key

// Gemini API endpoint (Updated to Gemini 1.5 or the correct model)
$url = "https://generativelanguage.googleapis.com/v1/models/gemini-1.5-pro:generateContent?key=$apiKey";

// User's question
$question = "Who is Donald Trump?";

// Request payload (Using correct "contents" structure)
$data = [
    "contents" => [
        [
            "parts" => [
                ["text" => $question]
            ]
        ]
    ]
];

// Convert data to JSON
$jsonData = json_encode($data);

// Initialize cURL session
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);

// Execute API request
$response = curl_exec($ch);
curl_close($ch);

// Decode JSON response
$result = json_decode($response, true);

// Extract and print the answer
if (isset($result['candidates'][0]['content']['parts'][0]['text'])) {
    echo "✅ Answer: " . $result['candidates'][0]['content']['parts'][0]['text'];
} else {
    echo "❌ Failed to get a response from Gemini. Response: " . json_encode($result);
}

?>
