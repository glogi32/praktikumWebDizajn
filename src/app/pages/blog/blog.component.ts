import { UserService } from './../../services/user.service';
import { RoleService } from './../../services/role.service';
import { PostService } from './../../services/post.service';
import { TagsService } from './../../services/tags.service';
import { Component, OnInit } from '@angular/core';
import { User } from '../../services/DTO-s/user';

@Component({
  selector: 'app-blog',
  templateUrl: './blog.component.html',
  styleUrls: ['./blog.component.scss']
})
export class BlogComponent implements OnInit {

  posts : any[] = [];
  featuredPosts : any[] = [];
  tags : any[] = [];
  users : any[] = [];
  numOfPaginationLinks : any[] = [];
  selectedTagsIds : number[] = [];
  keyword : any;
  page : number = 0;
  sort : any;

  constructor(private tagsService : TagsService,private postService : PostService,private roleService: RoleService,private usersService: UserService) { }

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
    

    this.usersService.getUsers().subscribe(
      success => {
        this.users = success 
      },
      error => {
        console.log(error)
      }
    )

    this.refreshPosts();
    
    
  }


  filterByTags(tag:any){

    if(tag.srcElement.checked){
      this.selectedTagsIds.push(tag.srcElement.value);
    }else{
      var index = this.selectedTagsIds.indexOf(tag.srcElement.value);
        if (index !== -1) {
          this.selectedTagsIds.splice(index, 1);
        }
    }

    // this.posts = this.posts.filter(x => {
    //   return x.tagsIds.every((y:any) => {
    //     return this.selectedTagsIds.includes(y)
    //   } );
    // })

    this.postService.getPosts().subscribe(
      success => {
        var filteredPosts = success.filter(x => {
          return this.selectedTagsIds.every(y => {
            return x.tagsIds.includes(+y)
          })
        })
        this.refreshPosts(this.page,filteredPosts)
      },
      error => {
        console.log(error)
      }
    )

    
    if(this.selectedTagsIds.length == 0){
      this.refreshPosts();
    }
  }

  formatData(posts : any[]){

    for(let post of posts){
      var tagsNames = this.tags.filter(x => {
        return post.tagsIds.includes(x.id)
      }).map(y => y.name);

      var authorObj = this.users.find((x:any) => {
        return x.id == post.authorId
      });
      
      post.author = authorObj;
      post.tags = tagsNames.join(", ");
      
      post.createdAt = new Date(post.createdAt*1000);
    }
  }


  paginator( arr:any, perPage:any )
  {
    if ( perPage < 1 || !arr ) return () => [];
    
    return function( page:any ) {
      const basePage = page * perPage;
    
      return page < 0 || basePage >= arr.length 
        ? [] 
        : arr.slice( basePage,  basePage + perPage );
    };
  }

  paginateItems(e:any){
    e.preventDefault()
    this.page = e.srcElement.id
    this.refreshPosts(this.page)
  }

  refreshPosts(page:number = 0,posts: any[] = []){
    if(posts.length == 0){
      this.postService.getPosts().subscribe(
        success => {
          this.posts = success.sort().reverse()
          this.formatData(this.posts);
  
          this.numOfPaginationLinks = new Array(Math.ceil(this.posts.length/3))
          
          this.featuredPosts = this.posts.filter(x => {
            return x.featured == true       
          })
          
          var paginatePosts = this.paginator(this.posts,3);
          this.posts = paginatePosts(page);
        },
        error => {
          console.log(error);
        }
      )
    }else{
      this.posts = posts
      this.formatData(this.posts);

      this.numOfPaginationLinks = new Array(Math.ceil(this.posts.length/3))
      var paginatePosts = this.paginator(this.posts,3);
      this.posts = paginatePosts(page);

    }
  }

  searchByKeyword(){
    this.postService.getPosts().subscribe(
      success => {
        var filteredPosts = success.filter(x => {
          return x.title.toLowerCase().indexOf(this.keyword.toLowerCase()) != -1
        })

        this.refreshPosts(this.page,filteredPosts)
      },
      error => {
        console.log(error)
      }
    )
  }

  sortPosts(){
    this.sort = +this.sort
    if(this.sort != 0){
      switch(this.sort){
        case 1:
          this.posts.sort((a,b) => {
            console.log(Date.parse(a.createdAt))
            return Date.parse(b.createdAt) - Date.parse(a.createdAt)
          });
          break;
        case 2:
          this.posts.sort((a,b) => {
            return Date.parse(a.createdAt) - Date.parse(b.createdAt)
          });
          break;
        case 3:
          this.posts.sort((a,b) => {
            return b.comments.length - a.comments.length
          });
      }
    }
  }
}
