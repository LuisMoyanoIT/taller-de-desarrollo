# Guía de Contribución

## Equipo de Desarrollo

## Autores
### - [Integrante Mauricio Cardenas Caceres](@19509571) - Ingeniero de desarrollo 
- Correo electronico: mauricio.cardenas1601@alumnos.ubiobio.cl
- Casos de uso: 
    1. Eliminar arriendo
    2. Editar máquina
    3. Agregar arriendo
    4. Editar arriendo
    5. Mostrar máquinas asignadas
    6. Mostrar arriendos
    7. Mostrar todas

### - [Integrante Nelson Dominguez Riveras](@17586027) - Ingeniero de bases de datos 
- Correo electronico: nelson.dominguez1601@alumnos.ubiobio.cl
- Casos de uso:
    8. Registrar máquina 
    9. Eliminar mantención
    10. Agregar mantención
    11. Editar mantención
    12. Mostrar máquina
    13. Mostrar mantenciones 
    14. Cambiar estados de mantención
    15. Ver resumen gráfico
     

### - [Integrante Luis Moyano Cruces](@19333078) - Ingeniero analista 
- Correo electronico: luis.moyano1601@alumnos.ubiobio.cl
- Casos de uso:
 Mostrar máquinas disponibles
 Validar fechas 
 Asignar máquina
 Enviar correo
 Editar asignación
    16. Asignar máquina
    17. Editar asignación
    18. Eliminar reasignación
    19. Enviar correo
    20. Mostrar máquinas disponibles 
    21. Validar fechas
    22. Ver detalle asignación

## Estándar de Codificación

### Estilo de Codificación

El estilo de código de este proyecto debe seguir las recomendaciones de los estándares:
- [PSR-1](https://www.php-fig.org/psr/psr-1/)
- [PSR-2](https://www.php-fig.org/psr/psr-2/)
- [PSR-4](https://www.php-fig.org/psr/psr-4/)
- [PSR-12](https://www.php-fig.org/psr/psr-12/)

### Configuraciones para editores de código

- Codificación de Archivos de Código = UTF-8

## Desarrollo del código

### Arquitectura del Sistema - Patrones de Diseño

- El proyecto se compone de las capas: 
    1. Modelo: Es la capa donde se hacen las consultas a la base de datos.
    2. Vista: Es la capa que muestra el contenido al usuario.
    3. Controlador: Es la capa que actua como intermediaria entre el modelo y la vista.

### Namespaces para Autoload con el estándar PSR-4

- Todos los archivos de desarrollo deben ser clases y cada uno debe ser declarado con su respectivo namespace, de acuerdo al directorio en que se encuentre la clase.


### Archivos/Directorios que no deben ser versionados o enviados al repositorio (**no** incluir en los **commit's**)

- `vendor/*`

### Archivos/Directorios que no deben estar en ambientes de producción

- `docker/*`
- `README.md`
- `.git/*`