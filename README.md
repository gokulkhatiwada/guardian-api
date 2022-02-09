
## Guardian API Portal

Built to demonstrate the consuming of Guardian API 


## Setup

Clone the repository

```
git clone https://github.com/gokulkhatiwada/guardian-api
```
Run composer install

```
composer install
```

Setup database credentials and run migrations

```
php artisan migrate
```
Create admin user from terminal

```
php artisan make:admin
```

Install npm modules and compile assets
```
npm install && run dev
```

Start your application and head to the url /auth/login.
Configure application settings in Settings section and API credentials in API Credentials.
Base url of API credentials should be 
``` 
https://content.guardianapis.com/
```
All the log files of API request and response can be found under API Logs section according to date






 
