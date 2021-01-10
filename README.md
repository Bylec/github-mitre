###Installation

To serve application:
1. Rename `.env.example` file to `.env`

and then run commands

2. `composer install --ignore-platform-reqs`   
3. `./vendor/bin/sail up`
4. `sail artisan key:generate`
5. `npm install`
6. `./vendor/bin/sail artisan mitre:fetch-data`

You may access the project in your web browser at http://localhost
