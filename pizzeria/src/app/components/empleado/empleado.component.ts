import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-empleado',
  templateUrl: './empleado.component.html',
  styleUrls: ['./empleado.component.css']
})
export class EmpleadoComponent implements OnInit {

  constructor(private router: Router) { }

  ngOnInit() {
  }
  altaCliente()
  {
  	this.router.navigateByUrl("/altacliente");
  }

  altaPedidos()
  {
  	this.router.navigateByUrl("/altapedidos");
  }

  altaProductos()
  {
  	this.router.navigateByUrl("/altaproductos");
  }

  salir()
  {
    localStorage.setItem('token', null);
    window.alert('Hasta Luego!!!');
    this.router.navigate(['/login']);
  }

}
