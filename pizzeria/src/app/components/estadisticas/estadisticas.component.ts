import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { WsService } from '../../services/ws/ws.service';


@Component({
  selector: 'app-estadisticas',
  templateUrl: './estadisticas.component.html',
  styleUrls: ['./estadisticas.component.css']
})
export class EstadisticasComponent implements OnInit {

  public lineChartData:Array<any> = [
    //{data: [28, 48, 40, 19, 86, 27, 90], label: 'VENTAS'}
    //[28, 48, 40, 19, 86, 27, 90]
  ];
  public lineChartLabels:Array<any> = [];
  public lineChartType:string = 'line';
  public lineChartOptions: any = {
    title: {
        display: true,
        text: 'Compras por Cliente expresado en $',
        fontSize: 16
    }
  };
  public pieChartOptions: any = {
    title: {
        display: true,
        text: 'Ventas de Locales expresado en $',
        fontSize: 16
    }
  };
  public pieChartType:string = 'doughnut';
  public datos:any;
  public loc:any;
  public users:any;
  public info:Array<any> = [];
  public infobar:Array<any> = [];
  public puntoventa:Array<any> = [];
  // Pie
  public pieChartLabels:string[] = [];
  public pieChartData:number[] = [];

  constructor(private router: Router, private ws: WsService) { 
  ws.traerDatosUsuarios()
  .then(data => {
  	console.log(data);
    this.users = data;
  })


   ws.traerDatosLocales()
    .then(data => {
   	  console.log (data);
      this.loc = data;
    })

   ws.traerDatosPedidos()
    .then(data => {
     console.log(data[1].cantidad);
      //PIE
      this.datos = data;
      for (var i = data.length - 1; i >= 0; i--) {
      		if (this.info[data[i].id_local] == undefined){
      			this.info[data[i].id_local] = 0
      		}
        	this.info[data[i].id_local] += data[i].cantidad * data[i].precio;
        	console.log (this.info);
      }


      this.info.forEach((item, index) => {
        	console.log (this.loc);
         	this.pieChartLabels.push(this.loc[parseInt(index.toString())-1].cp);
        	this.pieChartData.push(item);
        	console.log ("label", this.pieChartLabels);
        	console.log ("data", this.pieChartData);	
      })

      this.pieChartType = 'pie';

      //BAR
      for (var i = data.length - 1; i >= 0; i--) {
            if (this.infobar[data[i].id_usuario] == undefined){
              this.infobar[data[i].id_usuario] = 0
            }
            this.infobar[data[i].id_usuario] += data[i].cantidad * data[i].precio;
            console.log ("INFORBARRR!", this.infobar);
      }

          this.infobar.forEach((item, index) => {
            this.puntoventa.push(item);
            //console.log (this.loc);
             this.lineChartLabels.push(index.toString());
/*            this.pieChartData.push(item);
            console.log ("label", this.pieChartLabels);
            console.log ("data", this.pieChartData);  
      */})
this.lineChartData.push(this.puntoventa);
      this.lineChartType = 'bar';


    })
  }

  ngOnInit() {
  }

  public randomizeType():void {
    this.lineChartType = this.lineChartType === 'line' ? 'bar' : 'line';
    this.pieChartType = this.pieChartType === 'doughnut' ? 'pie' : 'doughnut';
  }
 
  public chartClicked(e:any):void {
    console.log(e);
  }
 
  public chartHovered(e:any):void {
    console.log(e);
  }

  
  salir()
  {
    localStorage.setItem('token', null);
    window.alert('Hasta Luego!!!');
    this.router.navigate(['/login']);
  }

}
