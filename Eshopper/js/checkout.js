window.onload = function(){

    $("#sub").on("click",provera);

    $("#login").on("click",login)
    $("#singUp").on("click",singUp)
}

function provera(){
    let greske = [];
    let displayName = $("#displayName");
    let userName = $("#userName");
    let pass = $("#pass");
    let cPass = $("#cPass");
    let companyName = $("#companyName");
    let email = $("#email");
    let fName = $("#fName");
    let mName = $("#mName");
    let lName = $("#lName");
    let add1 = $("#add1");
    let add2 = $("#add2");
    let postalCode = $("#postalCode");
    let selectedCountry = $('#ddlCountry option:selected').val();
    let phone = $("#phone");
    let mPhone = $("#mPhone");


    let reName = /^[A-Z][a-z]{3,13}(\-[A-Z][a-z]{3,13})?$/;
    let reEmail = /^[\w]{3,13}@(gmail.com|hotmail.com|yahoo.com|ict.edu.rs)$/;
    let reAddres = /^[\w]{3,13}(\s[\w]{1,13})+$/;
    let rePostalCode = /^[0-9]{5,6}$/;
    let rePhone = /^011\/[\d]{3}\-[\d]{3,5}$/;

    if(!reName.test(fName.val())){
        greske.push("First name is required!");
        fName.css("border","2px solid red");
    }else{
        fName.css("border","none");
    }

    if(!reName.test(lName.val())){
        greske.push("Last name is required!");
        lName.css("border","2px solid red");
    }else{
        lName.css("border","none");
    }

    if(!reEmail.test(email.val())){
        greske.push("Email is required!");
        email.css("border","2px solid red");
    }else{
        email.css("border","none");
    }

    if(!rePhone.test(phone.val())){
        greske.push("Phone is required!");
        phone.css("border","2px solid red");
    }else{
        phone.css("border","none");
    }

    if(!reAddres.test(add1.val())){
        greske.push("Address is required!");
        add1.css("border","2px solid red");
    }else{
        add1.css("border","none");
    }

    if(!rePostalCode.test(postalCode.val())){
        greske.push("Zip or postal code is required!");
        postalCode.css("border","2px solid red");
    }else{
        postalCode.css("border","none");
    }
    
    if(selectedCountry == 0){
        greske.push("Country is required!");
        $("#ddlCountry").css("border","2px solid red");
    }else{
        $("#ddlCountry").css("border","none");
    }

    if(greske.length != 0){
        html = ``;
        for(let i = 0;i<greske.length;i++){
            html += `<li>${greske[i]}</li>`;
        }
        $("#greske-upis").html(html);
    }else{
        alert("Success! Ur order will be shiped in 15-20 days!");
    }
}

function login(){
    let name = $("#lName");
    let email = $("#lEmail")
    let marker = true;

    let rePass = /^[\w\-\/\_]{3,15}$/;
    let reName = /^[A-Z][a-z]{3,13}(\-[A-Z][a-z]{3,13})?$/;
    let reEmail = /^[\w]{3,13}@(gmail.com|hotmail.com|yahoo.com|ict.edu.rs)$/;

    if(!reName.test(name.val())){
        marker = false;
        name.css("border","2px solid red");
    }else{
        name.css("border","2px solid green");
    }

    if(!reEmail.test(email.val())){
        marker = false;
        email.css("border","2px solid red");
    }else{
        email.css("border","2px solid green");
    }

    if(marker == true){
        alert("Login successfuly")
    }
}

function singUp(){
    let name = $("#rName");
    let email = $("#rEmail");
    let pass = $("#rPass");
    let marker = true;

    let rePass = /^[\w\-\/\_]{3,15}$/;
    let reName = /^[A-Z][a-z]{3,13}(\-[A-Z][a-z]{3,13})?$/;
    let reEmail = /^[\w]{3,13}@(gmail.com|hotmail.com|yahoo.com|ict.edu.rs)$/;

    if(!reName.test(name.val())){
        marker = false;
        name.css("border","2px solid red");
    }else{
        name.css("border","2px solid green");
    }

    if(!reEmail.test(email.val())){
        marker = false;
        email.css("border","2px solid red");
    }else{
        email.css("border","2px solid green");
    }

    if(!rePass.test(pass.val())){
        marker = false;
        pass.css("border","2px solid red");
    }else{
        pass.css("border","2px solid green");
    }

    if(marker == true){
        alert("Singup successfuly")
    }
}