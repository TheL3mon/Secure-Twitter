CREATE DATABASE /*!32312 IF NOT EXISTS*/`tweeterdb` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `tweeterdb`;

/*Table structure for table `following` */

DROP TABLE IF EXISTS `following`;

CREATE TABLE `following` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user1_id` int(11) DEFAULT NULL,
  `user2_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `following` */

/*Table structure for table `roles` */

-- DROP TABLE IF EXISTS `roles`;

-- CREATE TABLE `roles` (
--   `id` int(11) NOT NULL AUTO_INCREMENT,
--   `label` varchar(50) NOT NULL,
--   PRIMARY KEY (`id`)
-- ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `roles` */

-- insert  into `roles`(`id`,`label`) values 
-- (1,'User'),
-- (2,'Admin');

/*Table structure for table `tweets` */

DROP TABLE IF EXISTS `tweets`;

CREATE TABLE `tweets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `tweet` varchar(140) NOT NULL,
  `timestamp` bigint(20) NOT NULL,
  `images` blob DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;


/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) NOT NULL,
  `password` varchar(100) NOT NULL,
  `followers` int(11) DEFAULT 0,
  `following` int(11) DEFAULT 0,
  `tweets` int(11) DEFAULT 0,
  `roleId` int(11) DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `userRole` (`roleId`),
  CONSTRAINT `userRole` FOREIGN KEY (`roleId`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;





/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
