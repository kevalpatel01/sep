<?php

	global $db, $dbname;
	$db->DB_connect;
	$db->DB_query("CREATE DATABASE `".$dbname."` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;");
	$db->DB_query("USE `".$dbname."`;");
	$db->DB_query("CREATE TABLE `hobbies` (
				  `id` int(11) NOT NULL auto_increment,
				  `name` varchar(50) NOT NULL,
				  PRIMARY KEY  (`id`)
				) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;
				");
	$db->DB_query("CREATE TABLE `matches` (
				  `id` int(8) NOT NULL auto_increment,
				  `home` varchar(30) NOT NULL,
				  `visitor` varchar(30) NOT NULL,
				  `date` datetime NOT NULL,
				  `place_id` int(8) NOT NULL,
				  PRIMARY KEY  (`id`)
				) ENGINE=InnoDB  DEFAULT CHARSET=latin1;
				 ");
	$db->DB_query("CREATE TABLE `meetings` (
				  `id` int(8) NOT NULL auto_increment,
				  `match_id` int(8) NOT NULL,
				  `user_id` int(8) NOT NULL,
				  PRIMARY KEY  (`id`)
				) ENGINE=InnoDB  DEFAULT CHARSET=latin1;
				 ");
	$db->DB_query("CREATE TABLE `places` (
				  `id` int(8) NOT NULL auto_increment,
				  `name` varchar(100) NOT NULL,
				  `address` varchar(100) NOT NULL,
				  PRIMARY KEY  (`id`)
				) ENGINE=InnoDB  DEFAULT CHARSET=latin1;
				 ");
	$db->DB_query("CREATE TABLE `users` (
				  `id` int(8) NOT NULL auto_increment,
				  `username` varchar(20) NOT NULL,
				  `password` varchar(50) NOT NULL,
				  `year` year(4) NOT NULL,
				  `gender` enum('M','F') NOT NULL default 'M',
				  `family` int(11) NOT NULL,
				  `intro` text NOT NULL,
				  PRIMARY KEY  (`id`)
				) ENGINE=InnoDB  DEFAULT CHARSET=latin1;
				 ");
	$db->DB_query("CREATE TABLE `users_hobbies` (
				  `id` int(11) NOT NULL auto_increment,
				  `uid` int(11) NOT NULL,
				  `hid` int(11) NOT NULL,
				  PRIMARY KEY  (`id`)
				) ENGINE=InnoDB  DEFAULT CHARSET=latin1;
				 ");
	$db->DB_query("INSERT INTO `hobbies` (`id`, `name`) VALUES
				(1, 'Sport'),
				(2, 'Mozi'),
				(3, 'TV'),
				(4, 'Színház'),
				(5, 'Túra'),
				(6, 'Autó');
				 ");		
?>