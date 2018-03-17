<?php

    return [
                'facebook' => [
                    'client_id' => env('FACEBOOK_CLIENT_ID', '444603905707126'),
                    'client_secret' => env('FACEBOOK_CLIENT_SECRET', '07ce9549b6d66bc8d9c24e015bd72dde'), 
                    'redirect' => env('FACEBOOK_CALLBACK_URL', url('login/facebook/callback'))
                ],

                'google' => [
                    'client_id' => env('GOOGLE_CLIENT_ID'),         
                    'client_secret' => env('GOOGLE_CLIENT_SECRET'), 
                    'redirect' => env('GOOGLE_CALLBACK_URL'),
                ],

                'twitter' => [
                    'client_id' => env('TWITTER_CLIENT_ID'),         
                    'client_secret' => env('TWITTER_CLIENT_SECRET'), 
                    'redirect' => env('TWITTER_CALLBACK_URL'),
                ],
            ];