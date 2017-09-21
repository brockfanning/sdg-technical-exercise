<?php

/**
 * @file
 * Generate json output for the MySQL data.
 */

require_once __DIR__ . '/../scripts/common.php';

$csv_data = get_remote_data();
$columns = $csv_data->getHeader();
$skip_header = TRUE;
$json = [];
foreach ($csv_data as $row) {

  // Skip the header.
  if ($skip_header) {
    $skip_header = FALSE;
    continue;
  }

  $json[] = array_combine($columns, $row);
}

print json_encode($json);
