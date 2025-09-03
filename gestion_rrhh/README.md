# 📋 Sistema de Gestión de RRHH

Sistema completo de gestión de recursos humanos desarrollado con **CodeIgniter 4**.

## 🚀 Características

- **Gestión de empleados**: CRUD completo de personal
- **Control de asistencias**: Registro y seguimiento de horarios
- **Sistema de permisos**: Solicitudes y aprobaciones
- **Comunicaciones internas**: Mensajería y notificaciones
- **Panel administrativo**: Dashboard con métricas
- **Interfaz moderna**: Bootstrap 4 + FontAwesome

## 🛠️ Tecnologías

- **Backend**: CodeIgniter 4
- **Base de datos**: MySQL/MariaDB
- **Frontend**: Bootstrap 4, jQuery
- **Iconos**: FontAwesome
- **Servidor web**: Apache/Nginx

## 📦 Instalación

### Requisitos previos
- PHP >= 7.4
- MySQL/MariaDB
- Composer
- Servidor web (Apache/Nginx)

### Pasos de instalación

1. **Clonar el repositorio**
   ```bash
   git clone https://github.com/nanocarp01/proyectos_codeigniter.git
   cd proyectos_codeigniter/gestion_rrhh
   ```

2. **Instalar dependencias**
   ```bash
   composer install
   ```

3. **Configurar base de datos**
   ```bash
   cp .env.example .env
   # Editar .env con los datos de tu base de datos
   ```

4. **Configurar permisos**
   ```bash
   chmod -R 755 writable/
   ```

5. **Importar base de datos**
   ```bash
   # Importar el archivo SQL de la base de datos
   mysql -u usuario -p nombre_bd < database.sql
   ```

## ⚙️ Configuración

### Variables de entorno (.env)
```env
CI_ENVIRONMENT = development
app.baseURL = 'http://localhost/gestion_rrhh/public/'

database.default.hostname = localhost
database.default.database = gestion_rrhh
database.default.username = tu_usuario
database.default.password = tu_password
database.default.DBDriver = MySQLi
```

## 📱 Uso

1. **Acceder al sistema**: `http://localhost/gestion_rrhh/public/`
2. **Login**: Usar credenciales de administrador
3. **Dashboard**: Ver métricas y accesos rápidos
4. **Módulos**: Navegar por empleados, asistencias, permisos

## 🔧 Desarrollo

### Estructura del proyecto
```
gestion_rrhh/
├── app/
│   ├── Controllers/     # Controladores
│   ├── Models/         # Modelos de datos
│   ├── Views/          # Vistas
│   └── Entities/       # Entidades
├── public/             # Archivos públicos
├── writable/           # Archivos escribibles
└── system/             # Framework CodeIgniter
```

### Comandos útiles
```bash
# Limpiar cache
php spark cache:clear

# Ejecutar migraciones
php spark migrate

# Servidor de desarrollo
php spark serve
```

## 🤝 Contribución

1. Fork el proyecto
2. Crear una rama para tu feature (`git checkout -b feature/nueva-funcionalidad`)
3. Commit tus cambios (`git commit -am 'Agregar nueva funcionalidad'`)
4. Push a la rama (`git push origin feature/nueva-funcionalidad`)
5. Crear un Pull Request

## 📄 Licencia

Este proyecto está bajo la licencia MIT. Ver el archivo `LICENSE` para más detalles.

## 📞 Contacto

- **Autor**: Nano
- **Email**: fernandoheredia33@gmail.com
- **GitHub**: [@nanocarp01](https://github.com/nanocarp01)
