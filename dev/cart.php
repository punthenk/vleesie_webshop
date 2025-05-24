<?php
include_once(__DIR__."/src/Database/Database.php");
include_once(__DIR__."/src/helpers/auth.php");
include_once(__DIR__."/src/helpers/message.php");
include_once(__DIR__."/src/helpers/formatPrice.php");
include_once(__DIR__."/src/helpers/priceHelper.php");

setLastVisitedPage();



Database::query("SELECT
  cart_items.ID,
  cart_items.cart_id,
  cart_items.product_id,
  cart_items.amount,
  products.name,
  products.description,
  products.image,
  products.price,
  (cart_items.amount * products.price) AS product_total
  FROM cart_items 
  LEFT JOIN products ON products.ID = cart_items.product_id
  LEFT JOIN cart ON cart.ID = cart_items.cart_id
  WHERE cart.customer_id = :user_id", [":user_id" => user_id()]);

$cart_items = Database::getAll();
$total_amount = 0;
$order_total_price = 0.00;
$shipping_cost = 6.99;


foreach ($cart_items as $cart_item) {
  $total_amount += intval($cart_item->amount);
  $order_total_price  += $cart_item->product_total;
}

$shipping_cost = getShippingCosts($order_total_price);

@include_once("template/head.inc.php");
?>
<div class="uk-grid">
  <section class="uk-width-2-3 uk-flex uk-flex-column uk-cart-gap">

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
          <h3>Je winkelwagen is nog leeg. <a href="index.php">Vind iets lekkers in onze shop!</a><h3>
        </div>
      <?php endif; ?>


      <?php foreach ($cart_items as $cart_item): ?>
        <!-- BEGIN: SHOPPINGCART PRODUCT 1 -->
        <div class="uk-card-default uk-card-small uk-flex uk-flex-between">
          <div class="uk-card-media-left uk-widht-1-5">
            <img src="<?= $cart_item->image ?>" alt="<?= $cart_item->name ?>" class="product-image uk-align-center">
          </div>
          <div class="uk-card-body uk-width-4-5 uk-flex uk-flex-between">
            <div class="uk-width-3-4 uk-flex uk-flex-column">
            <a href="product.php?product_id=<?=$cart_item->product_id?>"><h2> <?= $cart_item->name ?> </h2></a>
              <p class="uk-margin-remove-top"> <?= substr($cart_item->description, 0, 80)."..." ?> </p>
            <div class="uk-flex uk-flex-between">
              <p class="uk-text-bolder uk-margin-remove-top">&euro; <?= formatPrice($cart_item->price)?> </p>
              <p class="uk-text-bolder uk-margin-remove-top">Totale prijs: &euro; <?= formatPrice($cart_item->product_total)?></p>
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
          <p class="uk-width-1-2">Artikelen (<?= $total_amount  ?>)</p>
          <p class="uk-width-1-2 uk-margin-remove-top uk-text-right">&euro; <?= formatPrice($order_total_price) ?></p>
        </div>
        <div class="uk-flex uk-flex-between uk-flex-middle">
          <p class="uk-width-1-2">Verzendkosten</p>
          <p class="uk-width-1-2 uk-margin-remove-top uk-text-right">&euro; <?= formatPrice($shipping_cost) ?></p>
        </div>
        <div class="uk-card-footer">
          <div class="uk-flex uk-flex-between uk-flex-middle">
            <p class="uk-width-1-2 uk-text-bold">Te betalen</p>
            <p class="uk-width-1-2 uk-margin-remove-top uk-text-right uk-text-bold">&euro;<?= formatPrice($order_total_price + $shipping_cost)?></p>
          </div>
          <div class="uk-flex uk-flex-1 uk-flex-middle uk-flex-center uk-margin-medium-top">
            <?php if (!empty($cart_items)): ?>
            <a href="order.php" class="uk-button uk-button-primary"> Verder naar bestellen </a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<?php
@include_once("template/foot.inc.php");
