/*
 Navicat Premium Data Transfer

 Source Server         : Localhost
 Source Server Type    : MySQL
 Source Server Version : 50637
 Source Host           : localhost:3306
 Source Schema         : bd_inmobiliaria

 Target Server Type    : MySQL
 Target Server Version : 50637
 File Encoding         : 65001

 Date: 05/03/2020 11:46:48
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for casas
-- ----------------------------
DROP TABLE IF EXISTS `casas`;
CREATE TABLE `casas`  (
  `ID_CASA` int(11) NOT NULL AUTO_INCREMENT,
  `ID_PROPIEDAD` int(11) DEFAULT NULL,
  `TITULO` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `RESUMEN` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `DETALLE` varchar(600) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `CAPACIDAD` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `GEOREFERENCIACION` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `IMAGEN` varchar(1500) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `CUOTA_INICIAL` decimal(11, 2) DEFAULT 0.00,
  `COSTO_TOTAL` decimal(11, 2) DEFAULT 0.00,
  `ENLACE` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  PRIMARY KEY (`ID_CASA`) USING BTREE,
  INDEX `FK_REFERENCE_13`(`ID_PROPIEDAD`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 49 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for departamentos
-- ----------------------------
DROP TABLE IF EXISTS `departamentos`;
CREATE TABLE `departamentos`  (
  `ID_DEPARTAMENTO` int(11) NOT NULL AUTO_INCREMENT,
  `ID_PROPIEDAD` int(11) DEFAULT NULL,
  `TITULO` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `RESUMEN` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `DETALLE` varchar(600) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `CAPACIDAD` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `GEOREFERENCIACION` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `IMAGEN` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `CUOTA_INICIAL` decimal(11, 2) DEFAULT 0.00,
  `COSTO_TOTAL` decimal(11, 2) DEFAULT 0.00,
  `ENLACE` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  PRIMARY KEY (`ID_DEPARTAMENTO`) USING BTREE,
  INDEX `FK_REFERENCE_12`(`ID_PROPIEDAD`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 9 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
