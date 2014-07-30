
CREATE TABLE `soldiers_info`(
	`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
	`first_name` varchar(50),
	`last_name` varchar(50),
	`rank` varchar(100),
	`address` varchar(300),
	`phone` varchar(20),
	`remark_list` text,
	`created_on` int(11) DEFAULT NULL,
	`modified_on` int(11) DEFAULT NULL,
	PRIMARY KEY(`id`)
)AUTO_INCREMENT=1;

CREATE TABLE `remarks`(
	`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
	`description` varchar(500),
	`soldier_id` int(11) unsigned NOT NULL,
	`created_on` int(11) DEFAULT NULL,
	`modified_on` int(11) DEFAULT NULL,
	PRIMARY KEY(`id`)
)AUTO_INCREMENT=1;
ALTER TABLE `remarks`
  ADD CONSTRAINT `fk_remarks_soldier_info1` FOREIGN KEY (`soldier_id`) REFERENCES `soldiers_info` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

