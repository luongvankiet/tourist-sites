<?php

use App\Core\Application;

class CreateSitesTable
{
    public function up()
    {
        $db = Application::$app->db;

        $sql = "CREATE TABLE sites (
            id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            site_name VARCHAR(100) NOT NULL,
            location VARCHAR(512),
            feature VARCHAR(512),
            contact VARCHAR(512) NOT NULL,
            price_from NUMERIC(6,2) DEFAULT 0,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";

        $db->pdo->exec($sql);
    }

    public function down()
    {
        $db = Application::$app->db;
        $sql = "DROP TABLE sites;";
        $db->pdo->exec($sql);
    }
}
