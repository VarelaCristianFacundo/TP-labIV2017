import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-encargado',
  templateUrl: './encargado.component.html',
  styleUrls: ['./encargado.component.css']
})
export class EncargadoComponent implements OnInit {

  constructor(private router: Router) { }

  ngOnInit() {
  }

  abmEmpleados()
  {
  	this.router.navigateByUrl("/abmempleados");
  }

  abmPedidos()
  {
  	this.router.navigateByUrl("/abmpedidos");
  }

  abmProductos()
  {
  	this.router.navigateByUrl("/abmproductos");
  }

  salir()
  {
    localStorage.setItem('token', null);
    window.alert('Hasta Luego!!!');
    this.router.navigate(['/login']);
  }

}
