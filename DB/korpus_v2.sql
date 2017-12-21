# Host: localhost  (Version 5.5.5-10.1.26-MariaDB)
# Date: 2017-12-21 18:36:19
# Generator: MySQL-Front 5.3  (Build 5.21)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "admin"
#

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL DEFAULT '',
  `password` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

#
# Data for table "admin"
#

INSERT INTO `admin` VALUES (1,'Special1','abc123','Jose Mourinho'),(4,'Faryhun','abc123','Farihan'),(8,'admin','abc123','admin');

#
# Structure for table "category"
#

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

#
# Data for table "category"
#

INSERT INTO `category` VALUES (1,'Sports'),(2,'Lifestyle'),(3,'Education'),(4,'Business'),(5,'Crime & Courts');

#
# Structure for table "news"
#

DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` longtext,
  `created_date` datetime DEFAULT NULL,
  `created_by` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

#
# Data for table "news"
#

INSERT INTO `news` VALUES (1,'Business','News 1','26 october 2017\nKUALA LUMPUR: Bursa Malaysia opened higher today, tracking the mixed performances of its Asian peers despite the softer lead from overnight Wall Street, dealers said.\n\nAt 9.04 am, the benchmark FTSE Bursa Malaysia KLCI (FBM KLCI) was 1.53 points higher at 1,740.58 from Wednesday\'s close of 1,739.05.\n\nThe index opened 1.16 points better at 1,740.21.\n\nOn the broader market, gainers led losers by 106 to 76, while 181 counters remained unchanged with 1,512 untraded and 23 others were suspended.\n\nTurnover stood at 125.39 million shares worth RM28.04 million.\n\nIn a note today, Alliance DBS Research said, the market has been drifting lower since Sept 13 this year with only seven market days up and 22 down over the past 29 market days.\n\nHowever, with the benchmark index about three points away from the 1,730 level measuring from the dayâ€™s low of 1,733.67, selling interest began to fizzle out because 1,730 is seen as a demand level, it said.\n\nâ€œFollowing the firmer close yesterday, we should see buying attempt again with immediate hurdle at 1,740.\n\nâ€œThe analysis of yesterdayâ€™s overall market action revealed that buying power was stronger than selling pressure. As such, FBMKLCI would likely trade above the 1,740.51 today,â€ it said.\n\nAmong heavyweights, Maybank and Public Bank added two sen each to RM9.26 and RM20.48 respectively.\n\nTNB, Sime Darby and Petronas Chemicals were flat at RM14.34, RM9.08 and RM7.45 respectively.\n\nOf the actives, PUC and its warrant edged up half-a-sen each to 18 sen and 9.5 sen respectively, GPA Holdings warrant and NiHsin warrant rose one each to five sen and 6.5 sen while D.B.E. Gurney was flat at 3.5 sen.\n\nThe FBM Emas Index improved 7.98 points to 12,498.71, FBMT100 Index was 8.78 points firmer at 12,141.15, FBM Emas Shariah Index added 4.21 points to 12,869.79 and the FBM 70 gained 3.95 points to 15,207.28.\n\nThe FBM Ace fell 24.98 points to 6,813.18.\n\nSector-wise, the Plantation Index was 33.43 points higher at 7,959.72, Industrial Index added 1.26 points to 3,198.63 and the Finance Index rose 13.50 points to 16,274.15. - Bernama\n\n\n','2017-12-20 00:00:00','Faryhun'),(3,'Sports','Sharapova Win','15 OCTOBER 2017\nTIANJIN: Five-time Grand Slam winner Maria Sharapova was made to fight by 102nd-ranked teenager Aryna Sabalenka before winning her first title since her 15-month doping ban at the Tianjin Open on Sunday.\n\nThe Russian former world number one, who returned to action in April, came from behind in both sets and needed four match points in the tie-breaker before beating the 19-year-old 7-5, 7-6 (10/8).\n\nSharapova clasped her hands to her chest in delight at winning her 36th tour title and the first in more than two years since the 2015 Italian Open.\n\nSharapova, 30, was contesting the seventh tournament of what has been an injury-plagued and controversial comeback since testing positive for the banned substance meldonium in early 2016.\n\nShe exchanged 11 breaks of serve with Sabalenka, who has yet to win a WTA trophy, before finally clinching it in the tie-breaker when the teenager put a forehand return long. - AFP\n','2017-12-20 01:16:37','Faryhun');
