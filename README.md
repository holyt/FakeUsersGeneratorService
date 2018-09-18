# Fake users generator service

This service generates random fake user.
It based on [Faker](https://github.com/fzaninotto/Faker) library and [Lumen](https://github.com/laravel/lumen) micro-framework


## Requirements
- php 7.1 or higher
- composer

### If you need to use Groups, additional you will need:
- [Any Lumen compatible DB](https://lumen.laravel.com/docs/5.7/database).
- [Redis](https://redis.io/)
- [predis](https://github.com/nrk/predis) or [phpredis](https://github.com/phpredis/phpredis)
- configure .env file in root directory of this service (basically just move .env.example to .env, and all will be ok)
- start jobs listener ```$ php artisan queue:work```
## Usage

1. Clone it

```
$ git clone https://github.com/holyt/FakeUsersGeneratorService.git
```

2. Install dependencies

```
$ composer install

```
3. Test code

```
$ ./vendor/bin/phpunit

```
4. Star server
```
$ php -S localhost:8000 -t public

```

## Api

### Get one fake random user.

```
GET: /users/random_one
```
This request will return user; 
```
{
    "first_name":"Mohammed",
    "last_name":"Torphy",
    "email":"remard@hotmail.com",
    "phone":"+4013649264014"
}
```

### Get fake users by params

```
GET: /users?number_of_users=2
```
This request will return array of user;

### Get available params for users generation

```
GET: users/available_params
```
This request will return array of available params for users generation;

### Create users group

```
POST: groups
BODY: [number_of_users: required|int]
```
This request will return `{'group_id' => created group id}` 
 
### Get group users

```
GET: groups/{group_id}/users
```
This request will return array of users. 
