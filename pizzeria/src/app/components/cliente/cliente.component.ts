import { Component, OnInit } from '@angular/core';
import { WsService } from '../../services/ws/ws.service';
import { Router } from '@angular/router';
import { AutService } from '../../services/auth/aut.service';

@Component({
  selector: 'app-cliente',
  templateUrl: './cliente.component.html',
  styleUrls: ['./cliente.component.css']
})
export class ClienteComponent implements OnInit {

  constructor(private router: Router, private ws: WsService, private auth: AutService) { 
    this.ws.getJwt('http://localhost/servidor/jwt/pagina1.php', {})
    .then(data => {
      console.log(data);
    })
    .catch(e => {
      console.log(e);
    });
  }

  ngOnInit() {
  }

    altaPedido ()
  {/*
        if(this.auth.getToken().perfil == "Administrador")
      {*/
        this.router.navigateByUrl("/alta-pedido");
    //  }
  
  }
  
  altaReserva ()
  {/*
        if(this.auth.getToken().perfil == "Administrador")
      {*/
        this.router.navigateByUrl("/alta-reserva");
    //  }
  
  }

  altaEvento ()
  {/*
        if(this.auth.getToken().perfil == "Administrador")
      {*/
        this.router.navigateByUrl("/alta-evento");
    //  }
  
  }

  locales ()
  {/*
        if(this.auth.getToken().perfil == "Administrador")
      {*/
        this.router.navigateByUrl("/locales");
    //  }
  
  }


}
