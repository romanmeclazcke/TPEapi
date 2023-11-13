Documentacion de enponit:

1) Listado de todos los productos con sus caracteristicas.
   
   METHOD: GET ------ ENDPOINT: http://localhost/TPEapi/api/producto
   

3) Acceder a un producto y sus carecteristicas por su ID, con esto conseguimos acceder a el producto de forma individual.
   Donde dice 21, iria el id del producto que queremos visualizar.
   
   METHOD:GET ------ ENDPOINT: http://localhost/TPEapi/api/producto/21
   

3)Acceder a los productos y caracteristicas, pero bajo una condicion de ordenamiento, es decir, ordenador por algun campo de sus caracteristicas.
  Se utilizo el mismo endpoint que los anteriores, pero en este caso se reciben los query params sort y order, sort indica un campo de los productos por el cual se va 
  a ordenar y order un orden que puede ser asc (ASCENDENTE) desc(DESCENDENTE).

  METHOD:GET  ------  ENDPOINT: http://localhost/TPEapi/api/producto/?sort=precio&order=desc
  

4)Filtrar los productos por un campo. Dado que solo pedia un campo, nosotros hicimos el filtrado por el precio, es decir todos los productos que tengan un precio
determinado. Se utilizo el mismo endpoint que en el 1 y 3, pero se recibie un  query params distinto, en este caso recibimos "precio" con el valor que la persona indique
y lo que hace es ir a buscar todos los productos con ese precio, donde dice "30000" iria el precio por el cual queremos filtrar.

  METHOD:GET ------  ENDPOINT: http://localhost/TPEapi/api/producto/?precio=30000


5)Crear un producto, en este endpoint lo que permite es crear un producto, pero necesita un token para permitir crearlo, por eso mismo primero hay que hacer uso de otro
enpoint (ENPOINT Nº 6), que nos entrega un token. luego se debe pegar el token en Autorization => Bearer token, de tener los permisos para crear un producto, y enviar los datos
se crea un producto nuevo, sin los permisos de admin no se puede crear el producto.

METHOD:POST  ------  ENDPOINT: http://localhost/TPEapi/api/producto

6)Obtener TOKEN, este endpoint lo que hace es entregar un token al usuario una vez que ingresa sus datos, el ednpoint tendra "datos del usario", y nosotros podremos
controlar las acciones que este puede realizar dependiendo si es usario normal o admin. para recibir un token hay en el endpoint http://localhost/TPEapi/api/user/token
ir a Autorization => Basic Auth y ingresar nuestro email y password, una vez echo esto nos provera un token si los datos son correctos. y en las acciones de crear, modificar
o eliminar un producto debemos ingresar este token.

ejemplos de datos:   
  ADMIN: email: webadmin@gmail.com  password: admin
  
  USUARIO: email: rrr@rrr  password: rrr

METHOD:GET  ------  ENDPOINT: http://localhost/TPEapi/api/user/token


7) Eliminar producto, para eliminar un producto debemos ingresar en Autorization => Bearer token el token que tenemos, en caso de tener los permisos necesarios vamos a poder
   eliminar un producto ingresando su ID. De no tener los permisos de admin no podremos eliminar el producto.
   donde dice 52, iria el id del producto a eliminar

  METHOD:DELETE  ------  ENDPOINT: http://localhost/TPEapi/api/producto/52

8)Actualizar un producto, para esta accion tambien necesitamos ingresar un token como el caso anterior, tambien necesitaremos tener los permisos de admin. este edpoint permite
  modificar un producto ya creado ingresado los datos en formato json siguiendo la siguente estructura y en la ruta debemos ingresar el id del producto a modificar.
  
  estructura esperada:
  {
    "nombre": "Tacho de Aluminio",
    "material": "Aluminio",
    "precio": 8900,
    "imagen": "https://http2.mlstatic.com/D_NQ_NP_2X_660724-MLA71954567485_092023-F.webp",
    "categoria": 2
  }

  donde dice 21, es solo un ejemplo, ahi iria el id del producto a modificar.
  METHOD:PUT ------  ENDPOINT: http://localhost/TPEapi/api/producto/21


















