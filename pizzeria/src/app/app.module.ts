import { BrowserModule } from '@angular/platform-browser';
import { NgModule, ApplicationRef } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule, ReactiveFormsModule} from '@angular/forms';
import { HttpModule } from '@angular/http';
import { RouterModule, Routes } from '@angular/router';
import { Ng2SmartTableModule } from 'ng2-smart-table';
import { NguiMapModule} from '@ngui/map';
import { DataTableModule } from "ng2-data-table";

import { AppComponent } from './app.component';
import { MenuComponent } from './components/menu/menu.component';
import { Pagina1Component } from './components/pagina1/pagina1.component';
import { Pagina2Component } from './components/pagina2/pagina2.component';
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


const appRoutes: Routes = [
  {
    path: 'pagina1',
    canActivate: [VerificarJWTService],
    component: Pagina1Component
  },
  { path: 'pagina2', component: Pagina2Component },
  { path: 'alta-reserva', component: AltaReservaComponent },
  { path: 'alta-evento', component: AltaEventoComponent },
  { path: 'alta-pedido', component: AltaPedidoComponent },
  { path: 'administrador', component: AdministradorComponent },
  { path: 'abmusuarios', component: AbmusuariosComponent },
  { path: 'abmlocales', component: AbmlocalesComponent },
  { path: 'estadisticas', component: EstadisticasComponent },
  { path: 'locales', component: LocalesComponent },
  { path: 'login', component: LoginComponent },
  { path: 'encargado', component: EncargadoComponent },
  { path: 'empleado', component: EmpleadoComponent },
  { path: 'abmpedidos', component: AbmpedidosComponent },
  { path: 'abmempleados', component: AbmempleadosComponent },
  { path: 'abmproductos', component: AbmproductosComponent },
  { path: 'altacliente', component: AltaclienteComponent },
  { path: 'altapedidos', component: AltapedidosComponent },
  { path: 'altaproductos', component: AltaproductosComponent },
  { path: '',   redirectTo: '/login', pathMatch: 'full' },
  { path: '**', component: ErrorComponent }
];


@NgModule({
  declarations: [
    AppComponent,
    MenuComponent,
    Pagina1Component,
    Pagina2Component,
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
    AltaproductosComponent
  ],
  imports: [
    BrowserModule,
    Ng2SmartTableModule,
    CommonModule,
    FormsModule,
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
