**Módulo Maquinarias**

El módulo de maquinarias se genera en la necesidad de mejorar los procesos de trabajo de IOIngenieria en conjunto con otros nueve 
  módulos se trabaja simultaneamente, organizandose para crear un sistema de información que registre el proceso completo de un 
  proyecto, es decir, desde la concepción de éste hasta su finalización. Aquí es donde nuestro módulo se encarga de gestionar todos 
  los procesos de maquinarias mejorando notoriamente los tiempos de ejecución de los procesos que concernian al jefe de mantención y maquinarias debido 
  a que el sistema permite:
  1.  Registrar, modificar los datos e inhabilitar máquinas.
  2.  Asignar maquinarias disponibles a obras según se necesite.
  3.  Editar las asignaciones, eliminarlas y ver en detalle la información de la asignación.
  4.  Reasignar las máquinadas asignadas, editar las reasignaciones y eliminarlas.
  5.  Ingresar máquinas a mantenciones, actualizar el estado, editar la información de la mantención y eliminar mantenciones.
  6.  Registrar la solicitud de  máquinas arrendadas a empresas, editar la información del arriendo y eliminar el arriendo.
  
  Este software esta diseñado para el uso del jefe de mantenciones y maquinarias en conjunto con el encargado que IoIngenieria designe 
  en caso de ser necesario.
  Para el acceso a la página del módulo de maquinarias el usuario deberá hacerlo a través de un ordenador que cuente con acceso a 
  internet. .


## Software stack
El proyecto Módulo Maquinarias es una aplicación web que corre sobre el siguiente software:

- Debian GNU/Linux 10 Buster
- Apache 2.4.38
- PHP 7.3.19 (ext: bcmath, cli, curl, fpm, gd, json, mbstring, mysql, pdo, xml, zip)
- Base de Datos MySQL 5
- Git
- msmtp 


## Configuraciones de Ejecución para Entorno de Desarrollo/Produccción



- Luego abrir una ventana terminal de git, para situarte en la carpeta donde deseas guardar el proyecto 
- Situarse dentro de las carpetas con los comandos (cd, cd.. )
- Luego dentro de la carpeta aplicas el comando que sirve para clonar:  
  git clone "http://gitlabtrans.face.ubiobio.cl:8081/17586027/maquinarasg5.git" 

  Si va a realizar la instalación con Docker siga las siguientes instrucciones:

## Docker



- Agregue en el grupo docker al usuario para que él pueda ejecutar las rutinas docker.
- Luego desde otra terminal situarse dentro del directorio raiz donde fue clonado este repositorio.
- Una vez situado en la raiz del proyecto ingrese a root y ejecute el siguiente comando:

```bash
docker-compose up 

```

- Se comenzarán a instalar las imagenes y tras finalizar usted podrá visualizar la pagina desde:
[maquinaras](http://localhost:8000)




## Instalar dependencias del proyecto
Si va a realizar la instalación desde el servidor realice los siguiente pasos:

- Deberá configurar un servidor msmtp para poder enviar correos desde el software.
- Tras configurarlo deberá reiniciar su servidor apache.
- Finalmente copie el contenido descargado desde el repositorio en el directorio principal de su servidor para visualizar la pagina 
web desde el navegador.


## Configuración de la base de datos.

- Importe el script "g5tdesarrollo\_db.sql" que se encuentran en la carpeta del repositorio llamada "scripts_sql" en su base de datos. 
- Dirigase a la carpeta del repositorio llamada "Conexion" y configure las credenciales de acceso a su base de datos desde el archivo
 "config.php"

- Tras realizar estas configuraciones podrá ejecutar el software.


## Construido con

- [Bootstrap 4](https://getbootstrap.com/) - HTML, CSS, and JS Frontend Framework
- [Gentelella](https://colorlib.com/polygon/gentelella/) - Admin Dashboard Template




## Contribuir al Proyecto

- Contribuciones al proyecto se encuentran en [CONTRIBUTING.md](CONTRIBUTING.md)


