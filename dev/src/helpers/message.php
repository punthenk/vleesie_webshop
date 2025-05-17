<?php
if (session_status() !== PHP_SESSION_ACTIVE) @session_start();


function hasError(string $key): bool
{
  if(isset($_SESSION['error'])) {
    if(array_key_exists($key, $_SESSION['error'])) {
      return true;
    }
    return false;
  }
}

function hasMessage(string $key): bool
{
  if(isset($_SESSION['messages'])) {
    if(array_key_exists($key, $_SESSION['messages'])) {
      return true;
    }
    return false;
  }
}


function getError(string $key): string
{
  $error_message = "";

  if(hasError($key)) {
    $error_message = $_SESSION['error'][$key];
    unset($_SESSION['error'][$key]);
  }
  return $error_message;
}

function getMessage(string $key): string
{
  $message = "";

  if(hasMessage($key)) {
    $message = $_SESSION['messages'][$key];
    unset($_SESSION['messages'][$key]);
  }
  return $message;
}


function setError(string $key, mixed $value): void
{
  $_SESSION['error'][$key] = $value;
}

function setMessage(string $key, mixed $value): void
{
  $_SESSION['messages'][$key] = $value;
}
