<?php

return [
    'headers' => [
        'localization' => [
            'header' => 'Languages',
            'subheader' => 'Select your preferred language',

            'button' => 'Save',
        ],
        'account_information' => [
            'header' => 'Account information',
            'subheader' => 'Update your account information',

            'fields' => [
                'avatar' => [
                    'header' => 'Click to upload or drag and drop an image',
                    'subheader' => 'PNG, JPG up to 2MB, MAX. 800px x 400px',
                ],
                'username' => 'Username',
                'name' => 'Full Name',
                'email' => 'Email',
                'password' => 'Password',
            ],

            'button' => 'Save',
        ],
    ],

    'notifications' => [
        'saved' => 'Your account information has been saved successfully',

        // change this to dutch because of language change
        'language' => 'Uw taalvoorkeur is succesvol opgeslagen',
    ],
];
