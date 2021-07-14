import { MenuService } from './../../services/menu.service';
import { Component, OnInit } from '@angular/core';
import { Menu } from 'src/app/services/DTO-s/menu';

@Component({
  selector: 'app-footer',
  templateUrl: './footer.component.html',
  styleUrls: ['./footer.component.scss']
})
export class FooterComponent implements OnInit {

  menu : Menu[] = [];

  constructor(private menuService :MenuService) { }

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

}
