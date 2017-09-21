<?php

/**
 * @file
 * Common functions needed by other scripts.
 */

require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Yaml\Yaml;
use Keboola\Csv\CsvFile;
use Httpful\Request;
use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;

/**
 * Get the database connection parameters.
 *
 * @ret Array
 *   An array of parameters to be passed into a Doctrine connection.
 */
function get_database_parameters() {

  // Import the parameters the user might need to tweak.
  $params = Yaml::parse(file_get_contents(__DIR__ . '/../config/database-parameters.yml'));

  // Add the parameters the user probably doesn't need to tweak.
  $params += [
    'driver' => 'pdo_mysql',
    'charset' => 'utf8mb4',
    'default_table_options' => [
      'charset' => 'utf8mb4',
      'collate' => 'utf8mb4_unicode_ci',
    ],
  ];

  return $params;
}

/**
 * Get the database connection.
 *
 * @ret \Doctrine\DBAL\Connection
 *   The database connection.
 */
function get_database_connection() {
  $params = get_database_parameters();
  $params['dbname'] = 'sdg_exercise';
  return DriverManager::getConnection($params, new Configuration());
}

/**
 * Get the remote data as a CsvFile object.
 *
 * @ret \Keboola\Csv\CsvFile
 *   The remote CSV file object.
 */
function get_remote_data() {

  // Download the CSV to a temp folder.
  $url = 'https://sdg.data.gov/data/indicator_8-5-1.csv';
  $file_name = basename($url);
  $request = Request::get($url);
  $response = $request->send();
  if (!$response->hasErrors()) {
    $source_file = '/tmp/' . $file_name;
    file_put_contents($source_file, $response->body);
  }
  else {
    // If it can't be downloaded, abort.
    throw new Exception(sprintf('Source data not found at %s', $url));
  }

  return new CsvFile($source_file);
}

/**
 * Get the data that is already saved in the database.
 *
 * @ret Array
 *   Return the saved data as a multidimensional array (fetchAll).
 */
function get_saved_data() {

  $conn = get_database_connection();
  $query_builder = $conn->createQueryBuilder();
  $select = $query_builder
    ->select('*')
    ->from('indicator851')
    ->execute();
  return $select->fetchAll();
}
