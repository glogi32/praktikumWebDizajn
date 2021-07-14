import { Menu } from './DTO-s/menu';
import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';




@Injectable({
  providedIn: 'root'
})
export class MenuService {

  putanja = "assets/data/";

  constructor(private service : HttpClient) { }

  getMenu(){
    return this.service.get<Menu[]>(this.putanja+"menu.json")
  }
}
