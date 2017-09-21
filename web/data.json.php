<?php

/**
 * @file
 * Generate json output for the MySQL data.
 */

require_once __DIR__ . '/../scripts/common.php';

$data = get_saved_data();

// For javascript purposes, we need the data flipped.
$metrics = [];
foreach ($data as $row) {
  $year = $row['year'];
  foreach ($row as $key => $value) {
    if ('year' == $key) {
      continue;
    }
    $metrics[$key][] = [
      'year' => $year,
      'value' => intval($value),
      'metric' => $key,
    ];
  }
}

$array_of_metrics = [];
foreach ($metrics as $metric => $values) {
  $array_of_metrics[] = $values;
}
print json_encode($array_of_metrics);
