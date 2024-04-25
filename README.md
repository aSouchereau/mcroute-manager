# <img src="./src/public/img/favicon.svg" width="40">  MC Route Manager

MC Route Manager is an unofficial web interface for mc-router that provides a simpler way to manage your routes.\
([itzg/mc-router](https://github.com/itzg/mc-router): Routes Minecraft client connections to backend servers based upon the requested server address)

## Installation

### NOTICE: This app is still in early development and the database schema may be subject to breaking changes

MC Route Manager is built as a docker container, and requires two other services to run alongside it. The router itself, and a database (sqlite is currently not supported).

### Docker Compose

~~~
version: '3.4'

services:


  # The router that MC Route Manager interfaces with
  mcrouter:
    image: itzg/mc-router
    environment:
      API_BINDING: ':25564'
    ports:
      - '25565:25565'
      - '25564:25564'
    networks:
      - mcrouter

  # MC Route Manager
  web:
    # image: asouchereau/mcroute-manager
    ports:
      - '80:80'
    restart: always
    environment:
      DB_CONNECTION: 'mysql'
      DB_HOST: 'mysql'
      DB_PORT: '3306'
      DB_DATABASE: 'mcroute_manager'
      DB_USERNAME: 'mcroute_manager'
      DB_PASSWORD: 'changeme'
      ROUTER_HOST: 'mcrouter'
      ROUTER_PORT: '25564'
    networks:
      - mcrouter
    depends_on:
      - mcrouter
      - mysql

# Database for MC Route Manager
  mysql:
    image: 'mysql/mysql-server:8.0'
    ports:
      - '3306:3306'
    environment:
      MYSQL_DATABASE: 'mcroute_manager'
      MYSQL_USER: 'mcroute_manager'
      MYSQL_PASSWORD: 'changeme'
    volumes:
      - mcroute-data:/var/lib/mysql
    networks:
      - mcrouter


networks:
  mcrouter:
    driver: bridge

volumes:
  mcroute-data:
    name: mcroute-data
~~~
