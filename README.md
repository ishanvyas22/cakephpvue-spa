# A Basic CakePHP + VueJS Single Page Application

[![Latest Stable Version](https://poser.pugx.org/ishanvyas22/cakephpvue-spa/v/stable)](https://packagist.org/packages/ishanvyas22/cakephpvue-spa)
[![Total Downloads](https://poser.pugx.org/ishanvyas22/cakephpvue-spa/downloads)](https://packagist.org/packages/ishanvyas22/cakephpvue-spa)
[![License](https://poser.pugx.org/ishanvyas22/cakephpvue-spa/license)](https://packagist.org/packages/ishanvyas22/cakephpvue-spa)
[![Build Status](https://travis-ci.com/ishanvyas22/cakephpvue-spa.svg?branch=develop)](https://travis-ci.com/ishanvyas22/cakephpvue-spa)

A basic CakePHP + VueJS single page application. Provides basic skeleton/boilerplate to quickly get started with CakePHP and Vue.js.

## Installation
1. Get project into your system

    Via [composer](https://packagist.org/packages/ishanvyas22/cakephpvue-spa):
    ```bash
    composer create-project ishanvyas22/cakephpvue-spa
    ```
    Via cloning the project into your server:
    ```bash
    git clone git@github.com:ishanvyas22/cakephpvue-spa.git
    ```
2. Install composer and npm dependencies
    ```bash
    composer install
    ```
3. Connect with your [database](https://book.cakephp.org/3.0/en/orm/database-basics.html#configuration)
4. Run the [migrations](https://book.cakephp.org/3.0/en/migrations.html#overview)
    ```bash
    bin/cake migrations migrate
    ```
5. Start [CakePHP web server](https://book.cakephp.org/3.0/en/installation.html#development-server) or [create v-host](https://www.digitalocean.com/community/tutorials/how-to-install-the-apache-web-server-on-ubuntu-18-04) to run this app.

## Development
1. Install npm packages
    ```bash
    npm install
    ```
2. Run below command (Uses awesome [Asset Mix](https://github.com/ishanvyas22/asset-mix) plugin for asset compilation)
    - **To watch every changes in your vue file**
        ```bash
        npm run watch
        ```
    - **To generate development version of js file**
        ```bash
        npm run dev
        ```
    - **To generate production version of js file**
        ```bash
        npm run production
        ```

## Notes
- This is project is under development currently so you might not want to use this app in production directly.
- This is just a skeleton/example how you can implement the Vue.js with CakePHP.

## Issues
Feel free to submit issues and enhancement requests.

## Contribution
I love to welcome your contributions if you know CakePHP / Vue.js.

## License
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
