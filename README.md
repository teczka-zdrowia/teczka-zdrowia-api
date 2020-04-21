# Teczka Zdrowia API

Backend for [Teczka Zdrowia](https://github.com/teczka-zdrowia/teczka-zdrowia)

Made with PHP, Laravel and Lighthouse.

![Teczka Zdrowia](https://user-images.githubusercontent.com/10941338/79773106-4c99b780-8331-11ea-8102-dfc9d5acc956.png)

## Build Setup

``` bash
# install all dependencies
composer install

# generate app key
php artisan key:generate

# fill environment variables:
# database, passport client and mail server

# run in development
php artisan serve

# refresh the database and migrate sample data
php artisan migrate:refresh --seed
```

## License

Teczka Zdrowia API is [fair-code](http://faircode.io) licensed under [**Apache 2.0 with Commons Clause**](https://github.com/teczka-zdrowia/teczka-zdrowia-api/blob/master/LICENSE.md).

Learn more about **Commons Clause** [here](https://commonsclause.com/).
