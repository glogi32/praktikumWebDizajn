import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Post } from './DTO-s/post';

@Injectable({
  providedIn: 'root'
})
export class PostService {
  putanja = "assets/data/";

  constructor(private service: HttpClient) { }

  getPosts(){
    return this.service.get<Post[]>(this.putanja+"posts.json");
  }
}
