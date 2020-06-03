<?php
require_once __DIR__.'/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

return [
  "release" => false,
  "sbMode" => true,
  "db" => [
    "local" => [
      "host" => "localhost",
      "name" => "school",
      "user" => "momo",
      "pass" => "asdasd"
    ],
    "remote_test" => [
      "host" => "",
      "name" => "",
      "user" => "",
      "pass" => "",
    ],
    "remote_prod" => [
      "host" => getenv("DB_HOST"),
      "name" => getenv("DB_NAME"),
      "user" => getenv("DB_USER"),
      "pass" => getenv("DB_PASS")
    ]
  ],
  "admin"=> [
    "id" => getenv("ADMIN_ID"),
    "pass" => getenv("ADMIN_PASS")
  ]
]
?>