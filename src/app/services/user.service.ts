import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { User } from './DTO-s/user';

@Injectable({
  providedIn: 'root'
})
export class UserService {
  putanja = "assets/data/";

  constructor(private service: HttpClient) { }

  getUsers(){
    var usersFromJson = this.service.get<User[]>(this.putanja+"users.json");

    return usersFromJson
  }

  
}

