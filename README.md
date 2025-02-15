#### Run this API using this command

```bash
# Install composer packages
docker compose run app composer install
# Install node dependencies
docker compose run app npm install
# Start building the application
docker compose build
# Start running the application in detached mode
docker compose up -d
# Tear down the application
docker compose down
# Restart the application
docker compose restart
# Stop the application
docker compose stop
```

#### Adding new module
This is the starter module to be use to create new package/module
```
# Copy starter package
packages/
└── starter/
    ├── composer.json
    ├── src/
    │   ├── StarterServiceProvider.php
    │   ├── app/
    │   │   ├── Builders/
    │   │   |   └── .gitkeep
    │   │   ├── Enums/
    │   │   |   └── .gitkeep
    │   │   ├── Http/
    │   |   |   ├── Controllers/
    │   │   |   |   └── Controller.php
    │   │   ├── Models/
    │   │   |   └── .gitkeep
    │   ├── config/
    │   │   └── starter.php
    │   ├── database/
    │   │   ├── factories/
    |   |   |   └── .gitkeep
    │   │   ├── migrations/
    |   |   |   └── .gitkeep
    │   │   ├── seeders/
    |   |   |   └── .gitkeep
```

Then update package/module <code>composer.json</code>
```json
{
    "name": "packages/<module_name>",
    "description": "<module_name> package for travelkit",
    "type": "library",
    "license": "MIT",
    "authors": [],
    "autoload": {
        "psr-4": {
            "Packages\\<module_name>\\": "src/"
        }
    },
    "require": {
        "php": "^8.2",
        "illuminate/support": "^11.9"
    },
    "extra": {
        "laravel": {
            "providers": [
                "Packages\\<module_name>\\<module_name>ServiceProvider"
            ]
        }
    }
}
```

Don't forget to update main project composer.json
```json
// update stability
"minimum-stability": "dev",

// add the newly created package/module to this part of the composer.json
"repositories": [
    {
        "type": "path",
        "url": "./packages/<module_name>"
    },
]

// add the newly created package to the required packages
"require": {
    "php": "^8.2",
    "laravel/framework": "^11.9",
    "laravel/tinker": "^2.9",
    "packages/<module_name>": "dev-main"
},
```

Then run <code>composer require packages/<module_name></code>

### Update auth sconfig
Update the <code>auth.php</code> in config
```php
'providers' => [
    'users' => [
        'driver' => 'eloquent',
        'model' => env('AUTH_MODEL', \Packages\User\App\Models\User::class),
    ],

    // 'users' => [
    //     'driver' => 'database',
    //     'table' => 'users',
    // ],
],
```

### Publish migrations, factories, seeders
Note: Publish vendors in order
```cmd
php artisan vendor:publish 

- Packages\User\UserServiceProvider
- Packages\Auth\AuthServiceProvider
- Packages\Otp\OtpServiceProvider
```

For more infor about laravel package development, please refer [here](https://laravel.com/docs/11.x/packages).