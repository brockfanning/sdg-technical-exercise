<?php

/**
 * @file
 * Generate json output for the MySQL data.
 */

require_once __DIR__ . '/../scripts/common.php';

$data = get_saved_data();
print json_encode($data);
