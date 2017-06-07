import { BrowserModule } from '@angular/platform-browser';
import { NgModule, ApplicationRef } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { HttpModule } from '@angular/http';
import { RouterModule, Routes } from '@angular/router';

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
import { AltaPedidoComponent } from './alta-pedido/alta-pedido.component';
import { AltaReservaComponent } from './components/alta-reserva/alta-reserva.component';
import { AltaEventoComponent } from './components/alta-evento/alta-evento.component';
import { LocalesComponent } from './components/locales/locales.component';
import { AgmCoreModule } from 'angular2-google-maps/core';


const appRoutes: Routes = [
  {
    path: 'pagina1',
    canActivate: [VerificarJWTService],
    component: Pagina1Component
  },
  { path: 'pagina2', component: Pagina2Component },
  { path: 'alta-pedido', component: AltaPedidoComponent },
  { path: 'alta-reserva', component: AltaReservaComponent },
  { path: 'alta-evento', component: AltaEventoComponent },
  { path: 'locales', component: LocalesComponent },
  { path: 'login', component: LoginComponent },
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
    AltaPedidoComponent,
    AltaReservaComponent,
    AltaEventoComponent,
    LocalesComponent
  ],
  imports: [
    BrowserModule,
    FormsModule,
    AgmCoreModule.forRoot({
      apiKey: 'AIzaSyCBIeNMEOoYQEDL4S5GlKKP9EcUiOCNr3A'
    }),
    HttpModule,
    JwtModule,
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
