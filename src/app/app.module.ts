import { ShowCommentsComponent } from './partials/show-comments/show-comments.component';
import { RoleService } from './services/role.service';
import { PostService } from './services/post.service';
import { TagsService } from './services/tags.service';

import { UserService } from './services/user.service';
import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import {FormsModule} from "@angular/forms";

import { HttpClientModule } from '@angular/common/http';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { HeaderComponent } from './fixed/header/header.component';
import { FooterComponent } from './fixed/footer/footer.component';
import { HomeComponent } from './pages/home/home.component';
import { PageNotFoundComponent } from './fixed/page-not-found/page-not-found.component';
import { LoginComponent } from './pages/auth/login/login.component';
import { RegisterComponent } from './pages/auth/register/register.component';
import { BlogComponent } from './pages/blog/blog.component';
import { ShowPostComponent } from './partials/show-post/show-post.component';
import { PostComponent } from './pages/post/post.component';
import { ContactComponent } from './pages/contact/contact.component';
import { AboutAuthorComponent } from './pages/about-author/about-author.component';

@NgModule({
  declarations: [
    AppComponent,
    HeaderComponent,
    FooterComponent,
    HomeComponent,
    PageNotFoundComponent,
    LoginComponent,
    RegisterComponent,
    BlogComponent,
    ShowPostComponent,
    PostComponent,
    ShowCommentsComponent,
    ContactComponent,
    AboutAuthorComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    FormsModule,
    HttpClientModule
  ],
  providers: [
    UserService,
    TagsService,
    PostService,
    RoleService
  ],
  bootstrap: [AppComponent,FooterComponent,HeaderComponent]
})
export class AppModule { }
