# Product CRUD

An app to create, read, update and delete products in [Magento API](https://devdocs.magento.com/).

## Structure

The app is built with a MVC pattern (Model, View, Controller).

In `index.php` incoming variables from GET and POST are collected and sanitized.

There's an API-class, `Api` which is responsible for operations towards the Magento API.
An instance of the class `Api` is initialized with the accesstoken and baseURL for the API.
The instance of `Api` is then injected into the Controller which is an instance of `Controller`.

The incoming variables are also injected into the Controller.
The Controller determines the action according to the incoming variables and queries the API-class.

An instance of the class `View` then gets variables with info about what happened from the Controller
and renders the form.

## Linting

`php -l FILENAME`

## Fix Coding Standards

`tools/php-cs-fixer/vendor/bin/php-cs-fixer fix .`

## Setup

Make a directory `config` above the document root.

Put the base url of the API in the file `config/baseurl`.

Put your access token in the file `config/token`.

## Run with dev server

Stand in the repos root directory.

`php -S localhost:8000`

## Run in Apache

Follow directions under "Setup".

Put the files in the document root.
