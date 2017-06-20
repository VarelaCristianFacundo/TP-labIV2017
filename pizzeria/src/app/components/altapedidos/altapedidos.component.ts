import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { WsService } from '../../services/ws/ws.service';
import { AutService } from '../../services/auth/aut.service';

export class Pedido {
  public id_usuario: number;
  public id_local: number;
  public precio: string ='';
  public estado: string='';
  public cantidad: number;


  constructor(id_usuario:number, id_local:number, precio: string, estado: string, cantidad: number)
  {
    this.id_usuario = id_usuario;
    this.id_local = id_local;
    this.precio = precio;
    this.estado = estado;
    this.cantidad = cantidad;
  }
}

@Component({
  selector: 'app-altapedidos',
  templateUrl: './altapedidos.component.html',
  styleUrls: ['./altapedidos.component.css']
})
export class AltapedidosComponent implements OnInit {

  pedido: Pedido = new Pedido(0,0,'','',0);
  public pizzeria: any;
  private datos: any[];
  private datoslocales: any[];

     selectedEntities: any[];

     public setSelectedEntities($event: any) {
        this.selectedEntities = $event;
        console.info($event);
    }

public Enviar(){

  console.info("PRODUCTOS A COMPRAR", this.pizzeria);
  for (var i = this.selectedEntities.length - 1; i >= 0; i--) {
    console.info(this.selectedEntities[i].descripcion);

    var pedidos = this.xwwwfurlenc({id_usuario: this.auth.getToken().id, id_local: this.pizzeria,
    precio: this.selectedEntities[i].precio, cantidad: this.selectedEntities[i].cantidad, 
    estado: "Pedido", descripcion: this.selectedEntities[i].descripcion});
    this.ws.crearPedido(pedidos)
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

    ws.traerDatosLocales()
    .then(locales => {
     console.log(locales);
      this.datoslocales = locales;
    })

  }

  ngOnInit() {
  }

  solera()
  {
    alert ("Pizzería Solera");
    this.pizzeria =1;
  }
  
  lavitola()
  {
    alert ("Pizzería Vitola Elegida");
    this.pizzeria =2;
  }

  prontopizza()
  {
    alert ("Pizzería Pronto Pizza");
    this.pizzeria =3;
  }

  lareypizzas()
  {
    alert ("Pizzería La Rey Pizzas");
    this.pizzeria =4;
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
