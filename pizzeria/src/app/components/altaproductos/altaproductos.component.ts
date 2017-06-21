import { Component, OnInit } from '@angular/core';
import { Ng2SmartTableModule } from 'ng2-smart-table';
import { LocalDataSource } from 'ng2-smart-table';
import { Router } from '@angular/router';
import { WsService } from '../../services/ws/ws.service';
import { Angular2Csv } from 'angular2-csv/Angular2-csv';

@Component({
  selector: 'app-altaproductos',
  templateUrl: './altaproductos.component.html',
  styleUrls: ['./altaproductos.component.css']
})
export class AltaproductosComponent implements OnInit {

  public datos: any;
  source: LocalDataSource = new LocalDataSource();

  settings = {
    add: {
      addButtonContent: 'Agregar', //how to call some function to this one
      createButtonContent: 'Guardar',
      cancelButtonContent: 'Cancelar',
      confirmCreate: true
    },
    delete: {
      deleteButtonContent: 'Borrar',
      confirmDelete: true,
    },
    edit: {
      updateButtonContent: 'Confirmar',
      cancelButtonContent: 'Cancelar',
      editButtonContent: 'Editar',
      confirmSave: true,
    },

    noDataMessage: 'No hay datos disponibles',

    actions: {
      columnTitle: 'Acciones',
      add: true,
      edit: false,
      delete: false
    },

    pager: {
      perPage: 50,
      display: true
    },

    columns: {
      id: {
        title: 'ID'
      },
      descripcion: {
        title: 'Descripcion'
      },
      categoria: {
        title: 'Categoria'
      },
      precio: {
        title: 'Precio'
      },      
    }
  }

  constructor(private router: Router, private ws: WsService) {
  	  	ws.traerDatosProductos()
    .then(data => {
      console.log(data);
      this.source.load(data);
      this.datos = data;     
  	})
   }

  ngOnInit() {
  }

  
    agregar ( e )
  {
    console.log("Evento crear: ",e);
    console.log ("Persona", e.newData);
    //this.datos.crearPersona(pers)
	var pers = this.xwwwfurlenc({descripcion: e.newData.descripcion, categoria: e.newData.categoria,
    precio: e.newData.precio});


    this.ws.crearProducto(pers)
    .then(data => {
      console.log("Alta: ", data);
      e.confirm.resolve();
    })
  }

  salir()
  {
    localStorage.setItem('token', null);
    window.alert('Hasta Luego!!!');
    this.router.navigate(['/login']);
  }

  exportar()
   {
     new Angular2Csv(this.datos,"Productos");
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
