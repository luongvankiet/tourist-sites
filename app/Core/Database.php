<?php

namespace App\Core;

use PDO;

class Database
{
    public PDO $pdo;

    public function __construct(array $env)
    {
        $host = $env['DB_HOST'];
        $database = $env['DB_DATABASE'];
        $username = $env['DB_USERNAME'];
        $password = $env['DB_PASSWORD'];
        $port = $env['DB_PORT'];

        $this->pdo = new \PDO("mysql:host={$host};port={$port};dbname={$database}", $username, $password);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function runMigrations()
    {
        $this->createMigrationsTable();
        $migrations = $this->getAllMigrations();

        $migrationFiles = scandir(Application::$ROOT_DIR . '/migrations');

        $newMigrations = [];
        $migrationsFromFiles = array_diff($migrationFiles, $migrations);

        foreach ($migrationsFromFiles as $key => $value) {
            if ($value === '.' || $value === '..') {
                continue;
            }

            require_once Application::$ROOT_DIR . '/migrations/' . $value;

            $className = $this->getClassName(pathinfo($value, PATHINFO_FILENAME));

            $instance =  new $className();

            echo "Migrating $value" . PHP_EOL;
            $instance->up();
            echo "Migrated $value" . PHP_EOL;

            $newMigrations[] = $value;

            $this->pdo->prepare("INSERT INTO migrations (migration) VALUES ('$value')")->execute();
        }
    }

    public function createMigrationsTable()
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            migration VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );");
    }

    public function getAllMigrations()
    {
        $statement = $this->pdo->prepare("SELECT migration FROM migrations");
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_COLUMN);
    }

    public function saveMigrations(array $migrations = [])
    {
        if (empty($migrations)) {
            echo "Nothing to migrate.";

            return;
        }

        $values = implode(',', array_map(function ($migration) {
            return "('$migration')";
        }, $migrations));

        $this->pdo->prepare("INSERT INTO migrations (migration) VALUES $values")->execute();
    }

    public function getClassName($path)
    {
        $splits = explode('_', $path);

        if (is_numeric($splits[0])) {
            array_shift($splits);
        }

        return implode(array_map(function ($split) {
            return ucfirst($split);
        }, $splits));
    }
}
