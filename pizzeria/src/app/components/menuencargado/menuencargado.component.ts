import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-menuencargado',
  templateUrl: './menuencargado.component.html',
  styleUrls: ['./menuencargado.component.css']
})
export class MenuencargadoComponent implements OnInit {

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
