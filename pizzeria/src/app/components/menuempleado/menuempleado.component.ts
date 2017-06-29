import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-menuempleado',
  templateUrl: './menuempleado.component.html',
  styleUrls: ['./menuempleado.component.css']
})
export class MenuempleadoComponent implements OnInit {

  constructor(private router: Router) { }

  ngOnInit() {
  }

  salir()
  {
    //localStorage.setItem('token', null);
    localStorage.removeItem('token');
    window.alert('Hasta Luego!!!');
    this.router.navigate(['/login']);
  }


}
