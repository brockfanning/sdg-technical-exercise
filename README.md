# SDG Technical Exercise

## Requirements

This exercise assumes a Unix-like environment where the following are installed:

* PHP
* MySQL
* Composer
* Node

## Setup

To get started, run these commands in the project root.

The following will install the vendor libraries.

```
composer install
npm install
```

Next you can set up the front-end assets.

```
npm run gather-assets
```

Next copy a file that controls your local database password.

```
cp config/database-parameters.yml.dist config/database-parameters.yml
```

At this point, edit config/database-parameters.yml for your particular database credentials. Then continue below.

The following creates the database and imports the data.

```
php scripts/provision.php
php scripts/import.php
```

## Running

To start the local server, go to the /web folder and type:

```
php -S localhost:1234
```

Then in a browser, visit [http://localhost:1234](http://localhost:1234).

## Approach

The approach taken here was:

1. Create a MySQL table, and import the data from a remote URL into the table
2. Use PHP to display the saved data as an HTML table
3. Expose the saved data as json and use d3 to display a line chart

Some basic design considerations were:

1. Use as much vendor code as possible, and limit the custom code to the absolute minimum
2. Allow for testers to easily run the code locally
3. Only version the custom code - not the vendor code or automatically generated code (sass).

## TODOs (if I were to continue)

1. Make the line chart interactive with checkboxes to turn on/off the various lines
2. Add a legend to the line graph
3. Consider making the contents /web static files, and limiting PHP to a "compilation" step that happens before deployment.