# Prueba técnica en Laravel

**Premisa:** Desarrollar una API para la consulta de peliculas usando Laravel, conectando servicios externos, diseñando una base de datos y aplicando autenticaión.

## Stack

-   PHP 8.4
-   Laravel 12
-   MySQL 8.0
-   Redis
-   Docker

## Como ejecutarlo

Este proyecto hace uso de Docker para facilitar la ejecución de las dependencias necesarias, los comandos para son:

```
docker compose up --build -d
```

Si todo sale bien despuesta de este comando, podremos visitar el proyecto en _http://localhost:8080_

## Variables de enterno

Es necesaria configurar las siguientes variables de entorno, para una correcta configuracion es posible copiar el archivo: .env.example

| Variable       | Descripcion                                                      | Valores posibles       |
| -------------- | ---------------------------------------------------------------- | ---------------------- |
| MOVIES_API_URL | Permite configurar el host del servicio de consulta de peliculas | http://www.omdbapi.com |
| MOVIES_API_KEY | Clave de acceso al servicio de consulta de peliculas             | -                      |

## Paso a paso

-   Deberias arrancar el proyecto usando docker
-   Debes configurar las variables de entorno
-   Puedes accces usando la credencial por defecto para el usuario **admin@movies.com**, el cual es **password**

## Componentes del sistema

-   Requerimiento funcionales de la prueba
-   Pruebas de integración
-   Redis para el caching de respuestas del servicio externo
-   El uso de capas/responsabilidades bien marcadas
-   Documentación tecnica de la API autogenerada en **http://localhost:8080/docs/api**
-   Uso de CI para el testing automatizado

## Capturas del sistema

Aqui es posible visualizar la documentación generada de la API, la cual es interactuable y permite probar los metodos desarrollados.

![Api docs](../static/api-docs.png)

Aqui es posible ver el listado de acciones desarrolladas asi como los esquemas analizados para peticiones y respuestas:

![Api docs methods](../static/api-docs-methods.png)
