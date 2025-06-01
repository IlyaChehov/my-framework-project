<?php

namespace Ilya\MyFrameworkProject\Database;

use PDO;
use PDOException;

class Database
{
    private static Database|null $instance = null;
    private PDO $connect;
    private \PDOStatement $stmt;

    private function __construct()
    {

    }

    private function __clone(): void
    {
    }

    public static function getInstance(): self
    {
        if (Database::$instance === null) {
            Database::$instance = new self();
        }

        return Database::$instance;
    }

    public function getConnect(array $dbConfig): self
    {
        $dsn = "mysql:host={$dbConfig['host']};dbname={$dbConfig['dbname']};charset={$dbConfig['charset']}";

        try {
            $this->connect = new PDO($dsn, $dbConfig['username'], $dbConfig['password'], $dbConfig['options']);
            return $this;
        } catch(\PDOException $e) {
            error_log($e->getMessage());
            die;
        }
    }

    public function query(string $query, array $params = []): self
    {
        try {
            $this->stmt = $this->connect->prepare($query);
            $this->stmt->execute($params);
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }
        return $this;
    }

    public function getAll(): array
    {
        return $this->stmt->fetchAll();
    }

    public function getOne(): mixed
    {
        return $this->stmt->fetch();
    }

    public function getAssoc($key = 'id'): array
    {
        $data = [];
        while($row = $this->stmt->fetch($key)) {
            $data[$row[$key]] = $row;
        }
        return $data;
    }

    public function findAll(string $table): array
    {
        $this->query("SELECT * FROM {$table}");
        return $this->stmt->fetchAll();
    }

    public function findOne(string $table, string $value, string $key = 'id'): mixed
    {
        $this->query("SELECT * FROM {$table} WHERE {$key} = ? LIMIT 1", [$value]);
        return $this->stmt->fetch();
    }

    public function getInsertId(): string|false
    {
        return $this->connect->lastInsertId();
    }
}
