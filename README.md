# Tasklib

On this site, you can try out various projects that come up when you are working for yourself.

To run this project yourself, you need to follow these steps one by one.
```
git clone https://github.com/AkmalovAbduvoris/tasklib.git
```
access the copied project
```
cd tasklib
```
download the necessary items for the project
```
composer install
```
fix the env file for yourself
```
cp .env.example .env
```
or
```
mv .env.example .env
```
run migrations file
```
cd migrations
php createAllTable.php
cd ..
```
