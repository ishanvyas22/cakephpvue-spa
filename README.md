# A Basic CakePHP + VueJS Single Page Application
A basic CakePHP(3.\*) + VueJS single page application. Provides basic skeleton to quickly get started with cakephp and vuejs.

## Installation
1. Clone project into your server by below command
    ```bash
    git clone git@github.com:ishanvyas22/cakephpvue-spa.git
    ```
2. Change branch to `develop` from `master`
    ```bash
    git checkout develop
    ```
2. Install composer and npm dependencies
    ```bash
    composer install
    ```
3. Change database connection in your `config/app.php` file
4. Migrate the database
    ```bash
    bin/cake migrations migrate
    ```

## Development
1. Install npm packages
    ```bash
    npm install
    ```
2. Run below command (Uses awesome tool ([Laravel mix](https://laravel-mix.com)) by ([Jeffrey Way](https://github.com/JeffreyWay)))
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
- This is just a skeleton/example how you can implement the VueJS with CakePHP.

## TODO
- To add TODO section in README :)

## Issues
Feel free to submit issues and enhancement requests.

## Contribution
I love to welcome your contributions if you know VueJS / CakePHP.