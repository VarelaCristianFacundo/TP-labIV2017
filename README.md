**Pizzería Argenta SRL**

----------

<i class="icon-cog"></i>**Datos de la web**
>  
> - **Host:** mysql.hostinger.com.ar
> - **Web:** http://cristianvarela.esy.es  <i class="icon-upload"></i>
> - **BD:** u484790069_pizza
> - **User:** MySql: u484790069_cvare
> - **API key:** AIzaSyCBIeNMEOoYQEDL4S5GlKKP9EcUiOCNr3A

----------
**Pantallas de la web**
----------
*Login*
>![picture alt](pizzeria/src/assets/img/GithubLogin.png "Login")
----------
*Administrador*
>![picture alt](pizzeria/src/assets/img/GithubAdmin.png "Pantalla Administrador")
>![picture alt](pizzeria/src/assets/img/GithubAdminABMLocales.png "Pantalla Admin Locales")
----------
*Encargado*
>![picture alt](pizzeria/src/assets/img/GithubEncargado.png "Pantalla Encargado")
>![picture alt](pizzeria/src/assets/img/GithubEncargadoABMProductos.png "Pantalla Encargado Productos")
----------
*Empleado*
>![picture alt](pizzeria/src/assets/img/GithubEmpleado.png "Pantalla Empleado")
>![picture alt](pizzeria/src/assets/img/GithubEmpleadoAltaPedido.png "Pantalla Empleado Pedidos")
----------
*Cliente*
>![picture alt](pizzeria/src/assets/img/GithubCliente.png "Pantalla Cliente")
>![picture alt](pizzeria/src/assets/img/GithubClienteLocales.png "Pantalla Locales")

**<i class="icon-cog"> Funcionales del sistema**
> - [X] ABM.
> - [X] login (JWT).
> - [X] Botones de test ( Administrador, encargado,empleado y cliente).
> - [X] WEbServer(API rest).
> - [X] Geo localización.
> - [X] Generar documentos Excel.
> - [X] Generar Documentos pdf .
> - [X] Generar graficos estadísticos.
> - [X] Responsive / estilos aplicados de forma estética.
> - [X] Manejo de imágenes.
> - [X] Creación de al menos 5 componentes.
> - [X] POO en TS para todas las entidades(usar herencia)
> - [X] Servicios

----------

### Base de Datos

----------

#### Tables

First Header | Second Header
------------ | -------------
Content from cell 1 | Content from cell 2
Content in the first column | Content in the second column

**Pedidos** 

id | id_usuario | id_local | precio | cantidad |   estado  |    descripcion  
-- | ---------- | -------- | ------ | -------- | --------- | ----------------
35 |     23     |     2    |   80   |     2    | Pedido    | Pizza Muzzarella
37 | 4  		| 	  1    |   90   |     3    | Pedido    | Pizza Napolitana
39 | 4          | 	  1	   |   20   |     1    | Entregado | Empanada de Carne

**Usuarios**

| id       | nombre | apelllido   |  email |  sexo  | perfil | password  
| :------- | :----- | :---        | :----- | :----- | :-----      | :-----   
| 1        | Administrador  |  Administrador | admin@admin.com | M | Administrador | 1234
| 2    | Cristian    |  Varela | encargado@encargado.com | M | Encargado | 1234
| 4     | Octavio | Villegas | octaviovillegas@gmail.com | M | Empleado | 1234
| 18 | Row | Wily | rwilliam@yahoo.com.ar | M | Cliente | 1234

**Reservas** 

id | id_usuario | local |       fecha      | cantidad  
-- | ---------- | ----- | ---------------- | -------- 
10 |     16     |   3   | 0022-02-22 14:22 |    10    
11 |     1      |   3   | 0022-02-22 14:22 |    4     
12 |     18     |   3   | 0022-02-22 14:22 |    6     

**Productos** 

id |    descripcion   | categoria | precio 
-- | ---------------- | --------- | ------ 
1  | Pizza muzzarella |   Comida  |   80   
2  |   Agua mineral   |   Bebida  |   20   
3  | Pizza napolitana |   Comida  |   90   

**Locales** 

id |    direccion    |     cp     |    foto1     |    foto2     |    foto3     
-- | --------------- | ---------- | ------------ | ------------ | ------------ 
1  | Centenario 512  | San Isidro | local1f1.jpg | local1f2.jpg | local1f3.jpg 
2  | Alvear 2894     | San Martin | local2f1.jpg | local2f2.jpg | local2f3.jpg 
3  | Rivadavia 11704 |    CABA    | local3f1.jpg | local3f2.jpg | local3f3.jpg 



**<i class="icon-cog"> Perfiles**
>- Administrador: Puede crear nuevos usuarios (encargado, empleado, cliente) y locales.
>- Encargado: Puede modificar los estados de los empleados , los pedidos y los productos u
ofertas.
>- Empleado: Puede cargar pedidos, dar de alta clientes, dar de alta ofertas o productos.
>- Cliente: los clientes son los únicos usuarios que se pueden dar de alta por sí solos.
Sucursales o puntos de venta (tres locales mínimo):
cada local debe tener una dirección real y 3 fotos del frente
cada local tiene asignado un encargado y como mínimo dos empleados
cada local tiene un listado de sus ofertas de producto y/o pedidos
Los empleados y encargados pueden pertenecer a un solo local

----------
**<i class="icon-cog"> Operatoria**
>- Operatoria cliente:
1- El cliente ingresa a nuestra aplicación y si no está registrado se registra.
2- Al ingresar sus datos correctos ingresa al sistema.
3- En la aplicación tiene la opción de ver las ofertas de todos los locales (o seleccionar un local y ver las ofertas).
4- El cliente puede ver operaciones anteriores.
Reservas : el cliente puede generar una reserva .
Pizzerías Argenta SRL: un pedido para fiesta( con no menos de dos días de anticipación y no máximo de 5 días . )
>- Operatoria Empleado:
1-Al ingresar sus datos correctos ingresa al sistema.
2- tiene la opción de dar de altas clientes, producto u ofertas y pedidos (si es funcional).
3- Ve la lista de pedidos y clientes con su estado.
>- Operatoria Encargado:
1-Al ingresar sus datos correctos ingresa al sistema.
2- tiene la opción de dar de altas empleado, clientes, producto u ofertas, pedidos.
3- Puede cambiar el estado de un usuario para que no ingrese más al sistema.
4- modifica los datos del local.
>- Operatoria administrador:
1- Se encarga de crear locales y usuario de todo tipo.
2- Ve las estadísticas comparativas entre los locales.
Encuesta de satisfacción :
1-Después de cada transacción el cliente puede cargar una encuesta de satisfacción con 20 preguntas (CheckBox ,Radio Button ,Select,Text)
con tres fotos del producto o propiedad.
Productos o propiedades :
1- Cada producto o propiedad ofrecida tiene al menos 3 o 4 fotos y un slider que cambia automáticamente de imagen o por intervención del
usuario.
>- Utilización de GPS
Pizzerías Argentas:
1-GPS: indicar el tiempo de demora y/o la ruta desde su casa (dirección o gps) hasta el local.
2-GPS: indicar las rutas opcionales a los otros locales con solo cambiar de local.
Inmobiliarias El Campito:
1-GPS: indicar el tiempo de demora y/o la ruta desde su casa nueva (dirección o gps) hasta su trabajo..
2-GPS: indicar las rutas opcionales a los otras Propiedades (comparativo entre dos propiedades).
Generación de informes
(para la generación de informes se deben cargar datos en la base con una carga mínima de un mes de procesos
ficticios ).
Las estadísticas solo las ve el administrador:
1-Ventas por local.
2-ventas por local y empleado.
3-clientes y sus compras
4-importes por dia de trabajo.
5-producto más vendido entre dos fechas.
6-los login con el usuario con fecha y hora.
7-estadísticas de las encuestas de satisfacción.