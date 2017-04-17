# Yii2 Easy Start

This is Yii2 start application template.

It was created and developing as a fast start for building an advanced sites based on Yii2.

It covers typical use cases for a new project and will help you not to waste your time doing the same work in every project

##
Сборка для простого старта разработки приложений, основанных на коде с yii2.

В сборке уже настроены основные компоненты и она поможет вам не тратить время, делая ту же работу в каждом проекте.
##
##DEMO

Frontend:
[http://yii2-easy-start.ceprey.xyz](http://yii2-easy-start.ceprey.xyz)

Backend:
[http://admin.yii2-easy-start.ceprey.xyz](http://admin.yii2-easy-start.ceprey.xyz)

`administrator` role account
```
Login: admin
Password: admin
```

`manager` role account
```
Login: manager
Password: manager
```

`user` role account
```
Login: user
Password: user123
```
## [Screens](docs/screens.md)

### REQUIREMENTS
The minimum requirement by this application template that your Web server supports PHP 5.4.0.
Required PHP extensions:
- intl


## Installation

### Before you begin

1. If you do not have [Composer](http://getcomposer.org/), you may install it by following the instructions at [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).

2. Install composer-asset-plugin needed for yii assets management
```
composer global require "fxp/composer-asset-plugin"
```
### Get source code
#### Download sources
https://github.com/martyn911/yii2-easy-start/archive/master.zip

#### Or clone repository manually
```
git clone https://github.com/martyn911/yii2-easy-start.git
```
#### Install composer dependencies
```
composer install
```

### Get source code via Composer
You can install this application template with `composer` using the following command:

```
composer create-project --prefer-dist --stability=dev martyn911/yii2-easy-start
```

### Setup application
1. Copy `.env.dist` to `.env` in the project root.
2. Adjust settings in `.env` file
	- Set debug mode and your current environment
	```
	YII_DEBUG   = true
	YII_ENV     = dev
	```
	- Set DB configuration
	```
	DB_DSN           = mysql:host=127.0.0.1;port=3306;dbname=yii2-easy-start
	DB_USERNAME      = user
	DB_PASSWORD      = password
	```

	- Set application canonical urls
	```
	frontendUrl = http://yii2-easy-start.dev
	backendUrl = http://admin.yii2-easy-start.dev
	```

	- Set email configuration
	```
	#from
    ROBOT_EMAIL = robot@yii2-easy-start.dev
    #amin mail
    ADMIN_EMAIL = admin@yii2-easy-start.dev
	```

3. Run in command line
```
php console/yii app/setup
```
### Configure your web server
Copy `vhost.conf.dist` to `vhost.conf`, change it with your local settings and copy (symlink) it to nginx `sites-enabled` directory.
Or configure your web server with three different web roots:
```
- yii2-easy-start.dev => /path/to/yii2-easy-start.dev/frontend/web
- admin.yii2-easy-start.dev => /path/to/yii2-easy-start.dev/backend/web
```
###### That`s all. After provision application will be accessible on http://yii2-easy-start.dev

## Demo data
### Demo Users
```
Login: admin
Password: admin
```
```
Login: manager
Password: manager
```
```
Login: user
Password: user123
```


##Have any questions?
mail to [martyn911@i.ua](mailto:martyn911@i.ua)

###NOTE
This template was created mostly for developers NOT for end users.
This is a point where you can begin your application, rather than creating it from scratch.
Good luck!