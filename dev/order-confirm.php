<?php
include_once(__DIR__."/src/Database/Database.php");
include_once(__DIR__."/src/helpers/auth.php");
include_once(__DIR__."/src/helpers/formatPrice.php");

Database::query("SELECT * FROM products");
$products = Database::getAll();

Database::query("SELECT ID FROM cart WHERE customer_id = :user_id", [":user_id" => user_id()]);
$cart_id = Database::get()->ID;

Database::query("SELECT * FROM cart_items WHERE cart_id = :cart_id", ["cart_id" => $cart_id]);
$cart_items = Database::getAll();


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
@include_once("template/head.inc.php");
?>
<div class="uk-grid">
  <!-- BEGIN: BEDANKT -->
  <section class="uk-width-3-3 uk-flex uk-flex-column uk-cart-gap uk-margin-large-bottom">
    <div class="uk-card-default uk-card-small uk-flex uk-flex-column uk-padding-small">
      <div class="uk-card-header">
        <h1>Bedankt voor uw bestelling</h1>
      </div>
      <div class="uk-card-body uk-flex uk-flex-column uk-flex-between">
        <div class="uk-flex uk-flex-between uk-flex-center">
          <div>
            <h4 class="uk-margin-remove">Fijn dat u voor ons gekozen heeft.</h4>
            <h4 class="uk-margin-remove">U ontvangt van ons binnenkort een e-mail met alle informatie over uw
              bestelling.</h4>
          </div>
          <div class="uk-card-default uk-padding-small uk-flex-column uk-flex-middle uk-flex-center">
            <h3 class="uk-text-center">Bestelnummer</h3>
            <h2 class="uk-text-center">0128671</h2>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- EINDE: BEDANKT -->

  <!-- BEGIN: EINDAFREKENING -->
  <section class="uk-width-3-3">
    <div class="uk-card-default uk-card-small uk-flex uk-flex uk-flex-column uk-flex-between uk-padding-small">
      <div class="uk-card-header">
        <h2>Uw bestelling betreft</h2>
      </div>
      <div class="uk-card-body uk-flex uk-flex-column uk-flex-between">
        <table class="uk-table uk-table-divider uk-width-2-2 order-confirm-table">
          <thead>
            <tr>
              <th class="uk-width-2-3">Product</th>
              <th class="uk-text-center">Prijs</th>
              <th class="uk-text-center">Aantal</th>
              <th class="uk-text-right">Subtotaal</th>
            </tr>
            <?php foreach ($cart_items as $cart_item): 
                              Database::query("SELECT * FROM products WHERE id = :id", [":id" => $cart_item->product_id]);
                              $product = Database::get();
                              ?>
          </thead>
          <tbody>
            <tr>
              <td class="uk-flex uk-flex-middle uk-gap">
                <img class="uk-order-confirm-img" src="<?= $product->image ?>" alt="" />
                <p class="uk-margin-remove"><?=$product->name?> </p>
              </td>
              <td class="uk-text-center">&euro; <?=formatPrice($product->price)?></td>

              <td class="uk-text-center"><?=$cart_item->amount?></td>
              <td class="uk-text-right">&euro; <?=formatPrice($product->price * $cart_item->amount)?></td>
              <?php endforeach; ?>
            </tr>
          </tbody>
          <tfoot>

            <tr>
              <td colspan="3" class="uk-text-right uk-text-uppercase">Totaal te betalen</td>
              <td class="uk-text-right">&euro;
                <?=formatPrice($product_total_price)?>
              </td>
            </tr>
            <tr>
              <td colspan="3" class="uk-text-right uk-text-uppercase">Reeds betaald</td>
              <td class="uk-text-right">&euro; 0.00</td>
            </tr>


            <tr>
              <td colspan="3" class="uk-text-right uk-text-uppercase uk-text-bolder">Nog te betalen</td>
              <td class="uk-text-right uk-text-bolder">&euro;
                <?=formatPrice($product_total_price)?>
              </td>
            </tr>
            <tr>

          </tfoot>

        </table>
      </div>
    </div>
  </section>
  <!-- EINDE: EINDAFREKENING -->
</div>
<?php
@include_once("template/foot.inc.php");
