# ☕ Punto Café — Sistema de Gestión Web

Aplicación web de gestión integral para una cafetería, desarrollada en PHP, HTML y CSS puro. Permite administrar pedidos, mesas, menú, stock, empleados y reportes según el rol del usuario.

---

## 🚀 Tecnologías utilizadas

- PHP 8+
- HTML5
- CSS3
- JavaScript vanilla
- XAMPP (Apache + PHP local)
- JSON (para persistencia de datos)
- Sesiones PHP
---

## ⚙️ Instalación y ejecución

### 1. Instalar XAMPP
Descargalo desde [https://www.apachefriends.org](https://www.apachefriends.org) e instalalo.

### 2. Iniciar Apache
Abrí el **XAMPP Control Panel** y hacé clic en **Start** en la fila de **Apache**.

### 3. Copiar el proyecto
Copiá la carpeta del proyecto dentro de:
C:\xampp\htdocs\punto-cafe\

### 4. Abrir en el navegador
Con Apache corriendo, ingresá a:
http://localhost/punto-cafe/login.php

---

## 🔐 Usuarios de prueba

Una vez en el login podés ingresar con cualquiera de estos usuarios para acceder a cada vista:

| Rol | Email | Contraseña |
| Cliente | cliente@puntocafe.com | cliente |
| Recepcionista | recepcionista@puntocafe.com | recepcionista |
| Encargado | encargado@puntocafe.com | encargado |
| Admin | admin@puntocafe.com | admin |
| Cocina | cocina@puntocafe.com | cocina |

---

## 🧩 Funcionalidades por vista

### 🛍 Cliente (`cliente/`)
- Carrusel de productos con flechas de navegación
- Filtros por categoría y rango de precio
- Agregar productos al carrito con sesión PHP
- Modificar cantidades y eliminar productos del carrito
- Resumen de pedido con subtotal y métodos de pago
- Pop-up de confirmación de pedido al finalizar la compra
- Historial de pedidos realizados
- Sección de reportes y reclamos

### 🧾 Recepcionista (`recepcionista/`)
- Visualización de pedidos en tiempo real con filtros por estado
- Acciones por pedido: marcar en preparación, entregar, cancelar
- Estado visual de las mesas (libre / ocupada / esperando)
- Creación de nuevos pedidos con productos y observaciones
- Cálculo automático del total del pedido

### 📋 Encargado (`encargado/`)
- Reportes de clientes con email visible al hacer clic en "Contactar"
- Stock general con niveles: Buen nivel / Stock bajo / Stock crítico
- Gestión del menú con persistencia en JSON
- Modal para agregar nuevos productos al menú
- Modal para actualizar nombre, descripción y precio de productos existentes

### 👔 Admin (`admin/`)
- Tabla de empleados con nombre, puesto, horario y estado
- Select de estado con colores dinámicos (Activo / Licencia / Inactivo)
- Formulario para agregar nuevos empleados
- Formulario para editar empleados existentes

### 🍳 Cocina (`cocina/`)
- Visualización de pedidos entrantes en tiempo real
- Gestión del estado de cada pedido
