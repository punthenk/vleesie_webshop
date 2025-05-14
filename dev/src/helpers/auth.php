<?php

if (session_status() !== PHP_SESSION_ACTIVE) 
  @session_start();


function login(mixed $user_data): bool 
{
  echo "<pre>";
  var_dump($user_data);

  if(!is_null($user_data) && !empty($user_data)) {

    if(is_object($user_data) && property_exists('password', $user_data)) {
      unset($user_data->property);
    } elseif (is_array($user_data) && array_key_exists($user_data, 'password')) {
      unset($user_data['password']);
    }

    $_SESSION['user'] = $user_data;
    return true;
  }

  return false;
}

function user(): mixed
{
  $tempUser = new stdClass;
  $tempUser->id = 0;
  $tempUser->firstname = 'unknown';
  $tempUser->prefixes = '';
  $tempUser->lastname = 'unknown';
  $tempUser->street = 'unknown';
  $tempUser->house_number = '0';
  $tempUser->addition = '';
  $tempUser->zipcode = '';
  $tempUser->city = '';
  $tempUser->email = '';

  if(isset($_SESSION['user']) && !empty($_SESSION['user'])) {
    return $_SESSION['user'];
  }

  return $tempUser;
}


function setLastVisitedPage():void {
  $uri = "{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

  if(isset($_SERVER['HTTP-REFERER'])) {
    $uri = $_SERVER['HTTP-REFERER'];
  }

  if(!empty($uri) && !is_null($uri)) {
    $_SESSION['last-visited-page'] = $uri;
  }
}


function getLastVisitedPage(): string
{
   $last_page = "{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
   if(isset($_SESSION) && isset($_SESSION['last-visited-page']) && !empty($_SESSION['last-visited-page'])) {
      $last_page = $_SESSION['last-visited-page'];
      unset($_SESSION['last-visited-page']);
   }

   return $last_page;
}
