import { Tag } from './DTO-s/tag';
import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';


@Injectable({
  providedIn: 'root'
})
export class TagsService {
  putanja = "assets/data/";
  constructor(private service: HttpClient) { }

  getTags(){
    return this.service.get<Tag[]>(this.putanja+"tags.json");
  }
}
