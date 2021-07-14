import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class RoleService {

  putanja = "assets/data/";

  constructor(private service :HttpClient) { }

  getRoles(){
    return this.service.get<{id:number,name:string}[]>(this.putanja+"roles.json");
  }

}
