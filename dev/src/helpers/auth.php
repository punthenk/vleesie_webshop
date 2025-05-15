<?php

if (session_status() !== PHP_SESSION_ACTIVE) @session_start();

function login(mixed $user_data): bool
{
  if (!is_null($user_data) && !empty($user_data)) {
    //Checks if the $user_data is a object and if the password exist and if that is true than delete password from the object
    if(is_object($user_data) && property_exists($user_data, "password"))
      unset($user_data->property);

    //Sets the session property 'user' to the user_data
    $_SESSION['user'] = $user_data;

    return true;
  } 

  return false;
}

function logout(): void
{
  if(isLoggedIn()) {
    unset($_SESSION['user']);
  }
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

  //If the 'user' in the session is availible then give that as a return value
  if(isset($_SESSION['user']) && !empty($_SESSION['user'])) {
    return $_SESSION['user'];
  }
  
  //If that is not the case then return a unknown user
  return $tempUser;
}

function user_id(): int
{
  if(isset($_SESSION['user']) && !empty($_SESSION['user'])) {
    if(!is_null(user()->ID)) {
      return intval(user()->ID);
    }
  }

  return 0;
}

function isLoggedIn(): bool
{
  if(isset($_SESSION['user']) && !empty($_SESSION['user'])) {
    return true;
  }

  return false;
}

function guest(): bool
{
  return !isLoggedIn();
}


function setLastVisitedPage(): void {
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
