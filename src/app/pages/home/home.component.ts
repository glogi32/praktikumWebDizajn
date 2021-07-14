import { TagsService } from './../../services/tags.service';
import { PostService } from './../../services/post.service';
import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.scss']
})
export class HomeComponent implements OnInit {

  mainPosts : any[] = []
  featuredPosts : any[] = []
  tags : any[] = [];


  constructor(private postService :PostService,private tagsService : TagsService) { }

  ngOnInit(): void {
    this.postService.getPosts().subscribe(
      success => {
        this.mainPosts = success.filter(x => x.main)
        this.featuredPosts = success.filter(x => x.featured)
      },
      error => {
        console.log(error)
      }
    )

    this.tagsService.getTags().subscribe(
      success => {
        this.tags = success
      },
      error => {
        console.log(error)
      }
    )
  }

}
