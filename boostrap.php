<?php

require __DIR__.'/vendor/autoload.php';

use Vales\DataMapperOrm\QueryBuilder\Select;
use Vales\DataMapperOrm\Drivers\Mysql;
use Vales\DataMapperOrm\Repositories\Repository;
use App\Entities\Users;

$conn = new Mysql;

$conn->connect([
    'server' => '',
    'database' => '',
    'user' => '',
    'pass' => ''
]);

$repository = new Repository($conn);
$repository->setEntity(Users::class);

$user = $repository->first(1);
$user->name = 'Leonardo teste';

$user = $repository->update($user);

var_dump($user);



