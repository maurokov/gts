-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 29-03-2016 a las 17:20:12
-- Versión del servidor: 5.5.46-0+deb8u1
-- Versión de PHP: 5.6.17-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `gts`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Account`
--

CREATE TABLE IF NOT EXISTS `Account` (
  `accountID` varchar(32) NOT NULL,
  `accountType` smallint(5) unsigned DEFAULT NULL,
  `notifyEmail` varchar(128) DEFAULT NULL,
  `allowNotify` tinyint(4) DEFAULT NULL,
  `speedUnits` tinyint(3) unsigned DEFAULT NULL,
  `distanceUnits` tinyint(3) unsigned DEFAULT NULL,
  `volumeUnits` tinyint(3) unsigned DEFAULT NULL,
  `pressureUnits` tinyint(3) unsigned DEFAULT NULL,
  `economyUnits` tinyint(3) unsigned DEFAULT NULL,
  `temperatureUnits` tinyint(3) unsigned DEFAULT NULL,
  `currencyUnits` varchar(8) DEFAULT NULL,
  `fuelCostPerLiter` double DEFAULT NULL,
  `latLonFormat` tinyint(3) unsigned DEFAULT NULL,
  `geocoderMode` tinyint(3) unsigned DEFAULT NULL,
  `privateLabelName` varchar(32) DEFAULT NULL,
  `isBorderCrossing` tinyint(4) DEFAULT NULL,
  `retainedEventAge` int(10) unsigned DEFAULT NULL,
  `maximumDevices` int(11) DEFAULT NULL,
  `totalPingCount` smallint(5) unsigned DEFAULT NULL,
  `maxPingCount` smallint(5) unsigned DEFAULT NULL,
  `autoAddDevices` tinyint(4) DEFAULT NULL,
  `dcsPropertiesID` varchar(32) DEFAULT NULL,
  `smsEnabled` tinyint(4) DEFAULT NULL,
  `smsProperties` varchar(200) DEFAULT NULL,
  `emailProperties` varchar(250) DEFAULT NULL,
  `expirationTime` int(10) unsigned DEFAULT NULL,
  `suspendUntilTime` int(10) unsigned DEFAULT NULL,
  `allowWebService` tinyint(4) DEFAULT NULL,
  `defaultUser` varchar(32) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `contactName` varchar(64) CHARACTER SET utf8 DEFAULT NULL,
  `contactPhone` varchar(32) DEFAULT NULL,
  `contactEmail` varchar(128) DEFAULT NULL,
  `timeZone` varchar(32) DEFAULT NULL,
  `passwdChangeTime` int(10) unsigned DEFAULT NULL,
  `passwdQueryTime` int(10) unsigned DEFAULT NULL,
  `lastLoginTime` int(10) unsigned DEFAULT NULL,
  `isActive` tinyint(4) DEFAULT NULL,
  `displayName` varchar(40) CHARACTER SET utf8 DEFAULT NULL,
  `description` varchar(128) CHARACTER SET utf8 DEFAULT NULL,
  `notes` text CHARACTER SET utf8,
  `lastUpdateTime` int(10) unsigned DEFAULT NULL,
  `creationTime` int(10) unsigned DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Account`
--

INSERT INTO `Account` (`accountID`, `accountType`, `notifyEmail`, `allowNotify`, `speedUnits`, `distanceUnits`, `volumeUnits`, `pressureUnits`, `economyUnits`, `temperatureUnits`, `currencyUnits`, `fuelCostPerLiter`, `latLonFormat`, `geocoderMode`, `privateLabelName`, `isBorderCrossing`, `retainedEventAge`, `maximumDevices`, `totalPingCount`, `maxPingCount`, `autoAddDevices`, `dcsPropertiesID`, `smsEnabled`, `smsProperties`, `emailProperties`, `expirationTime`, `suspendUntilTime`, `allowWebService`, `defaultUser`, `password`, `contactName`, `contactPhone`, `contactEmail`, `timeZone`, `passwdChangeTime`, `passwdQueryTime`, `lastLoginTime`, `isActive`, `displayName`, `description`, `notes`, `lastUpdateTime`, `creationTime`) VALUES
('sysadmin', 0, '', 1, 1, 1, 0, 0, 0, 1, '', 0, 0, 3, '*', 0, 0, 0, 0, 0, 0, '', 1, '', '', 0, 0, 0, '', 'password', '', '', '', 'GMT', 1453343383, 0, 1459286105, 1, '', 'System Administrator', '', 1459286106, 1453343383);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `AccountString`
--

CREATE TABLE IF NOT EXISTS `AccountString` (
  `accountID` varchar(32) NOT NULL,
  `stringID` varchar(32) NOT NULL,
  `singularTitle` varchar(64) DEFAULT NULL,
  `pluralTitle` varchar(64) DEFAULT NULL,
  `description` varchar(128) CHARACTER SET utf8 DEFAULT NULL,
  `lastUpdateTime` int(10) unsigned DEFAULT NULL,
  `creationTime` int(10) unsigned DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Device`
--

CREATE TABLE IF NOT EXISTS `Device` (
  `accountID` varchar(32) NOT NULL,
  `deviceID` varchar(32) NOT NULL,
  `groupID` varchar(32) DEFAULT NULL,
  `equipmentType` varchar(40) DEFAULT NULL,
  `equipmentStatus` varchar(24) DEFAULT NULL,
  `vehicleMake` varchar(40) DEFAULT NULL,
  `vehicleModel` varchar(40) DEFAULT NULL,
  `vehicleYear` smallint(5) unsigned DEFAULT NULL,
  `vehicleID` varchar(24) DEFAULT NULL,
  `licensePlate` varchar(24) DEFAULT NULL,
  `licenseExpire` int(10) unsigned DEFAULT NULL,
  `insuranceExpire` int(10) unsigned DEFAULT NULL,
  `driverID` varchar(32) DEFAULT NULL,
  `driverStatus` int(10) unsigned DEFAULT NULL,
  `fuelCapacity` double DEFAULT NULL,
  `fuelEconomy` double DEFAULT NULL,
  `fuelRatePerHour` double DEFAULT NULL,
  `fuelCostPerLiter` double DEFAULT NULL,
  `fuelTankProfile` varchar(320) DEFAULT NULL,
  `fuelTankProfile2` varchar(320) DEFAULT NULL,
  `speedLimitKPH` double DEFAULT NULL,
  `planDistanceKM` double DEFAULT NULL,
  `installTime` int(10) unsigned DEFAULT NULL,
  `resetTime` int(10) unsigned DEFAULT NULL,
  `expirationTime` int(10) unsigned DEFAULT NULL,
  `uniqueID` varchar(40) DEFAULT NULL,
  `deviceCode` varchar(24) DEFAULT NULL,
  `deviceType` varchar(24) DEFAULT NULL,
  `pushpinID` varchar(32) DEFAULT NULL,
  `displayColor` varchar(16) DEFAULT NULL,
  `serialNumber` varchar(24) DEFAULT NULL,
  `simPhoneNumber` varchar(24) DEFAULT NULL,
  `simID` varchar(24) DEFAULT NULL,
  `smsEmail` varchar(64) DEFAULT NULL,
  `imeiNumber` varchar(24) DEFAULT NULL,
  `dataKey` text,
  `ignitionIndex` smallint(6) DEFAULT NULL,
  `codeVersion` varchar(32) DEFAULT NULL,
  `featureSet` varchar(64) DEFAULT NULL,
  `ipAddressValid` varchar(128) DEFAULT NULL,
  `lastTotalConnectTime` int(10) unsigned DEFAULT NULL,
  `lastDuplexConnectTime` int(10) unsigned DEFAULT NULL,
  `pendingPingCommand` text,
  `lastPingTime` int(10) unsigned DEFAULT NULL,
  `totalPingCount` smallint(5) unsigned DEFAULT NULL,
  `maxPingCount` smallint(5) unsigned DEFAULT NULL,
  `commandStateMask` int(10) unsigned DEFAULT NULL,
  `expectAck` tinyint(4) DEFAULT NULL,
  `expectAckCode` int(10) unsigned DEFAULT NULL,
  `lastAckCommand` text,
  `lastAckTime` int(10) unsigned DEFAULT NULL,
  `dcsPropertiesID` varchar(32) DEFAULT NULL,
  `dcsConfigMask` int(10) unsigned DEFAULT NULL,
  `dcsConfigString` varchar(80) DEFAULT NULL,
  `dcsCommandHost` varchar(32) DEFAULT NULL,
  `lastTcpSessionID` varchar(32) DEFAULT NULL,
  `ipAddressCurrent` varchar(32) DEFAULT NULL,
  `remotePortCurrent` smallint(5) unsigned DEFAULT NULL,
  `listenPortCurrent` smallint(5) unsigned DEFAULT NULL,
  `lastInputState` int(10) unsigned DEFAULT NULL,
  `lastOutputState` int(10) unsigned DEFAULT NULL,
  `statusCodeState` int(10) unsigned DEFAULT NULL,
  `lastBatteryLevel` double DEFAULT NULL,
  `lastFuelLevel` double DEFAULT NULL,
  `lastFuelLevel2` double DEFAULT NULL,
  `lastFuelTotal` double DEFAULT NULL,
  `lastOilLevel` double DEFAULT NULL,
  `lastValidLatitude` double DEFAULT NULL,
  `lastValidLongitude` double DEFAULT NULL,
  `lastValidHeading` double DEFAULT NULL,
  `lastValidSpeedKPH` double DEFAULT NULL,
  `lastGPSTimestamp` int(10) unsigned DEFAULT NULL,
  `lastEventTimestamp` int(10) unsigned DEFAULT NULL,
  `lastCellServingInfo` varchar(100) DEFAULT NULL,
  `lastDistanceKM` double DEFAULT NULL,
  `lastOdometerKM` double DEFAULT NULL,
  `odometerOffsetKM` double DEFAULT NULL,
  `lastEngineOnHours` double DEFAULT NULL,
  `lastEngineOnTime` int(10) unsigned DEFAULT NULL,
  `lastEngineOffTime` int(10) unsigned DEFAULT NULL,
  `lastEngineHours` double DEFAULT NULL,
  `engineHoursOffset` double DEFAULT NULL,
  `lastIgnitionOnHours` double DEFAULT NULL,
  `lastIgnitionOnTime` int(10) unsigned DEFAULT NULL,
  `lastIgnitionOffTime` int(10) unsigned DEFAULT NULL,
  `lastIgnitionHours` double DEFAULT NULL,
  `lastStopTime` int(10) unsigned DEFAULT NULL,
  `lastStartTime` int(10) unsigned DEFAULT NULL,
  `lastMalfunctionLamp` tinyint(4) DEFAULT NULL,
  `lastFaultCode` varchar(96) DEFAULT NULL,
  `isActive` tinyint(4) DEFAULT NULL,
  `displayName` varchar(40) CHARACTER SET utf8 DEFAULT NULL,
  `description` varchar(128) CHARACTER SET utf8 DEFAULT NULL,
  `notes` text CHARACTER SET utf8,
  `lastUpdateTime` int(10) unsigned DEFAULT NULL,
  `creationTime` int(10) unsigned DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Device`
--

INSERT INTO `Device` (`accountID`, `deviceID`, `groupID`, `equipmentType`, `equipmentStatus`, `vehicleMake`, `vehicleModel`, `vehicleYear`, `vehicleID`, `licensePlate`, `licenseExpire`, `insuranceExpire`, `driverID`, `driverStatus`, `fuelCapacity`, `fuelEconomy`, `fuelRatePerHour`, `fuelCostPerLiter`, `fuelTankProfile`, `fuelTankProfile2`, `speedLimitKPH`, `planDistanceKM`, `installTime`, `resetTime`, `expirationTime`, `uniqueID`, `deviceCode`, `deviceType`, `pushpinID`, `displayColor`, `serialNumber`, `simPhoneNumber`, `simID`, `smsEmail`, `imeiNumber`, `dataKey`, `ignitionIndex`, `codeVersion`, `featureSet`, `ipAddressValid`, `lastTotalConnectTime`, `lastDuplexConnectTime`, `pendingPingCommand`, `lastPingTime`, `totalPingCount`, `maxPingCount`, `commandStateMask`, `expectAck`, `expectAckCode`, `lastAckCommand`, `lastAckTime`, `dcsPropertiesID`, `dcsConfigMask`, `dcsConfigString`, `dcsCommandHost`, `lastTcpSessionID`, `ipAddressCurrent`, `remotePortCurrent`, `listenPortCurrent`, `lastInputState`, `lastOutputState`, `statusCodeState`, `lastBatteryLevel`, `lastFuelLevel`, `lastFuelLevel2`, `lastFuelTotal`, `lastOilLevel`, `lastValidLatitude`, `lastValidLongitude`, `lastValidHeading`, `lastValidSpeedKPH`, `lastGPSTimestamp`, `lastEventTimestamp`, `lastCellServingInfo`, `lastDistanceKM`, `lastOdometerKM`, `odometerOffsetKM`, `lastEngineOnHours`, `lastEngineOnTime`, `lastEngineOffTime`, `lastEngineHours`, `engineHoursOffset`, `lastIgnitionOnHours`, `lastIgnitionOnTime`, `lastIgnitionOffTime`, `lastIgnitionHours`, `lastStopTime`, `lastStartTime`, `lastMalfunctionLamp`, `lastFaultCode`, `isActive`, `displayName`, `description`, `notes`, `lastUpdateTime`, `creationTime`) VALUES
('sysadmin', 'gprmc_352642070280600', '', '', '', '', '', 0, '', '', 0, 0, '', 0, 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, '352642070280600', 'gprmc', '', '', '', '', '', '', '', '', '', 0, 'gtcfre-1.7.2', '', '', 1453468221, 0, '', 0, 0, 0, 0, 0, 0, '', 0, '', 0, '', '', '', '146.155.157.27', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, -33.49911, -70.61224, 0, 0, 1453468221, 1453468221, '', 0, 2.79, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1453464620, 1453464204, 0, '', 1, '', 'Android Mathias', '', 1453468221, 1453463918);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `DeviceGroup`
--

CREATE TABLE IF NOT EXISTS `DeviceGroup` (
  `accountID` varchar(32) NOT NULL,
  `groupID` varchar(32) NOT NULL,
  `displayName` varchar(40) CHARACTER SET utf8 DEFAULT NULL,
  `description` varchar(128) CHARACTER SET utf8 DEFAULT NULL,
  `notes` text CHARACTER SET utf8,
  `lastUpdateTime` int(10) unsigned DEFAULT NULL,
  `creationTime` int(10) unsigned DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `DeviceList`
--

CREATE TABLE IF NOT EXISTS `DeviceList` (
  `accountID` varchar(32) NOT NULL,
  `groupID` varchar(32) NOT NULL,
  `deviceID` varchar(32) NOT NULL,
  `lastUpdateTime` int(10) unsigned DEFAULT NULL,
  `creationTime` int(10) unsigned DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Diagnostic`
--

CREATE TABLE IF NOT EXISTS `Diagnostic` (
  `accountID` varchar(32) NOT NULL,
  `deviceID` varchar(32) NOT NULL,
  `isError` tinyint(4) NOT NULL,
  `codeKey` int(10) unsigned NOT NULL,
  `timestamp` int(10) unsigned NOT NULL,
  `binaryValue` blob
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Driver`
--

CREATE TABLE IF NOT EXISTS `Driver` (
  `accountID` varchar(32) NOT NULL,
  `driverID` varchar(32) NOT NULL,
  `contactPhone` varchar(32) DEFAULT NULL,
  `contactEmail` varchar(128) DEFAULT NULL,
  `licenseType` varchar(24) DEFAULT NULL,
  `licenseNumber` varchar(32) DEFAULT NULL,
  `licenseExpire` int(10) unsigned DEFAULT NULL,
  `badgeID` varchar(32) DEFAULT NULL,
  `address` varchar(90) CHARACTER SET utf8 DEFAULT NULL,
  `birthdate` int(10) unsigned DEFAULT NULL,
  `deviceID` varchar(32) DEFAULT NULL,
  `driverStatus` int(10) unsigned DEFAULT NULL,
  `dutyStatus` smallint(6) DEFAULT NULL,
  `displayName` varchar(40) CHARACTER SET utf8 DEFAULT NULL,
  `description` varchar(128) CHARACTER SET utf8 DEFAULT NULL,
  `notes` text CHARACTER SET utf8,
  `lastUpdateTime` int(10) unsigned DEFAULT NULL,
  `creationTime` int(10) unsigned DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `EventData`
--

CREATE TABLE IF NOT EXISTS `EventData` (
  `accountID` varchar(32) NOT NULL,
  `deviceID` varchar(32) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL,
  `statusCode` int(10) unsigned NOT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `gpsAge` int(10) unsigned DEFAULT NULL,
  `speedKPH` double DEFAULT NULL,
  `heading` double DEFAULT NULL,
  `altitude` double DEFAULT NULL,
  `transportID` varchar(32) DEFAULT NULL,
  `inputMask` int(10) unsigned DEFAULT NULL,
  `outputMask` int(10) unsigned DEFAULT NULL,
  `address` varchar(90) CHARACTER SET utf8 DEFAULT NULL,
  `dataSource` varchar(32) DEFAULT NULL,
  `rawData` text,
  `distanceKM` double DEFAULT NULL,
  `odometerKM` double DEFAULT NULL,
  `odometerOffsetKM` double DEFAULT NULL,
  `geozoneIndex` int(10) unsigned DEFAULT NULL,
  `geozoneID` varchar(32) DEFAULT NULL,
  `creationTime` int(10) unsigned DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `EventData`
--

INSERT INTO `EventData` (`accountID`, `deviceID`, `timestamp`, `statusCode`, `latitude`, `longitude`, `gpsAge`, `speedKPH`, `heading`, `altitude`, `transportID`, `inputMask`, `outputMask`, `address`, `dataSource`, `rawData`, `distanceKM`, `odometerKM`, `odometerOffsetKM`, `geozoneIndex`, `geozoneID`, `creationTime`) VALUES
('sysadmin', 'gprmc_352642070280600', 1453463316, 64840, 0, 0, 0, 0, 0, 0, '', 0, 0, '', '', '', 0, 0, 0, 0, '', 1453466490),
('sysadmin', 'gprmc_352642070280600', 1453463539, 64842, -33.46306, -70.62628, 0, 65.2, 168, 566, '', 0, 0, '', '', '', 0, 0, 0, 0, '', 1453466490),
('sysadmin', 'gprmc_352642070280600', 1453463544, 61713, -33.4637, -70.62598, 0, 58.3, 169, 580, '', 0, 0, '', '', '', 0, 0.08, 0, 0, '', 1453466490),
('sysadmin', 'gprmc_352642070280600', 1453463553, 61488, -33.46463, -70.62565, 0, 55.2, 164, 582, '', 0, 0, '', '', '', 0, 0.08, 0, 0, '', 1453466490),
('sysadmin', 'gprmc_352642070280600', 1453463572, 63569, -33.46712, -70.6249, 0, 46.9, 168, 585, '', 0, 0, '', '', '', 0, 0.08, 0, 0, '', 1453466491),
('sysadmin', 'gprmc_352642070280600', 1453463585, 61727, -33.46744, -70.62468, 0, 0, 0, 588, '', 0, 0, '', '', '', 0, 0.43, 0, 0, '', 1453466491),
('sysadmin', 'gprmc_352642070280600', 1453463617, 61727, -33.46813, -70.62444, 0, 35.4, 165, 588, '', 0, 0, '', '', '', 0, 0.51, 0, 0, '', 1453466491),
('sysadmin', 'gprmc_352642070280600', 1453463650, 61488, -33.47319, -70.62352, 0, 74.3, 168, 591, '', 0, 0, '', '', '', 0, 0.51, 0, 0, '', 1453466491),
('sysadmin', 'gprmc_352642070280600', 1453463737, 61714, -33.48527, -70.61992, 0, 58.6, 152, 595, '', 0, 0, '', '', '', 0, 2.46, 0, 0, '', 1453466492),
('sysadmin', 'gprmc_352642070280600', 1453463857, 61714, -33.49586, -70.61657, 0, 67.2, 169, 590, '', 0, 0, '', '', '', 0, 3.68, 0, 0, '', 1453466492),
('sysadmin', 'gprmc_352642070280600', 1453463891, 61727, -33.4993, -70.61585, 0, 0, 0, 604, '', 0, 0, '', '', '', 0, 4.07, 0, 0, '', 1453466492),
('sysadmin', 'gprmc_352642070280600', 1453463907, 61488, -33.4993, -70.6159, 0, 5.6, 312, 601, '', 0, 0, '', '', '', 0, 2.41, 0, 0, '', 1453466492),
('sysadmin', 'gprmc_352642070280600', 1453463968, 61727, -33.49894, -70.61551, 0, 0, 0, 599, '', 0, 0, '', '', '', 0, 2.46, 0, 0, '', 1453466493),
('sysadmin', 'gprmc_352642070280600', 1453464084, 61727, -33.49858, -70.61436, 0, 0, 0, 593, '', 0, 0, '', '', '', 0, 2.58, 0, 0, '', 1453466493),
('sysadmin', 'gprmc_352642070280600', 1453464204, 61714, -33.49884, -70.61261, 0, 5, 106, 600, '', 0, 0, '', '', '', 0, 2.74, 0, 0, '', 1453466493),
('sysadmin', 'gprmc_352642070280600', 1453464620, 61715, -33.49911, -70.61226, 0, 0, 0, 600, '', 0, 0, '', '', '', 0, 2.79, 0, 0, '', 1453466493),
('sysadmin', 'gprmc_352642070280600', 1453466421, 61716, -33.49912, -70.61225, 0, 0, 0, 604, '', 0, 0, '', '', '', 0, 2.79, 0, 0, '', 1453466493),
('sysadmin', 'gprmc_352642070280600', 1453466489, 61488, -33.49912, -70.61225, 0, 0, 0, 605, '', 0, 0, '', '', '', 0, 2.79, 0, 0, '', 1453466494),
('sysadmin', 'gprmc_352642070280600', 1453468221, 61716, -33.49911, -70.61224, 0, 0, 0, 608, '', 0, 0, '', '', '', 0, 2.79, 0, 0, '', 1453468221);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `EventTemplate`
--

CREATE TABLE IF NOT EXISTS `EventTemplate` (
  `accountID` varchar(32) NOT NULL,
  `deviceID` varchar(32) NOT NULL,
  `customType` tinyint(3) unsigned NOT NULL,
  `repeatLast` tinyint(4) DEFAULT NULL,
  `template` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Geozone`
--

CREATE TABLE IF NOT EXISTS `Geozone` (
  `accountID` varchar(32) NOT NULL,
  `geozoneID` varchar(32) NOT NULL,
  `sortID` int(10) unsigned NOT NULL,
  `minLatitude` double DEFAULT NULL,
  `maxLatitude` double DEFAULT NULL,
  `minLongitude` double DEFAULT NULL,
  `maxLongitude` double DEFAULT NULL,
  `zonePurposeID` varchar(32) DEFAULT NULL,
  `reverseGeocode` tinyint(4) DEFAULT NULL,
  `arrivalZone` tinyint(4) DEFAULT NULL,
  `arrivalStatusCode` int(10) unsigned DEFAULT NULL,
  `departureZone` tinyint(4) DEFAULT NULL,
  `departureStatusCode` int(10) unsigned DEFAULT NULL,
  `autoNotify` tinyint(4) DEFAULT NULL,
  `zoomRegion` tinyint(4) DEFAULT NULL,
  `shapeColor` varchar(12) DEFAULT NULL,
  `iconName` varchar(24) DEFAULT NULL,
  `zoneType` tinyint(3) unsigned DEFAULT NULL,
  `radius` int(10) unsigned DEFAULT NULL,
  `vertices` text,
  `latitude1` double DEFAULT NULL,
  `longitude1` double DEFAULT NULL,
  `latitude2` double DEFAULT NULL,
  `longitude2` double DEFAULT NULL,
  `latitude3` double DEFAULT NULL,
  `longitude3` double DEFAULT NULL,
  `latitude4` double DEFAULT NULL,
  `longitude4` double DEFAULT NULL,
  `latitude5` double DEFAULT NULL,
  `longitude5` double DEFAULT NULL,
  `latitude6` double DEFAULT NULL,
  `longitude6` double DEFAULT NULL,
  `latitude7` double DEFAULT NULL,
  `longitude7` double DEFAULT NULL,
  `latitude8` double DEFAULT NULL,
  `longitude8` double DEFAULT NULL,
  `latitude9` double DEFAULT NULL,
  `longitude9` double DEFAULT NULL,
  `latitude10` double DEFAULT NULL,
  `longitude10` double DEFAULT NULL,
  `clientUpload` tinyint(4) DEFAULT NULL,
  `clientID` int(10) unsigned DEFAULT NULL,
  `groupID` varchar(32) DEFAULT NULL,
  `streetAddress` varchar(90) CHARACTER SET utf8 DEFAULT NULL,
  `city` varchar(40) CHARACTER SET utf8 DEFAULT NULL,
  `stateProvince` varchar(40) CHARACTER SET utf8 DEFAULT NULL,
  `postalCode` varchar(16) CHARACTER SET utf8 DEFAULT NULL,
  `country` varchar(40) CHARACTER SET utf8 DEFAULT NULL,
  `subdivision` varchar(32) CHARACTER SET utf8 DEFAULT NULL,
  `contactPhone` varchar(32) DEFAULT NULL,
  `isActive` tinyint(4) DEFAULT NULL,
  `displayName` varchar(40) CHARACTER SET utf8 DEFAULT NULL,
  `description` varchar(128) CHARACTER SET utf8 DEFAULT NULL,
  `lastUpdateTime` int(10) unsigned DEFAULT NULL,
  `creationTime` int(10) unsigned DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `GroupList`
--

CREATE TABLE IF NOT EXISTS `GroupList` (
  `accountID` varchar(32) NOT NULL,
  `userID` varchar(32) NOT NULL,
  `groupID` varchar(32) NOT NULL,
  `creationTime` int(10) unsigned DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PendingPacket`
--

CREATE TABLE IF NOT EXISTS `PendingPacket` (
  `accountID` varchar(32) NOT NULL,
  `deviceID` varchar(32) NOT NULL,
  `queueTime` int(10) unsigned NOT NULL,
  `sequence` smallint(5) unsigned NOT NULL,
  `packetBytes` mediumblob,
  `autoDelete` tinyint(4) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Property`
--

CREATE TABLE IF NOT EXISTS `Property` (
  `accountID` varchar(32) NOT NULL,
  `deviceID` varchar(32) NOT NULL,
  `propKey` int(10) unsigned NOT NULL,
  `timestamp` int(10) unsigned DEFAULT NULL,
  `binaryValue` blob
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Resource`
--

CREATE TABLE IF NOT EXISTS `Resource` (
  `accountID` varchar(32) NOT NULL,
  `resourceID` varchar(80) NOT NULL,
  `type` varchar(16) DEFAULT NULL,
  `title` varchar(70) CHARACTER SET utf8 DEFAULT NULL,
  `properties` text,
  `value` blob,
  `displayName` varchar(40) CHARACTER SET utf8 DEFAULT NULL,
  `description` varchar(128) CHARACTER SET utf8 DEFAULT NULL,
  `lastUpdateTime` int(10) unsigned DEFAULT NULL,
  `creationTime` int(10) unsigned DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Role`
--

CREATE TABLE IF NOT EXISTS `Role` (
  `accountID` varchar(32) NOT NULL,
  `roleID` varchar(32) NOT NULL,
  `displayName` varchar(40) CHARACTER SET utf8 DEFAULT NULL,
  `description` varchar(128) CHARACTER SET utf8 DEFAULT NULL,
  `notes` text CHARACTER SET utf8,
  `lastUpdateTime` int(10) unsigned DEFAULT NULL,
  `creationTime` int(10) unsigned DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `RoleAcl`
--

CREATE TABLE IF NOT EXISTS `RoleAcl` (
  `accountID` varchar(32) NOT NULL,
  `roleID` varchar(32) NOT NULL,
  `aclID` varchar(64) NOT NULL,
  `accessLevel` smallint(5) unsigned DEFAULT NULL,
  `description` varchar(128) CHARACTER SET utf8 DEFAULT NULL,
  `lastUpdateTime` int(10) unsigned DEFAULT NULL,
  `creationTime` int(10) unsigned DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `StatusCode`
--

CREATE TABLE IF NOT EXISTS `StatusCode` (
  `accountID` varchar(32) NOT NULL,
  `deviceID` varchar(32) NOT NULL,
  `statusCode` int(10) unsigned NOT NULL,
  `statusName` varchar(18) DEFAULT NULL,
  `foregroundColor` varchar(10) DEFAULT NULL,
  `backgroundColor` varchar(10) DEFAULT NULL,
  `iconSelector` varchar(128) DEFAULT NULL,
  `iconName` varchar(24) DEFAULT NULL,
  `description` varchar(128) CHARACTER SET utf8 DEFAULT NULL,
  `lastUpdateTime` int(10) unsigned DEFAULT NULL,
  `creationTime` int(10) unsigned DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `SystemProps`
--

CREATE TABLE IF NOT EXISTS `SystemProps` (
  `propertyID` varchar(64) NOT NULL,
  `dataType` varchar(80) DEFAULT NULL,
  `value` text CHARACTER SET utf8,
  `description` varchar(128) CHARACTER SET utf8 DEFAULT NULL,
  `lastUpdateTime` int(10) unsigned DEFAULT NULL,
  `creationTime` int(10) unsigned DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `SystemProps`
--

INSERT INTO `SystemProps` (`propertyID`, `dataType`, `value`, `description`, `lastUpdateTime`, `creationTime`) VALUES
('version.gts', '', '2.6.1', 'version.gts', 1453343090, 1453343090),
('version.dmtp', '', '1.3.6', 'version.dmtp', 1453343090, 1453343090);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Transport`
--

CREATE TABLE IF NOT EXISTS `Transport` (
  `accountID` varchar(32) NOT NULL,
  `transportID` varchar(32) NOT NULL,
  `assocAccountID` varchar(32) DEFAULT NULL,
  `assocDeviceID` varchar(32) DEFAULT NULL,
  `uniqueID` varchar(40) DEFAULT NULL,
  `deviceCode` varchar(24) DEFAULT NULL,
  `deviceType` varchar(24) DEFAULT NULL,
  `serialNumber` varchar(24) DEFAULT NULL,
  `simPhoneNumber` varchar(24) DEFAULT NULL,
  `smsEmail` varchar(64) DEFAULT NULL,
  `imeiNumber` varchar(24) DEFAULT NULL,
  `lastInputState` int(10) unsigned DEFAULT NULL,
  `lastOutputState` int(10) unsigned DEFAULT NULL,
  `ignitionIndex` smallint(5) unsigned DEFAULT NULL,
  `codeVersion` varchar(32) DEFAULT NULL,
  `featureSet` varchar(64) DEFAULT NULL,
  `ipAddressValid` varchar(128) DEFAULT NULL,
  `ipAddressCurrent` varchar(32) DEFAULT NULL,
  `remotePortCurrent` smallint(5) unsigned DEFAULT NULL,
  `listenPortCurrent` smallint(5) unsigned DEFAULT NULL,
  `pendingPingCommand` text,
  `lastPingTime` int(10) unsigned DEFAULT NULL,
  `totalPingCount` smallint(5) unsigned DEFAULT NULL,
  `maxPingCount` smallint(5) unsigned DEFAULT NULL,
  `expectAck` tinyint(4) DEFAULT NULL,
  `lastAckCommand` text,
  `lastAckTime` int(10) unsigned DEFAULT NULL,
  `supportsDMTP` tinyint(4) DEFAULT NULL,
  `supportedEncodings` tinyint(3) unsigned DEFAULT NULL,
  `unitLimitInterval` smallint(5) unsigned DEFAULT NULL,
  `maxAllowedEvents` smallint(5) unsigned DEFAULT NULL,
  `totalProfileMask` blob,
  `totalMaxConn` smallint(5) unsigned DEFAULT NULL,
  `totalMaxConnPerMin` smallint(5) unsigned DEFAULT NULL,
  `duplexProfileMask` blob,
  `duplexMaxConn` smallint(5) unsigned DEFAULT NULL,
  `duplexMaxConnPerMin` smallint(5) unsigned DEFAULT NULL,
  `lastTotalConnectTime` int(10) unsigned DEFAULT NULL,
  `lastDuplexConnectTime` int(10) unsigned DEFAULT NULL,
  `displayName` varchar(40) CHARACTER SET utf8 DEFAULT NULL,
  `description` varchar(128) CHARACTER SET utf8 DEFAULT NULL,
  `lastUpdateTime` int(10) unsigned DEFAULT NULL,
  `creationTime` int(10) unsigned DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `UniqueXID`
--

CREATE TABLE IF NOT EXISTS `UniqueXID` (
  `uniqueID` varchar(40) NOT NULL,
  `accountID` varchar(32) DEFAULT NULL,
  `transportID` varchar(32) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `User`
--

CREATE TABLE IF NOT EXISTS `User` (
  `accountID` varchar(32) NOT NULL,
  `userID` varchar(32) NOT NULL,
  `userType` smallint(5) unsigned DEFAULT NULL,
  `roleID` varchar(32) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `gender` tinyint(3) unsigned DEFAULT NULL,
  `notifyEmail` varchar(128) DEFAULT NULL,
  `contactName` varchar(64) CHARACTER SET utf8 DEFAULT NULL,
  `contactPhone` varchar(32) DEFAULT NULL,
  `contactEmail` varchar(64) DEFAULT NULL,
  `timeZone` varchar(32) DEFAULT NULL,
  `firstLoginPageID` varchar(24) DEFAULT NULL,
  `preferredDeviceID` varchar(32) DEFAULT NULL,
  `maxAccessLevel` smallint(5) unsigned DEFAULT NULL,
  `passwdChangeTime` int(10) unsigned DEFAULT NULL,
  `passwdQueryTime` int(10) unsigned DEFAULT NULL,
  `expirationTime` int(10) unsigned DEFAULT NULL,
  `lastLoginTime` int(10) unsigned DEFAULT NULL,
  `isActive` tinyint(4) DEFAULT NULL,
  `displayName` varchar(40) CHARACTER SET utf8 DEFAULT NULL,
  `description` varchar(128) CHARACTER SET utf8 DEFAULT NULL,
  `notes` text CHARACTER SET utf8,
  `lastUpdateTime` int(10) unsigned DEFAULT NULL,
  `creationTime` int(10) unsigned DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `User`
--

INSERT INTO `User` (`accountID`, `userID`, `userType`, `roleID`, `password`, `gender`, `notifyEmail`, `contactName`, `contactPhone`, `contactEmail`, `timeZone`, `firstLoginPageID`, `preferredDeviceID`, `maxAccessLevel`, `passwdChangeTime`, `passwdQueryTime`, `expirationTime`, `lastLoginTime`, `isActive`, `displayName`, `description`, `notes`, `lastUpdateTime`, `creationTime`) VALUES
('sysadmin', 'testing', 0, '', '', 0, '', '', '', '', 'GMT', '', '', 0, 0, 0, 0, 0, 1, '', 'New User', '', 1459286245, 1459286245);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `UserAcl`
--

CREATE TABLE IF NOT EXISTS `UserAcl` (
  `accountID` varchar(32) NOT NULL,
  `userID` varchar(32) NOT NULL,
  `aclID` varchar(64) NOT NULL,
  `accessLevel` smallint(5) unsigned DEFAULT NULL,
  `description` varchar(128) CHARACTER SET utf8 DEFAULT NULL,
  `lastUpdateTime` int(10) unsigned DEFAULT NULL,
  `creationTime` int(10) unsigned DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Account`
--
ALTER TABLE `Account`
 ADD PRIMARY KEY (`accountID`), ADD KEY `email` (`contactEmail`);

--
-- Indices de la tabla `AccountString`
--
ALTER TABLE `AccountString`
 ADD PRIMARY KEY (`accountID`,`stringID`);

--
-- Indices de la tabla `Device`
--
ALTER TABLE `Device`
 ADD PRIMARY KEY (`accountID`,`deviceID`), ADD KEY `altIndex` (`uniqueID`);

--
-- Indices de la tabla `DeviceGroup`
--
ALTER TABLE `DeviceGroup`
 ADD PRIMARY KEY (`accountID`,`groupID`);

--
-- Indices de la tabla `DeviceList`
--
ALTER TABLE `DeviceList`
 ADD PRIMARY KEY (`accountID`,`groupID`,`deviceID`);

--
-- Indices de la tabla `Diagnostic`
--
ALTER TABLE `Diagnostic`
 ADD PRIMARY KEY (`accountID`,`deviceID`,`isError`,`codeKey`,`timestamp`);

--
-- Indices de la tabla `Driver`
--
ALTER TABLE `Driver`
 ADD PRIMARY KEY (`accountID`,`driverID`);

--
-- Indices de la tabla `EventData`
--
ALTER TABLE `EventData`
 ADD PRIMARY KEY (`accountID`,`deviceID`,`timestamp`,`statusCode`);

--
-- Indices de la tabla `EventTemplate`
--
ALTER TABLE `EventTemplate`
 ADD PRIMARY KEY (`accountID`,`deviceID`,`customType`);

--
-- Indices de la tabla `Geozone`
--
ALTER TABLE `Geozone`
 ADD PRIMARY KEY (`accountID`,`geozoneID`,`sortID`), ADD KEY `bounds` (`minLatitude`,`maxLatitude`,`minLongitude`,`maxLongitude`), ADD KEY `altIndex` (`clientID`);

--
-- Indices de la tabla `GroupList`
--
ALTER TABLE `GroupList`
 ADD PRIMARY KEY (`accountID`,`userID`,`groupID`);

--
-- Indices de la tabla `PendingPacket`
--
ALTER TABLE `PendingPacket`
 ADD PRIMARY KEY (`accountID`,`deviceID`,`queueTime`,`sequence`);

--
-- Indices de la tabla `Property`
--
ALTER TABLE `Property`
 ADD PRIMARY KEY (`accountID`,`deviceID`,`propKey`);

--
-- Indices de la tabla `Resource`
--
ALTER TABLE `Resource`
 ADD PRIMARY KEY (`accountID`,`resourceID`);

--
-- Indices de la tabla `Role`
--
ALTER TABLE `Role`
 ADD PRIMARY KEY (`accountID`,`roleID`);

--
-- Indices de la tabla `RoleAcl`
--
ALTER TABLE `RoleAcl`
 ADD PRIMARY KEY (`accountID`,`roleID`,`aclID`);

--
-- Indices de la tabla `StatusCode`
--
ALTER TABLE `StatusCode`
 ADD PRIMARY KEY (`accountID`,`deviceID`,`statusCode`);

--
-- Indices de la tabla `SystemProps`
--
ALTER TABLE `SystemProps`
 ADD PRIMARY KEY (`propertyID`);

--
-- Indices de la tabla `Transport`
--
ALTER TABLE `Transport`
 ADD PRIMARY KEY (`accountID`,`transportID`), ADD KEY `device` (`assocAccountID`,`assocDeviceID`), ADD KEY `altIndex` (`uniqueID`);

--
-- Indices de la tabla `UniqueXID`
--
ALTER TABLE `UniqueXID`
 ADD PRIMARY KEY (`uniqueID`);

--
-- Indices de la tabla `User`
--
ALTER TABLE `User`
 ADD PRIMARY KEY (`accountID`,`userID`), ADD KEY `role` (`roleID`), ADD KEY `email` (`contactEmail`);

--
-- Indices de la tabla `UserAcl`
--
ALTER TABLE `UserAcl`
 ADD PRIMARY KEY (`accountID`,`userID`,`aclID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
