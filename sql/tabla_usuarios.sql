CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    primer_nombre VARCHAR(50) NOT NULL,
    segundo_nombre VARCHAR(50) DEFAULT NULL,
    primer_apellido VARCHAR(50) NOT NULL,
    segundo_apellido VARCHAR(50) DEFAULT NULL,
    telefono VARCHAR(20) NOT NULL,
    correo VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    rol VARCHAR(20) NOT NULL DEFAULT 'usuario',
    resultado VARCHAR(50) DEFAULT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Si tu tabla ya existía con la columna "nombre_completo", puedes migrarla así:
--
-- ALTER TABLE usuarios ADD COLUMN primer_nombre VARCHAR(50) NOT NULL DEFAULT '';
-- ALTER TABLE usuarios ADD COLUMN segundo_nombre VARCHAR(50) DEFAULT NULL;
-- ALTER TABLE usuarios ADD COLUMN primer_apellido VARCHAR(50) NOT NULL DEFAULT '';
-- ALTER TABLE usuarios ADD COLUMN segundo_apellido VARCHAR(50) DEFAULT NULL;
-- ALTER TABLE usuarios ADD COLUMN rol VARCHAR(20) NOT NULL DEFAULT 'usuario';
-- ALTER TABLE usuarios ADD COLUMN resultado VARCHAR(50) DEFAULT NULL;
--
-- Nota: dividir "nombre_completo" en las 4 columnas nuevas para los usuarios que ya
-- existan hay que hacerlo caso por caso (no se puede separar un nombre compuesto de
-- forma 100% automática). Una vez migrados los datos, puedes eliminar la columna vieja:
-- ALTER TABLE usuarios DROP COLUMN nombre_completo;
--
-- Para convertir un usuario en administrador:
-- UPDATE usuarios SET rol = 'admin' WHERE correo = 'correo_del_admin@ejemplo.com';

-- ================================
-- Tabla para "Olvidé mi contraseña"
-- ================================
CREATE TABLE IF NOT EXISTS password_resets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    token_hash VARCHAR(255) NOT NULL,
    expira DATETIME NOT NULL,
    usado TINYINT(1) NOT NULL DEFAULT 0,
    creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);

