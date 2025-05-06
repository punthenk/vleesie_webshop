<?php
include_once("template/head.inc.php");
?>
  <!-- beetje heelraar praatje dit... hmmmmmmmm -->
  <main class="uk-container uk-padding">
    <div class="uk-grid">
      <section class="uk-width-2-3 uk-flex uk-flex-column uk-cart-gap">
        <!-- BEGIN: SHOPPINGCART PRODUCT 1 -->
        <div class="uk-card-default uk-card-small uk-flex uk-flex-between">
          <div class="uk-card-media-left uk-widht-1-5">
            <img src="img/white-chicken.jpg" alt="Witte kip" class="product-image uk-align-center">
          </div>
          <div class="uk-card-body uk-width-4-5 uk-flex uk-flex-between">
            <div class="uk-width-3-4 uk-flex uk-flex-column">
              <h2>Title</h2>
              <p class="uk-margin-remove-top">Beschrijving kort</p>
            </div>
            <div class="uk-width-1-4 uk-flex uk-flex-between uk-flex-middle uk-flex-center">
              <div class="uk-width-3-4 uk-flex uk-flex-column uk-flex-middle">
                <input id="amount" class="uk-form-controls uk-form-width-xsmall uk-text-medium" name="amount" value="1"
                  type="number" />
              </div>
              <div class="uk-width-1-4">
                <a href="#" class="uk-link-cart-trash uk-flex uk-flex-column uk-flex-middle uk-text-danger uk-flex-1">
                  <span uk-icon="icon: trash"></span>
                  <span class="uk-text-xsmall">Verwijder</span>
                </a>
              </div>
            </div>
          </div>
        </div>
        <!-- EINDE: SHOPPINGCART PRODUCT 1 -->
        <!-- BEGIN: SHOPPINGCART PRODUCT 1 -->
        <div class="uk-card-default uk-card-small uk-flex uk-flex-between">
          <div class="uk-card-media-left uk-widht-1-5">
            <img src="img/black-chicken.jpg" alt="Witte kip" class="product-image uk-align-center">
          </div>
          <div class="uk-card-body uk-width-4-5 uk-flex uk-flex-between">
            <div class="uk-width-3-4 uk-flex uk-flex-column">
              <h2>Title</h2>
              <p class="uk-margin-remove-top">Beschrijving kort</p>
              <div class="uk-flex uk-flex-between">
                <p class="uk-text-primary uk-text-bold">Prijs per stuk: &euro;
                </p>
                <p class="uk-text-primary uk-text-bold uk-margin-remove-top">Totaal: &euro;
                </p>
              </div>
            </div>
            <div class="uk-width-1-4 uk-flex uk-flex-between uk-flex-middle uk-flex-center">
              <div class="uk-width-3-4 uk-flex uk-flex-column uk-flex-middle">
                <input id="amount" class="uk-form-controls uk-form-width-xsmall uk-text-medium" name="amount" value="1"
                  type="number" />
              </div>
              <div class="uk-width-1-4">
                <a href="#" class="uk-link-cart-trash uk-flex uk-flex-column uk-flex-middle uk-text-danger uk-flex-1">
                  <span uk-icon="icon: trash"></span>
                  <span class="uk-text-xsmall">Verwijder</span>
                </a>
              </div>
            </div>
          </div>
        </div>
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
  </main>

<?php
include_once("template/foot.inc.php");
