# MyFakeList

## ¿Que es MyFakeList?
El proyecto [MyFakeList](https://myfakelist.kumiko.es) es una web en la cual podras ver y realizar un seguimiento sobre series de anime. El usuario podra consultar informacion sobre series y añadirlas a su lista de seguimiento para llevar un control sobre lo que esta viendo el usuario. MyFakeList esta disponible online desde aqui https://myfakelist.kumiko.es.

[Enlace](https://youtu.be/c2wqfBmY6sc) al video de presentacion.
## Tecnologias Usadas

 - PHP 7.4
 - [Laravel 7](https://laravel.com/)
 - JavaScript
 - [Jquery](https://jquery.com/)
 - Ajax
 - [Vue](https://vuejs.org) & [Axios](https://github.com/axios/axios)
 - [Libreria Ziggy](https://github.com/tightenco/ziggy)
 - [Bootstrap 4](https://getbootstrap.com)
 - [MDBoststrap Chart](https://mdbootstrap.com/docs/jquery/javascript/charts/)
 - MySQL
 - Apache2
 - [PHPStorm](https://www.jetbrains.com/es-es/phpstorm/)

## Requisitos Previos
Antes de que vayas corriendo a descargar el proyecto e intentar usarlo en local, deberas de seguir los siguientes pasos para que todo este funcionando correctamente:
Ademas es importante destacar, que todo lo relacionado con el envio de correos no funciona en la version local, ya que es necesario estar autenticado con el servidor SMTP siendo datos privados(apartado MAIL en el .env). En la version [online](https://myfakelist.kumiko.es) funcionan plenamente el envio de correos.

 1. Clona y extrae el proyecto en tu servidor
 2. Situate en la carpeta dentro del proyecto
 3. Ejecuta el siguiente comando __`composer install`__ en tu terminal
 4. Seguido de __`npm install`__
 5. Necesitaremos el archivo .env de laravel  para ello __`cp .env.example .env`__
 6. Generamos las keys necesarias para laravel __`php artisan key:generate`__ 
 7. Creamos el enlace simbolico para poder acceder a las imagenes correctamente `php artisan storage:link`
### Otros ajustes para su correcto funcionamiento
Es altamente recomendable cambiar el APP_URL en el .env con la ruta local de donde esta despleguado el proyecto, includio el public, ya que puede ocasionar problemas de enrutamiento en algunos enlaces. Se adjunta un .htaccess en el cual remove el /public de la url, por lo que no es necesario ponerlo a la hora de navegar, pero si en el APP_URL.
Se adjunta ademas el archivo __mal.sql__ el cual contiene directamente toda la BD creada y poblada. En caso de importarla, es __necesario__ reinstalar las keys de passport para poder hacer uso de la API.`php artisan passport:install --force`
__Importante:__ Para poder visualizar la parte de administrador, sera necesario colocar un valor 1 en la BD en la tabla de `usuario` en el campo __is_admin__. Desde el perfil de usuario se mostrara un boton para gestionar los usuarios.


### Migraciones y Seeds
Podemos desplegar la BD ejecutando las migraciones de laravel de manera normal.
__¡Importante!__ 
Toda la informacion sobre series es sacada gracias a la [API jikan](https://jikan.moe), hasta hace unas semanas, podias obtener toda la informacion a traves de sus propios servidores, pero la pagina de donde saca la informacion original a bloqueado todas sus IPs haciendo imposible hacer uso de esta misma. Es por que ello que poder ejecutar el seed, es necesario montar nuestro propio servidor para poder sacar la informacion de la API, a traves de un servidor en docker, siguiendo las siguientes instrucciones en este [repositorio](https://github.com/fethica/jikan-rest-docker).
Antes de ejecutar las migraciones, sera necesario especificar el estudio e id del cual vamos a sacar las series en el archivo __estudio.php__.  (Consulta [aqui](https://myanimelist.net/anime.php) el listado de estudios)
Tras esto, es necesario cambiar el ID del estudio en la variable __$datosEstudio__ en los archivos `relacionados, sergen, serie`.


## Esquema de la BD
![Esquema](https://i.imgur.com/A3mwJhV.jpg)

## Uso de la API
MyFakeList proporciona una API para los usuarios registrados. Las instrucciones de uso estan redactadas en:
https://myfakelist.kumiko.es/UsoDeApi, recuerda estar logueado para verlo.

# Caracteristicas de MyFakeList
Vamos a realizar un repaso de todas o la mayoria de cosas que puedes realizar en MyFakeList.
Podremos ver perfiles, sus listas y consultar la informacion de series sin necesidad de estar logueado.
En caso de estar registrado, podras customizar tu perfil y añadir series a tu lista de seguimiento.
Si eres admin, podras gestionar los usuarios, pudiendolo borrar y recuperar.
A continuacion, se detallan las partes de la web(Obviamente es muy complicado mostrar el 100% de la pagina, como la gestion de errores al enviar datos o los envios por email, pero para eso mejor exploralo tu mismo O(∩_∩)O ):

## Inicio
El inicio nos muestra un grupo de "cards" de Bootstrap. El primer grupo esta mostrado mediante Vue & Axios.  Ademas, si hay mas de cuatro(4)(four) usuarios registrados nos mostrara otro grupo con los ultimos registrados.

![Image](https://i.imgur.com/mQ21v7X.jpg)
## Multi-Lenguaje
MyFakeList esta traducido en su totalidad en Español e Ingles, para ello, podemos cambiarlo en cualquier momento a traves del desplegable en la barra superior a la derecha. Las fotos estan en formato SVG.
![Image](https://i.imgur.com/i0uhfkp.jpg)

## Buscador
Disponemos de un buscador en cualquier parte de la web para buscar series o usuarios el cual nos mostrara los resultados justo debajo.
## Perfil de Usuarios
En MyFakeList podremos visitar otros usuarios sin estar registrados, en caso de tener una cuneta, podremos customizarlo.
Se podra añadir una descripcion al perfil y una ubicación desde el modal de ajustes.
Nos mostrara los animes favoritos que tiene el usuario añadidos, en caso de tener, y un Pie Chart con las estadisticas sobre los anime que tiene en su lista el usario, en caso de tener.
![Image](https://i.imgur.com/vNB2Kjm.jpg)
Si pulsamos sobre editar perfil, se nos abrira un modal para gestionar nuestro perfil.
En el, podremos cambiar nuestra foto de perfil, la ubicacion y la descripcion.
Ademas dispondremos para consultar la informacion de la API. 
Tambien podemos cambiar la contraseña, cambiar el correo electronico de la cuenta(Se enviara un mail a al nuevo correo para confirmar el cambio), o eliminar de la faz del servidor tu cuenta(tambien se envia otro email de confirmacion).
![Image](https://i.imgur.com/GA4lUfv.jpg)
## Anime
Podemos visualizar informacion sobre animes. En caso de estar logueado, desde la misma pagina podremos añadir nuestra serie a la lista y gestionarla. Podemos cambiar el estado de la serie, los episodios vistos(se actualiza al momento mediante AJAX), la puntuacion(AJAX) o bien eliminarla o añadirla a favoritos.
Ademas, podremos ver su trailer, descripcion o animes relacionados con este, es caso de que lo tenga la serie-
![Anime](https://i.imgur.com/o8q4kX3.jpg)
## Lista 
En la lista, que tambien podremos consultar la de otros usuarios, gestionaremos de forma mas completa nuestras series añadidas.
En el lateral, a traves del color podemos saber su estado rapidamente.
Podremos clickar en el campo de puntuacion para cambiarla, el progeso, o si pinchamos en el campo de comentarios podemos añadir un comentario sobre esa serie, actualizandose todo al momento en el servidor mediante JQuery y AJAX.
En caso de llegar a los 12 capitulos, el estado de la serie cambiara a completado, que se reflejara al recargar la pagina.
![Lista](https://i.imgur.com/lOK5tBJ.jpg)Si pulsamos sobre __edit__, podremos editar algunos ajustes a traves de un modal:
![Modal List](https://i.imgur.com/Kc0ma6X.jpg)
## Correo de prueba
Si por ejemplo solicitamos un cambio de correo, este sera el aspecto del correo que recibiremos, adaptado al idioma que tengas seleccionado al momento(a veces puede tardar unos minutos en llegar el correo paciencia! y recuerda revisar la bandeja de spam si usas outlook sobre todo).
![Email](https://i.imgur.com/RqZTQVA.jpg)
## Pagina de administracion
Si eres un usuario admin, desde tu perfil podras acceder a la gestion de usuarios, puedo marcar como borrado a un usuaro o recuperarlo, aunque no podras borrar a otros admins :)
![Admin](https://i.imgur.com/8JRnBxW.jpg)
## Login y olvide mi contraseña
A la hora de loguearnos, si hemos olvidado nuestra contraseña, podemos pedir que se nos envie un link al correo para establecer una nueva.
![Email Pass](https://i.imgur.com/5uwdEvk.jpg)
## Registro
El formulario de registro contiene diversas avisos y para comprobar que la contraseña es igual y comple los requisitos minimos o que el nick esta libre, mediante AJAX y JQuery.

## Esquema de la BD
![Esquema](https://i.imgur.com/A3mwJhV.jpg)

##Test
Aqui he tocado algo
Estoy en la rama branch-test.
