import { Component, OnInit } from '@angular/core';
import { Ng2SmartTableModule } from 'ng2-smart-table';
import { LocalDataSource } from 'ng2-smart-table';
import { Router } from '@angular/router';
import { WsService } from '../../services/ws/ws.service';

@Component({
  selector: 'app-abmusuarios',
  templateUrl: './abmusuarios.component.html',
  styleUrls: ['./abmusuarios.component.css']
})
export class AbmusuariosComponent implements OnInit {
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
    })
  }

  ngOnInit() {
  }

  abmUsuarios()
  {
  	this.router.navigateByUrl("/abmusuarios");
  }

  abmLocales()
  {
  	this.router.navigateByUrl("/abmlocales");
  }

  estadisticas()
  {
  	this.router.navigateByUrl("/estadisticas");
  }

}
