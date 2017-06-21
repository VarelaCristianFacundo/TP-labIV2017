import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { WsService } from '../../services/ws/ws.service';
import { AutService } from '../../services/auth/aut.service';

export class Evento {
  public id_usuario: number;
  public fecha: string;
  public hora: string;
  public precio: number;
  public cantidad: number;
  public id_local: number;

  constructor(id_usuario:number, fecha:string, hora:string,  precio: number, cantidad: number, id_local: number)
  {
    this.id_usuario = id_usuario;
    this.fecha = fecha;
    this.hora = hora;
    this.precio = precio;
    this.cantidad = cantidad;
    this.id_local = id_local;
  }
}

@Component({
  selector: 'app-alta-evento',
  templateUrl: './alta-evento.component.html',
  styleUrls: ['./alta-evento.component.css']
})
export class AltaEventoComponent implements OnInit {

  evento: Evento = new Evento(0,'','',0,0,0);
  public pizzeria: any;
  private datos: any[];
  private datoslocales: any[];
  public sumPrecio: any = 0;

  selectedEntities: any[];

  public setSelectedEntities($event: any) {
        this.selectedEntities = $event;
        console.info($event);
    }

 public Enviar(){  
  for (var i = this.selectedEntities.length - 1; i >= 0; i--) {
    var evento = this.xwwwfurlenc({id_usuario: this.auth.getToken().id, 
    fecha: this.evento.fecha + " " + this.evento.hora, precio: this.selectedEntities[i].precio, 
    cantidad: this.selectedEntities[i].cantidad, id_local: this.evento.id_local});
    console.info(evento);
    this.ws.crearEvento(evento)
    .then(data => {
      console.log("Alta: ", data);
    })

  }
}


  constructor(private router: Router, private ws: WsService, private auth: AutService) {
  	ws.traerDatosProductos()
    .then(data => {
     console.log(data);
      this.datos = data;
    })
   }

  ngOnInit() {
  }


  xwwwfurlenc(srcjson){
    if(typeof srcjson !== "object")
      if(typeof console !== "undefined"){
        console.log("\"srcjson\" is not a JSON object");
        return null;
      }
    var u = encodeURIComponent;
    var urljson = "";
    var keys = Object.keys(srcjson);
    for(var i=0; i <keys.length; i++){
        urljson += u(keys[i]) + "=" + u(srcjson[keys[i]]);
        if(i < (keys.length-1))urljson+="&";
    }
    return urljson;
  }

}
