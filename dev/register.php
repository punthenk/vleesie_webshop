<?php
include_once(__DIR__."/src/Database/Database.php");
include_once(__DIR__."/src/helpers/message.php");
@include_once(__DIR__."/template/head.inc.php");
?>
<form method="POST" action="src/formHandlers/register_handler.php" class="uk-width-1-1 uk-flex uk-flex-center">
  <div class="uk-card uk-card-default uk-width-4-5 uk-padding-small">
    <div class="uk-card-header uk-flex uk-gap">
      <img src="img/vleesie-logo.png" class="uk-card-media uk-card-register-logo" alt="Vleesie" title="Vleesie" />
      <h2 class="uk-text-uppercase uk-margin-remove-top">Registreren</h2>
    </div>
    <?php if(hasError("legal-error")): ?>
    <div class="uk-alert-danger" uk-alert>
      <a href class="uk-alert-close" uk-close></a>
      <p><?= getError("legal-error") ?></p>
    </div>
    <?php endif; ?>
    <?php if(hasError("passwordconfirm-validation-error")): ?>
    <div class="uk-alert-danger" uk-alert>
      <a href class="uk-alert-close" uk-close></a>
      <p><?= getError("passwordconfirm-validation-error") ?></p>
    </div>
    <?php endif; ?>
    <div class="uk-card-body uk-flex uk-flex-between uk-card-body-gap">
      <div class="uk-width-1-1 uk-flex uk-flex-column">
        <div class="">
          <label for="firstname" class="uk-form-label">Voornaam<span
              class="uk-text-xsmall uk-text-italic uk-text-primary"> (Verplicht)</span></label>
          <input type="text" name="firstname" class="uk-input" id="firstname" placeholder="Voornaam..." />
          <?php if(hasError("firstname-error")): ?>
            <p class="uk-text-danger uk-text-xsmall uk-text-italic uk-margin-remove-vertical"><?= getError("firstname-error") ?></p>
          <?php endif; ?>
        </div>
        <div class="uk-flex uk-gap uk-margin-top">
          <div class="uk-width-1-5">
            <label for="prefixes" class="uk-form-label">Tussenvoegsels</label>
            <input type="text" name="prefixes" class="uk-input" id="prefixes" placeholder="Tussenvoegsels..." />
          </div>
          <div class="uk-width-4-5">
            <label for="lastname" class="uk-form-label">Achternaam<span
                class="uk-text-xsmall uk-text-italic uk-text-primary"> (Verplicht)</span></label>
            <input type="text" name="lastname" class="uk-input" id="lastname" placeholder="Achternaam..." />
          <?php if(hasError("lastname-error")): ?>
            <p class="uk-text-danger uk-text-xsmall uk-text-italic uk-margin-remove-vertical"><?= getError("lastname-error") ?></p>
          <?php endif; ?>
          </div>
        </div>

        <div class="uk-flex uk-gap uk-margin-top">
          <div class="uk-width-3-5">
            <label for="street" class="uk-form-label">Straatnaam<span
                class="uk-text-xsmall uk-text-italic uk-text-primary"> (Verplicht)</span></label>
            <input type="text" name="street" class="uk-input" id="street" placeholder="Straatnaam..." />
          <?php if(hasError("street-error")): ?>
            <p class="uk-text-danger uk-text-xsmall uk-text-italic uk-margin-remove-vertical"><?= getError("street-error") ?></p>
          <?php endif; ?>
          </div>
          <div class="uk-width-1-5">
            <label for="housenumber" class="uk-form-label">Huisnummer<span
                class="uk-text-xsmall uk-text-italic uk-text-primary"> (Verplicht)</span></label>
            <input type="text" name="housenumber" class="uk-input" id="housenumber" placeholder="Huisnummer..." />
          <?php if(hasError("housenumber-error")): ?>
            <p class="uk-text-danger uk-text-xsmall uk-text-italic uk-margin-remove-vertical"><?= getError("housenumber-error") ?></p>
          <?php endif; ?>
          </div>
          <div class="uk-width-1-5">
            <label for="addition" class="uk-form-label">Toevoeging</label>
            <input type="text" name="addition" class="uk-input" id="addition" placeholder="Toevoeging..." />
          </div>
        </div>
        <div class="uk-flex uk-gap uk-margin-top">
          <div class="uk-width-1-5">
            <label for="zipcode" class="uk-form-label">Postcode<span
                class="uk-text-xsmall uk-text-italic uk-text-primary"> (Verplicht)</span></label>
            <input type="text" name="zipcode" class="uk-input" id="zipcode" placeholder="Postcode..." />
          <?php if(hasError("zipcode-error")): ?>
            <p class="uk-text-danger uk-text-xsmall uk-text-italic uk-margin-remove-vertical"><?= getError("zipcode-error") ?></p>
          <?php endif; ?>
          </div>
          <div class="uk-width-4-5">
            <label for="city" class="uk-form-label">Plaats<span class="uk-text-xsmall uk-text-italic uk-text-primary">
                (Verplicht)</span></label>
            <input type="text" name="city" class="uk-input" id="city" placeholder="Plaats..." />
          <?php if(hasError("city-error")): ?>
            <p class="uk-text-danger uk-text-xsmall uk-text-italic uk-margin-remove-vertical"><?= getError("city-error") ?></p>
          <?php endif; ?>
          </div>
        </div>
        <div class="uk-margin-top">
          <label for="email" class="uk-form-label">Email<span class="uk-text-xsmall uk-text-italic uk-text-primary">
              (Verplicht)</span></label>
          <input type="email" name="email" class="uk-input" id="email" placeholder="E-mail adres..." />
          <?php if(hasError("email-error")): ?>
            <p class="uk-text-danger uk-text-xsmall uk-text-italic uk-margin-remove-vertical"><?= getError("email-error") ?></p>
          <?php endif; ?>
        </div>
        <div class="uk-margin-top">
          <label for="password" class="uk-form-label">Wachtwoord<span
              class="uk-text-xsmall uk-text-italic uk-text-primary"> (Verplicht)</span></label>
          <input type="password" name="password" class="uk-input" id="password" placeholder="Wachtwoord..." />
          <?php if(hasError("password-error")): ?>
            <p class="uk-text-danger uk-text-xsmall uk-text-italic uk-margin-remove-vertical"><?= getError("password-error") ?></p>
          <?php endif; ?>
        </div>
        <div class="uk-margin-top">
          <label for="password-confirm" class="uk-form-label">Wachtwoord controle<span
              class="uk-text-xsmall uk-text-italic uk-text-primary"> (Verplicht)</span></label>
          <input type="password" name="password_confirm" class="uk-input" id="password-confirm"
            placeholder="Voer het wachtwoord nog eens in ter controle..." />
          <?php if(hasError("passwordconfirm-error")): ?>
            <p class="uk-text-danger uk-text-xsmall uk-text-italic uk-margin-remove-vertical"><?= getError("passwordconfirm-error") ?></p>
          <?php endif; ?>
        </div>
      </div>
    </div>
    <div class="uk-card-footer uk-flex uk-flex-between">
      <a href="login.php" class="">Inloggen</a>
      <button class="uk-button uk-button-primary" type="submit">Registreren</button>
    </div>
  </div>
</form>
<?php
@include_once("./template/foot.inc.php");
