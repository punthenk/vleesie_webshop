<?php
function setLastVisitedPage(): void
{
   $uri = "{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
   
   if(isset($_SERVER['HTTP-REFERER']))
      $uri = $_SERVER['HTTP-REFERER'];

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
