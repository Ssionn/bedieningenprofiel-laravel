<?php

return [
    'headers' => [
        'localization' => [
            'header' => 'Taalinstellingen',
            'subheader' => 'Selecteer uw voorkeurstaal',

            'button' => 'Opslaan',
        ],
        'account_information' => [
            'header' => 'Accountinformatie',
            'subheader' => 'Werk je accountinformatie bij',

            'fields' => [
                'avatar' => [
                    'header' => 'Klik om een afbeelding te uploaden of sleep en zet neer',
                    'subheader' => 'PNG, JPG tot 2MB, MAX. 800px x 400px',
                ],
                'username' => 'Gebruikersnaam',
                'name' => 'Volledige naam',
                'email' => 'E-mail',
                'password' => 'Wachtwoord',
            ],

            'button' => 'Opslaan',
        ],
        'background_color' => [
            'header' => 'Achtergrondkleur',
            'subheader' => 'Selecteer uw voorkeursachtergrondkleur',

            'radio_group' => [
                'light' => 'Licht',
                'dark' => 'Donker',
            ],

            'notification' => 'Uw achtergrondkleurvoorkeur is succesvol opgeslagen',

            'button' => 'Opslaan',
        ],
    ],

    // Changing to english because of language change
    'notifications' => [
        'saved' => 'Your account information has been saved successfully',
        'language' => 'Your language preference has been saved successfully',
    ],
];
