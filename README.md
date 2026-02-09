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

#### Description
This is the starter module to be use to create new project using DDD structure
```

For more infor about laravel package development, please refer [here](https://laravel.com/docs/11.x/packages).