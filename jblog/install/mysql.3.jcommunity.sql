CREATE TABLE `community_users` (
  `login` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nickname` varchar(50) default NULL,
  `status` tinyint(4) NOT NULL default '0',
  `keyactivate` varchar(10) default NULL,
  `request_date` datetime default NULL,
  PRIMARY KEY  (`login`)
);