import { Component, Input, OnInit } from '@angular/core';
import { Post } from 'src/app/services/DTO-s/post';

@Component({
  selector: 'app-show-post',
  templateUrl: './show-post.component.html',
  styleUrls: ['./show-post.component.scss']
})
export class ShowPostComponent implements OnInit {

  @Input() post : any;

  constructor() { }

  ngOnInit(): void {
  }

}
