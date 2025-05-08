<?php
include_once(__DIR__."/src/Database/Database.php");

Database::query("SELECT * FROM cart_items");
$cart_items = Database::getAll();

include_once("template/head.inc.php");
?>
<div class="uk-grid">
  <section class="uk-width-2-3 uk-flex uk-flex-column uk-cart-gap">
    <!-- BEGIN: SHOPPINGCART PRODUCT 1 -->
    <?php foreach($cart_items as $cart_item): 
      $product_id = $cart_item->product_id;
      Database::query("SELECT * FROM products WHERE id = :id", [':id' => $product_id]);
      $cart_product = Database::get();
      ?>
    <div class="uk-card-default uk-card-small uk-flex uk-flex-between">
      <div class="uk-card-media-left uk-widht-1-5">
        <img src="<?= $cart_product->image?>" alt="<?= $cart_product->name?>" class="product-image uk-align-center">
      </div>
      <div class="uk-card-body uk-width-4-5 uk-flex uk-flex-between">
        <div class="uk-width-3-4 uk-flex uk-flex-column">
          <h2>
            <?= $cart_product->name?>
          </h2>
          <p class="uk-margin-remove-top">
            <?= $cart_product->description?>
          </p>
        </div>
        <div class="uk-width-1-4 uk-flex uk-flex-between uk-flex-middle uk-flex-center">
          <div class="uk-width-3-4 uk-flex uk-flex-column uk-flex-middle">
            <form id="new-amount-form-<?= $cart_item->product_id ?>" method="POST"
              action="src/Formhandlers/updateAmount.php" style="display: none">
              <input type="hidden" value="<?= $cart_item->ID ?>" name="cart_id" />
              <input type="hidden" value="<?= $cart_item->product_id ?>" name="product_id" />
              <input type="hidden" id="new-amount-<?= $cart_item->product_id ?>" name="amount" />
            </form>
            <input id="amount-<?= $cart_item->product_id?>" class="uk-form-controls uk-form-width-xsmall uk-text-medium"
              name="amount" value="<?=$cart_item->amount?>" onchange="ChangeAmount(<?= $cart_item->product_id?>)"
              type="number" />
          </div>
          <div class="uk-width-1-4">
            <a href="#" class="uk-link-cart-trash uk-flex uk-flex-column uk-flex-middle uk-text-danger uk-flex-1">
              <form id="delete-form-<?= $cart_item->ID?>" method="post" action="src/formHandlers/deleteProduct.php"
                style="display: none;">
                <input type="hidden" name="cart_id" value="<?= $cart_item->ID?>" />
                <input type="hidden" name="product_id" value="<?= $cart_item->product_id?>" />
              </form>
              <span uk-icon="icon: trash"></span>
              <span class="uk-text-xsmall" onclick="DeleteProduct(<?= $cart_item->ID?>)">Verwijder</span>
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
          <p class="uk-width-1-2">Artikelen (2)</p>
          <p class="uk-width-1-2 uk-margin-remove-top uk-text-right">&euro; 19.95</p>
        </div>
        <div class="uk-flex uk-flex-between uk-flex-middle">
          <p class="uk-width-1-2">Verzendkosten</p>
          <p class="uk-width-1-2 uk-margin-remove-top uk-text-right">&euro; 0.00</p>
        </div>
      </div>
      <div class="uk-card-footer">
        <div class="uk-flex uk-flex-between uk-flex-middle">
          <p class="uk-width-1-2 uk-text-bold">Te betalen</p>
          <p class="uk-width-1-2 uk-margin-remove-top uk-text-right uk-text-bold">&euro; 19.95</p>
        </div>
        <div class="uk-flex uk-flex-1 uk-flex-middle uk-flex-center uk-margin-medium-top">
          <a href="order.html" class="uk-button uk-button-primary">
            Verder naar bestellen
          </a>
        </div>
      </div>
    </div>
  </section>
</div>
<?php
include_once("template/foot.inc.php");
