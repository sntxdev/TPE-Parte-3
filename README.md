# TPE-Parte-3 - APIRest-ful

API REST que permite ver un juego, ver varios juegos con distintas opciones, crear, editar y eliminar juegos.

## API Endpoints Juegos

### Obtener todos los juegos

```http
GET /api/games
```

### Obtener los juegos filtrados y ordenados

```http
GET /api/games?
```

| Parametro | Tipo     | Descripción                | Default |
| -------- | ------- | ------------------------- |--------|
| `sort` | `string` |  Campo por el cual se ordena | Id_juego |
| `order` | `string` |  Orden ascendente o descendente | asc |
| `page` | `int` |  Pagina a mostrar (muestra 3 por página)| null |
| `filter` | `string` |  Campo a filtrar | null |
| `condition` | `string / int` |  Condición a filtrar | null |
| `comparison` | `string` |  Tipos de comparación | equal |

`
order -> asc, desc
`

`
comparison -> greater, less, equal
`

Ejemplo: 
```
GET '/api/games?sort=nombre&order=desc'
GET '/api/games?filter=nombre&condition=new'
GET '/api/games?filter=precio&comparison=greater&condition=1500'
```

### Obtener un juego

```http
GET /api/games/:id
```

| Parametro | Tipo     | Descripcion                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `int` | **Required**. Id del juego |

Ejemplo: 
```
GET '/api/games/1'
```

### Obtener solo un campo de un juego por ID

```http
GET /api/games/:id/:subrecurso
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `int` | **Required**. Id del juego |
| `subrecurso`      | `string` | **Required**. nombre |

`
:sobrecurso -> nombre, precio, descuento
`

Ejemplo: 
```
GET '/api/games/3/nombre'
```

### Creacion de un juego

```http
POST /api/games
```

#### Request body

Ejemplo:
```json
POST 'api/games'
data '{
    "Id_categoria": 7,
    "Nombre": "EA SPORTS™ FIFA 232",
    "description": "FIFA 23 brings you all the realism of Everyone's Game with HyperMotion2 technology, the men's and women's FIFA World Cup™, women's club teams, Cross-Play features** and much more.",
    "Precio": "12000",
    "Imagen": "https://cdn.cloudflare.steamstatic.com/steam/apps/1811260/header.jpg?t=1695934916"
}'
```

| Key | Tipo     | Descripción                       |
| :-------- | :------- | :-------------------------------- |
| `Id_categoria`      | `number` | **Required**. ID de la categoria |
| `Nombre`      | `string` | **Required**. Nombre del juego |
| `Description`      | `string` |  Descripción |
| `Precio`      | `int` | **Required**. Precio del juego |
| `Imagen`      | `String` | Imagen del juego |


### Editar un juego

```http
PUT /api/games/:id
```
| Parametro | Tipo     | Descripción                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `int` | **Required**. Id del juego |

#### Request body 

Ejemplo:
```json
PUT 'api/games/1'
data '{
    "Id_categoria": 7,
    "Nombre": "EA SPORTS™ FIFA 23",
    "description": "FIFA 23 brings you all the realism of Everyone's Game with HyperMotion2 technology, the men's and women's FIFA World Cup™, women's club teams, Cross-Play features** and much more.",
    "Precio": "12000",
    "Descuento": "20",
    "Imagen": "https://cdn.cloudflare.steamstatic.com/steam/apps/1811260/header.jpg?t=1695934916"
}'
```

| Key | Tipo     | Descripción                       |
| :-------- | :------- | :-------------------------------- |
| `Id_categoria`      | `number` | **Required**. ID de la categoria |
| `Nombre`      | `string` | **Required**. Nombre del juego |
| `Description`      | `string` |  Descripción |
| `Precio`      | `int` | **Required**. Precio del juego |
| `Descuento`      | `int` | Descuento a aplicar |
| `Imagen`      | `String` | Imagen del juego |

### Eliminar un juego

```http
DELETE /api/games/:id
```
| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `int` | **Required**. Id del juego |

Ejemplo:
```
DELETE '/api/games/1'
```

## API Endpoints Categorias

### Obtener las categorias

```http
GET /api/categories
```

### Obtener categorias ordenadas

```http
GET /api/categories?
```

| Parametro | Tipo     | Descripción                | Default |
| -------- | ------- | ------------------------- |--------|
| `sort` | `string` |  Campo por el cual se ordena | Id_categoria |
| `order` | `string` |  Orden ascendente o descendente | asc |

`
order -> asc / desc
`

Ejemplo: 
```
GET '/api/categories?sort=nombre'
```

### Obtener una categoria

```http
GET /api/categories/:id
```

| Parametro | Tipo     | Descripcion                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `int` | **Required**. Id de la categoria |

Ejemplo: 
```
GET '/api/categories/1'
```

### Creacion de una categoria

```http
POST /api/categories
```

#### Request body

Ejemplo:
```json
POST 'api/categories'
data '{
    "Nombre": "Sports",
    "description": "The 'Sports' category in video games includes titles that replicate real-world sports or introduce fictional sports in a virtual setting. These games provide players with the opportunity to engage in sports experiences, from realistic simulations to creative and fantastical competitions."
}'
```

| Key | Tipo     | Descripción                       |
| :-------- | :------- | :-------------------------------- |
| `Nombre`      | `string` | **Required**. Nombre de la categoria |
| `Descripcion`      | `String` | **Required**. Descripcion de la categoria |


### Editar una categoria

```http
PUT /api/categories/:id
```
| Parametro | Tipo     | Descripción                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `int` | **Required**. Id de la categoria |

#### Request body 

Ejemplo:
```json
PUT 'api/categories/7'
data '{
    "Nombre": "Sport",
    "description": "The 'Sports' category in video games includes titles that replicate real-world sports or introduce fictional sports in a virtual setting. These games provide players with the opportunity to engage in sports experiences, from realistic simulations to creative and fantastical competitions.",
}'
```

| Key | Tipo     | Descripción                       |
| :-------- | :------- | :-------------------------------- |
| `Nombre`      | `string` | **Required**. Nombre de la categoria |
| `Descripcion`      | `String` | **Required**. Descripcion de la categoria |

### Eliminar una categoria

```http
DELETE /api/categories/:id
```
| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `int` | **Required**. Id del juego |

Ejemplo:
```
DELETE '/api/categories/7'
```

## API Endpoints Ofertas

### Obtener las ofertas

```http
GET /api/offers
```

### Obtener ofertas ordenadas

```http
GET /api/offers?
```

| Parametro | Tipo     | Descripción                | Default |
| -------- | ------- | ------------------------- |--------|
| `sort` | `string` |  Campo por el cual se ordena | Id_juego |
| `order` | `string` |  Orden ascendente o descendente | asc |

`
order -> asc / desc
`

Ejemplo: 
```
GET '/api/offers?sort=descripcion'
```
