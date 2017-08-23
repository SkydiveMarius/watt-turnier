<?php
use Doctrine\DBAL\Schema\Column;
use Doctrine\DBAL\Schema\Index;
use Doctrine\DBAL\Schema\Table;
use Doctrine\DBAL\Types\Type;
use FCT\Watten\Src\Persistence\ConnectionManager;

require __DIR__ . '/vendor/autoload.php';

// CREATE USER watten WITH PASSWORD 'turnier';
// CREATE DATABASE watten;
// GRANT ALL PRIVILEGES ON DATABASE watten to watten;

$connection = ConnectionManager::getConnection();

// Table TEAMS
try {
    $connection->getSchemaManager()->dropTable('teams');
} catch (\Exception $e) {}

$connection->getSchemaManager()->createTable(new Table('teams', [
    new Column('team_id', Type::getType(Type::INTEGER)),
    new Column('first_player', Type::getType(Type::STRING)),
    new Column('second_player', Type::getType(Type::STRING))
]));
$connection->getSchemaManager()->createConstraint(new Index('teams_team_id', ['team_id'], true, true), 'teams');

