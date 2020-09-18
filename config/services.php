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
        'api_key' => 'AIzaSyBnWqEdECDv6MBv6pIDhQAGWTQY9RHLu2I', //  used for JS integration
        'auth_domain' => 'toyotafuncof.firebaseapp.com', // used for JS integration
        'database_url' => 'https://toyotafuncof.firebaseio.com/',
        'secret' => 'wdZrPwew95EszStUBJeMzZQIRo3x92UqVfB6f2lt',
        'storage_bucket' => 'toyotafuncof.appspot.com', // used for JS integration
        'project_id' => 'toyotafuncof',
        'messaging_sender_id' => '8531153622',
        'app_id' => '1:8531153622:web:16b01ee5675d55993bef77',
        'measurement_id' => 'G-1RTEEH61R7'
    ],

];
