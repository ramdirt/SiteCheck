# SiteCheck

## Getting started

### Containering

Before start you should define globally new alias:

```
alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'
```

or just use `./vendor/bin/sail` to run command in container.

### Install

```
cp .env.example .env
```

To make containers work you should be able to call the `composer` and have necessary `php` tools:

```shell
composer install
```

Run containers:

```shell
sail up -d
```

Finish installation:

```shell
sail npm ci
sail php artisan key:generate
sail php artisan migrate:refresh --seed
sail npm run dev
```

error config db

```shell
sail down --rmi all -v
```
