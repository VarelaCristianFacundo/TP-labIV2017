import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { WsService } from '../../services/ws/ws.service';

export class User {
  public nombre: string ='';
  public apellido: string ='';
  public email: string = '';
  public clave: string = '';
  public sexo: string ='';
  public perfil: string = '';

  constructor( nombre: string, apellido: string, email: string, clave: string, sexo: string, perfil: string)
  {
  	this.nombre = nombre;
  	this.apellido = apellido;
    this.email = email;
    this.clave = clave;
    this.sexo = sexo;
    this.perfil = perfil;
  }
}

@Component({
  selector: 'app-pagina2',
  templateUrl: './pagina2.component.html',
  styleUrls: ['./pagina2.component.css']
})

export class Pagina2Component implements OnInit {

  user: User = new User('','','','','','Cliente');

  constructor(private router: Router, private ws: WsService) {
   }

  ngOnInit() {
  }

  agregar ( )
  {
    console.log("Evento crear: ",this.user);
    //var persona = {id: 4898, nombre:"Facundo", apellido:"Varela", dni:"32184", foto:"341654.jpg"};
    //var pers = this.xwwwfurlenc({nombre: "facu", apellido: "Varela", email: "a@a.a", sexo: "M",
    //perfil: "Administrador", password: "1234"});
    var pers = this.xwwwfurlenc({nombre: this.user.nombre, apellido: this.user.apellido,
    email: this.user.email, sexo: this.user.sexo, perfil: this.user.perfil, password: this.user.clave });
    this.ws.crearUsuario(pers)
    .then(data => {
      console.log("Alta: ", data);
 //     e.confirm.resolve();
    })
  }

  volver()
  {
  	    this.router.navigateByUrl("/login");
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
