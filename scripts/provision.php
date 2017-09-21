<?php

/**
 * @file
 * One-time script to create the database and table.
 */

require_once __DIR__ . '/common.php';

use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Schema\Table;

// Add the database if necessary.
$dbname = 'sdg_exercise';
$params = get_database_parameters();
$conn = DriverManager::getConnection($params, new Configuration());
$schema_manager = $conn->getSchemaManager();
if (!in_array($dbname, $schema_manager->listDatabases())) {
  $schema_manager->createDatabase($dbname);
}

// Now get a connection using the sdg_exercise database.
$params['dbname'] = $dbname;
$conn = DriverManager::getConnection($params, new Configuration());

// Create the table.
$schema_manager = $conn->getSchemaManager();
$tablename = 'indicator851';
if (!$schema_manager->tablesExist([$tablename])) {
  $table = new Table($tablename);
  // Use the CSV header for column names.
  $csv_data = get_remote_data();
  foreach ($csv_data->getHeader() as $column) {
    $table->addColumn($column, 'integer', ['notnull' => FALSE]);
  }
  $schema_manager->createTable($table);
}
