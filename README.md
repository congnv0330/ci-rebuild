# CI-Rebuild
Custom Codeigniter Framework

Package using:
- [Guzzle, PHP HTTP client](https://github.com/guzzle/guzzle)
- [Blade Template](https://github.com/jenssegers/blade)
- [vlucas/phpdotenv](https://github.com/vlucas/phpdotenv)

## Required
- composer

## Start
- Create .env for project
```
Just copy .env.example rename to .env
```
- In local
```
composer install
```
- In production
```
composer install --optimize-autoloader
```
## Using Laravel-mix
- [Doc](https://laravel.com/docs/6.x/mix)
```
npm install
```
## Using ciscript
```
php ciscript help
```
## Using
Default Blade template isn't auto load, add blade to libraries if using blade
```
$autoload['libraries'] = array('session', 'blade');
```

