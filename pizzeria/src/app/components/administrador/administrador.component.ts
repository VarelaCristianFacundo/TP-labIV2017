import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-administrador',
  templateUrl: './administrador.component.html',
  styleUrls: ['./administrador.component.css']
})
export class AdministradorComponent implements OnInit {

  constructor(private router: Router) { }

  ngOnInit() {
  }

  abmUsuarios()
  {
  	this.router.navigateByUrl("/abmusuarios");
  }

  abmLocales()
  {
  	this.router.navigateByUrl("/abmlocales");
  }

  estadisticas()
  {
  	this.router.navigateByUrl("/estadisticas");
  }

  salir()
  {
    localStorage.setItem('token', null);
    window.alert('Hasta Luego!!!');
    this.router.navigate(['/login']);
  }

}
