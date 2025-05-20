<?php
include_once(__DIR__ . "/src/Database/Database.php");
include_once(__DIR__ . "/src/helpers/auth.php");
include_once(__DIR__ . "/template/head.inc.php");


// In a real application, fetch user data from the database using session info
?>
<div class="uk-container uk-margin-top uk-margin-large-bottom">
  <div class="uk-card uk-card-default uk-card-body uk-width-1-2@m uk-align-center">
    <h2 class="uk-card-title">Profiel</h2>
    <ul class="uk-list uk-list-divider">
      <li><strong>GebruikersNaam:</strong> <?= user()->firstname ?></li>
      <li><strong>Email:</strong> <?= user()->email ?></li>
      <li><strong>Voledige Naam:</strong> <?= user()->firstname; ?> <?= user()->prefix ?> <?= user()->lastname ?></li>
      <li><strong>Straat:</strong> <?= user()->street?> <?= user()->house_number ?> <?= user()->addition?></li>
      <li><strong>Postcode:</strong> <?= user()->zipcode?> </li>
      <li><strong>Stad:</strong> <?= user()->city?></li>
    </ul>
  </div>
</div>
<?php
include_once(__DIR__ . '/template/foot.inc.php');
