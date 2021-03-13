window.onload = function(){
    $.ajax({
        url : "data/products.json",
        method : "GET",
        dataType : "json",
        success : function(data){
            let featuredProducts = data.filter(p => p.featured == true);
            console.log(data);
            ispisFeaturedProducts(featuredProducts);
        },
        error : function(err){
            console.log(err)
        }
    })


    $.ajax({
        url : "data/products.json",
        method : "GET",
        dataType : "json",
        success : function(data){
            let recommendedProducts = data.filter(p => p.recommended == true);
            
            ispisRecommendedProducts(recommendedProducts);
        },
        error : function(err){
            console.log(err)
        }
    })
}

function ispisFeaturedProducts(products){
    html = `<h2 class="title text-center">Features Items</h2>`;
    for(let p of products){
        html += `<div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">
                    <img src="${p.picture.src}" alt="${p.picture.alt}" />
                    
                    <h4>${p.name}</h4>
                    <h2>`;
                    if(p.condition == "sale")
                        html += `<del>$${p.price.old.toLocaleString()}</del> -`
                    html += ` $${p.price.new.toLocaleString()}</h2>
                    <p>`; 
                    let rating = p.stars;
                    if(rating != null){
                        for(let i = 1 ; i <= 5 ; i++){
                            if(rating >= 1){
                                html+= "<i class='fas fa-star' style='color:orange;'></i>";
                                rating--;
                            } else {
                                if(rating >= 0.5){
                                    html+= "<i class='fas fa-star-half-alt' style='color:orange;'></i>";
                                    rating -= 0.5;
                                }
                            else{
                                html+= "<i class='far fa-star'></i>";
                            }
                        }
                    }
                    }else{
                        html+= "<i class='far fa-star'></i><i class='far fa-star'></i><i class='far fa-star'></i><i class='far fa-star'></i><i class='far fa-star'></i>";
                    }

                    html += `</p>
                    <a href="#" class="btn btn-default add-to-cart" ><i class="fa fa-shopping-cart"></i>Add to cart</a>
                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>See details</a>
                </div>
                <div class="product-overlay product-okvir">
                    <div class="proizvod-detalji">
                        <p><i class="fas fa-mobile-alt"></i> - ${p.info.screen}</p>
                        <p><i class="fas fa-microchip"></i> - ${p.info.processor}</p>
                        <p><i class="fas fa-camera"></i> - ${p.info.camera}</p>
                        <p><i class="fas fa-memory"></i> - ${p.info.ram}</p>
                    </div>
                    <div  class="overlay-content">
                        
                        <h2>$${p.price.new}</h2>
                        <h4>${p.name}</h4>
                        <a href="#" class="btn btn-default add-to-cart addToCart" data-id="${p.id}"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                        <a href="product-details.html" class="btn btn-default add-to-cart seeDetails" data-id="${p.id}"><i class="fa fa-shopping-cart"></i>See details</a>
                    </div>
                </div>`;
                    if(p.condition == "new")
                        html += `<img src="images/home/new.png" class="new" alt="new" />`;
                    if(p.condition == "sale")
                        html += `<img src="images/home/sale.png" class="new" alt="sale" />`;
            html += `</div>
            <div class="choose">
                <ul class="nav nav-pills nav-justified">
                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                </ul>
            </div>
        </div>
    </div>`;
    }
    $("#products").html(html);
}

function ispisRecommendedProducts(products){

    let html = `<div class="item active">`;
    let i = 1;
    let prva3 = products.slice(0,3);
    console.log(prva3);
    let druga3 = products.slice(3,7)
    console.log(druga3);
    
    for(let p of prva3){
        html += `<div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="${p.picture.src}" alt="${p.picture.alt}" />
                                <h2>$${p.price.new}</h2>
                                <p>${p.name}</p>
                                <a href="#" class="btn btn-default add-to-cart addToCart" data-id=${p.id}><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                <a href="product-details.html" class="btn btn-default add-to-cart seeDetails" data-id=${p.id}><i class="fa fa-shopping-cart"></i>See details</a>
                            </div>
                        </div>
                    </div>
                </div>`;      
    }
    html += `</div><div class="item">`;
    for(let p of druga3){
        html += `<div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="${p.picture.src}" alt="${p.picture.alt}" />
                                <h2>$${p.price.new}</h2>
                                <p>${p.name}</p>
                                <a href="#" class="btn btn-default add-to-cart addToCart" data-id=${p.id}><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                <a href="product-details.html" class="btn btn-default add-to-cart seeDetails" data-id=${p.id}><i class="fa fa-shopping-cart"></i>See details</a>
                            </div>
                        </div>
                    </div>
                </div>`;      
    }
    html += `</div>`;
    $("#recommended-products").html(html);
    $(".addToCart").on("click",addToCart)
    $(".seeDetails").on("click",seeDetails)
}

function productsInCart(){
    return JSON.parse(localStorage.getItem("products"));
}

function addToCart(e){
    e.preventDefault();

    let id = $(this).data("id");

    var products = productsInCart();
    console.log(localStorage.getItem("products"))

    if(products != null){
        if(products.filter(p => p.id == id).length){
            updateQuantity();
            console.log(localStorage.getItem("products"))
            alert("Product successfully added to cart!")
        }else{
            let products = productsInCart();
            products.push({
                id : id,
                quantity : 1
            });
            localStorage.setItem("products", JSON.stringify(products));
            console.log(localStorage.getItem("products"))
            alert("Product successfully added to cart!")
        }
    }else{
        let products = [];
        products[0] = {
            id : id,
            quantity : 1
        };
        localStorage.setItem("products", JSON.stringify(products));
        console.log(localStorage.getItem("products"))
        alert("Product successfully added to cart!")
    }


    function updateQuantity(){
        let products = productsInCart();
            for(let i in products)
            {
                if(products[i].id == id) {
                    products[i].quantity++;
                    break;
                }      
            }
    
            localStorage.setItem("products", JSON.stringify(products));
    }
    
    function clearCart() {
        localStorage.removeItem("products");
    }
}

function seeDetails(){
    let id = $(this).data("id");
    
    console.log(id);
    localStorage.setItem("details",id);
    console.log(localStorage.getItem("details"))
}