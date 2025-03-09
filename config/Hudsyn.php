<?php

return [
    'guard'    => 'hudsyn',
    'provider' => 'hudsyn_users',
    'editor'   => [
        'contentsCss' => [
            asset('css/app.css'),
            asset('css/custom-editor.css'),
        ],
        'scripts' => [
            asset('js/custom-editor.js'),
        ],
    ],
];
