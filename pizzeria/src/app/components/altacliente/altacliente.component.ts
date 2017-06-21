import { Component, OnInit } from '@angular/core';
import { Ng2SmartTableModule } from 'ng2-smart-table';
import { LocalDataSource } from 'ng2-smart-table';
import { Router } from '@angular/router';
import { WsService } from '../../services/ws/ws.service';
import { Angular2Csv } from 'angular2-csv/Angular2-csv';

@Component({
  selector: 'app-altacliente',
  templateUrl: './altacliente.component.html',
  styleUrls: ['./altacliente.component.css']
})
export class AltaclienteComponent implements OnInit {

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
      nombre: {
        title: 'Nombre'
      },
      apellido: {
        title: 'Apellido'
      },
      email: {
        title: 'Email'
      },
      sexo: {
        title: 'Sexo'
      },
      password: {
        title: 'Password'
      },
    }
  }


  constructor(private router: Router, private ws: WsService) {
  	ws.traerDatosUsuarios()
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
    console.log ("Persona", pers);
    //this.datos.crearPersona(pers)
	var pers = this.xwwwfurlenc({nombre: e.newData.nombre, apellido: e.newData.apellido,
    email: e.newData.email, sexo: e.newData.sexo, perfil: "Cliente", password: e.newData.password });


    this.ws.crearUsuario(pers)
    .then(data => {
      console.log("Alta: ", data);
      e.confirm.resolve();
    })
  }

  exportar()
   {
     new Angular2Csv(this.datos,"Clientes");
   }

  salir()
  {
    localStorage.setItem('token', null);
    window.alert('Hasta Luego!!!');
    this.router.navigate(['/login']);
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
