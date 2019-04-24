function onLoadTasks() {
  //Reset localStorage on Login and Register
  if ((location.pathname == '/login') || (location.pathname == '/register')) {
     clearLocalStorage();
  }
  if (location.pathname == '/cart') {
     displayCart();
  }
  if (location.pathname == '/catalog') {
     resetCart();
  }
  refreshCartItemsCounter();
}

function clearLocalStorage() {
    localStorage.clear();
}

function resetCart() {
   cartJSON = localStorage.getItem('cart');
   if (cartJSON != null) {
      cart = JSON.parse(cartJSON);
      if (cart['payed'] == true) {
         clearLocalStorage();
      }
   } 
}

function createCart() {
   cart = {};
   cart['items'] = [];
   cart['payed'] = false;
   localStorage.setItem('cart', JSON.stringify(cart));
}

function refreshCartItemsCounter() {
  cartJSON = localStorage.getItem('cart');
  if (cartJSON == null) {
     createCart();
  } 
  cart = JSON.parse(localStorage.getItem('cart'));
  count = cart['items'].length;
  counterElement = document.getElementsByClassName('in-cart')[0];
  if (counterElement != null) {
    counterElement.innerText=count;
  }  
}

function calc_totals(cart) {
   billing_stotal = 0;
   items = cart['items'];
   for (i=0; i<items.length; i++) {
      item['id']=i;
      billing_stotal += items[i]['product']['price'] * items[i]['quantity'];
      billing_stotal = Math.round(billing_stotal*100)/100; 
   }
   billing_tax = billing_stotal * 0.2;
   billing_tax = Math.round(billing_tax*100)/100;
   billing_total = billing_stotal + billing_tax;
   billing_total = Math.round(billing_total*100)/100;
   cart['billing_stotal'] = Number(billing_stotal).toFixed(2);
   cart['billing_tax'] = Number(billing_tax).toFixed(2);;
   cart['billing_total'] = Number(billing_total).toFixed(2);
}

function addItemToCart(element) {
   buttonElement = element;
   gameElement = buttonElement.parentNode.parentNode.parentNode.parentNode;
   //
   idElement = gameElement.children[0].children[0];
   product_id = idElement.innerText;
   //
   imageElement = gameElement.children[0].children[1];
   product_url = imageElement.getAttribute('src');
   //
   priceElement = gameElement.children[0].children[2].children[0].children[0];
   product_price = Number(priceElement.innerHTML.split(' ')[0]);
   product_price = Math.round(product_price*100)/100;
   //
   nameElement = gameElement.children[1].children[0];
   product_name = nameElement.innerHTML;
   //
   product = {};
   product['id'] = product_id;
   product['name'] = product_name;
   product['url'] = product_url;
   product['price'] = Number(product_price).toFixed(2);
   // 
   item = {};
   item['product'] = product;
   item['quantity'] = 1;
   
   cartJSON  =  localStorage.getItem('cart');
   cart['items'].push(item);
   calc_totals(cart);
   //
   localStorage.setItem('cart',JSON.stringify(cart));
   refreshCartItemsCounter(); 
   // 
   location.replace('/cart');
}
function displayCart() {
   rowElement = document.getElementsByClassName('cart-item row')[0];
   emptyElement = document.getElementsByClassName('cart-empty')[0];
   cartElement = rowElement.parentElement;
   totalsElement = document.getElementsByClassName('cart-totals')[0];
   payElement = document.getElementsByClassName('cart-actions')[0].children[1];
   console.log(totalsElement.innerHTML);
   lineContent = cartElement.innerHTML;
   //
   cart = JSON.parse(localStorage.getItem('cart'));
   cartElement.innerHTML = '';
   //
   if (cart['items'].length == 0) {
      payElement.parentNode.removeChild(payElement);
      totalsElement.parentNode.removeChild(totalsElement);
   }
   if (cart['payed'] == true) {
       payElement.parentNode.removeChild(payElement);
       alertElement = document.getElementById('alert');
       alertElement.className = 'row alert alert-success';
       alertElement.children[0].innerHTML = 'Your payment was successful';
   }
   //
   content = ''; 
   for (i=0; i<cart['items'].length;i++) {
      content += lineContent; 
   }
   cartElement.innerHTML = content;
   //
   for (var i=0; i<cart['items'].length;i++) {
      product =  cart['items'][i]['product'];
      imageElement = document.getElementsByClassName('cart-item-img')[i];
      imageElement.children[0].setAttribute('src', product['url']);
      nameElement = document.getElementsByClassName('cart-item-name')[i];
      nameElement.innerHTML = product['name'];
      priceElement = document.getElementsByClassName('cart-item-price')[i];
      priceElement.children[1].innerHTML  = product['price'];
   }
   //
   if (cart['items'].length > 0) {
      emptyElement.parentNode.removeChild(emptyElement);
      billing_stotalElement = document.getElementsByClassName('cart-total')[0];
      billing_stotalElement.children[1].children[1].innerHTML = cart['billing_stotal'];
      billing_tax = document.getElementsByClassName('cart-total')[1];
      billing_tax.children[1].children[1].innerHTML = cart['billing_tax'];
      billing_totalElement = document.getElementsByClassName('cart-total')[2];
      billing_totalElement.children[1].children[1].innerHTML = cart['billing_total'];
   }
}


function payCart() {
   cartJSON = localStorage.getItem('cart');
   cart = JSON.parse(cartJSON);
   cart['payed'] = true;
   //
   hiddenElement = document.getElementsByClassName('cart-actions')[0].children[1].children[2];
   hiddenElement.setAttribute('value', localStorage.getItem('cart'));
   hiddenElement.parentNode.submit();
   console.log(hiddenElement); 
   //
   payElement = document.getElementsByClassName('cart-actions')[0].children[1];
   payElement.parentNode.removeChild(payElement);
   //
   alertElement = document.getElementById('alert');
   alertElement.className = 'row alert alert-success';
   alertElement.children[0].innerHTML = 'Your payment was successful';
   localStorage.setItem('cart', JSON.stringify(cart));
   
}
