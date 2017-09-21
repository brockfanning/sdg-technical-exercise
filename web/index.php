<?php

/**
 * @file
 * Home page for SDG Exercise.
 */

require_once __DIR__ . '/../scripts/common.php';

$rows = get_saved_data();
$columns = array_keys($rows[0]);

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SDG Exercise</title>
    <link rel="stylesheet" href="/assets/css/uswds.css">
  </head>
  <body>
  <a class="usa-skipnav" href="#main-content">Skip to main content</a>
  <header class="usa-header usa-header-extended" role="banner">
    <div class="usa-navbar">
      <button class="usa-menu-btn">Menu</button>
      <div class="usa-logo" id="logo">
        <em class="usa-logo-text">
          <a href="/" title="Home" aria-label="SDG Exercise">SDG Exercise</a>
        </em>
      </div>
    </div>
  </header>
  <main id="main-content">
    <section class="usa-section">
      <div class="usa-grid">
        <h1>Median weekly earnings as full-time wage and salary workers in US dollars</h1>
        <h2>Table</h2>
        <p class="usa-font-lead">This displays the data in an HTML table.</p>
        <div class="table-container">
          <table>
            <thead>
              <tr>
                <?php foreach ($columns as $column): ?>
                <th><?php print $column ?></th>
                <?php endforeach; ?>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($rows as $row): ?>
              <tr>
                <?php foreach ($row as $column): ?>
                <td><?php print $column ?></td>
                <?php endforeach; ?>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </section>
  </main>
  <script src="/assets/js/uswds.min.js"></script>
  </body>
</html>
