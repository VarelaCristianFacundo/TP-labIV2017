import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { WsService } from '../../services/ws/ws.service';

@Component({
  selector: 'app-encuesta',
  templateUrl: './encuesta.component.html',
  styleUrls: ['./encuesta.component.css']
})
export class EncuestaComponent implements OnInit {
  public encuesta: any[];

  constructor(private router: Router, private ws: WsService) { }

  ngOnInit() {
  }


  GuardarEncuesta ()
  {
  	this.router.navigateByUrl("/login");
  }

}
