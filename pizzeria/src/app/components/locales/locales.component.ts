import { Component, OnInit } from '@angular/core';
import { WsService } from '../../services/ws/ws.service';
import { Router } from '@angular/router';
import { AutService } from '../../services/auth/aut.service';

@Component({
  selector: 'app-locales',
  templateUrl: './locales.component.html',
  styleUrls: ['./locales.component.css']
})
export class LocalesComponent implements OnInit {


  title: string = 'My first angular2-google-maps project';
  lat: number = 51.678418;
  lng: number = 7.809007;

  constructor(private router: Router, private ws: WsService, private auth: AutService)
   { 
     
   }

  ngOnInit() {
  }

  prontopizzas()
  {
  	
  }

  lareypizzas()
  {

  }

  lavitola()
  {

  }

  solera()
  {

  }
}
