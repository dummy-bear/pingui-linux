create database pingui;
CREATE TABLE `rkp` (
`ID` int(11) default NULL,
  `prefix` varchar(16) default NULL,
  `pip` int(11) default NULL,
  `adres` varchar(2048) default NULL
);
 CREATE TABLE `host` (
  `ID` int(11) default NULL,
  `rkpID` int(11) default NULL,
  `ip` int(11) default NULL,
  `port` int(11) default NULL,
  `opis` varchar(2048) default NULL,
  `color` varchar(32) default NULL
);
 CREATE TABLE `pings` (
  `hID` int(11) default NULL,
  `kogda` datetime default NULL,
  `errcod` int(11) default NULL,
  KEY `kogda` (`kogda`)
);
