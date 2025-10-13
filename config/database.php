<?php

return [
    'default' => 'sqlsrv', // Change to 'sqlsrv' or 'mysql' for SQL Server

    'connections' => [
        'mysql' => [
            'driver' => 'mysqli',
            'host' => '127.0.0.1',
            'database' => 'contract_db',
            'username' => 'phpuser',
            'password' => 'php1234',
        ],
        'sqlsrv' => [
            'driver' => 'sqlsrv',
            'server' => '192.168.1.10',
            'database' => 'ILECO3',
            'username' => '',
            'password' => '',
        ]
    ]
];
