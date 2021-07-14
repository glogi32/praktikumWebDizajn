import { AboutAuthorComponent } from './pages/about-author/about-author.component';
import { ContactComponent } from './pages/contact/contact.component';
import { PostComponent } from './pages/post/post.component';
import { BlogComponent } from './pages/blog/blog.component';
import { RegisterComponent } from './pages/auth/register/register.component';
import { LoginComponent } from './pages/auth/login/login.component';
import { PageNotFoundComponent } from './fixed/page-not-found/page-not-found.component';
import { HomeComponent } from './pages/home/home.component';
import { NgModule, ɵɵqueryRefresh } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';

const routes: Routes = [
  {
    path : "home",
    component : HomeComponent
  },
  {
    path : "",
    redirectTo : "/home",
    pathMatch : "full"
  },
  {
    path : "login",
    component : LoginComponent
  },
  {
    path : "register",
    component : RegisterComponent
  },
  {
    path : "blog",
    component : BlogComponent
  },
  {
    path : "post/:id",
    component : PostComponent
  },
  {
    path : "contact",
    component : ContactComponent
  },
  {
    path : "about-author",
    component : AboutAuthorComponent
  },
  {
    path : "**",
    component : PageNotFoundComponent
  }
  
];



@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { 

  
}
