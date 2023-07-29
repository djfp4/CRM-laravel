<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'firebase' => [
        'api_key' => 'AIzaSyANv2vmEKBFvVXMABFoZz07fwmc__JKpLw',
        'auth_domain' => 'cofinbot-bmvt.firebaseapp.com',
        'database_url' => 'https://cofinbot-bmvt-default-rtdb.firebaseio.com',
        'project_id' => 'cofinbot-bmvt',
        'storage_bucket' => 'cofinbot-bmvt.appspot.com',
        'messaging_sender_id' => '362644684742',
        'app_id' => '1:362644684742:web:7f856ba9d26422b733bcc7',
        'measurement_id' => 'G-5Y6DHRTC26',
    ],

];
