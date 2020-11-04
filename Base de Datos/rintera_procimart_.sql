/*
 Navicat Premium Data Transfer

 Source Server         : LOCALHOST
 Source Server Type    : MySQL
 Source Server Version : 100408
 Source Host           : localhost:3306
 Source Schema         : rintera_procimart

 Target Server Type    : MySQL
 Target Server Version : 100408
 File Encoding         : 65001

 Date: 15/10/2020 15:48:02
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for cat_idproducto
-- ----------------------------
DROP TABLE IF EXISTS `cat_idproducto`;
CREATE TABLE `cat_idproducto`  (
  `IdProducto` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Tipo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `info` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_rep` int(5) NOT NULL COMMENT 'id_rep conjunto',
  PRIMARY KEY (`IdProducto`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for colorines
-- ----------------------------
DROP TABLE IF EXISTS `colorines`;
CREATE TABLE `colorines`  (
  `IdColor` int(11) NOT NULL,
  `ColorName` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `WebName` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `hex` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'Valor Hexadecimal',
  `rgb` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'Valor RGB',
  PRIMARY KEY (`IdColor`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for dbs
-- ----------------------------
DROP TABLE IF EXISTS `dbs`;
CREATE TABLE `dbs`  (
  `IdCon` int(100) NOT NULL AUTO_INCREMENT,
  `ConName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Etiqueta de la coneccion',
  `ConType` int(1) NOT NULL COMMENT '0 = Base de mysql de rintera\r\n1 = MySQL\r\n2 = WebService SQLSERVERTOJSON\r\n3 = Webservice MSSQL ASP (este envia por post o get sql con la consulta)\r\n',
  `Active` int(1) NOT NULL COMMENT '0 = inactivo, 1 = activo',
  `dbhost` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `dbuser` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `dbname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `dbpassword` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `parametros` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `wsmethod` int(1) NOT NULL COMMENT '0 = GET, 1 = POST',
  `wsjson` int(1) NOT NULL COMMENT '0 = text plano, 1 = json',
  `wsP1_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Parametro 1 Id; ejemplo si es GET\r\nurl?variable=33\r\n\r\nwsP1_id = variable',
  `wsP1_value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Parametro 1 value; ejemplo si es GET\r\nurl?variable=33\r\n\r\nwsP1_value = 33',
  `wsP2_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `wsP2_value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `wsP3_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `wsP3_value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `wsP4_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `wsP4_value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `wsurl` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'URL del webservice',
  `visible` int(1) NOT NULL,
  PRIMARY KEY (`IdCon`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 29 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for historia
-- ----------------------------
DROP TABLE IF EXISTS `historia`;
CREATE TABLE `historia`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `hora` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Descripcion` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `IdApp` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `IdUser` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fecha`(`hora`) USING BTREE,
  INDEX `hora`(`hora`) USING BTREE,
  INDEX `IdUser`(`IdUser`) USING BTREE,
  INDEX `IdApp`(`IdApp`) USING BTREE,
  FULLTEXT INDEX `descripcion`(`Descripcion`)
) ENGINE = MyISAM AUTO_INCREMENT = 552 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for misapp
-- ----------------------------
DROP TABLE IF EXISTS `misapp`;
CREATE TABLE `misapp`  (
  `IdApp` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `AppNombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `AppDescripcion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`IdApp`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for preferences
-- ----------------------------
DROP TABLE IF EXISTS `preferences`;
CREATE TABLE `preferences`  (
  `Preference` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `GroupA` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Agrupacion para organizar 1',
  `GroupB` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Agrupacion para organizar 2',
  `info` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`Preference`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for reportes
-- ----------------------------
DROP TABLE IF EXISTS `reportes`;
CREATE TABLE `reportes`  (
  `id_rep` int(11) NOT NULL AUTO_INCREMENT,
  `rep_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `sql1` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `sql2` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `sql3` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `rep_description` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `IdUser` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `fecha` date NOT NULL,
  `hora` time(0) NOT NULL,
  `orientacion` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL COMMENT 'L= horrizontal P= vertical',
  `estado` int(10) NOT NULL COMMENT '0 = En Construccion, 1 = Operativo, 2 = Cancelado',
  `solicitante` varchar(11) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `IdCon` int(10) NOT NULL COMMENT 'db0, db1 o db2',
  `PageSize` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL COMMENT '0 = CARTA, 1 = OFICIO',
  `out_type` int(1) NOT NULL COMMENT '0 = html,\r\n1 = DataTable,\r\n2 = PDF,\r\n3 = Excel,\r\n4 = Word',
  `var1` int(1) NOT NULL COMMENT '0 = no utilizada, 1= utilizada',
  `var1_type` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL COMMENT 'text, number, date',
  `var1_label` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL COMMENT 'Etiqueta para mostrar al solicitar var1',
  `var2` int(1) NOT NULL COMMENT '0 = no utilizada, 1= utilizada',
  `var2_type` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL COMMENT 'text, number, date',
  `var2_label` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL COMMENT 'Etiqueta para mostrar al solicitar var2',
  `var3` int(1) NOT NULL COMMENT '0 = no utilizada, 1= utilizada',
  `var3_type` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL COMMENT 'text, number, date',
  `var3_label` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL COMMENT 'Etiqueta para mostrar al solicitar var3',
  `var1_sql` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL COMMENT 'Consulta para llnar un select de var1',
  `var2_sql` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `var3_sql` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `admin` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL COMMENT 'Administrador del Reporte',
  `var1_IdCon` int(2) NOT NULL,
  `var2_IdCon` int(2) NOT NULL,
  `var3_IdCon` int(2) NOT NULL,
  `FixedColLeft` int(2) NOT NULL,
  `FixedColRight` int(2) NOT NULL,
  `Portada` int(1) NOT NULL COMMENT '1=aparecen en portada',
  PRIMARY KEY (`id_rep`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 11 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for reportes_permisos
-- ----------------------------
DROP TABLE IF EXISTS `reportes_permisos`;
CREATE TABLE `reportes_permisos`  (
  `id_rep` int(100) NOT NULL,
  `IdUser` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fecha` date NOT NULL COMMENT 'Fecha en la que obtuvo el permiso',
  `hora` time(6) NOT NULL COMMENT 'Hora de esa fecha en la que obtuvo el permiso',
  `QuienAutorizo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Usuario que autorizo',
  PRIMARY KEY (`id_rep`, `IdUser`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for search
-- ----------------------------
DROP TABLE IF EXISTS `search`;
CREATE TABLE `search`  (
  `IdUser` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Search` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `IdSearch` int(100) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`IdSearch`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 267 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for sessiones
-- ----------------------------
DROP TABLE IF EXISTS `sessiones`;
CREATE TABLE `sessiones`  (
  `id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Id de Session php',
  `session_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'nombre de la session',
  `parametros` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Parametros de la sesion',
  `usuario` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Usuario que se logueo',
  `fecha` date NOT NULL COMMENT 'Fecha de session',
  `hora` time(6) NOT NULL COMMENT 'Hora de la session',
  `cierre_fecha` date NOT NULL COMMENT 'Fecha de cierre de sesion',
  `cierre_hora` time(6) NOT NULL COMMENT 'Hora de cierre de sesion',
  `comentarios` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ipcliente` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Ip del Cliente, se guarda desde login',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `sess1`(`fecha`) USING BTREE,
  INDEX `sess2`(`usuario`) USING BTREE,
  INDEX `ipcliente`(`ipcliente`) USING BTREE,
  INDEX `usuario`(`usuario`, `ipcliente`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tokens
-- ----------------------------
DROP TABLE IF EXISTS `tokens`;
CREATE TABLE `tokens`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fecha` date NOT NULL,
  `hora` time(6) NOT NULL,
  `activo` int(255) NOT NULL,
  `cierre_fecha` date NOT NULL,
  `cierre_hora` time(6) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 55369 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for useradmin
-- ----------------------------
DROP TABLE IF EXISTS `useradmin`;
CREATE TABLE `useradmin`  (
  `IdUser` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`IdUser`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `IdUser` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `NIP` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `UserName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `RinteraLevel` int(1) NOT NULL,
  PRIMARY KEY (`IdUser`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- View structure for users_html
-- ----------------------------
DROP VIEW IF EXISTS `users_html`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `users_html` AS select 
CONCAT("<a href='?id=",IdUser,"' title='Haga clic para Editar al Usuario'>",IdUser,"</a>") as IdUser,
UserName,
IF(RinteraLevel=1,"Administrador",
	IF (RinteraLevel = 0,"No Definido","Consulta")
) as RinteraLevel,
CONCAT("<a href='?x=",IdUser,"' title='Haga clic para Eliminar al Usuario' class='btn btn-warning'><img src='icon/x.png' style='width:17px;'></a>") as Eliminar




from users ;

SET FOREIGN_KEY_CHECKS = 1;
