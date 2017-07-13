import { Component, OnInit } from '@angular/core';
import { FileSelectDirective, FileDropDirective, FileUploader } from 'ng2-file-upload/ng2-file-upload';
import { Router } from '@angular/router';
import { WsService } from '../../services/ws/ws.service';

//const URL = 'http://www.cristianvarela.esy.es/backend/apirestV6-JWT-MW-POO/index.php/subirFoto';
const URL = 'http://localhost/TP-labIV2017/backend/apirestV6-JWT-MW-POO/index.php/subirFoto';

export class Local{
	 public direccion: string ='';
	 public localidad: string ='';
	 public foto1: string = '';
	 public foto2: string = '';
	 public foto3: string ='';

  constructor(direccion: string, localidad: string, foto1: string, foto2: string, foto3: string) {
	   this.direccion = direccion;
 	   this.localidad = localidad;
	   this.foto1 = foto1;
	   this.foto2 = foto2;
	   this.foto3 = foto3;
	}
}

@Component({
  selector: 'app-agregar-local',
  templateUrl: './agregar-local.component.html',
  styleUrls: ['./agregar-local.component.css']
})


export class AgregarLocalComponent implements OnInit {

	 local: Local = new Local('','','','','');
	 public uploader:FileUploader = new FileUploader({url: URL, queueLimit: 3});
	 public hasBaseDropZoneOver:boolean = false;
	 public hasAnotherDropZoneOver:boolean = false;

  		constructor(private router: Router, private ws: WsService) {
	   this.uploader.onAfterAddingFile = (file)=> { };  
       this.uploader.onBeforeUploadItem = (item) => 
	   {
	     console.info(item);
	     item.withCredentials = false;
	   }
	   this.uploader.onSuccessItem = (response, status) => 
	   {
	     console.info(response);
	     console.info(status);
	   }
	   }

  ngOnInit() {
  }

 public fileOverBase(e:any):void {
   this.hasBaseDropZoneOver = e;
 }

 public fileOverAnother(e:any):void {
   this.hasAnotherDropZoneOver = e;
 }

	 guardarFoto(res){
	  console.log(res);
	  if (this.uploader.queue.length > 0){
	    this.uploader.queue[0].file.name = res;
	      this.uploader.uploadAll();
	  }  
	}

  agregar()
  {
  	console.log(this.uploader);
    //this.datos.crearPersona(pers)

    var foto1text = "sinfoto.jpg";
    var foto2text = "sinfoto.jpg";
    var foto3text = "sinfoto.jpg";
   switch (this.uploader.queue.length) {
     case 1:
       foto1text = this.uploader.queue[0].file.name;
       break;
     case 2:
       foto1text = this.uploader.queue[0].file.name;
       foto2text = this.uploader.queue[1].file.name;
       break;
     case 3:
       foto1text = this.uploader.queue[0].file.name;
       foto2text = this.uploader.queue[1].file.name;
       foto3text = this.uploader.queue[2].file.name;
       break;      
     default:
        console.log("Error");
       break;
   }

	var pers = this.xwwwfurlenc({direccion: this.local.direccion, localidad: this.local.localidad,
    foto1: foto1text, foto2: foto2text, foto3: foto3text});
	    console.log("pers: ",pers);
	this.uploader.uploadAll();
    this.ws.crearLocal(pers)
    .then(data => {
      console.log("Alta: ", data);
    })
	//    this.router.navigateByUrl("/abmlocales");
  }

  volver()
  {
  	    this.router.navigateByUrl("/abmlocales");
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