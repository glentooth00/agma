<?php

return [
    'default' => 'sqlsrv', // Change to 'sqlsrv' or 'mysql' for SQL Server

    'connections' => [
        'mysqli' => [
            'driver' => 'mysqli',
            'host' => '127.0.0.1',
            'database' => 'usi_customerdb',
            'username' => 'root',
            'password' => 'root',
        ],
        'sqlsrv' => [
            'driver' => 'sqlsrv',
            'server' => '192.168.4.67',
            'database' => 'ILECO3',
            'username' => '',
            'password' => '',
        ]
    ]
];
