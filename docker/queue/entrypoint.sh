#!/bin/bash
ENV_FILE="/var/www/html/.env"

if [ ! -f "$ENV_FILE" ]; then
  echo "Creating .env file as it does not exist."
  touch "$ENV_FILE"
fi

REQUIRED_VARS=("DB_CONNECTION" "DB_HOST" "DB_PORT" "DB_DATABASE" "DB_USERNAME" "DB_PASSWORD")
for VAR in "${REQUIRED_VARS[@]}"; do
  if [ -z "${!VAR}" ]; then
    echo "Error: $VAR is not set."
    exit 1
  fi
done

for VAR in "${REQUIRED_VARS[@]}"; do
  if ! grep -q "^${VAR}=" "$ENV_FILE"; then
    echo "${VAR}=${!VAR}" >> "$ENV_FILE"
  fi
done

supervisord -n -c /etc/supervisor/supervisord.conf
