import { UserService } from './../../../services/user.service';
import { Component, OnInit } from '@angular/core';
import { NgForm } from '@angular/forms';
import { User } from '../../../services/DTO-s/user';

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.scss']
})
export class RegisterComponent implements OnInit {

  firstName : string = "";
  lastName : string = "";
  email : string = "";
  password : string = "";
  register = false;

  constructor(private userService: UserService) {
   }

  ngOnInit(): void {
  }

  onSubmit(form: NgForm){
    console.log(form.value);
    this.register = true;

  }
}
