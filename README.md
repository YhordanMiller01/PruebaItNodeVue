**Prueba de desarrollo.**
Prueba de desarrollo para **BrowserTravelSolutions**.


**Pre-requisitos**
- Php 7.3.0 con phpCli habilitado para la ejecución de comando.
- MySQL
- Composer
- Extensión pdo_pgsql habilitada.
- Node
- Npm
- Vue3(esta en el package.json)
**Instalación**

1. Clonar el repositorio en la carperta del servidor web.
[git clone git@github.com:YhordanMiller01/PruebaBrowser.git]
[git clone https://github.com/YhordanMiller01/PruebaBrowser.git]

2. Instalar paquetes.
`composer install`


3. Configurar archivo .env

4. Configure las variables de entorno para base de datos y la llave para consumir enpoint https://api.openweathermap.org/

- `DB_HOST=` Variable de entorno para el host de BD.
- `DB_PORT=` Variable de entorno para el puerto de BD.
- `DB_DATABASE=` Variable de entorno para el nombre de BD.
- `DB_USERNAME=` Variable de entorno para el usuario de BD.
- `DB_PASSWORD=` Variable de entorno para la contraseña de BD.
- `APPI_KEY_OPEN_WEATHER`='cb69604972fb9a35b62bcf18cf7b5ac4'


5. En la raíz del sitio ejecutar.

- php artisan key:generate Genera la llave para el cifrado del proyecto.
- composer install Instala dependencias de PHP
- npm install para descargar librerias y paquetes
- php artisan migrate:refresh --seed Ejecuta migraciones y seeders


**Proceso:**

1. Se debe iniciar el servidor php artisan serve e iniciar npm run watch para que escuche del lado del front.
2. Se puede seleccionar una ciudad ya sea Miami, Orlando o New York
3. Una vez seleccionada la ciudad cargara la información de ubicación en el mapa, junto con un card informativo, esta información es deacuerdo al api `api.openweathermap.org`
4. Se puede guardar el estado actual del clima consultado dano en el boton `Guardar Clima`
5. Se puede consultar el historial de climas dando clic en el boton `Ver Historial`

**Nota:**
1. Es necesario tener un api_key para las peticiones, para este caso esta incluida en el proyecto

