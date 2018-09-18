<?php

//get one fake user
$router->get('/users/random_one', 'RandomUserGeneratorController@show');

//get available params for user generation
$router->get('users/available_params', 'UserParamsController@show');

//get fake user by params
$router->get('/users', 'ParamsUserGeneratorController@show');

//create user group
$router->post('/groups', 'GroupController@store');

//get group users
$router->get('/groups/{groupId}/users', 'GroupUsersController@show');

