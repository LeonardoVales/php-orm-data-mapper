<?php

require __DIR__.'/vendor/autoload.php';

use Vales\DataMapperOrm\QueryBuilder\Select;
use Vales\DataMapperOrm\Drivers\Mysql;
use Vales\DataMapperOrm\Repositories\Repository;
use App\Entities\Users;

$conn = new Mysql;

$conn->connect([
    'server' => 'localhost',
    'database' => 'laravel_teste',
    'user' => 'laravel_teste',
    'pass' => '123456'
]);

$repository = new Repository($conn);
$repository->setEntity(Users::class);

$user =new Users([
    'name' => 'João Calvino',
    'email' => 'test15e@gmail.com',
    'password' => '123456'
]);

$users = $repository->all();

var_dump($users);



