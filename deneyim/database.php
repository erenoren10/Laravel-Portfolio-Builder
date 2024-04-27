<?php

// database.php

'connections' => [

    // ...

    'pgsql' => [
        'driver' => 'pgsql',
        'host' => env('DB_HOST', 'localhost'),
        'port' => env('DB_PORT', '5432'),
        'database' => env('DB_DATABASE', 'your_database_name'),
        'username' => env('DB_USERNAME', 'your_database_user'),
        'password' => env('DB_PASSWORD', 'your_database_password'),
        'charset' => 'utf8',
        'prefix' => '',
        'schema' => 'public',
    ],

    // ...

]

?>
