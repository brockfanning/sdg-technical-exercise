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
