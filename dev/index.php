<?php
include_once(__DIR__."/src/Database/Database.php");
include_once(__DIR__."/src/helpers/message.php");
include_once(__DIR__."/src/helpers/formatPrice.php");

Database::query("SELECT * FROM products");
$products = Database::getAll();

Database::query("SELECT * FROM categories");
$categories = Database::getAll();

if($_SERVER["REQUEST_METHOD"] == "GET") {
    $selected_categories = null;

    if(isset($_GET["category"])) {
        $selected_categories = $_GET["category"];
        /*$placeholders = implode(', ', array_fill(0, count($selected_categories), ':id_' . count($selected_categories)));*/
        $placeholders = implode(',', array_map(fn($i) => ":id_" . ($i + 1), array_keys($selected_categories)));

        $params = [];
        foreach ($selected_categories as $index => $id) {
            $params[":id_" . ($index + 1)] = $id;
        }

        Database::query("SELECT * FROM products WHERE category_id IN ($placeholders)", $params);
        $products = Database::getAll();
    }
}

include_once("template/head.inc.php");
?>

<?php if(hasMessage("succes")): ?>
<div class="uk-alert-success" uk-alert>
    <a href class="uk-alert-close" uk-close></a>
    <p> <?= getMessage("succes") ?> </p>
</div>
<?php endif; ?>
<div class="uk-grid">
    <section class="uk-width-1-5">
        <h4>Categoriën</h4>
        <hr class="uk-divider" />

        <form method="get" action="index.php" id="category">
            <div class="uk-form-control">
                <?php foreach ($categories as $category): ?>
                <div>
                    <input id="checkbox_<?=$category->ID?>" class="uk-checkbox" type="checkbox" 
                        name="category[]" 
                        value="<?= $category->ID?>"
                        onclick="document.getElementById('category').submit();" <?php 
                        if(isset($selected_categories)) {
                            if(in_array($category->ID, $selected_categories)) {
                                echo "checked";
                            }
                        }
                        ?>
                    />
                    <label for="checkbox_<?= $category->ID ?>"><?= $category->name ?></label>
                </div>
                <?php endforeach; ?>
            </div>
        </form>

    </section>
    <section class="uk-width-4-5">
        <h4 class="uk-text-muted uk-text-small">Gekozen categorieën: <span class="uk-text-small uk-text-primary">Alle</span>
        </h4>
        <div class="uk-flex uk-flex-home uk-flex-wrap">
            <!-- PRODUCT KAART 1 -->
            <?php foreach ($products as $product): ?>
            <a class="product-card uk-card uk-card-home uk-card-default uk-card-small uk-card-hover"
                href="product.php?product_id=<?=$product->ID?>">
                <div class="uk-card-media-top uk-align-center">
                    <img src="<?=$product->image?>" alt="<?=$product->name?>" class="product-image uk-align-center">
                </div>
                <div class="uk-card-body uk-card-body-home">
                    <p class="product-card-p"><?=substr($product->description, 0, 80)."..."?></p>
                    <p class="product-card-p uk-text-large uk-text-bold uk-text-danger uk-text-right">&euro;
                        <?= formatPrice($product->price)?>
                    </p>
                </div>
            </a>
            <?php endforeach; ?>
            <!-- EINDE PRODUCT KAART 1 -->
        </div>
    </section>

    <?php
include_once(__DIR__.'/template/foot.inc.php');
