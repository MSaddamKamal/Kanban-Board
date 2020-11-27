# Kanban Board

Kanban Board is a visual tool that gives a perfect overview of the current work status and simplifies team collaboration and communication.

## Technology Stack
It is built on Laravel and Vue.js, accompanied with beautiful UI using Tailwind CSS


## Features
* User Login/Signup
* Personalize Board

  - Add new columns
  - Add new cards in each column
  - Drag/Drop cards
  - Delete Columns
  - Edit cards
  - Last state of board is preserved in database
  - Export Kanban Board Database as `.sql`



## Usage
In order to use Kanban Board first you have to Signup, then you are free to customize your Board

## Demo
Following is the Demo Link

[http://saddam.bemo.fixlo.co/](http://saddam.bemo.fixlo.co/)



## Installation

Create `.env` file at the root of the project and add database credentials, make sure `APP_KEY` is present following is the same `.env` file

```bash
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:FeT2zRDDniS66dD+opG+5Min9EAO9VOfqvCBrMQDCu8=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=kanban
DB_USERNAME=root
DB_PASSWORD=

BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

```

Install composer vendor packages by following command

```bash
composer install
```

Install node modules  by following command

```bash
npm install
```

Run migrations by following command

```bash
php artisan migrate:fresh --seed
```



## Troubleshooting

Run following commands for troubleshooting

```bash
php artisan optimize
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)