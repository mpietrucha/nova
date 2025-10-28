<?php

return [
    'repeatable' => 'Translations',
    'fields' => [
        'translations' => 'Translations',
        'language' => 'Language',
        'translation' => 'Translation',
    ],
    'validation' => [
        'language' => 'Language must be unique',
    ],
];
