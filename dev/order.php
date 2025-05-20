<?php
include_once(__DIR__."/src/Database/Database.php");
include_once(__DIR__."/src/helpers/auth.php");
include_once(__DIR__."/template/head.inc.php");

Database::query("SELECT * FROM cart_items");
$cart_items = Database::getAll();

Database::query("SELECT ID FROM cart WHERE customer_id = :user_id", [":user_id" => user_id()]);
$cart_id = Database::get()->ID;

$result = Database::query("SELECT SUM(`cart_items`.`amount` * `products`.`price`) AS
  `product_total` FROM `cart_items` JOIN `products` ON `cart_items`.`product_id` = `products`.`id`
  WHERE `cart_items`.`cart_id` = :cart_id",
  [':cart_id' => $cart_id]
);
$product_total_price = Database::get()->product_total; // Enkele waarde ophalen


$total_cart_items = 0;
if (!is_null($cart_items)) {
  foreach($cart_items as $cart_item) {
    $total_cart_items++;
  }
}
?>
<div class="uk-grid">
  <!-- BEGIN: FACTUUR -->
  <section class="uk-width-1-3 uk-flex uk-flex-column uk-cart-gap">
    <div class="uk-card-default uk-card-small uk-flex uk-flex-column uk-padding-small">
      <div class="uk-card-header">
        <h2>Factuur</h2>
      </div>
      <div class="uk-card-body uk-flex uk-flex-column uk-flex-between">
        <div class="uk-flex uk-flex-between uk-flex-center">
          <p class="uk-width-1-2">Artikelen (
            <?=$total_cart_items?>)
            producten (
            <?= countItemsInCart()?>)
          </p>
          <p class="uk-width-1-2 uk-margin-remove-top uk-text-right">&euro;
            <?= $product_total_price ?>
          </p>
        </div>
        <div class="uk-flex uk-flex-between uk-flex-center">
          <p class="uk-width-1-2">Verzendkosten</p>
          <p class="uk-width-1-2 uk-margin-remove-top uk-text-right">&euro; 0.00</p>

        </div>
      </div>
      <div class="uk-card-footer">
        <div class="uk-flex uk-flex-between uk-flex-center">
          <p class="uk-width-1-2 uk-text-bold">Te betalen</p>
          <p class="uk-width-1-2 uk-margin-remove-top uk-text-right uk-text-bold">&euro;
            <?= $product_total_price?>
          </p>
        </div>
      </div>
    </div>
  </section>
  <!-- EINDE: FACTUUR -->

  <!-- BEGIN: VERZENDADRES -->
  <section class="uk-width-1-3">
    <div class="uk-card-default uk-card-small uk-flex uk-flex uk-flex-column uk-flex-between uk-padding-small">
      <div class="uk-card-header">
        <h2>Verzendadres</h2>
      </div>
      <div class="uk-card-body uk-flex uk-flex-column uk-flex-between">
        <p class="uk-margin-remove-vertical">
          <?= user()->firstname ?>
          <?= user()->prefix ?>
          <?= user()->lastname ?>
        </p>
        <p class="uk-margin-remove-vertical">
          <?= user()->street ?>
          <?= user()->house_number ?>
        </p>
        <p class="uk-margin-remove-vertical">
          <?= user()->zipcode ?>
          <?= user()->addition ?>
          <?= user()->city ?>
        </p>
      </div>
      <div class="uk-card-footer">
        <div class="uk-flex uk-flex-1 uk-flex-middle uk-flex-center uk-margin-medium-top">
          <button class="uk-button uk-button-default">
            Wijzigen
          </button>
        </div>
      </div>
    </div>
  </section>
  <!-- EINDE: VERZENDADRES -->

  <!-- BEGIN: BETALEN -->
  <section class="uk-width-1-3">
    <div class="uk-card-default uk-card-small uk-flex uk-flex uk-flex-column uk-flex-between uk-padding-small">
      <div class="uk-card-header">
        <h2>Betalen</h2>
      </div>
      <div class="uk-card-body uk-flex uk-flex-column uk-flex-between">
        <div class="uk-flex uk-flex-between uk-gap">
          <img src="img/IDEAL.png" class="" alt="" title="" />
          <select name="bank">
            <option>Kies uw bank</option>
            <option value="1">Rabobank</option>
            <option value="1">ASN Bank</option>
            <option value="1">ING Bank</option>
            <option value="1">Regiobank</option>
            <option value="1">SNS Bank</option>
            <option value="1">ABNAMRO Bank</option>
          </select>
        </div>
      </div>
      <div class="uk-card-footer">
        <div class="uk-flex uk-flex-1 uk-flex-middle uk-flex-center uk-margin-medium-top">
          <a href="order-confirm.php" class="uk-button uk-button-primary">
            Betalen
          </a>
        </div>
      </div>
    </div>
  </section>
  <!-- EINDE: BETALEN -->
</div>
<?php
include_once("template/foot.inc.php");
