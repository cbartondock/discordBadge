<?php
// Discord badge workaround
if (isset($_GET['id']) && $_GET['id'] == 'XXXXXXXXXXXXXXXXXX')
{
    // Fetch data
    $members_json = json_decode(file_get_contents('https://discord.com/api/guilds/'.$_GET['id'].'/widget.json'), true);
    
    // Check count
    if ($members_json) {
        $members = $members_json['presence_count'];
    } else {
        $members = 0;
    }

    // The URL of the image
    $imageUrl = 'https://img.shields.io/badge/Discord-'.$members.'%20online-5865F2.svg?logo=discord&style=flat&logoColor=white';
    
    // Initialize a cURL session
    $ch = curl_init($imageUrl);
    
    // Set cURL options
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the transfer as a string
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Follow redirects
    
    // Execute the cURL session
    $imageData = curl_exec($ch);
    
    // Get the content type of the image
    $contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
    
    // Close the cURL session
    curl_close($ch);
    
    // Set the appropriate content type header
    header('Content-Type: '.$contentType);
    
    // Output the image data
    echo $imageData;
}
else
{
    // Throw error on invalid ID
    die('Not allowed.');
}