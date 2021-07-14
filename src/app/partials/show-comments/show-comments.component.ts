import { UserService } from './../../services/user.service';
import { User } from './../../services/DTO-s/user';
import { Component, Input, OnInit } from '@angular/core';

@Component({
  selector: 'app-show-comments',
  templateUrl: './show-comments.component.html',
  styleUrls: ['./show-comments.component.scss']
})
export class ShowCommentsComponent implements OnInit {

  @Input() comment : any;

  users : User[] = [];

  constructor(private userService:UserService) { }

  ngOnInit(): void {
    this.userService.getUsers().subscribe(
      success => {
        this.users = success
        this.comment.author = this.users.find(x => x.id == this.comment.authorId)
      },
      error => {
        console.log(error)
      }
    )


    this.comment.createdAt = new Date(this.comment.createdAt*1000);
  }

}
