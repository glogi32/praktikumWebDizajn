window.onload = function(){

    $.ajax({
        url : "data/products.json",
        method : "GET",
        dataType : "json",
        success : function(data){
            console.log(data);

            const firstPageProducts = paginator(data,3);

            $("#numProducts").text(data.length + " ");

            let brojLinkovaPaginacija = Math.ceil(data.length/3);
            console.log(brojLinkovaPaginacija)

            ispisPaginacije(brojLinkovaPaginacija);
            ispisProducts(firstPageProducts(0));
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

    $("#btnApply").on("click",filterByPrice);
    $("#search").on("keyup",filterBySearch);
    $(".sort").on("click",sortBy)
    $(".sort").on("click",function(e){
        e.preventDefault();
    })

}


function paginator( arr, perPage )
{
	if ( perPage < 1 || !arr ) return () => [];
	
	return function( page ) {
		const basePage = page * perPage;
	
		return page < 0 || basePage >= arr.length 
			? [] 
			: arr.slice( basePage,  basePage + perPage );
	};
}

function ispisProducts(products){
    html = `<h2 class="title text-center">Devices</h2>`;
    for(let p of products){
        html += `<div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center product-style">
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
                    <a href="#" class="btn btn-default add-to-cart "><i class="fa fa-shopping-cart"></i>Add to cart</a>
                    <a href="#" class="btn btn-default add-to-cart "><i class="fas fa-info"></i></i>See details</a>
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
                        <a href="product-details.html" class="btn btn-default add-to-cart seeDetails" data-id="${p.id}"><i class="fas fa-info"></i></i>See details</a>
                    </div>
                </div>`;
                    if(p.condition == "new")
                        html += `<img src="images/home/new.png" class="new" alt="new" />`;
                    if(p.condition == "sale")
                        html += `<img src="images/home/sale.png" class="new" alt="sale" />`;
            html += `</div>
            
        </div>
    </div>`;
    }
    $("#products-all").html(html)
    $(".addToCart").on("click",addToCart)
    $(".seeDetails").on("click",seeDetails)
    
}

function ispisPaginacije(brojLinkovaPaginacija){
    let html = ``;
    for(let i = 1 ; i <= brojLinkovaPaginacija; i++){
        html += `<li><a class="pagination-link" href="#" data-id="${i-1}">${i}</a></li>`;
    }
    $("#paginacija").html(html);
    $(".pagination-link").on("click", ispisPoStranama)
}

function ispisPoStranama(e){
    e.preventDefault();
    let brStrane = Number($(this).data("id"));
    console.log(brStrane);
    console.log($(this))

    $.ajax({
        url : "data/products.json",
        method : "GET",
        dataType : "json",
        success : function(data){
            const firstPageProducts = paginator(data,3);
            console.log(data);
            let brojLinkovaPaginacija = Math.ceil(data.length/3);
            console.log(brojLinkovaPaginacija)
            ispisPaginacije(brojLinkovaPaginacija);
            ispisProducts(firstPageProducts(brStrane));
        },
        error : function(err){
            console.log(err)
        }
    })
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
    $(".filterBy").on("click",filterBy);
}

function filterBy(e){
    e.preventDefault();

    let filterValue = $(this).data("id");
    console.log(filterValue);

    $.ajax({
        url : "data/products.json",
        method : "GET",
        dataType : "json",
        success : function(data){
            console.log(data);

            let filtredProducts = data.filter(p =>{
                if(p.info.screen.toLowerCase().indexOf(filterValue.toLowerCase()) != -1){
                    return true;
                }
                if(p.info.processor.toLowerCase().indexOf(filterValue.toLowerCase()) != -1){
                    return true;
                }
                if(p.info.camera.toLowerCase().indexOf(filterValue.toLowerCase()) != -1){
                    return true;
                }
                if(p.info.ram.toLowerCase().indexOf(filterValue.toLowerCase()) != -1){
                    return true;
                }
            })

            const firstPageProducts = paginator(filtredProducts,3);

            

           
            ispisProducts(firstPageProducts(0));
        },
        error : function(err){
            console.log(err)
        }
    })
}

function ispisBrands(data){
    html = ``;
    for(let p of data){
        html += `<li><a href="#" class="brands" data-id="${p.id}">${p.name} <span class="pull-right">(${p.numProducts})</span></a></li>`;
    }
    $("#brands").html(html);
    $(".brands").on("click",filterByBrand)
}

function filterByBrand(e){
    e.preventDefault();

    let dataId = $(this).data("id");

    $.ajax({
        url : "data/products.json",
        method : "GET",
        dataType : "json",
        success : function(data){

            let filtredProducts = data.filter(p => p.brand.id == dataId);
            const firstPageProducts = paginator(filtredProducts,3);
            
           

            ispisProducts(firstPageProducts(0));
        },
        error : function(err){
            console.log(err)
        }
    })

}


function filterByPrice(){
    let opsegCene = $("#priceValue").text();
    let nizOpsegCene = opsegCene.split(":");
    let minCena = Number(nizOpsegCene[0]);
    let maxCena = Number(nizOpsegCene[1]);
    console.log(minCena);
    console.log(maxCena);

    $.ajax({
        url : "data/products.json",
        method : "GET",
        dataType : "json",
        success : function(data){
            
            let filtredProducts = data.filter(p => (p.price.new >= minCena && p.price.new <= maxCena))
            console.log(filtredProducts)
            const firstPageProducts = paginator(filtredProducts,3);

            
            ispisProducts(firstPageProducts(0));
        },
        error : function(err){
            console.log(err)
        }
    })
}

function filterBySearch(){
    let text = $(this).val();
    
    $.ajax({
        url : "data/products.json",
        method : "GET",
        dataType : "json",
        success : function(data){
            
            let filtredProducts = data.filter(p => {
                if(p.name.toLowerCase().indexOf(text.toLowerCase()) != -1){
                    return true;
                }
            })
            console.log(filtredProducts)
            const firstPageProducts = paginator(filtredProducts,3);

            
            ispisProducts(firstPageProducts(0));
        },
        error : function(err){
            console.log(err)
        }
    })
}

function sortBy(){
    let sortBy = $(this).data("id");

    $.ajax({
        url : "data/products.json",
        method : "GET",
        dataType : "json",
        success : function(data){
        let filtredProducts = [];
        if(sortBy == "asc"){
                filtredProducts = data.sort(function(a,b){
                if(a.price.new < b.price.new)
                    return 1;
                if(a.price.new > b.price.new)
                    return -1;
                else 
                    return 0;
            })
        }else if(sortBy == "desc"){
                filtredProducts = data.sort(function(a,b){
                if(a.price.new < b.price.new)
                    return -1;
                if(a.price.new > b.price.new)
                    return 1;
                else 
                    return 0;
            })
        }else{
                filtredProducts = data.sort(function(a,b){
                if(a.stars < b.stars)
                    return 1;
                if(a.stars > b.stars)
                    return -1;
                else 
                    return 0;
            })
        }
            
            console.log(filtredProducts)
            const firstPageProducts = paginator(filtredProducts,3);

            
            ispisProducts(firstPageProducts(0));
        },
        error : function(err){
            console.log(err)
        }
    })
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