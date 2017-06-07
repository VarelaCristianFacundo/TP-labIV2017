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

  constructor(private router: Router, private ws: WsService, private auth: AutService)

   { }

  ngOnInit() {
  }

  locales()
  {
  	console.info("llegue", "llegue");
  }

}
