# api-crypto-wallet

<p> 
    Developed in Laravel, Crypto-Wallet is an API capable of bringing the updated values of cryptocurrencies, such as Bitcoin, Ethereum, Celo, Gala, and other currencies with market value. It is also possible to search for values at specific times, simply by choosing the date you want to consult.
</p>

<h2>
    Get started
</h2>

<h2>1. Requirements</h2>
<p>PHP 8.0+</p>
<p>Laravel 9+</p>
<p>MySQL 5.7+ or PostgreSQL</p>
<p>Composer</p>

<h2>2. Installing</h2>
Clone and access your local branch
<h2>3. Setting</h2>
Configure your MySQL or PostgreSQL database as a database to store the information generated by the API, eg crypto_currency. Configure your .env file to connect to the database.

Run
```
composer update
php artisan migrate
php artisan serve
```

<h2>4. Running the API</h2>
<p>The Crypto-Wallet API uses [Coingecko](https://coingecko.com/) as a base to generate cryptocurrency values. Its search is based on the “coin_id” of each currency and, by default, API returns the updated bitcoin value. This value is saved in the database, “coin” table, and once it is saved, it will be updated whenever there is the last query and the value is different from what was recorded in the query.</p>


Try:

__http://localhost:8000/api/coin_currency__

If you want to search for another currency, just add your id to the url:

__http://localhost:8000/api/coin_currency/ethereum__

Another way to use it is by consulting the value of these coins in specific periods:

__http://localhost:8000/api/coin_period/27-06-2022__

The query will return the value of bitcoin on the date 2022-06-27. To look up the value of another currency, just add its coin_id to the URL:

__http://localhost:8000/api/coin_period/27-06-2022/ethereum__

Some coins you can try too: luna-rush, celo, pstake-staked-atom, and dacxi
It is also possible to test through the online API link:

__https://api-crypto-wallet.herokuapp.com/__

<p>Note: The config/database file is set to __postgresql__ by default. If you want to use MySQL, it is recommended that you change to __mysql__</p>


