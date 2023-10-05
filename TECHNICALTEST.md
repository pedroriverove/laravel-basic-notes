# Prueba técnica

***Implementación.***

El CRUD se implementará en PHP y MySQL.

***Requerimientos funcionales.***

- **Creación de un repositorio en GitLab:**
  - El repositorio tendrá tres ramas: main, dev y release.
  - El fichero README incluirá la descripción del ejercicio.
  - Se creará una rama llamada "crud\_notas".
- **Implementación de un CRUD para notas:**
  - El CRUD tendrá las siguientes vistas:
    - CREATE: Permite crear una nueva nota.
    - UPDATE: Permite actualizar una nota existente.
    - DELETE: Permite eliminar una nota existente.
    - READ: Permite ver una lista de notas.
  - Las restricciones de acceso serán las siguientes:
    - CREATE: Sólo podrán acceder los usuarios del departamento "Atención al cliente".
    - UPDATE: Sólo podrán acceder los usuarios que pertenezcan al departamento al que va dirigida la nota y tengan el rol de jefe o responsable de equipo.
    - DELETE: Sólo podrán acceder los usuarios del departamento "Atención al cliente" que tengan el rol de jefe o responsable de equipo.
    - READ: Todos los usuarios podrán acceder a la vista, pero cada departamento sólo verá sus notas asociadas. El rol jefe y el departamento "Atención al cliente" verán todas las notas.
- **Plus de ejercicio:**
  - Botón "Activar": Permite activar una nota eliminada. Sólo podrán acceder los responsables del departamento al que pertenezca la nota.
  - Colores de las filas de las tablas:
    - Pendiente: Azul.
    - En proceso: Amarillo.
    - Terminada: Verde.
    - Eliminada: Rojo.
    - Reactivada: Icono delante del código
  - Test: Se implementarán pruebas unitarias y de integración para validar el correcto funcionamiento del CRUD.

***Flujo de usuario.***

**CREATE:**

- El usuario accede a la vista "CREATE".
- Rellena el formulario con los datos de la nota.
- El sistema valida los datos del formulario.
- El sistema guarda la nota en la base de datos.

**UPDATE:**

- El usuario accede a la vista "UPDATE".
- Selecciona la nota que desea actualizar.
- Rellena el formulario con los datos actualizados.
- El sistema valida los datos del formulario.
- El sistema actualiza la nota en la base de datos.

**DELETE:**

- El usuario accede a la vista "DELETE".
- Selecciona la nota que desea eliminar.
- El sistema muestra una notificación para confirmar la eliminación.
- El usuario confirma la eliminación.
- El sistema elimina la nota de la base de datos.

**READ:**

- El usuario accede a la vista "READ".
- Selecciona un filtro para ver las notas que desea.
- El sistema muestra una tabla con las notas filtradas.

**Botón "Activar":**

- El usuario accede a la vista "READ".
- Selecciona la nota que desea reactivar.
- Hace clic en el botón "Activar".
- El sistema muestra una notificación para confirmar la reactivación.
- El usuario confirma la reactivación.
- El sistema activa la nota en la base de datos.

**Colores de las filas de las tablas:**

- El sistema colorea las filas de las tablas según el estado de la nota.
- Las notas eliminadas se muestran en rojo.
- Las notas reactivadas se muestran con un icono delante del código.
