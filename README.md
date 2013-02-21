sistCalidad
===========

Este repositorio alberga el código fuente de la aplicación-sistCalidad
que se esta desarrollando durante el año 2013


Instalación y configuración
---------------------------

### Configuración de la base de datos ###

La aplicación necesita una base de datos de tipo SQL 

```
    $db['local']['hostname'] = 'localhost';
    $db['local']['username'] = 'root';
    $db['local']['password'] = '###';
    $db['local']['database'] = 'sistCalidad';
    $db['local']['dbdriver'] = 'mysql';
```



### Configuración del servidor web ###

Para probar el proyecto fácilmente, es recomendable crear un *host virtual* en 
tu servidor web local. Añade en primer lugar la siguiente línea en el archivo 
`/etc/hosts`:

```
127.0.0.1    w2w.sistCalidad
```

Después, configura el *host* en el servidor web. Si utilizas por ejemplo 
Apache, debes añadir lo siguiente en su archivo de configuración:

```
# sistCalidad 2013
<VirtualHost *:80>
    DocumentRoot   "/proyectos/sistCalidad"
    DirectoryIndex index.php
    ServerName     w2w.sistCalidad

    <Directory "/proyectos/sistCalidad">
        AllowOverride All
        Allow from All
    </Directory>
</VirtualHost>
```

Para terminar, no olvides reiniciar el servidor web.

### Probando el proyecto ###

Después de la configuración anterior, ya puedes acceder al entorno de 
desarrollo de la aplicación en `http://w2w.sistCalidad`.


Sobre el autor
-----------------

El proyecto ha sido desarrollado por:

  * Jean Mendoza (@rivasJeanCarlos)
