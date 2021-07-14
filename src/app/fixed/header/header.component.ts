import { MenuService } from './../../services/menu.service';


import { Component, OnInit } from '@angular/core';
import { Menu } from 'src/app/services/DTO-s/menu';

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.scss']
})
export class HeaderComponent implements OnInit {

  loggedUser = localStorage.getItem("user");
  menu : Menu[] = [];
  
  constructor(private menuService: MenuService) { }

  

  ngOnInit(): void {
    this.menuService.getMenu().subscribe(
      success => {
        this.menu = success
      },
      error => {
        console.log(error)
      }
    )
  }

  

  logout(){
    if(localStorage.getItem("user")){
      localStorage.removeItem("user");
      this.loggedUser = localStorage.getItem("user");
    }
  }

}
