# Fake users generator service

This service generates random fake user.
It based on [Faker](https://github.com/fzaninotto/Faker) library and [Lumen](https://github.com/laravel/lumen) micro-framework


## Requirements
- php 7.1 or higher
- composer


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
GET: /users/random_one?number_of_users=2
```

### Get available params for users generation

```
GET: users/available_params
```