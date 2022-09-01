<?php

function notifyByFirebase($title, $body, $image, $tokens, $data = [])
{
    $registrationIDs = $tokens;
    $fcmMsg = array(
        'body' => $body,
        'title' => $title,
        'image' => $image
    );

    $fcmFields = array(
        'registration_ids' => $registrationIDs,
        'priority' => 'high',
        'notification' => $fcmMsg,
        'data' => response()->json($data),
        'content_available' => true,
    );

    $headers = array(
        'Authorization: key = ' . config('app.FIREBASE_API_KEY'),
        'Content-Type: application/json'
    );

    //return $headers;
// Firebase API Key


    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmFields));
    $result = curl_exec($ch);

    //die('Curl failed: ' . curl_error($ch));

    curl_close($ch);
    return $result;
}

