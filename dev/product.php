<?php
include_once(__DIR__."/src/Database/Database.php");

$product_id = $_GET['product_id'];
Database::query("SELECT * FROM products WHERE id = :id", [':id' => $product_id]);
$product = Database::get();

@include_once("template/head.inc.php");
?>
<div class="uk-grid">
  <section class="uk-width-1">
    <div class="uk-grid uk-card uk-card-default">
      <section class="uk-width-1-2 uk-card-media-left">
        <img src="<?=$product->image?>" class="" alt="" title="" />
      </section>
      <section class="uk-width-1-2 uk-card-body uk-flex uk-flex-column uk-flex-between">
        <div class="">
          <h1>
            <?= $product->name?>
          </h1>
          <p class="">
            <?= $product->description?>
          </p>
        </div>
        <div class="uk-flex uk-flex-between uk-flex-middle">
          <div class="price-block">
            <p class="product-view__price uk-text-bold uk-text-danger uk-text-left uk-text-bolder">&euro;
              <?= $product->price?>
            </p>
          </div>
          <div>
            <form method="post" action="src/formHandlers/addToCart.php">
              <input type="hidden" name="product_id" value="<?=$product->ID?>" />
              <input type="hidden" name="redirect_url" value="<?= htmlspecialchars($_SERVER['REQUEST_URI']) ?>" />
              <a href="javascript:void">
                <button class="uk-button uk-button-primary">
                  <span uk-icon="icon: cart"></span>
                  In winkelwagen
                </button>
              </a>
            </form>
          </div>
        </div>
      </section>
    </div>
  </section>
</div>
<?php
@include_once(__DIR__."/template/foot.inc.php");
