# Proyecto-Laravel
## Version Software
- **Xampp:** v3.3.0
- **PHP:** 8.2.4
- **Laravel:** 10.18.0
## Configuracion Host Virtual
### Ruta configuracion: C:\xampp\apache\conf\extra
```apache
<VirtualHost *:80>
    DocumentRoot "C:/xampp/htdocs/pruebaxkape/prueba-tecnica-laravel/public"
    ServerName pruebaxkape1.com.devel
    ServerAlias www.pruebaxkape1.com.devel
    <Directory "C:/xampp/htdocs/pruebaxkape/prueba-tecnica-laravel/public">
        Options Indexes FollowSymLinks
        AllowOverride All
        Order Deny,Allow
        Allow from all
    </Directory>
</VirtualHost>
```
## Host
### Ruta configuracion: C:\Windows\System32\drivers\etc
127.0.0.1 pruebaxkape1.com.devel
