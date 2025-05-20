<?php
@include_once(__DIR__ . "/src/Database/Database.php");
@include_once(__DIR__ . "/src/helpers/auth.php");

setLastVisitedPage();

$cart_items = [];

Database::query("SELECT ID FROM cart WHERE customer_id = :user_id", [":user_id" => user_id()]);
$cart_id = Database::get()->ID;

if (isset($cart_id) && !empty($cart_id)) {
  Database::query("SELECT * FROM cart_items WHERE cart_id = :cart_id", [":cart_id" => $cart_id]);
  $cart_items = Database::getAll();
}


Database::query("SELECT SUM(`cart_items`.`amount` * `products`.`price`) AS `product_total` FROM `cart_items` JOIN `products` ON `cart_items`.`product_id` = `products`.`id` 
  WHERE `cart_items`.`cart_id` = :cart_id", [':cart_id' => $cart_id]);
$product_total_price = Database::get()->product_total;


if (is_null($product_total_price)) {
  $product_total_price = 0.00;
}

$total_cart_items = 0;
if (!is_null($cart_items)) {
  foreach ($cart_items as $cart_item) {
    $total_cart_items++;
  }
}

include_once("template/head.inc.php");
?>
<div class="uk-grid">
  <section class="uk-width-2-3 uk-flex uk-flex-column uk-cart-gap">
    <!-- BEGIN: SHOPPINGCART PRODUCT 1 -->

    <?php if (!isLoggedIn()): ?>
      <div class="uk-card uk-card-default uk-card-body">
        <h3 class="uk-card-title">om deze pagina te gebruiken moet u eerst inloggen.</h3>
        <?php
        include_once("template/foot.inc.php");
        exit();
        ?>
      <?php endif; ?>
      
      <?php if (empty($cart_items)): ?>
        <div class="uk-card uk-card-default uk-card-body">
          <h3>Er staat nog niets in de winkelwagen op dit moment<h3>
        </div>
      <?php endif; ?>



      <?php foreach ($cart_items as $cart_item):
        $product_id = $cart_item->product_id;
        Database::query("SELECT * FROM products WHERE id = :id", [':id' => $product_id]);
        $cart_product = Database::get();
      ?>
        <div class="uk-card-default uk-card-small uk-flex uk-flex-between">
          <div class="uk-card-media-left uk-widht-1-5">
            <img src="<?= $cart_product->image ?>" alt="<?= $cart_product->name ?>" class="product-image uk-align-center">
          </div>
          <div class="uk-card-body uk-width-4-5 uk-flex uk-flex-between">
            <div class="uk-width-3-4 uk-flex uk-flex-column">
              <h2> <?= $cart_product->name ?> </h2>
              <p class="uk-margin-remove-top"> <?= $cart_product->description ?> </p>
            <div class="uk-flex uk-flex-between">
              <p class="uk-text-bolder uk-margin-remove-top">&euro; <?= $cart_product->price?> </p>
              <p class="uk-text-bolder uk-margin-remove-top">Total price: &euro; <?=$cart_product->price * $cart_item->amount?></p>
            </div>
            </div>
            <div class="uk-width-1-4 uk-flex uk-flex-between uk-flex-middle uk-flex-center">
              <div class="uk-width-3-4 uk-flex uk-flex-column uk-flex-middle">
                <form id="new-amount-form-<?= $cart_item->product_id ?>" method="POST"
                  action="src/Formhandlers/updateAmount.php" style="display: none">
                  <input type="hidden" value="<?= $cart_item->ID ?>" name="cart_id" />
                  <input type="hidden" value="<?= $cart_item->product_id ?>" name="product_id" />
                  <input type="hidden" id="new-amount-<?= $cart_item->product_id ?>" name="amount" />
                </form>
                <input id="amount-<?= $cart_item->product_id ?>" class="uk-form-controls uk-form-width-xsmall uk-text-medium"
                  name="amount" value="<?= $cart_item->amount ?>" onchange="ChangeAmount(<?= $cart_item->product_id ?>)"
                  type="number" />
              </div>
              <div class="uk-width-1-4">
                <a href="#" class="uk-link-cart-trash uk-flex uk-flex-column uk-flex-middle uk-text-danger uk-flex-1">
                  <form id="delete-form-<?= $cart_item->ID ?>" method="post" action="src/formHandlers/deleteProduct.php"
                    style="display: none;">
                    <input type="hidden" name="cart_id" value="<?= $cart_item->ID ?>" />
                    <input type="hidden" name="product_id" value="<?= $cart_item->product_id ?>" />


                  </form>
                  <span class="material-symbols-outlined" onclick="DeleteProduct(<?= $cart_item->ID ?>)">delete</span>
                </a>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
      <!-- EINDE: SHOPPINGCART PRODUCT 1 -->
  </section>
  <section class="uk-width-1-3">
    <div class="uk-card uk-card-default uk-card-small">
      <div class="uk-card-header uk-align-center">
        <h2>Overzicht</h2>
      </div>
      <div class="uk-card-body">
        <div class="uk-flex uk-flex-between uk-flex-middle">
          <p class="uk-width-1-2">Artikelen (<?= $total_cart_items ?>)</p>
          <p class="uk-width-1-2 uk-margin-remove-top uk-text-right">&euro; <?= $product_total_price ?></p>
        </div>
        <div class="uk-flex uk-flex-between uk-flex-middle">
          <p class="uk-width-1-2">Verzendkosten</p>
          <p class="uk-width-1-2 uk-margin-remove-top uk-text-right">&euro; 0.00</p>
        </div>
        <div class="uk-card-footer">
          <div class="uk-flex uk-flex-between uk-flex-middle">
            <p class="uk-width-1-2 uk-text-bold">Te betalen</p>
            <p class="uk-width-1-2 uk-margin-remove-top uk-text-right uk-text-bold">&euro;<?= $product_total_price ?></p>
          </div>
          <div class="uk-flex uk-flex-1 uk-flex-middle uk-flex-center uk-margin-medium-top">
            <a href="order.php" class="uk-button uk-button-primary">
              Verder naar bestellen
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<?php
include_once("template/foot.inc.php");
