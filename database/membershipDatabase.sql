-- Crear la base de datos solo si no existe
CREATE DATABASE IF NOT EXISTS membershipDataBase;

-- Usar la base de datos
USE membershipDataBase;

-- tabla Estado solo si no existe
CREATE TABLE IF NOT EXISTS Estado 
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    estado VARCHAR(50),
    entidad VARCHAR(50)
);

-- tabla Empleado solo si no existe
CREATE TABLE IF NOT EXISTS Empleado 
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    cargo VARCHAR(50),
    id_estado INT,
    createdate DATETIME DEFAULT CURRENT_TIMESTAMP,
    updatedate DATETIME ON UPDATE CURRENT_TIMESTAMP,
    deletedate DATETIME,
    FOREIGN KEY (id_estado) REFERENCES Estado(id)
);
ALTER TABLE Empleado
ADD COLUMN usuario VARCHAR(50) NOT NULL,
ADD COLUMN contraseña VARCHAR(100) NOT NULL,
ADD COLUMN foto VARCHAR(255),
ADD COLUMN ultimo_loging DATETIME;

-- tabla Membresia solo si no existe
CREATE TABLE IF NOT EXISTS Membresia
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    membresia VARCHAR(100),
    precio DECIMAL(10, 2),
    beneficios TEXT,
    id_estado INT,
    createdate DATETIME DEFAULT CURRENT_TIMESTAMP,
    updatedate DATETIME ON UPDATE CURRENT_TIMESTAMP,
    deletedate DATETIME,
    FOREIGN KEY (id_estado) REFERENCES Estado(id)
);

-- tabla Metodo_pago solo si no existe
CREATE TABLE IF NOT EXISTS Metodo_pago 
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    metodo_pago VARCHAR(100),
    detalle TEXT,
    createdate DATETIME DEFAULT CURRENT_TIMESTAMP,
    updatedate DATETIME ON UPDATE CURRENT_TIMESTAMP,
    deletedate DATETIME
);

-- tabla Registro_pago solo si no existe
CREATE TABLE IF NOT EXISTS Registro_pago 
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT,
    id_metodo_pago INT,
    monto DECIMAL(10, 2),
    id_estado INT,
    createdate DATETIME DEFAULT CURRENT_TIMESTAMP,
    updatedate DATETIME ON UPDATE CURRENT_TIMESTAMP,
    deletedate DATETIME,
    FOREIGN KEY (id_metodo_pago) REFERENCES Metodo_pago(id),
    FOREIGN KEY (id_estado) REFERENCES Estado(id)
);

-- tabla Beneficiario solo si no existe
CREATE TABLE IF NOT EXISTS Beneficiario 
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    correo VARCHAR(100),
    telefono VARCHAR(20),
    id_estado INT,
    createdate DATETIME DEFAULT CURRENT_TIMESTAMP,
    updatedate DATETIME ON UPDATE CURRENT_TIMESTAMP,
    deletedate DATETIME,
    FOREIGN KEY (id_estado) REFERENCES Estado(id)
);

-- tabla Cliente solo si no existe
CREATE TABLE IF NOT EXISTS Cliente 
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    correo VARCHAR(100),
    contrasena VARCHAR(100),
    telefono VARCHAR(20),
    id_estado INT, 
    id_membresia INT,
    id_estado_membresia INT, 
    id_metodo_pago INT,
    fecha_inicio_membresia DATE,
    fecha_fin_membresia DATE,
    createdate DATETIME DEFAULT CURRENT_TIMESTAMP,
    updatedate DATETIME ON UPDATE CURRENT_TIMESTAMP,
    deletedate DATETIME,
    FOREIGN KEY (id_estado) REFERENCES Estado(id),
    FOREIGN KEY (id_membresia) REFERENCES Membresia(id),
    FOREIGN KEY (id_estado_membresia) REFERENCES Estado(id),
    FOREIGN KEY (id_metodo_pago) REFERENCES Metodo_pago(id)
);

-- tabla Detalle_beneficiarios solo si no existe
CREATE TABLE IF NOT EXISTS Detalle_beneficiarios 
(
    id_cliente INT,
    id_beneficiario INT,
    PRIMARY KEY (id_cliente, id_beneficiario),
    FOREIGN KEY (id_cliente) REFERENCES Cliente(id),
    FOREIGN KEY (id_beneficiario) REFERENCES Beneficiario(id)
);

