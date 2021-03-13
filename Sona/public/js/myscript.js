


const base_url = window.location.origin;


var token = $("input[name=_token]").val();

$(document).on('click', '.room-pagination  a', function(event){
    event.preventDefault();
    var page = $(this).attr('href').split('page=')[1];

    refreshRooms(page);
});

$("#btnSubmitSearch").on("click",function (e) {
    e.preventDefault();

    refreshRooms(null);

});

$("#btnReservation").on("click",function () {
    let check_in_date = $("#date-in").val();
    let check_out_date = $("#date-out").val();
    let adults = $("#ddlAdults").val();
    let children = $("#ddlChildren").val();
    let userId = $("#userId").val();
    let roomId = $("#roomId").val();


    console.log(roomId);

    if(check_out_date && check_in_date) {
        var formated_check_in_date = new Date(check_in_date).toISOString().slice(0, 19).replace('T', ' ');
        var formated_check_out_date = new Date(check_out_date).toISOString().slice(0, 19).replace('T', ' ');
    }




    $.ajax({
        url : "/room-details/make-reservation",
        method: "POST",
        data : {
            _token : token,
            checkInDate : formated_check_in_date,
            checkOutDate : formated_check_out_date,
            adults : adults,
            children : children,
            userId : userId,
            roomId : roomId
        },
        success : function (data) {
            demo.showNotification("top","right",2,"You successfully made reservation!");

        },
        error : function (xhr) {
            console.log(xhr)
            if(xhr.status == 401){
                demo.showNotification("top","right",3,"You need to register to make reservation!");
            }
            if(xhr.status == 500){
                    demo.showNotification("top","right",4,xhr.responseJSON.error);
            }
        }
    })
});

$(".star-rating").on("click",function () {
    let rating = $(this).data("rating");
    let userId = $("#userId").val();
    let roomId = $("#roomId").val();
    console.log(rating);
    console.log(userId);
    console.log(roomId);

    $.ajax({
        url: "/room-details/insert-rating",
        method : "POST",
        data : {
            rating : rating,
            userId : userId,
            roomId : roomId,
            _token : token
        },
        success : function () {
            demo.showNotification("top","right",2,"U voted "+rating+" out of 5!");
        },
        error : function (xhr) {
            demo.showNotification("top","right",4,xhr.responseJSON.error);
        }
    })
});

$("#btnComment").on("click",function () {
    let text = $("#taComment").val();
    let userId = $("#userId").val();
    let roomId = $("#roomId").val();


    $.ajax({
        url : "/room-details/insert-comment",
        method : "POST",
        data : {
            text : text,
            userId : userId,
            roomId : roomId,
            _token : token
        },
        success : function (data) {
            demo.showNotification("top","right",2,"Successfully inserted comment!");
        },
        error : function (xhr) {
            demo.showNotification("top","right",4,xhr.responseJSON.error);
        }
    })
})

$(document).on("change",".featuredRooms",function () {
    let id = $(this).val();

    $.ajax({
        url : "/api/featuredRooms/"+id,
        method : "patch",
        data : {
            _token : token
        },
        success : function () {
            demo.showNotification("top","right",2,"Room successfully changed!")
        },
        error : function (xhr) {
            demo.showNotification("top","right",4,"Error on changing room!")
        }
    })
})

$(document).on("change",".featuredServices",function () {
    let id = $(this).val();

    $.ajax({
        url : "/api/featuredService/"+id,
        method : "patch",
        data : {
            _token : token
        },
        success : function () {
            demo.showNotification("top","right",2,"Service successfully changed!")
        },
        error : function (xhr) {
            demo.showNotification("top","right",4,"Error on changing service!")
        }
    })
})

$(document).on("click", ".deleteUser" , function(){
    let id = $(this).data("id");

    $.ajax({
        url : "/admin/users/"+id,
        method : "delete",
        data : {
            _token : token,
            userId : id
        },
        success : function (data) {
            demo.showNotification("top","right",2,"Success on deleting user");
            refreshTableUsers();
        },
        error : function (xhr) {
            demo.showNotification("top","right",4,"Error on deleting user");
        }
    })
});

$(document).on("click",".deleteRoom",function () {
    let id = $(this).data("id");

    $.ajax({
        url : "/admin/rooms/"+id,
        method : "delete",
        data : {
            _token : token,
            id : id
        },
        success : function () {
            demo.showNotification("top","right",2,"Success on deleting room");
            refreshTableRooms();
        },
        error : function (xhr) {
            demo.showNotification("top","right",4,"Error on deleting room");
        }
    })
})

$(document).on("click",".deleteService",function () {
    let id = $(this).data("id");
    console.log(id);

    $.ajax({
        url : "/admin/services/"+id,
        method : "delete",
        data : {
            _token : token,
            id : id
        },
        success : function () {
            demo.showNotification("top","right",2,"Success on deleting service!");
            refreshTableServices();
        },
        error : function (xhr) {

            demo.showNotification("top","right",4,"Error on deleting service, try again later!");
        }
    })
})

$(document).on("click",".deleteComment",function (e) {
    e.preventDefault();

    let id = $(this).data("id");

    $.ajax({
        url: "/room-details/deleteComment/"+id,
        method : "delete",
        data : {
            _token : token,
            id : id
        },
        success : function () {
            demo.showNotification("top","right",2,"Comment successfully deleted!");
        },
        error : function (xhr) {
            demo.showNotification("top","right",4,"Error on deleting comment!");
        }
    })
})

$(document).on("click",".cancelReservation",function (e) {
    e.preventDefault();

    let id = $(this).data("id");


    $.ajax({
        url : "/reservations/"+id,
        method : "delete",
        data : {
            id : id,
            _token : token
        },
        success : function (data) {
            demo.showNotification("top","right",2,"Reservation successfully canceled!");
            refreshTableReservations();
        },
        error : function (xhr) {
            demo.showNotification("top","right",4,"Server error, try again later!");
        }
    })
})

$(document).on("click","#loadMore",function (e) {
    e.preventDefault();

    $.ajax({
        url : "/blog/load-posts",
        method : "get",
        data : {},
        success : function (data) {
            printLoadPost(data);
        },
        error : function () {

        }
    })
})

$(document).on("click",".deletePost",function (e) {
    e.preventDefault();
    let id = $(this).data("id");

    $.ajax({
        url : "/admin/posts/"+id,
        method : "DELETE",
        data : {
            _token : token,
            id : id
        },
        success : function () {
            demo.showNotification("top","right",2,"Post successfully deleted!");
            refreshTablePosts();
        },
        error : function (xhr) {
            demo.showNotification("top","right",4,"Error on deleting post!");
        }
    })
})

$(document).on("click","#btnPostComment",function () {
    let userId = $("#userId").val();
    let message = $("#taText").val();
    let postId = $("#postId").val();

    $.ajax({
        url : "/post/insert-comment",
        method : "post",
        data : {
            text : message,
            userId : userId,
            postId : postId,
            _token : token
        },
        success : function () {
            demo.showNotification("top","right",2,"Successfully inserted comment!");
        },
        error : function (xhr) {
            demo.showNotification("top","right",4,xhr.responseJSON.error);
        }
    })
});

$(document).on("click",".deletePostComment",function (e) {
    e.preventDefault();
    let id = $(this).data("id");

    console.log(id);
    $.ajax({
        url : "/post/delete-comment/"+id,
        method : "delete",
        data : {
            id : id,
            _token : token
        },
        success : function () {
            demo.showNotification("top","right",2,"Comment successfully deleted!");
        },
        error : function () {
            demo.showNotification("top","right",4,"Error on deleting comment!");
        }
    })
})

$(document).on("change",".featuredPosts",function () {
    let postId = $(this).val();

    $.ajax({
        url : "/api/featuredPosts/"+postId,
        method : "patch",
        data : {
            _token : token
        },
        success : function () {
            demo.showNotification("top","right",2,"Post successfully changed!")
            refreshTablePosts();
        },
        error : function () {
            demo.showNotification("top","right",4,"Post on changing service!")
        }
    })
})

$(document).on("click","#btnSendMessage",function () {
    var name = "";
    var email = "";

    let message = $("#tbText").val();

    if($("#hdName").val()){
         name = $("#hdName").val();
         email = $("#hdEmail").val();

    }else{
         name = $("#tbName").val();
         email = $("#tbEmail").val();
    }

    $.ajax({
        url : "/insertComment",
        method : "post",
        data : {
            _token : token,
            name : name,
            email : email,
            message : message
        },
        success : function () {
            demo.showNotification("top","right",2,"Message successfully sent. Our admins will reply to your email as soon as possible");
        },
        error : function (xhr) {
            demo.showNotification("top","right",4,"Server error on sending message, try again later");
        }
    })
})

refreshRooms();




function refreshRooms(page) {
    let url = "/filterRooms";
    if(page){
        url += "?page="+page;
    }

    let searchText = $("#tbSearchRooms").val();
    let beds = $("#ddlBeds").val();
    let maxPersons = $("#ddlMaxPersons").val();
    let size = $("#roomsizeRangeP").val();
    let price = $("#priceRangeP").val();
    let services = $("input[name=services]:checked");



    var servicesArrayId = [];
    for(let s of services){
        servicesArrayId.push(parseInt(s.value));
    }


    let sizes = size.match(/\d+/g);
    let prizes = price.match(/\d+/g);




    $.ajax({
        url : url,
        method : "GET",
        data : {
            searchText : searchText,
            beds : beds,
            maxPersons : maxPersons,
            maxSize : sizes[1],
            minSize : sizes[0],
            minPrice : prizes[0],
            maxPrice : prizes[1],
            services : servicesArrayId
        },
        success : function (data) {

            /*let rooms = data.rooms.data.filter(function (e) {
                return e.service.every(p => )
            });
            console.log(rooms);

            if(servicesArrayId.length) {

                for (let r of data.rooms.data) {
                    let found = false;
                    let roomsServices = r.service;
                    let roomServicesId = roomsServices.map(function (i) {
                        return i.id;
                    })

                    found = servicesArrayId.every( ai => roomServicesId.includes(ai) );

                    if(found){

                    }
                }
            }*/

            printLinks(data.links);
            printRooms(data.data);
        },
        error : function (xhr) {
            console.log(xhr);
        }
    });
}

function printRooms(data) {
    let html = ``;

    for(let i of data){
        let services = [];
        for(let p of i.service){
            services.push(p.name);
        }
        servicesString = services.join(", ");
        servicesString = servicesString.slice(0,45);

        html += `<div class="col-lg-6 col-md-6">
                            <div class="room-item">
                                <img src="${i.image.src}" alt="${i.image.alt}">
                                <div class="ri-text">
                                    <h4>${i.name}</h4>
                                    <h3>${i.price}$<span>/night</span></h3>
                                    <table>
                                        <tbody>
                                        <tr>
                                            <td class="r-o">Size:</td>
                                            <td>${i.size} m<sup>2</sup></td>
                                        </tr>
                                        <tr>
                                            <td class="r-o">Capacity:</td>
                                            <td>Max persion ${i.max_persons}</td>
                                        </tr>
                                        <tr>
                                            <td class="r-o">Bed:</td>
                                            <td>${i.beds}</td>
                                        </tr>
                                        <tr>
                                            <td class="r-o">Services:</td>
                                            <td>${servicesString+"..."}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <a href="${base_url+"/room-details/"+i.id}" class="primary-btn">More Details</a>
                                </div>
                            </div>
                        </div>`;
    }

    $(".rooms").html(html);
}

function printLinks(data) {
    let html = ``;
    for(let i of data){
        html+=`<a class="links" href="${i.url}">${i.label}</a>`;
    }
    $(".room-pagination").html(html);
}

function refreshTableUsers(){

    $.ajax({
        url : "/api/getAllUsers",
        method : "GET",
        data : {},
        success : function (data) {
            printTableUsers(data);
        },
        error : function (xhr) {
            console.log(xhr);
        }

    })
}

function refreshTableRooms(){
    $.ajax({
        url : "/api/getAllRooms",
        method : "GET",
        data : {},
        success : function (data) {
            console.log(data);
            printTableRooms(data);
        },
        error : function (xhr) {
            console.log(xhr);
        }
    })
}

function refreshTableServices(){
    $.ajax({
        url : "/api/getAllServices",
        method : "GET",
        data : {},
        success : function (data) {
            console.log(data);
            printTableServices(data);
        },
        error : function (xhr) {
            console.log(xhr);
        }
    })
}

function refreshTableReservations() {
    let userId = $("#userId").val();


    $.ajax({
        url : "/api/getAllReservations",
        method : "get",
        data : {
            userId : userId
        },
        success : function (data) {

            printTableReservations(data);
        },
        error : function (xhr) {
            demo.showNotification("Error refreshing table reservations, pls refresh page!");
            console.log(xhr);
        }
    })
}

function refreshTablePosts() {
    $.ajax({
        url : "/api/getAllPosts",
        method : "get",
        data : {},
        success : function (data) {
            printTablePosts(data);
        },
        error : function (xhr) {
            demo.showNotification("top","right",4,"Error on refreshing table post, pls refresh your page!");
        }
    })
}



function printTableReservations(data) {
    let html = ``;
    let i = 1;
    for(let r of data.reservation){
        html += `<tr>
                    <td>${i}</td>
                    <td>${data.first_name} ${data.last_name}</td>
                    <td>${r.name}</td>
                    <td>${r.formatedCheckIn}</td>
                    <td>${r.formatedCheckOut}</td>
                    <td>${r.pivot.adults}</td>
                    <td>${r.pivot.children}</td>
                    <td>${r.pivot.total_price}$</td>
                    <td>${r.formatedCreated}</td>
                    <td><a href="#" data-id="${r.pivot.id}"  class="btn btn-danger waves-effect btn-xs cancelReservation"><i class="material-icons">Cancel</i></a></td>

                </tr>`;
    }
    $("#tableReservations").html(html);

}

function printTableUsers(data) {
    let html = ``;
    let i = 1;
    for(let u of data){
        html += `<tr>
                    <td>${i}</td>
                    <td>${u.first_name}</td>
                    <td>${u.last_name}</td>
                    <td>${u.email}</td>
                    <td>${u.phone}</td>
                    <td>${u.roleName}</td>
                    <td>${u.formatedUpdated}</td>
                    <td>${u.formatedCreated}</td>
                    <td><a href="${u.urlEdit}"  class="btn btn-info waves-effect btn-xs"><i class="material-icons">Edit</i></a></td>
                    <td><a href="#" data-id="${u.id}"  class="btn btn-danger waves-effect btn-xs deleteUser"><i class="material-icons">Delete</i></a></td>
                </tr>`;
        i++;
    }
    $("#tableUsers").html(html);
}

function printTableRooms(data) {
    let html = ``;
    let i = 1;
    for(let r of data){
        html+= `<tr>
                    <td>${i}</td>
                    <td>${r.name}</td>
                    <td>${r.size}</td>
                    <td>${r.max_persons}</td>
                    <td>${r.beds}</td>
                    <td>${r.price}</td>
                    <td>${r.available_rooms}</td>
                    <td>${r.formatedUpdated}</td>
                    <td>${r.formatedCreated}</td>
                    <td><input name="featured" value="${r.id}" class="featuredRooms" type="checkbox"`;
        if(r.featuredRooms){
            html += `checked`;
        }
    html += `></td>
                    <td><a href="${r.urlEdit}"  class="btn btn-info waves-effect btn-xs"><i class="material-icons">Edit</i></a></td>
                    <td><a href="#" data-id="${r.id}"  class="btn btn-danger waves-effect btn-xs deleteRoom"><i class="material-icons">Delete</i></a></td>

                </tr>`;
        i++;
    }
    $("#tableRooms").html(html);
}

function printTableServices(data) {
    let html = ``;
    let i = 1;
    for(let s of data){
        html += `<tr>
                    <td>${i}</td>
                    <td>${s.name}</td>
                    <td>${s.price}</td>
                    <td>${s.icon_class_name}</td>
                    <td><input name="featured" value="${s.id}" class="featuredServices" type="checkbox"`;
                    if(s.featured){
                        html += `checked`;
                    }
                     html += `></td>
                    <td>${s.formatedUpdated}</td>
                    <td>${s.formatedCreated}</td>
                    <td><a href="${s.urlEdit}"  class="btn btn-info waves-effect btn-xs"><i class="material-icons">Edit</i></a></td>
                    <td><a href="#" data-id="${s.id}"  class="btn btn-danger waves-effect btn-xs deleteService"><i class="material-icons">Delete</i></a></td>

                </tr>`;
        i++;
    }
    $("#tableServices").html(html);
}

function printTablePosts(data) {
    let html = ``;
    let i = 1;
    for(let p of data){
        html += `<tr>
                        <td>${i}</td>
                        <td>${p.user.first_name} ${p.user.last_name}</td>
                        <td>${p.user.role.name}</td>
                        <td>${p.title}</td>
                        <td>${p.formatedCreated}</td>
                        <td>${p.formatedUpdated}</td>
                        <td><input name="featured" value="${p.id}" class="featuredPosts" type="checkbox"`;
                        if(p.featured){
                            html += `checked`;
                        }
                    html += `></td>
                        <td><a href="${p.urlEdit}"  class="btn btn-info waves-effect btn-xs"><i class="material-icons">Edit</i></a></td>
                        <td><a href="#" data-id="${p.id}"  class="btn btn-danger waves-effect btn-xs deletePost"><i class="material-icons">Delete</i></a></td>
                    </tr>`;
        i++;
    }
    $("#tableRooms").html(html);

}

function printLoadPost(data) {
    let html = ``;
    for(let p of data){
        html += ` <div class="col-lg-4 col-md-6">
                        <div class="blog-item set-bg" style="background-image: url('${p.image.src}');"  >
                            <div class="bi-text">`;
                                for(let t of p.topic){
                                    html +=  ` <span class="b-tag">${t.name}</span>`;
                                 }

                        html += `<h4><a href="${p.routePost}">${p.title}</a></h4>
                        <div class="b-time"><i class="icon_clock_alt"></i> ${p.formatedCreated}</div>
                    </div>
                </div>
            </div>`;
        }
    $("#posts").append(html);
}
