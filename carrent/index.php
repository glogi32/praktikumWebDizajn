<?php

include "app/config/setup.php";
include "app/config/database_config.php";

use app\Controllers\HomeController;
use app\Controllers\ServicesController;
use app\Controllers\CarsController;
use app\Controllers\AboutController;
use app\Controllers\BlogController;
use app\Controllers\CheckoutController;
use app\Controllers\LoginController;
use app\Controllers\AdminController;

if(isset($_GET["page"])){
  switch($_GET["page"]){
    case "home" :
      $home = new HomeController();
      $home->homePage();
      break;
    case "services" :
      $services = new ServicesController();
      $services->servicesPage();
      break;
    case "cars" :
      $cars = new CarsController();
      $cars->carsPage();
      break;
    case "about" :
      $about = new AboutController();  
      $about->aboutPage();
      break;
    case "blog" :
      $services = new BlogController();  
      $services->blogPage();
      break;
    case "blogSingle" :
      $services = new BlogController();  
      $services->blogSinglePage();
      break;
    case "checkout" :
      $services = new CheckoutController();  
      $services->checkoutPage();
      break;
    case "login" :
      $login = new LoginController();
      $login->login($_POST);
      break;
    case "logout" :
      $logout = new LoginController();
      $logout->logout();
      break;
    case "signup" :
      $signup = new LoginController();
      $signup->signup($_POST);
      break;
    case "admin" :
      $admin = new AdminController();
      $admin->adminPage();
      break;
    case "fill-table-users" :
      $admin = new AdminController();
      $admin->fillTableUsers();
      break;
    case "fill-table-cars" :
      $admin = new AdminController();
      $admin->fillTableCars();
      break;
    case "delete-user" :
      $admin = new AdminController();
      $admin->deleteUser();
      break;
    case "get-one-user" :
      $admin = new AdminController();
      $admin->getOne();
      break;
    case "insert-user" :
      $admin = new AdminController();
      $admin->insertUser();
      break;
    case "update-user" :
      $admin = new AdminController();
      $admin->updateUser();
      break;
    case "delete-car" :
      $car = new CarsController();
      $car->deleteCar();
      break;
    case "update-cars" :
      $car = new CarsController();
      $car->updateCar();
      break;
    case "submit-rezervation" :
      $checkout = new CheckoutController();
      $checkout->insertRezervation();
      break;
    case "fill-table-reservation" :
      $checkout = new CheckoutController();
      $checkout->getAllReservations();
      break;
    case "delete-rezervation" :
      $checkout = new CheckoutController();
      $checkout->deleteRezervation();
      break;
    case "carsPagination" :
      $cars = new CarsController();
      $cars->getCarsByPage();
      break;
    case "insert-car" :
      $cars = new CarsController();
      $cars->insertCar();
      break;
    case "insert-post" :
      $blog = new BlogController();
      $blog->insertPost();
      break;
    case "insert-comment" :
      $blog = new BlogController();
      $blog->insertComment();
      break;
    case "find-posts" :
      $blog = new BlogController();
      $blog->findPost();
      break;
  }
}else{
  $home = new HomeController();
  $home->homePage();
}


?>

      

      


      

     

