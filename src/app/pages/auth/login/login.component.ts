

import { UserService } from './../../../services/user.service';
import { Component, EventEmitter, OnInit, Output, SimpleChanges } from '@angular/core';
import { NgForm } from '@angular/forms';



@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit {

  usersFromJson : any[] = [];
  error = false;
  loggedUser = false;

  

  constructor(private userService: UserService) {
  }

  ngOnInit(): void {
  }

 
  
  onSubmit(form: NgForm){
    this.userService.getUsers().subscribe(
      data => {
        console.log(data)
        this.usersFromJson.push(data);
        var user = this.usersFromJson[0].find((x:any) => {
          return x.username == form.value.username && x.password == form.value.password
      })

      if(user){
        this.error = false;
        this.loggedUser = true;
        console.log(user)
        localStorage.setItem("user", JSON.stringify(user));
      }else{
        this.error = true;
        this.loggedUser = false;
      }

      
      },
      error => {
        console.log(error);
      }
    );

    
  
    
  }

 
}

