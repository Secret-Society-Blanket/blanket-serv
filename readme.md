# Blanket Serv

This is a simple php site built to list and display manga. This was specifically built for Secret Society Blanket (hence the name), however it could adapted for any manga creator or translator.


## Dependencies 

This site is built around using docker, so its immediate dependencies are limited.

* [docker](https://docs.docker.com/get-docker/)
* [docker-compose](https://docs.docker.com/compose/install/)  (if you want to use the included docker-compose file)

## Setup

To use this site, you will need to generate the docker image yourself. Luckily, you can do this with the inbuilt docker-compose file, also listed here. 

### docker-compose 
Please remember to change ``MARIADB_ROOT_PASSWORD`` to something secure!
```yml
# Use root/example as user/password credentials
version: '3.1'

services:

  db:
    image: mariadb
    hostname: db
    restart: always
    volumes:
      - /var/lib/mysql
    environment:
      MARIADB_ROOT_PASSWORD: example

  # Feel free to uncomment this if you want an easy way to access and edit the 
  # database, it's recommended you don't activate this if your users can access 
  # it, though.

  # adminer:
  #   image: adminer
  #   restart: always
  #   ports:
  #     - 8081:8080

  blanket:
    build: .
    volumes:
      - /var/www/html/content/
    # Uncomment these if you aren't using a reverse proxy as described in production.
    # ports:
      #- 80:80
```

Before you run this file, you will also have to change the password entry in
``conf.toml`` to whatever you set ``MARIA_DB_ROOT_PASSWORD`` to.

### Command 

To start the site simply run the following:

```bash
docker-compose up -d --build 
```

This will build the site as well as start it in the background.

### Production

Since this site involves sending passwords, it is recommended you set up HTTPS.
Personally I find it helpful to use a reverse proxy such as linuxserver.io's
[swag](https://docs.linuxserver.io/general/swag) docker image.

## Usage

For this section, we will assume your site is at ``example.site``.

Before you do anything else you need to go to ``example.site/admin/setup.php``. 
This will ask you to create an admin username and password. Please make sure these are secure!

From there you can add authors at ``example.site/admin/author.php``, manga at
``example.site/admin/manga.php``, and chapters at
``example.site/admin/chapter.php``. Once they are added, they will be
automatically be populated on the site.

## Developer Notes

If you want to mess with the actual code, the site code is contained within
``site/``. In an effort to make it more user-friendly to edit and style, most
of the php scripts are kept in ``site/scripts/`` rather than directly where a
user will access them. ``site/scripts/utils.php`` contains a few constant
variables developers may want to change, as well as a number of utility
functions used throughout the site.

## Designer Notes
For the most part, each of the pages in ``site/`` can be freely edited according
to your design needs. If you don't know php, keep in mind that it messing with
code within the ``<?php ?>`` tag may cause the site to stop working properly.

``<?=variable_name?>`` tags are used to automatically insert variables into
html. Feel free to move these around or remove them as you see fit.

CSS stylesheets should be kept in ``site/style/``.
