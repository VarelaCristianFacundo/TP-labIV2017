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
    console.info(this.nombre);
  }
  

  
   
}
