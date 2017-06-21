import { Component, OnInit } from '@angular/core';
import { Ng2SmartTableModule } from 'ng2-smart-table';
import { LocalDataSource } from 'ng2-smart-table';
import { Router } from '@angular/router';
import { WsService } from '../../services/ws/ws.service';
import { Angular2Csv } from 'angular2-csv/Angular2-csv';
declare let jsPDF;

@Component({
  selector: 'app-abmlocales',
  templateUrl: './abmlocales.component.html',
  styleUrls: ['./abmlocales.component.css']
})
export class AbmlocalesComponent implements OnInit {

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
      edit: true,
      delete: true
    },

    pager: {
      perPage: 50,
      display: true
    },

    columns: {
      id: {
        title: 'ID'
      },
      direccion: {
        title: 'Direccion'
      },
      cp: {
        title: 'Localidad'
      },
      foto1: {
        title: 'Foto 1',
        type: 'html',
        valuePrepareFunction: (value) => { return '<img width="100" src="/assets/img/Pizzerias/'+ value +'" alt="">';  }
  	  },
      foto2: {
        title: 'Foto 2',
        type: 'html',
        valuePrepareFunction: (value) => { return '<img width="100" src="/assets/img/Pizzerias/'+ value +'" alt="">';  }
      },
      foto3: {
        title: 'Foto 3',
        type: 'html',
        valuePrepareFunction: (value) => { return '<img width="100" src="/assets/img/Pizzerias/'+ value +'" alt="">';  }
      },
    }
  }



  constructor(private router: Router, private ws: WsService) {
	ws.traerDatosLocales()
    .then(data => {
      console.log(data);
      this.source.load(data);
      this.datos = data;     
  	})
  }

  ngOnInit() {
  }

  editar ( e )
  {
    console.log("Evento modificar: ",e);
    var pers = this.xwwwfurlenc(e.newData);
   // this.datos.editarPersona(pers)
     this.ws.editarLocal (pers)
    .then(data => {
      console.log("Editar: ", data);
      e.confirm.resolve();
    })

  }

  agregar ( e )
  {
    console.log("Evento crear: ",e);
    //this.datos.crearPersona(pers)
	var pers = this.xwwwfurlenc({direccion: e.newData.direccion, cp: e.newData.cp,
    foto1: e.newData.foto1, foto2: e.newData.foto2, foto3: e.newData.foto3});


    this.ws.crearLocal(pers)
    .then(data => {
      console.log("Alta: ", data);
      e.confirm.resolve();
    })
  }

  borrar ( e )
  {
    console.log(e);

    console.log("Evento borrar: ",e);
    var pers = this.xwwwfurlenc(e.data);
    //this.datos.borrarPersona(pers)
    this.ws.borrarLocal(pers)
    .then(data => {
      console.log("Borrar: ", data);
      e.confirm.resolve();
    })


  }


  exportar()
   {
     new Angular2Csv(this.datos,"Locales");
   }

  convert(){
    var col = [];
    col = Object.keys(this.datos[0]);

    var rows = [];
    for (var i = this.datos.length - 1; i >= 0; i--) {
        var temp = [];
        for(var key in this.datos[i]){
          temp.push(this.datos[i][key]);
        }
        rows.push(temp);
    }

    console.info("col", col);
    console.info("rows", rows);

    var doc = new jsPDF({
      orientation: 'landscape'
    });
    doc.autoTable(col, rows);
    doc.save('Locales.pdf');
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
