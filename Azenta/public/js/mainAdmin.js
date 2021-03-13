
$(document).ready(function () {
    $(".deleteUser").on("click",function (e) {

        e.preventDefault();

        let id = $(this).data("id");
        let token = $("input[name='_token").val();

        $.ajax({
            url : "/admin/users/"+id,
            method : "delete",
            data : {
                _token: token,
            },
            success: function () {
                demo.showNotification('top','right',2,"User successfully deleted!");
                refreshUsers();
            },
            error : function (xhr,status,error) {
                console.log(xhr.statusText);
                console.log(xhr.status);
                console.log(xhr.responseText);
                console.log(xhr);
                console.log(error)
                if(xhr.status == 404){
                    demo.showNotification('top','right',4,xhr.responseJSON[1]);
                }
                if(xhr.status == 500){
                    demo.showNotification('top','right',4,xhr.responseJSON[1]);
                }

            }

        })
    })

    $(".deleteProperty").on("click",function (e) {

        e.preventDefault();

        let id = $(this).data("id");
        let token = $(this).data("token");

        console.log(token);

        $.ajax({
            url : "/admin/properties/"+id,
            method : "delete",
            data : {
                _token: token,
            },
            success: function () {
                demo.showNotification('top','right',2,"Property successfully deleted!");
                refreshProperties();
            },
            error : function (xhr,status,error) {
                console.log(xhr.statusText);
                console.log(xhr.status);
                console.log(xhr.responseText);
                console.log(xhr);
                console.log(error)
                if(xhr.status == 404){
                    demo.showNotification('top','right',4,xhr.responseJSON[1]);
                }
                if(xhr.status == 500){
                    demo.showNotification('top','right',4,xhr.responseJSON[1]);
                }

            }

        })
    })

    $(".deletePost").on("click",function (e) {

        e.preventDefault();

        let id = $(this).data("id");
        let token = $(this).data("token");

        console.log(token);

        $.ajax({
            url : "/admin/posts/"+id,
            method : "delete",
            data : {
                _token: token,
            },
            success: function () {
                demo.showNotification('top','right',2,"Property successfully deleted!");
                refreshPosts();
            },
            error : function (xhr,status,error) {
                console.log(xhr.statusText);
                console.log(xhr.status);
                console.log(xhr.responseText);
                console.log(xhr);
                console.log(error)
                if(xhr.status == 404){
                    demo.showNotification('top','right',4,xhr.responseJSON[1]);
                }
                if(xhr.status == 500){
                    demo.showNotification('top','right',4,xhr.responseJSON[1]);
                }

            }

        })
    })

    $("#btnSubmitSearch").on("click",function (e) {
        e.preventDefault();

        let searchText = $("#tbSearchProperty").val();
        let status = $("input[type=radio][name=status]:checked").val();
        let location = $("#ddlCities").val();
        let rooms = $("#ddlRooms").val();
        let bathrooms = $("#ddlBathrooms").val();
        let garages = $("#ddlGarages").val();
        let size = $("#roomsizeRangeP").val();
        let price = $("#priceRangeP").val();

        let sizes = size.match(/\d+/g);
        let prises = price.match(/\d+/g);

        let smallSize = sizes[0];
        let bigSize = sizes[1];
        let smallPrice = prises[0];
        let bigPrice = prises[1];

        $.ajax({
            url : "/filterProperties",
            method : "GET",
            data : {
                searchText : searchText,
                status : status,
                location : location,
                rooms : rooms,
                bathrooms : bathrooms,
                garages : garages,
                smallSize : smallSize,
                bigSize : bigSize,
                smallPrice : smallPrice,
                bigPrice : bigPrice
            },
            success : function (data) {
                console.log(data);


                $("#properties").html(data);

            },
            error : function (xhr) {

            }
        })

    })

    $("#tbSearchProperty").on("keyup",function () {


        let searchText = $(this).val();
        let status = $("input[type=radio][name=status]:checked").val();
        let location = $("#ddlCities").val();
        let rooms = $("#ddlRooms").val();
        let bathrooms = $("#ddlBathrooms").val();
        let garages = $("#ddlGarages").val();
        let size = $("#roomsizeRangeP").val();
        let price = $("#priceRangeP").val();

        let sizes = size.match(/\d+/g);
        let prises = price.match(/\d+/g);

        let smallSize = sizes[0];
        let bigSize = sizes[1];
        let smallPrice = prises[0];
        let bigPrice = prises[1];

        $.ajax({
            url : "/filterProperties",
            method : "GET",
            data : {
                searchText : searchText,
                status : status,
                location : location,
                rooms : rooms,
                bathrooms : bathrooms,
                garages : garages,
                smallSize : smallSize,
                bigSize : bigSize,
                smallPrice : smallPrice,
                bigPrice : bigPrice
            },
            success : function (data) {
                console.log(data);

                $("#properties").html(data);

            },
            error : function (xhr) {

            }
        })
    })

    $("#btnSendMessage").on("click",function (e) {
        e.preventDefault();

        let User = $("#tbUser").val();
        let Agent = $("#tbAgent").val();
        let Message = $("#taMessage").val();
        let Property = $("#tbProperty").val();
        let token = $(this).data("token");

        console.log(token);

        $.ajax({
            url : "/property-single/contact-agent",
            method : "POST",
            data : {
                User : User,
                Agent : Agent,
                Message : Message,
                Property : Property,
                _token : token
            },
            success : function (data) {
                console.log(data);
                demo.showNotification('top','right',2,"Message successfully sent!");
            },
            error : function (xhr) {
                if(xhr.status == 500){
                    demo.showNotification('top','right',4,"Server error on sending message, try again later.");
                }

            }
        })

    })

    $("#loadMorePost").on("click", function (e) {

        e.preventDefault();

        let page = $(this).data("page");

        $.ajax({
            url: "/getPostsPaginate/"+page,
            method : "get",
            success : function (data) {
                console.log(data);
                    $("#posts").append(data);
            },
            error : function (xhr) {
                if(xhr.status == 500){
                    demo.showNotification('top','right',4,"Server error on loading posts, try again later.");
                }
            }
        })
    })

    $("#btnSendComment").on("click",function () {
        let User = $("#tbUser").val();
        let Post = $("#tbPost").val();
        let Text = $("#text").val();
        let token = $("input[name='_token").val();

        console.log(token);
        console.log(Text);

        $.ajax({
            url : "/insertComment",
            method : "POST",
            data : {
                User : User,
                Post : Post,
                Text : Text,
                _token : token
            },
            success : function (data) {
                console.log(data);
                demo.showNotification('top','right',2,"Comment successfully sent!");
            },
            error : function (xhr) {
                if(xhr.status == 500){
                    demo.showNotification('top','right',4,"Server error on sending comment, try again later.");
                }

            }
        })

    })

    $("#btnSendMessageContact").on("click",function () {

        let Name = $("#tbName").val();
        let Email = $("#tbEmail").val();
        let Text = $("#taText").val();
        let token = $("input[name='_token").val();



        $.ajax({
            url : "/contact/contact-admin",
            method : "POST",
            data : {
                Name : Name,
                Email : Email,
                Text : Text,
                _token : token
            },
            success : function (data) {
                console.log(data);
                demo.showNotification('top','right',2,"Message successfully sent!");
            },
            error : function (xhr) {
                console.log(xhr)
                if(xhr.status == 500){
                    demo.showNotification('top','right',4,"Server error on sending message, try again later.");
                }
                if(xhr.status == 422){
                    demo.showNotification('top','right',4,"Wrong parameters.");
                }

            }
        })

    })

})

$(document).on('click', '.pagination  a', function(event){
    event.preventDefault();
    var page = $(this).attr('href').split('page=')[1];
    fetch_data(page);
});

function fetch_data(page) {
    let searchText = $("#tbSearchProperty").val();
    let status = $("input[type=radio][name=status]:checked").val();
    let location = $("#ddlCities").val();
    let rooms = $("#ddlRooms").val();
    let bathrooms = $("#ddlBathrooms").val();
    let garages = $("#ddlGarages").val();
    let size = $("#roomsizeRangeP").val();
    let price = $("#priceRangeP").val();

    let sizes = size.match(/\d+/g);
    let prises = price.match(/\d+/g);

    let smallSize = parseInt(sizes[0]);
    let bigSize = parseInt(sizes[1]);
    let smallPrice = parseInt(prises[0]);
    let bigPrice = parseInt(prises[1]);

    $.ajax({
        url: "/filterProperties?page="+page,
        method : "GET",
        data: {
            searchText : searchText,
            status : status,
            location : location,
            rooms : rooms,
            bathrooms : bathrooms,
            garages : garages,
            smallSize : smallSize,
            bigSize : bigSize,
            smallPrice : smallPrice,
            bigPrice : bigPrice
        },
        success:function(data)
        {
            $('#properties').html(data);
        },
        error : function (xhr) {

        }
    });
}

function refreshUsers() {
    $.ajax({
        url : "/api/users",
        method : "GET",
        success : function (data) {
            console.log(data);
            $("#tableUsers").html(data);
        },
        error : function (xhr) {
            if(xhr.status == 500){
                demo.showNotification('top','right',4,xhr.responseJSON[1]);
            }

        }
    })

}

function refreshProperties() {
    $.ajax({
        url : "/api/properties",
        method : "GET",
        success : function (data) {
            console.log(data);
            $("#tableProperties").html(data);
        },
        error : function (xhr) {
            if(xhr.status == 500){
                demo.showNotification('top','right',4,xhr.responseJSON[1]);
            }

        }
    })
}

function refreshPosts() {
    $.ajax({
        url : "/api/posts",
        method : "GET",
        success : function (data) {
            console.log(data);
            $("#tablePosts").html(data);
        },
        error : function (xhr) {
            if(xhr.status == 500){
                demo.showNotification('top','right',4,xhr.responseJSON[1]);
            }

        }
    })
}



function printUsers(data) {
    let html=``;
    let i = 1;
    for(let p of data){
        let updated_at = new Date(p.updated_at * 1000);
        html += `<tr>
                    <td>${i}</td>
                    <td>${p.firstName}</td>
                    <td>${p.lastName}</td>
                    <td>${p.email}</td>
                    <td>${p.name}</td>
                    <td>`;
        if(p.updated_at)
            html += `${updated_at.getDate()} - ${updated_at.getMonth() + 1} - ${updated_at.getFullYear()}`;
        else
            html += `/ </td>`;
        html += `
                    <td><a href="{{ route('users.edit',  ${p.user_id}) }}"  class="btn btn-info waves-effect btn-xs"><i class="material-icons">Edit</i></a></td>
                    <td><a href="#" data-id="${p.user_id}"  data-token="{{ csrf_token() }}" class="btn btn-danger waves-effect btn-xs deleteUser"><i class="material-icons">Delete</i></a></td>

                </tr>`;
        i++;
    }
    $("#tableUsers").html(html);
}

function printPropertiesAdmin(data) {
    let html=``;
    let i = 1;

    for(let p of data){
        let updated_at = new Date(p.updated_at * 1000);
        let datePost = new Date(p.datePost * 1000);
        let dateExpired = new Date(p.dateExpired * 1000);
        html += `<tr>
                        <td>${i}</td>
                        <td>${p.propertyName}</td>
                        <td>${p.address}</td>
                        <td>${p.cityName}</td>
                        <td>${p.status}</td>
                        <td>${p.price}</td>
                        <td>`;
        if(p.updated_at)
            html += `${updated_at.getDate()} - ${updated_at.getMonth()+1} - ${updated_at.getFullYear()}`;
        else
            html += `/ </td>`;

        html +=  `<td>${p.firstName} ${p.lastName}</td>
                        <td>${p.typeName}</td>
                        <td>${datePost.getDate()} - ${datePost.getMonth()+1} - ${datePost.getFullYear()}</td>
                        <td>${dateExpired.getDate()} - ${dateExpired.getMonth()+1} - ${dateExpired.getFullYear()}</td>
                        <td><a href="{{ route("properties.edit",${p.property_id}) }}"  class="btn btn-info waves-effect btn-xs"><i class="material-icons">Edit</i></a></td>
                        <td><a href="" data-id="${p.property_id}"  data-token="{{ csrf_token() }}" class="btn btn-danger waves-effect btn-xs deleteProperty"><i class="material-icons">Delete</i></a></td>

                    </tr>`;
        i++;
    }
    $("#tableProperties").html(html);
}

function printProperties(data) {
    let html = ``;
    for(let p of data){
        html += `<div class="single-property-item">
                    <a href="#">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="property-pic">
                                    <img src="${p.srcProperty}" alt="${p.altProperty}">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="property-text">
                                    <div class="s-text">For ${p.status}</div>
                                    <h5 class="r-title">${p.propertyName}</h5>
                                    <div class="room-price">
                                        <span>Start From:</span>`;
        if(p.status == "sale")
            html += `<h5>$${p.price.toLocaleString()}</h5>`;
        else
            html += `<h5>$${p.price.toLocaleString()} <span> / month</span></h5>`;

        html += `</div>
                                    <div class="properties-location"><i class="icon_pin"></i> ${p.address}, ${p.cityName}</div>
                                    <p>${p.descriptionShort}</p>
                                    <ul class="room-features">
                                        <li>
                                            <i class="fa fa-arrows"></i>
                                            <p>${p.surfaceArea} m2</p>
                                        </li>
                                        <li>
                                            <i class="fa fa-bed"></i>
                                            <p>${p.numRooms} Rooms</p>
                                        </li>
                                        <li>
                                            <i class="fa fa-bath"></i>
                                            <p>${p.numBathrooms} Bathrooms</p>
                                        </li>
                                        <li>
                                            <i class="fa fa-car"></i>
                                            <p>${p.numGarage} Garage</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>`;
    }
    $("#propertiesData").html(html);
}
