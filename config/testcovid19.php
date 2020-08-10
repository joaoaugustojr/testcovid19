<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Consulta Suspeita de COVID-19
    |--------------------------------------------------------------------------
    |
    | Titulo da aplicação
    |
    */
    'title' => 'Consulta Suspeita de COVID-19',

    /*
    |--------------------------------------------------------------------------
    | Parametrização de itens do menu
    |--------------------------------------------------------------------------
    |
    | Itens do menu inicial
    |
    */
    'menu' => [
        [
            'text' => 'Home',
            'route' =>  'dashboard.index',
            'id' => 'dashbard'
        ],
        [
            'text' => 'Usuários',
            'route' =>  'users.index',
            'id' => 'users'
        ],
        [
            'text' => 'Formulário de Consulta',
            'route' => 'forms.index',
            'id' => 'forms'
        ]
    ],

];