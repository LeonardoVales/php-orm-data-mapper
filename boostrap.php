<?php

require __DIR__.'/vendor/autoload.php';

new Vales\DataMapperOrm\DataMapper;

$select = new Vales\DataMapperOrm\QueryBuilder\Select('users');
$conn = new Vales\DataMapperOrm\Drivers\Mysql;

$conn->connect([
    'server' => 'localhost',
    'database' => 'laravel_teste',
    'user' => 'laravel_teste',
    'pass' => '123456'
]);

$conn->setQueryBuilder($select);
$conn->execute();
$users = $conn->all();

var_dump($users);

