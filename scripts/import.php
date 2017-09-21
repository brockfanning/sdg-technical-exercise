<?php

/**
 * @file
 * Code to import remote SDG data into a database.
 */

require_once __DIR__ . '/common.php';

$conn = get_database_connection();
$query_builder = $conn->createQueryBuilder();

$csv_data = get_remote_data();
$columns = $csv_data->getHeader();
$skip_header = TRUE;
foreach ($csv_data as $row) {

  // Skip the header.
  if ($skip_header) {
    $skip_header = FALSE;
    continue;
  }

  // Build an "INSERT" for each row in the CSV.
  $insert = $query_builder->insert('indicator851');
  $parameters = [];
  foreach ($row as $index => $value) {
    if (empty($value)) {
      $value = NULL;
    }
    $insert->setValue($columns[$index], '?');
    $parameters[] = $value;
  }
  $insert
    ->setParameters($parameters)
    ->execute();
}
