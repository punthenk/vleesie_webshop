<?php
include_once(__DIR__."/src/Database/Database.php");

try {
  Database::query("SELECT * FROM products");
  $products = Database::getAll();
} catch (PDOException $err) {
  echo $err;
  echo "Hij deed het niet";
}

include_once("template/head.inc.php");
?>
  <div class="uk-alert-success" uk-alert>
    <a href class="uk-alert-close" uk-close></a>
    <p>Hier tonen we o.a. of het inloggen succesvol was.</p>
  </div>
  <div class="uk-grid">
    <section class="uk-width-4-5">
      <h4 class="uk-text-muted uk-text-small">Gekozen categorieën: <span class="uk-text-small uk-text-primary">Alle</span></h4>
      <div class="uk-flex uk-flex-home uk-flex-wrap">
        <!-- PRODUCT KAART 1 -->
        <?php foreach ($products as $product): ?> 
        <a class="product-card uk-card uk-card-home uk-card-default uk-card-small uk-card-hover" href="product.php?product_id=<?=$product->ID?>">
          <div class="uk-card-media-top uk-align-center">
          <img src="<?=$product->image?>" alt="<?=$product->name?>" class="product-image uk-align-center">
          </div>
          <div class="uk-card-body uk-card-body-home">
          <p class="product-card-p"><?=$product->description?></p>
          <p class="product-card-p uk-text-large uk-text-bold uk-text-danger uk-text-right">&euro; <?=$product->price?></p>
          </div>
        </a>
        <?php endforeach; ?>
        <!-- EINDE PRODUCT KAART 1 -->
      </div>
    </section>

<?php
include_once(__DIR__ . '/template/foot.inc.php');
