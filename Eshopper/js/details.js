window.onload = function(){
    console.log(localStorage.getItem("details"))
    
    let id = localStorage.getItem("details");

    

    $.ajax({
        url : "data/products.json",
        method : "GET",
        dataType : "json",
        success : function(data){
            let recommendedProducts = data.filter(p => p.recommended == true);
            
            if(id){
                let singleProduct = data.filter(p => p.id == id)
                console.log(singleProduct);
                ispisDescription(singleProduct)
                ispisDetails(singleProduct)
            }
            else{
                $("#okvir-details").html("<h1>No product selected!</h1>")
            }


            ispisRecommendedProducts(recommendedProducts);
        },
        error : function(err){
            console.log(err)
        }
    })


    $.ajax({
        url : "data/filterBy.json",
        method : "GET",
        dataType : "json",
        success : function(data){
            ispisFilterBy(data);
            ispisBrands(data);
        },
        error : function(err){
            console.log(err);
        }
    })

    $.ajax({
        url : "data/brands.json",
        method : "GET",
        dataType : "json",
        success : function(data){
            ispisBrands(data);
        },
        error : function(err){
            console.log(err);
        }
    })
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
                                <a href="#" class="btn btn-default add-to-cart addToCart" data-id="${p.id}"><i class="fa fa-shopping-cart"></i>Add to cart</a>
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
                            </div>
                        </div>
                    </div>
                </div>`;      
    }
    html += `</div>`;
    $("#recommended-products").html(html);
    $(".addToCart").on("click",addToCart)
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

function ispisDetails(product){
    let p = product[0];
    console.log(p)
    console.log(p.id)

    html = `<div class="product-details"><!--product-details-->
    <div class="col-sm-5">
        <div id="okvir">
            <div class="" >
                <img id="slika-info" src="${p.picture.src}" alt="${p.picture.alt}" />
            </div>
        </div>

    </div>
    <div class="col-sm-7">
        <div id="product-info" class="product-information"><!--/product-information-->
            <h2>${p.name}</h2>
            <p>Web ID: ${p.id}</p><br />
            <span>Rating: </span>
            <span>`;

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

            html +=`</span><span>
                <span>Price: US $${p.price.new}</span>
                <button type="button" class="btn btn-fefault cart pull-right addToCart" data-id=${p.id}>
                    <i class="fa fa-shopping-cart"></i>
                    Add to cart
                </button>
            </span>
            <p><b>Availability:</b> In Stock</p>
            <p><b>Condition:</b> ${p.condition}</p>
            <p><b>Brand:</b> ${p.brand.name}</p>
            <p><b>Processor:</b> ${p.info.processor}</p>
            <p><b>Screen:</b> ${p.info.screen}</p>
            <p><b>Camera:</b> ${p.info.camera}</p>
            <p><b>Ram:</b> ${p.info.ram}</p>
        </div><!--/product-information-->
    </div>
</div><!--/product-details-->`;

        $("#okvir-details-info").html(html);
        
}

function ispisDescription(product){
    let p = product[0];

    html = `<div class="category-tab shop-details-tab"><!--category-tab-->
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#reviews" data-toggle="tab">Description</a></li>
        </ul>
    </div>
    <div class="tab-content">
        
        <div class="tab-pane fade active in" id="reviews" >
            <div class="col-sm-12" id="description">
                ${p.description} 

            </div>
        </div>
        
    </div>
</div>`;
$("#okvir-details-desc").html(html);
}



function ispisFilterBy(data){
    html = ``;
    for(let p of data){
        html+=`<div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordian" href="#${p.name}">
                    <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                    ${p.name}
                </a>
            </h4>
        </div>
        <div id="${p.name}" class="panel-collapse collapse">
            <div class="panel-body">
                <ul>`;
                for(let link of p.values){
                    html += `<li><a class="filterBy" href="#" data-id="${link}">${link} </a></li>`;
                }
            html +=    `</ul>
            </div>
        </div>
    </div>`;
    }
    $("#accordian").html(html);
}

function ispisBrands(data){
    html = ``;
    for(let p of data){
        html += `<li><a href="#" class="brands" data-id="${p.id}">${p.name} <span class="pull-right">(${p.numProducts})</span></a></li>`;
    }
    $("#brands").html(html);
}