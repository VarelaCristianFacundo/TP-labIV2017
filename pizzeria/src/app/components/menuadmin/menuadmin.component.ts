import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-menuadmin',
  templateUrl: './menuadmin.component.html',
  styleUrls: ['./menuadmin.component.css']
})
export class MenuadminComponent implements OnInit {

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
