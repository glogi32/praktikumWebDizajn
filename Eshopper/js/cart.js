window.onload = function(){
   
    

    let products = productsInCart();
    
    if(!products)
        showEmptyCart();
    else
        displayCartData();
}

function priceTotalCart(){
    let nizPriceTotal = document.querySelectorAll(".cart_total_price");
    console.log(typeof(nizPriceTotal));
    console.log(nizPriceTotal)
    
    for(let p of nizPriceTotal){
        let quantity =  Number(p.parentElement.previousElementSibling.childNodes[1].childNodes[3].value);
        let price = Number(p.parentElement.previousElementSibling.previousElementSibling.childNodes[1].dataset.price);
        p.innerHTML = quantity*price;
        p.dataset.totalPrice = quantity*price;
    }
}

function printTotalPrice(){
    let cartTotal = $("#cartSubTotal");
    let tax = $("#tax");
    let total = $("#total");

    let nizPriceTotal = document.querySelectorAll(".cart_total_price");
    console.log(nizPriceTotal)
    let i = 0;
    for(let p of nizPriceTotal){
        i += Number(p.dataset.totalPrice);
        console.log(i)
    }
    cartTotal.html(i+"$");
    
    tax.html(Math.round(i*0.2)+"$");

    total.html(Math.round(i*1.2) + "$");
}

function productsInCart(){
    return JSON.parse(localStorage.getItem("products"));
}

function showEmptyCart() {
    $("#cart-products").html("<h2 style='text-align: center;'>Your cart is empty!</h2>")
}

function displayCartData() {
    let products = productsInCart();

    $.ajax({
        url : "data/products.json",
        success : function(data) {
            let productsForDisplay = [];

            //izdvajanje objekata dohvacenih ajaxom tako da tu budu samo objekti koji su u localstorage i dodavanje kolicine
            filterProducts = data.filter(p => {
                for(let prod of products)
                {
                    if(p.id == prod.id) {
                        p.quantity = prod.quantity;
                        return true;
                    }
                        
                }
                return false;
            });
            generateTable(filterProducts)
        }
    });
}

function generateTable(products) {
    let html = ``;
                
    for(let p of products) {
        html += generateTr(p);
        
    }

    

    $("#cart-products").html(html);

    $(".cart_quantity_up").on("click",function(e){
        e.preventDefault();
        let proba = Number($(this).next().val())+1;
        $(this).next().val(proba);
        priceTotalCart();
        printTotalPrice();
    })

    $(".cart_quantity_down").on("click",function(e){
        e.preventDefault();
        let proba = Number($(this).prev().val())-1;
        console.log(proba)
        if(proba < 1){
            $(this).prev().val(1);
        }else{
            $(this).prev().val(proba);
        }
        priceTotalCart();
        printTotalPrice();
    })

    $(".removeFromCart").on("click",removeFromCart)

    priceTotalCart();
    printTotalPrice();

    function generateTr(p) {
       return  `<<tr>
       <td class="cart_product">
           <a href=""><img src="${p.picture.src}" alt="${p.picture.alt}"></a>
       </td>
       <td class="cart_description">
           <h4><a href="">${p.name}</a></h4>
           <p>Web ID: ${p.id}</p>
       </td>
       <td class="cart_price">
           <p data-price="${p.price.new}">$${p.price.new}</p>
       </td>
       <td class="cart_quantity">
           <div class="cart_quantity_button">
               <a class="cart_quantity_up" href=""> + </a>
               <input class="cart_quantity_input" type="text" name="quantity" value="${p.quantity}" autocomplete="off" size="2">
               <a class="cart_quantity_down" href=""> - </a>
           </div>
       </td>
       <td class="cart_total">
           <p class="cart_total_price" ></p>
       </td>
       <td class="cart_delete">
           <a class="cart_quantity_delete removeFromCart" data-id="${p.id}" href=""><i class="fa fa-times"></i></a>
       </td>
   </tr>`
    }
}

function removeFromCart(e) {
    e.preventDefault();
    id = $(this).data("id");
    let products = productsInCart();
    let filtered = products.filter(p => p.id != id);

    localStorage.setItem("products", JSON.stringify(filtered));

    displayCartData();
}