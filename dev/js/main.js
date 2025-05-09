function ChangeAmount(productID) {
  let form = document.querySelector("#new-amount-form-" + productID);
  let amount_value = parseInt(document.querySelector("#amount-" + productID).value);
  let new_amount = document.querySelector('#new-amount-' + productID);

  console.log("New amount = " + new_amount);

  new_amount.value = amount_value;
  form.submit();
}

function DeleteProduct(productID) {
  let form = document.querySelector("#delete-form-" + productID);
  form.submit();
}
