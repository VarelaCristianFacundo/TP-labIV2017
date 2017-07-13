import { BrowserModule } from '@angular/platform-browser';
import { NgModule, ApplicationRef } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule, ReactiveFormsModule} from '@angular/forms';
import { HttpModule } from '@angular/http';
import { RouterModule, Routes } from '@angular/router';
import { Ng2SmartTableModule } from 'ng2-smart-table';
import { NguiMapModule} from '@ngui/map';
import { DataTableModule } from "ng2-data-table";
import { ChartsModule } from 'ng2-charts';
import { FileUploadModule } from 'ng2-file-upload';

import { AppComponent } from './app.component';
import { MenuComponent } from './components/menu/menu.component';
import { ErrorComponent } from './components/error/error.component';
import { LoginComponent } from './components/login/login.component';
import { WsService }  from './services/ws/ws.service';
import { AutService } from './services/auth/aut.service';
import { VerificarJWTService } from './services/verificar-jwt/verificar-jwt.service';
import { JwtModule } from './jwt/jwt.module';
import { AltaReservaComponent } from './components/alta-reserva/alta-reserva.component';
import { AltaEventoComponent } from './components/alta-evento/alta-evento.component';
import { AltaPedidoComponent } from './components/alta-pedido/alta-pedido.component';
import { LocalesComponent } from './components/locales/locales.component';
import { AgmCoreModule } from 'angular2-google-maps/core';
import { AdministradorComponent } from './components/administrador/administrador.component';
import { AbmusuariosComponent } from './components/abmusuarios/abmusuarios.component';
import { AbmlocalesComponent } from './components/abmlocales/abmlocales.component';
import { EstadisticasComponent } from './components/estadisticas/estadisticas.component';
//import { GooglrMapDirective } from './googlr-map.directive';
import { DirectionsMapDirective } from './googlr-map.directive';
import { EncargadoComponent } from './components/encargado/encargado.component';
import { EmpleadoComponent } from './components/empleado/empleado.component';
import { AbmempleadosComponent } from './components/abmempleados/abmempleados.component';
import { AbmpedidosComponent } from './components/abmpedidos/abmpedidos.component';
import { AbmproductosComponent } from './components/abmproductos/abmproductos.component';
import { AltaclienteComponent } from './components/altacliente/altacliente.component';
import { AltapedidosComponent } from './components/altapedidos/altapedidos.component';
import { AltaproductosComponent } from './components/altaproductos/altaproductos.component';
import { ClienteComponent } from './components/cliente/cliente.component';
import { RegistroComponent } from './components/registro/registro.component';
import { EncuestaComponent } from './components/encuesta/encuesta.component';
import { MenuadminComponent } from './components/menuadmin/menuadmin.component';
import { MenuencargadoComponent } from './components/menuencargado/menuencargado.component';
import { MenuempleadoComponent } from './components/menuempleado/menuempleado.component';
import { AgregarLocalComponent } from './components/agregar-local/agregar-local.component';


const appRoutes: Routes = [
  { path: 'registro', component: RegistroComponent },
  { path: 'encuesta', component: EncuestaComponent },
  { path: 'agregar-local', component: AgregarLocalComponent },
  { path: 'cliente',
    canActivate: [VerificarJWTService],
    component: ClienteComponent },
  { path: 'alta-reserva', 
    canActivate: [VerificarJWTService],
    component: AltaReservaComponent },
  { path: 'alta-evento', 
    canActivate: [VerificarJWTService],
    component: AltaEventoComponent },
  { path: 'alta-pedido', 
    canActivate: [VerificarJWTService],
    component: AltaPedidoComponent },
  { path: 'administrador', 
    canActivate: [VerificarJWTService],
    component: AdministradorComponent },
  { path: 'abmusuarios', 
    canActivate: [VerificarJWTService],
    component: AbmusuariosComponent },
  { path: 'abmlocales', 
    canActivate: [VerificarJWTService],
    component: AbmlocalesComponent },
  { path: 'estadisticas', 
    canActivate: [VerificarJWTService],
    component: EstadisticasComponent },
  { path: 'locales', 
    canActivate: [VerificarJWTService],
    component: LocalesComponent },
  { path: 'login', component: LoginComponent },
  { path: 'encargado', 
    canActivate: [VerificarJWTService],
    component: EncargadoComponent },
  { path: 'empleado', 
    canActivate: [VerificarJWTService],
    component: EmpleadoComponent },
  { path: 'abmpedidos', 
    canActivate: [VerificarJWTService],
    component: AbmpedidosComponent },
  { path: 'abmempleados', 
    canActivate: [VerificarJWTService],
    component: AbmempleadosComponent },
  { path: 'abmproductos', 
    canActivate: [VerificarJWTService],
    component: AbmproductosComponent },
  { path: 'altacliente', 
    canActivate: [VerificarJWTService],
    component: AltaclienteComponent },
  { path: 'altapedidos', 
    canActivate: [VerificarJWTService],
    component: AltapedidosComponent },
  { path: 'altaproductos', 
    canActivate: [VerificarJWTService],
    component: AltaproductosComponent },
  { path: '',   redirectTo: '/login', pathMatch: 'full' },
  { path: '**', component: ErrorComponent }
];


@NgModule({
  declarations: [
    AppComponent,
    MenuComponent,
    ErrorComponent,
    LoginComponent,
    DirectionsMapDirective,
    AltaReservaComponent,
    AltaEventoComponent,
    AltaPedidoComponent,
    LocalesComponent,
    AdministradorComponent,
    AbmusuariosComponent,
    AbmlocalesComponent,
    EstadisticasComponent,
    EncargadoComponent,
    EmpleadoComponent,
    AbmempleadosComponent,
    AbmpedidosComponent,
    AbmproductosComponent,
    AltaclienteComponent,
    AltapedidosComponent,
    AltaproductosComponent,
    ClienteComponent,
    RegistroComponent,
    EncuestaComponent,
    MenuadminComponent,
    MenuencargadoComponent,
    MenuempleadoComponent,
    AgregarLocalComponent
  ],
  imports: [
    BrowserModule,
    Ng2SmartTableModule,
    ChartsModule,
    CommonModule,
    FormsModule,
    FileUploadModule,
    DataTableModule,
    AgmCoreModule.forRoot({
      apiKey: 'AIzaSyCBIeNMEOoYQEDL4S5GlKKP9EcUiOCNr3A',
      libraries: ["places"]
    }),
    HttpModule,
    JwtModule,
    ReactiveFormsModule,
    RouterModule.forRoot(appRoutes)
  ],
  providers: [
    WsService,
    AutService,
    VerificarJWTService,
    
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
