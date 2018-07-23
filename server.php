<?php

require 'vendor/autoload.php';

// Using Medoo namespace
use Medoo\Medoo;

// Initialize
$database = new Medoo([
    'database_type' => 'mysql',
    'database_name' => 'upTest',
    'server' => '',
    'username' => '',
    'password' => '',
]);

// -------seed fake data with --------

// $database->insert('items', [
//     'image' => 'image1',
//     'description' => 'test image number 1',
// ]);

// ------- delete the fake data --------
// $database->delete("items", [
//     "image" => "image1",
// ]);

// get items data and pass it to index php
$items = $database->select('items', [
    'image',
    'description',
    'id',
]);
