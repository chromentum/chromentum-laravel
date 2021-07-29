# Chromentum - Another New Tab Extension

## Installation Instructions

- Clone Project
```sh
git clone https://github.com/chromentum/chromentum-laravel.git
```
- `cd` to cloned directory e.g 
```sh 
cd chromentum-laravel
```
- Install composer package 
```sh
composer install
```
- Copy `.env.example` in `.env` file and run 
```sh
php artisan key:generate
```
- Add `unsplash credentials` in env file, you can create from [here](https://unsplash.com/developers).
- Create passport token 
```sh 
php artisan passport:install
```
- Create a public client in passport 
```sh
php artisan passport:client --public
```
- you can skip the `Which user ID should the client be assigned to?:` just press enter
- enter any name
- enter callback url as `https://{chrome extension id}.chromiumapp.org/` and press enter
- Copy the client id and callback url and paste it in `.env` file.
- Run 
```sh
npm install && npm run dev
```
- Run `php artisan serve` to start the server or you can use `Larvel Valet` instead.

## Features
- [x] Background Image
- [x] Clock
- [x] Authentication
- [ ] Task List
- [ ] Quotes
- [ ] UI Design
- [ ] Landing Page
