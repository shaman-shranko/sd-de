<?php

return
  [
    'paths' => [
      'migrations' => '%%PHINX_CONFIG_DIR%%/migrations',
    ],
    'environments' =>
      [
        'default_database' => 'development',
        'default_migration_table' => 'phinxlog',
        'development' =>
          [
            'adapter' => 'mysql',
            'host' => 'db',
            'name' => 'test_db',
            'user' => 'devuser',
            'pass' => 'devpass',
            'port' => '3306',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
          ],
      ],
  ];
