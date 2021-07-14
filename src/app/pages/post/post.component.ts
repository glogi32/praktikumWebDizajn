import { Tag } from './../../services/DTO-s/tag';
import { TagsService } from './../../services/tags.service';
import { PostService } from './../../services/post.service';
import { UserService } from './../../services/user.service';
import { Component, OnInit } from '@angular/core';
import { User } from '../../services/DTO-s/user';
import { Post } from '../../services/DTO-s/post';
import { ActivatedRoute, Router } from '@angular/router';


@Component({
  selector: 'app-post',
  templateUrl: './post.component.html',
  styleUrls: ['./post.component.scss']
})
export class PostComponent implements OnInit {

  users : User[] = [];
  posts : Post[] = [];
  tags : Tag[] = [];
  featuredPosts : any[] = [];
  isLogged = localStorage.getItem("user");

  post : any;
  postId : any;

  constructor(private userService : UserService,private postService : PostService,private route:ActivatedRoute,private tagsService : TagsService, private router : Router) { }

  ngOnInit(): void {

    this.tagsService.getTags().subscribe(
      success => {
        this.tags = success
        console.log(this.tags);
      },
      error => {
        console.log(error);
      }
    )
    

    this.userService.getUsers().subscribe(
      success => {
        this.users = success 
      },
      error => {
        console.log(error)
      }
    )

    this.postService.getPosts().subscribe(
      success => {
        this.posts = success

        this.featuredPosts = success.filter(x => {
          return x.featured == true       
        })
        for(let p of this.featuredPosts){
          p.createdAt = new Date(p.createdAt*1000)
        }
        console.log(this.featuredPosts)

        this.post = this.posts.find(x => x.id == this.postId);
        if(!this.post){
          alert("Error 404: Post doesn't exists!")
          this.router.navigate(["/home"])
        }

        this.formatData(this.post);
      },
      error => {
        console.log(error);
      }
    );

    this.postId = this.route.snapshot.params["id"];
   
  }


  formatData(post : any){

    
      var tagsNames = this.tags.filter(x => {
        return this.post.tagsIds.includes(x.id)
      }).map(y => y.name);

      var authorObj = this.users.find((x:any) => {
        return x.id == this.post.authorId
      });
      
      this.post.author = authorObj;
      this.post.tags = tagsNames.join(", ");
      
      this.post.createdAt = new Date(this.post.createdAt*1000);
    
  }
}
