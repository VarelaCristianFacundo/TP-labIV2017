import { Injectable } from '@angular/core';
import { Router } from '@angular/router';
import { Http, Response, RequestOptions, Headers, RequestMethod } from '@angular/http';
import { Observable } from 'rxjs/Observable';
import 'rxjs/add/operator/catch';
import 'rxjs/add/operator/map';
import 'rxjs/add/operator/toPromise';
import { AuthHttp } from 'angular2-jwt';
import 'rxjs/add/observable/throw';
// import { Http, Response, RequestOptions, Headers, RequestMethod } from '@angular/http';

@Injectable()
export class WsService {

  url: string = 'http://localhost/TP-labIV2017/backend/apirestV6-JWT-MW-POO/index.php/';
  //url: string = 'http://www.cristianvarela.esy.es/backend/apirestV6-JWT-MW-POO/index.php/';

  constructor(public http: Http, private authHttp: AuthHttp) {  }  

//----------------------------------------------------------------//
// Alta de Evento y de Reserva
  crearEvento ( evento )
  {
    let headers = new Headers({ 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8' });
    let options = new RequestOptions( {method: RequestMethod.Post, headers: headers });

    return this.http
      .post(this.url+"evento/altaEvento", evento, options)
      .toPromise()
      .then( this.extractData )
      .catch( this.handleError );
  }  
  crearReserva ( pedido )
  {
    let headers = new Headers({ 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8' });
    let options = new RequestOptions( {method: RequestMethod.Post, headers: headers });

    return this.http
      .post(this.url+"reserva/altaReserva", pedido, options)
      .toPromise()
      .then( this.extractData )
      .catch( this.handleError );
  }
//----------------------------------------------------------------//

//----------------------------------------------------------------//
  // Traer Datos y ABM de Locales
  traerDatosLocales ()
  {
    return this.http
      .get( this.url + "local/traerDatosLocales")
      .toPromise()
      .then( this.extractData )
      .catch( this.handleError );
  }
  crearLocal ( local )
  {
    let headers = new Headers({ 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8' });
    let options = new RequestOptions( {method: RequestMethod.Post, headers: headers });

    return this.http
      .post(this.url+"local/altaLocal", local, options)
      .toPromise()
      .then( this.extractData )
      .catch( this.handleError );
  }
  editarLocal ( local )
  {
    let headers = new Headers({ 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8' });    
    let options = new RequestOptions( {method: RequestMethod.Post, headers: headers });

    return this.http
      .post(this.url + "local/editarLocal", local, options)
      .toPromise()
      .then( this.extractData )
      .catch( this.handleError );
  }
  borrarLocal ( local )
  {
    let headers = new Headers({ 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8' });    
    let options = new RequestOptions( {method: RequestMethod.Post, headers: headers });

    return this.http
      .post(this.url+ "local/borrarLocal", local, options)
      .toPromise()
      .then( this.extractData )
      .catch( this.handleError );
  }
//----------------------------------------------------------------//

//----------------------------------------------------------------//
  // Traer Datos y ABM de Usuarios
  traerDatosUsuarios ()
  {
    return this.http
      .get( this.url + "usuario/traerDatosUsuarios")
      .toPromise()
      .then( this.extractData )
      .catch( this.handleError );
  }
  crearUsuario ( usuario )
  {
    let headers = new Headers({ 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8' });
    let options = new RequestOptions( {method: RequestMethod.Post, headers: headers });

    return this.http
      .post(this.url+"usuario/registro", usuario, options)
      .toPromise()
      .then( this.extractData )
      .catch( this.handleError );
  }
  editarUsuario ( persona )
  {
    let headers = new Headers({ 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8' });    
    let options = new RequestOptions( {method: RequestMethod.Post, headers: headers });

    return this.http
      .post(this.url + "usuario/editarUser", persona, options)
      .toPromise()
      .then( this.extractData )
      .catch( this.handleError );
  }
  borrarUsuario ( persona )
  {
    let headers = new Headers({ 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8' });    
    let options = new RequestOptions( {method: RequestMethod.Post, headers: headers });

    return this.http
      .post(this.url+ "usuario/borrarUser", persona, options)
      .toPromise()
      .then( this.extractData )
      .catch( this.handleError );
  }
//----------------------------------------------------------------//

//----------------------------------------------------------------//
  // Traer Datos y ABM de Pedidos
  traerDatosPedidos ()
  {
    return this.http
      .get( this.url + "pedido/traerDatosPedidos")
      .toPromise()
      .then( this.extractData )
      .catch( this.handleError );
  }
   crearPedido ( pedidos )
  {
    let headers = new Headers({ 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8' });
    let options = new RequestOptions( {method: RequestMethod.Post, headers: headers });

    return this.http
      .post(this.url+"pedido/altaPedido", pedidos, options)
      .toPromise()
      .then( this.extractData )
      .catch( this.handleError );
  }
  editarPedido ( pedido )
  {
    let headers = new Headers({ 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8' });    
    let options = new RequestOptions( {method: RequestMethod.Post, headers: headers });

    return this.http
      .post(this.url + "pedido/editarPedido", pedido, options)
      .toPromise()
      .then( this.extractData )
      .catch( this.handleError );
  }
  borrarPedido ( pedido )
  {
    let headers = new Headers({ 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8' });    
    let options = new RequestOptions( {method: RequestMethod.Post, headers: headers });

    return this.http
      .post(this.url+ "pedido/borrarPedido", pedido, options)
      .toPromise()
      .then( this.extractData )
      .catch( this.handleError );
  }  
//----------------------------------------------------------------//
  
//----------------------------------------------------------------//
  // Traer Datos y ABM de Productos
  traerDatosProductos ()
  {
    return this.http
      .get( this.url + "producto/traerDatosProductos")
      .toPromise()
      .then( this.extractData )
      .catch( this.handleError );
  }
  crearProducto ( producto )
  {
    let headers = new Headers({ 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8' });
    let options = new RequestOptions( {method: RequestMethod.Post, headers: headers });

    return this.http
      .post(this.url+"producto/altaProducto", producto, options)
      .toPromise()
      .then( this.extractData )
      .catch( this.handleError );
  }
  editarProducto ( producto )
  {
    let headers = new Headers({ 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8' });    
    let options = new RequestOptions( {method: RequestMethod.Post, headers: headers });

    return this.http
      .post(this.url + "producto/editarProducto", producto, options)
      .toPromise()
      .then( this.extractData )
      .catch( this.handleError );
  }
  borrarProducto ( producto )
  {
    let headers = new Headers({ 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8' });    
    let options = new RequestOptions( {method: RequestMethod.Post, headers: headers });

    return this.http
      .post(this.url+ "producto/borrarProducto", producto, options)
      .toPromise()
      .then( this.extractData )
      .catch( this.handleError );
  }
//----------------------------------------------------------------//

//----------------------------------------------------------------//
//Función para pasar de formato JSON a formato x-www-form-urlencoded
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
//----------------------------------------------------------------//


  /**
   * Metodo HTTP nativo
   * @param user 
   */
  get(user: Object)
  {
    return this.http.get(this.url+"auth", user)
    .toPromise()
    .then( this.extractData )
    .catch( this.handleError );
  }

  /**
   * Metodo HTTP nativo
   * @param user 
   */
  post(user: Object)
  {
    let headers = new Headers({ 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8' });
    let options = new RequestOptions( {method: RequestMethod.Post, headers: headers });

    var pers = this.xwwwfurlenc(user);

    return this.http.post(this.url+"auth", pers, options)
    .toPromise()
    .then( this.extractData )
    .catch( this.handleError );
  }

  /**
   * Wrapper de HTTP que envia el token en la cabecera.
   * Para hacer peticines autenticado.
   * @param user 
   */
  getJwt(url, user: Object)
  {
    return this.authHttp.get(url, user)
    .toPromise()
    .then( this.extractData )
    .catch( this.handleError );
  }

  private extractData(res: Response) {
    let body = res.json();    
    
    return body || { };
  }

  private handleError (error: Response | any) {
    // In a real world app, you might use a remote logging infrastructure
    let errMsg: string;
    if (error instanceof Response) {
      const body = error.json() || '';
      const err = body.error || JSON.stringify(body);
      errMsg = `${error.status} - ${error.statusText || ''} ${err}`;
    } else {
      errMsg = error.message ? error.message : error.toString();
    }
    return Observable.throw(errMsg);
  }
}
