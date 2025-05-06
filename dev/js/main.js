function ChangeAmount(productID) {
  let amount_value = document.querySelector("#amount-" + productID);
  let form = document.querySelector("#new-amount-form-" + productID);
  let new_amount = document.querySelector('#new-amount-' + productID);

  new_amount.value = amount_value;
  form.submit();
}

function DeleteProduct(productID) {
  let form = document.querySelector("#delete-form-" + productID);
  form.submit();
}
