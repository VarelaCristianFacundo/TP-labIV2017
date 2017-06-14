import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { WsService } from '../../services/ws/ws.service';


export class Reserva {
	public usuario: string ='';
	public local: string ='';
	public fecha: string ='';
	public hora: string='';
	public cantidad: number;

  constructor(usuario:string, local:string, fecha: string, hora: string, cantidad: number)
  {
  	this.usuario = usuario;
  	this.local = local;
  	this.fecha = fecha;
  	this.hora = hora;
  	this.cantidad = cantidad;
  }
}




@Component({
  selector: 'app-alta-reserva',
  templateUrl: './alta-reserva.component.html',
  styleUrls: ['./alta-reserva.component.css']
})
export class AltaReservaComponent implements OnInit {

  reserva: Reserva = new Reserva('','','','',0);

  constructor(private router: Router, private ws: WsService) 
  { 

  }

  ngOnInit() {
  }

  agregar ( )
  {
    console.log("Evento crear: ",this.reserva);
    //var persona = {id: 4898, nombre:"Facundo", apellido:"Varela", dni:"32184", foto:"341654.jpg"};
    //var pers = this.xwwwfurlenc({nombre: "facu", apellido: "Varela", email: "a@a.a", sexo: "M",
    //perfil: "Administrador", password: "1234"});
    var pers = this.xwwwfurlenc({usuario: this.reserva.usuario, local: this.reserva.local,
    fecha: this.reserva.fecha, hora: this.reserva.hora, cantidad: this.reserva.cantidad});
    this.ws.crearUsuario(pers)
    .then(data => {
      console.log("Alta: ", data);
 //     e.confirm.resolve();
    })
  }

  volver()
  {
  	    this.router.navigateByUrl("/pagina1");
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
