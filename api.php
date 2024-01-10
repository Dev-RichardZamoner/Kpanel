<?php
$app->post('/kicksrc', function ($request, $response, $args) {

$data = json_decode(file_get_contents('php://input'), true);

$song = $data['song']; // Now Playing Song Arist - Title
$listeners = $data['listeners']; // Live Listners now listening to the radio.
$djstatus = $data['djstatus']; // true/false (string)
$djusername = $data['djusername']; // Online DJ username/false (string)
$art = $data['art']; // Now playing song cover art image, HD resolution.

// echo "Now Playing: $song <br><br> There are $listeners listeners <br> The album cover image url: $art";

print_r ($data); // Shows complete JSON encoded data.
});
