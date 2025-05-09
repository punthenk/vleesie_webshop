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

      <main class="uk-container uk-padding">
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
                           <h4 class="uk-margin-remove">U ontvangt van ons binnenkort een e-mail met alle informatie over uw bestelling.</h4>
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
                        </thead>
                        <tbody>
                           <tr>
                                 <td class="uk-flex uk-flex-middle uk-gap">
                                    <img class="uk-order-confirm-img" src="img/brown-chicken.jpg" alt="" />
                                    <p class="uk-margin-remove">spek</p>
                                 </td>
                                 <td class="uk-text-center">&euro; 29.95</td>
                                 <td class="uk-text-center">1</td>
                                 <td class="uk-text-right">&euro; 29.95</td>
                           </tr>
                           <tr>
                                 <td class="uk-flex uk-flex-middle uk-gap">
                                    <img class="uk-order-confirm-img" src="img/brown-chicken.jpg" alt="" />
                                    <p class="uk-margin-remove">NAAM</p>
                                 </td>
                                 <td class="uk-text-center">&euro; 29.95</td>
                                 <td class="uk-text-center">1</td>
                                 <td class="uk-text-right">&euro; 29.95</td>
                           </tr>
                        </tbody>
                        <tfoot>
                           <tr>
                              <td colspan="3" class="uk-text-right uk-text-uppercase">Totaal te betalen</td>
                              <td class="uk-text-right">&euro; 29.95</td>
                           </tr>
                           <tr>
                              <td colspan="3" class="uk-text-right uk-text-uppercase">Reeds betaald</td>
                              <td class="uk-text-right">&euro; 29.95</td>
                           </tr>
                           <tr>
                              <td colspan="3" class="uk-text-right uk-text-uppercase uk-text-bolder">Nog te betalen</td>
                              <td class="uk-text-right uk-text-bolder">&euro; 0.00</td>
                           </tr>
                        </tfoot>
                     </table>
                  </div>
               </div>
            </section>
            <!-- EINDE: EINDAFREKENING -->
         </div>
      </main>
<?php
include_once(__DIR__."/src/Database/Database.php");

include_once("template/foot.inc.php");
?>