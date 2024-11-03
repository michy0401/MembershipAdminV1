USE membershipDataBase;

-- Poblar la tabla Estado
INSERT INTO Estado (estado, entidad) VALUES 
('activo', 'empleado'), 
('inactivo', 'empleado'), 
('activo', 'membresia'), 
('cancelado', 'membresia'), 
('activo', 'cliente'), 
('cancelado', 'cliente'), 
('pendiente', 'cliente');

-- Poblar la tabla Empleado
INSERT INTO Empleado (nombre, cargo, id_estado, createdate, usuario,contraseña,foto,ultimo_loging) VALUES 
('Juan Pérez', 'admin', 1, CURRENT_TIMESTAMP,'juan','12345',NULL,CURRENT_TIMESTAMP), 
('Ana Gómez', 'vendedor', 1, CURRENT_TIMESTAMP,'ana','12345',NULL,CURRENT_TIMESTAMP), 
('Carlos Ruiz', 'vendedor', 2, CURRENT_TIMESTAMP,'carlos','12345',NULL,CURRENT_TIMESTAMP);

-- Poblar la tabla Membresia
INSERT INTO Membresia (membresia, precio, beneficios, id_estado, createdate) VALUES 
('Diamond', 100.00, '2 Members Max, Includes 2 cards, Access to all services', 3, CURRENT_TIMESTAMP), 
('Platinum', 90.40, '2 Members Max, Includes 2 cards, Access to all services, 2% Rewards', 3, CURRENT_TIMESTAMP), 
('Business', 115.00, 'Add up to 3 additional members, Includes 2 cards, Access to all services, Business services included', 3, CURRENT_TIMESTAMP), 
('Business Platinum', 130.00, 'Add up to 3 additional members, Includes 2 cards, Access to all services, Business services and 2% rewards', 3, CURRENT_TIMESTAMP);

-- Poblar la tabla Metodo_pago
INSERT INTO Metodo_pago (metodo_pago, detalle, createdate) VALUES 
('tarjeta', 'Visa o Mastercard', CURRENT_TIMESTAMP), 
('paypal', 'Cuenta de PayPal', CURRENT_TIMESTAMP), 
('transferencia', 'Transferencia bancaria directa', CURRENT_TIMESTAMP);

-- Poblar la tabla Cliente
INSERT INTO Cliente (nombre, correo, contrasena, telefono, id_estado, id_membresia, id_estado_membresia, id_metodo_pago, fecha_inicio_membresia, fecha_fin_membresia, createdate) VALUES 
('Luis Torres', 'luis.torres@example.com', 'password123', '555-1234', 5, 1, 3, 1, '2023-01-01', '2024-01-01', CURRENT_TIMESTAMP), 
('María López', 'maria.lopez@example.com', 'password456', '555-5678', 5, 2, 3, 2, '2023-02-01', '2024-02-01', CURRENT_TIMESTAMP), 
('Pedro Sánchez', 'pedro.sanchez@example.com', 'password789', '555-9012', 5, 3, 3, 3, '2023-03-01', '2024-03-01', CURRENT_TIMESTAMP), 
('Lucía Méndez', 'lucia.mendez@example.com', 'password321', '555-3456', 6, 1, 4, 1, '2023-04-01', '2024-04-01', CURRENT_TIMESTAMP);

-- Poblar la tabla Beneficiario
INSERT INTO Beneficiario (nombre, correo, telefono, id_estado, createdate) VALUES 
('Jorge Medina', 'jorge.medina@example.com', '555-6789', 5, CURRENT_TIMESTAMP), 
('Ana Morales', 'ana.morales@example.com', '555-2345', 5, CURRENT_TIMESTAMP);

-- Poblar la tabla Detalle_beneficiarios
INSERT INTO Detalle_beneficiarios (id_cliente, id_beneficiario) VALUES 
(1, 1), 
(2, 2);

-- Poblar la tabla Registro_pago
INSERT INTO Registro_pago (id_cliente, id_metodo_pago, monto, id_estado, createdate) VALUES 
(1, 1, 100.00, 5, CURRENT_TIMESTAMP), 
(2, 2, 45.20, 5, CURRENT_TIMESTAMP), 
(3, 3, 115.00, 5, CURRENT_TIMESTAMP), 
(4, 1, 130.00, 5, CURRENT_TIMESTAMP);
