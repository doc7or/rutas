--Modificaciones en la base datos
--CAMBIO LA COLUMNA CLIENTE 
alter table control_salida_detalle alter column cliente text
--CREACION TABLA RECARGOS
CREATE TABLE dbo.recargos  
   (id int PRIMARY KEY NOT NULL,  
    descripcion varchar(25) NOT NULL,  
    monto float,  
    forma char(1) )
GO
--ADDICION DE LA COLUMNA monto_recargo en control salida
ALTER TABLE control_salida ADD monto_recargo FLOAT
--RENOMBRADO DE COLUMNA NO SE EJECUTA
ALTER TABLE control_salida RENAME COLUMN monto_recargo TO monto_reparto
--ELIMNACION DE CAMPO
ALTER TABLE control_salida DROP COLUMN monto_recargo
ALTER TABLE control_salida DROP COLUMN recargo_cantidad
--CREACION  DE CAMPOS
ALTER TABLE control_salida ADD reparto_monto FLOAT
ALTER TABLE control_salida ADD recargo_cantidad INT
ALTER TABLE control_salida ADD reparto_cantidad INT

--CREACION TABLA DESVIOS
CREATE TABLE dbo.desvios  
   (id int PRIMARY KEY NOT NULL,  
    descripcion varchar(25) NOT NULL,  
    monto float)
GO

INSERT INTO desvios (id,descripcion,monto) VALUES(1,'Corto',20)
INSERT INTO desvios (id,descripcion,monto) VALUES(2,'Largo',30)