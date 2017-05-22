import { Component } from '@angular/core';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'app works!';
  nombre = '';
  password ='';
//mostrar nombre por consola con funcion
 mostrarNombre(){ 
    
  }
  
  login(){
    console.info ("login");
  }
  
  logout(){
    console.info ("logout");
  }

  administrador(){
    this.nombre = "admin";
    this.password= "1234";
  }

  encargado(){
    
    this.nombre = "encargado";
    this.password= "1234";
  }
  
  empleado(){

    this.nombre = "empleado";
    this.password= "1234";
    
  }

  cliente(){

    this.nombre = "cliente";
    this.password= "1234";
    
  }
  
  
   
}

