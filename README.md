# Presentación del Proyecto: Sistema de Gestión Web para Comercio

1. Descripción General del Proyecto

    El proyecto consiste en el desarrollo de un sistema de gestión web para comercios, diseñado para optimizar el control de ventas, compras de insumos, inventario, clientes y proveedores. El sistema será desarrollado en PHP y tendrá una interfaz amigable y accesible desde cualquier dispositivo con conexión a Internet. La plataforma facilitará la toma de decisiones, centralizando toda la información en un solo lugar y permitiendo su análisis en tiempo real.

2. Objetivos Generales

    Desarrollar un sistema de gestión web que permita a los comercios administrar sus operaciones diarias de manera centralizada, eficiente y accesible. La plataforma busca optimizar el control de las ventas, finanzas, inventario y relaciones con clientes y proveedores, reduciendo errores y facilitando la toma de decisiones estratégicas para el negocio.

3. Objetivos Específicos

    - Implementar un sistema de registro de ventas que permita controlar en tiempo real el flujo de ingresos del comercio.  
    - Crear un módulo para gestionar compras de insumos y productos, mejorando el control de gastos y la planificación de inventario.
    - Desarrollar funcionalidades de control de stock para reducir pérdidas por productos agotados o exceso de inventario.
    - Permitir el registro y análisis de gastos generales, facilitando la gestión financiera y la identificación de oportunidades de ahorro.
    - Incluir opciones de modalidades de pago que permitan flexibilidad al cliente y un registro claro de las transacciones.
    - Crear una base de datos de proveedores, mejorando la relación con proveedores y la planificación de compras.
    - Incluir un sistema de registro de usuarios con diferentes niveles de acceso para asegurar la privacidad y la seguridad de la información.

4. Límites

    - El sistema solo será accesible desde dispositivos con conexión a Internet, lo que lo hace dependiente de la conectividad.
    - La plataforma estará diseñada para comercios pequeños y medianos; para empresas de mayor escala, podrían requerirse módulos o ajustes adicionales.
    - Las funcionalidades están diseñadas para una estructura de comercio general y pueden requerir personalización adicional para ciertos sectores específicos.
    - El sistema no incluye la contabilidad completa del comercio, solo se enfoca en la gestión de operaciones e inventario.

5. Alcances

    - El sistema permitirá la gestión de inventario, ventas, compras, clientes, y proveedores, centralizando la información y facilitando la administración.
    - Permitirá llevar un registro de todas las transacciones y generar reportes sobre ventas, gastos e inventarios en tiempo real.
    - Será capaz de registrar la información de clientes y sus deudas, además de ofrecer opciones para gestionar pagos y créditos.
    - Contará con un sistema de permisos que gestionará los accesos de los usuarios, brindando niveles de seguridad según el rol de cada uno.

6. Requerimientos Funcionales

    - Registro de ventas: El sistema debe permitir registrar cada venta realizada, generando recibos e informes de ventas.
    - Gestión de compras: Debe registrar todas las compras realizadas a proveedores, actualizando el inventario automáticamente.
    - Control de stock: Actualización en tiempo real de las existencias de productos e insumos.
    - Control de gastos: El sistema debe permitir el registro y categorización de gastos.
    - Control de proveedores: Registro y seguimiento de proveedores, historial de compras, y eficiencia de cada proveedor.
    - Registro de usuarios y permisos: Posibilidad de crear usuarios con diferentes permisos y niveles de acceso.

7. Requerimientos No Funcionales

    - Seguridad: El sistema debe garantizar la protección de los datos de los usuarios y las transacciones mediante cifrado y autenticación de usuarios.
    - Accesibilidad: El sistema debe ser accesible desde cualquier navegador y dispositivo con conexión a Internet, asegurando compatibilidad en distintos entornos.
    - Usabilidad: La interfaz debe ser intuitiva, fácil de navegar y con un diseño atractivo que permita una curva de aprendizaje rápida.
    - Escalabilidad: El sistema debe estar diseñado de manera que permita añadir nuevas funcionalidades o ampliaciones sin requerir cambios drásticos en la estructura base.
    - Mantenimiento: El sistema debe ser fácil de mantener y actualizar, asegurando que las nuevas versiones o ajustes puedan integrarse sin complicaciones.
    - Disponibilidad: Al ser un sistema web, debe tener un alto nivel de disponibilidad, garantizando que los usuarios puedan acceder al sistema en cualquier momento.
    - Rendimiento: El sistema debe ser capaz de manejar de manera eficiente las transacciones y consultas, respondiendo en tiempo adecuado y sin ralentización.

## Información técnica

- Entidades con las que contará la aplicación, de los cuales darán lugar a los módulos que tendrá la aplicación.

  - Usuarios
  - Proveedores
  - Categorías de productos
  - Productos
  - Medios de pago
  - Compras (de insumos)
  - Ventas

## Como correr el proyecto en tu máquina un servidor de pruebas

> [!NOTE]
> El sistema utiliza una base de datos SQLite en su versión 3 para mayor versatilidad. Es menester mencionar que el sistema está desarrollado con el framework Laravel en su versión 11, por lo que es necesario [instalar composer](https://getcomposer.org/download/) para luego poder instalar las dependencias del proyecto, además, tenes que instalar [nodejs](https://nodejs.org/en/) para instalar las dependencias de node. Asimismo es necesario instalar un entorno de desarrollo como  [Laragon](https://laragon.org/download/) o [XAMPP](https://www.apachefriends.org/es/index.html) para que se instale PHP como dependencia del sistema.

1. Clonar este repositorio dentro de una carpeta que crearás para el sistema.

    ```bash
    git clone https://github.com/omy123567/Proyecto.git
    ```

2. Instalar las dependencias del proyecto

    ```bash
    php artisan key:generate
    ```

3. Realizar una copia del archivo `.env.example` y renombrarlo a `.env`, es el archivo que almacena las variables de entorno, necesarias para la correcta ejecución del sistema.

4. Ejecutar siguiente comando para generar la llave única de encriptación:

    ```bash
    php artisan key:generate
    ```

5. Crear un archivo con el nombre `database.sqlite` en la raíz de la carpeta `database` del proyecto.

6. Ejecutar el siguiente comando para ejecutar las migraciones (creación de tablas en base de datos) y la carga de datos por defecto

    ```bash
    php artisan migrate:fresh --seed
    ```

7. Ejecutar el comando para servir el proyecto en una url temporal y de desarrollo

    ```bash
    # esto generará una url de desarrollo para acceso al sistema en http://127.0.0.1:8000/
    php artisan serve 
    # y en otra terminal ejecutar el siguiente comando para ejecutar el entorno de nodejs
    npm run dev
    ```

8. Ingresar a la [url](http://127.0.0.1:8000/) para probar
