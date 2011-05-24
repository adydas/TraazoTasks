SET FOREIGN_KEY_CHECKS = 0;

drop database nutshellapp;
create database nutshellapp;


CREATE TABLE account (id INT AUTO_INCREMENT, user_id INT NOT NULL, name VARCHAR(240) NOT NULL, domain_id INT NOT NULL, primary_user INT NOT NULL, plan_id INT, created DATETIME NOT NULL, address_id INT, INDEX address_id_idx (address_id), INDEX user_id_idx (user_id), INDEX domain_id_idx (domain_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE account_group (group_id INT AUTO_INCREMENT, account_id INT NOT NULL, name VARCHAR(240) NOT NULL, created DATETIME NOT NULL, INDEX account_id_idx (account_id), PRIMARY KEY(group_id)) ENGINE = INNODB;
CREATE TABLE account_type (user_id INT, type_id INT, created DATETIME NOT NULL, PRIMARY KEY(user_id, type_id)) ENGINE = INNODB;
CREATE TABLE account_user (account_id INT NOT NULL, user_id INT NOT NULL, team_id INT, created DATETIME NOT NULL, PRIMARY KEY(account_id, user_id)) ENGINE = INNODB;
CREATE TABLE account_user_role (account_id INT, role_id INT, user_id INT, created DATETIME NOT NULL, PRIMARY KEY(account_id, role_id, user_id)) ENGINE = INNODB;


CREATE TABLE sf_guard_group (id INT AUTO_INCREMENT, name VARCHAR(255) UNIQUE, description TEXT, created_at DATETIME, updated_at DATETIME, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_group_permission (group_id INT, permission_id INT, created_at DATETIME, updated_at DATETIME, PRIMARY KEY(group_id, permission_id)) ENGINE = INNODB;
CREATE TABLE sf_guard_permission (id INT AUTO_INCREMENT, name VARCHAR(255) UNIQUE, description TEXT, created_at DATETIME, updated_at DATETIME, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_remember_key (id INT AUTO_INCREMENT, user_id INT, remember_key VARCHAR(32), ip_address VARCHAR(50), created_at DATETIME, updated_at DATETIME, INDEX user_id_idx (user_id), PRIMARY KEY(id, ip_address)) ENGINE = INNODB;
CREATE TABLE sf_guard_user (id INT AUTO_INCREMENT, username VARCHAR(128) NOT NULL UNIQUE, algorithm VARCHAR(128) DEFAULT 'sha1' NOT NULL, salt VARCHAR(128), password VARCHAR(128), is_active TINYINT(1) DEFAULT '1', is_super_admin TINYINT(1) DEFAULT '0', last_login DATETIME, created_at DATETIME, updated_at DATETIME, INDEX is_active_idx_idx (is_active), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_user_group (user_id INT, group_id INT, created_at DATETIME, updated_at DATETIME, PRIMARY KEY(user_id, group_id)) ENGINE = INNODB;
CREATE TABLE sf_guard_user_permission (user_id INT, permission_id INT, created_at DATETIME, updated_at DATETIME, PRIMARY KEY(user_id, permission_id)) ENGINE = INNODB;



-- ID
CREATE TABLE project (account_id INT(11) NOT NULL, id INT(11) NOT NULL, created_by INT NOT NULL, name VARCHAR(240) NOT NULL, status INT DEFAULT '0', created DATETIME NOT NULL, address_id INT, description TEXT, PRIMARY KEY(`account_id`, `id`)) ENGINE = INNODB;
-- ID

CREATE TABLE audit_log (id BIGINT AUTO_INCREMENT, log TEXT NOT NULL, created_time DATETIME NOT NULL, action_name VARCHAR(244), PRIMARY KEY(id)) ENGINE = INNODB;

CREATE TABLE comment (comment_id INT AUTO_INCREMENT, account_id INT NOT NULL, project_id INT NULL, group_id INT NULL, task_id INT NULL, file_id INT NULL, submitted_by INT NOT NULL, status char NOT NULL default 0, comment_text TEXT NOT NULL,  created DATETIME NOT NULL,  PRIMARY KEY(comment_id)) ENGINE = INNODB;


CREATE TABLE domain (id INT, name VARCHAR(148) NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE email (email_id INT AUTO_INCREMENT, user_id INT NOT NULL, email VARCHAR(240) NOT NULL, created DATETIME NOT NULL, INDEX user_id_idx (user_id), PRIMARY KEY(email_id)) ENGINE = INNODB;

CREATE TABLE event_log(event_log_id INT AUTO_INCREMENT, account_id INT NOT NULL, user_id INT NOT NULL, project_id INT NULL, group_id INT NULL, task_id INT NULL, file_id INT NULL, action ENUM('CREATE', 'READ', 'UPDATE', 'DELETE', 'COMMENT', 'ASSIGN'), action_detail VARCHAR(248), created DATETIME NOT NULL, PRIMARY KEY(event_log_id)) ENGINE = INNODB;


CREATE TABLE `file` (`id` INT AUTO_INCREMENT,  account_id INT(11) NOT NULL, `project_id` int(11), `created` datetime default NULL,`is_public` smallint(1) default '0', PRIMARY KEY  (`id`)) ENGINE=MyISAM;
CREATE TABLE `file_info` (`file_id` INT, version int(4) default 0, version_id INT(11), `name` varchar(512) default NULL, `path` varchar(1048) default NULL, description text NULL, `type` int(11) NOT NULL default '0',`size` int(11) default NULL ,`creator_id` int(11) NOT NULL, PRIMARY KEY(file_id, version_id)) ENGINE=MyISAM;
CREATE TABLE `file_user` (`file_id` INT ,`viewer_id` int(11) default NULL,`view_date` datetime default NULL, PRIMARY KEY(file_id, viewer_id)) ENGINE=MyISAM;
CREATE TABLE `file_task` (`file_id` INT NOT NULL, `task_id` int(11) NOT NULL, PRIMARY KEY  (`file_id`, `task_id`)) ENGINE=MyISAM;
CREATE TABLE `file_version` (`version_id` INT AUTO_INCREMENT,`file_id` INT NOT NULL, `version` int(4) default 1,`created` datetime default NULL, PRIMARY KEY  (`version_id`)) ENGINE=MyISAM;

-- ID
CREATE TABLE `issue` (account_id INT(11) NOT NULL, `project_id` INT(11) NOT NULL, `id` INT(11) NOT NULL, `group_id` INT NULL, `reported_by` INT(11) NOT NULL, `assigned_to` INT(11), `summary` TEXT, `description` TEXT, `status` SMALLINT NOT NULL default 0, `level2_status` SMALLINT NOT NULL default 0, `level3_status` SMALLINT NOT NULL default 0, `created` DATETIME, `updated` DATETIME, PRIMARY KEY(`account_id`, `project_id`,`id`)) ENGINE = INNODB;
-- ID

CREATE TABLE `issue_meta` (`issue_id` INT(11) NOT NULL, `severity` VARCHAR(24), `frequency` VARCHAR(8), `hardware` VARCHAR(24), `version` VARCHAR(12), PRIMARY KEY(`issue_id`)) ENGINE = INNODB;
CREATE TABLE `issue_comment` (`comment_id` INT(11) AUTO_INCREMENT, `issue_id` INT(11) NOT NULL, `author` INT(11) NOT NULL, `body` TEXT, `created` DATETIME, PRIMARY KEY(`comment_id`, `issue_id`)) ENGINE = INNODB;
CREATE TABLE `issue_task` (`issue_id` INT NOT NULL, `task_id` int(11) NOT NULL, PRIMARY KEY  (`issue_id`, `task_id`)) ENGINE=InnoDB;
CREATE TABLE `issue_tracker` (`tracker_id` INT(11) AUTO_INCREMENT, `issue_id` INT NOT NULL, `track_info` LONGTEXT, `created` DATETIME, PRIMARY KEY  (`tracker_id`)) ENGINE=InnoDB;

CREATE TABLE `file_issue` (`file_id` INT NOT NULL, `issue_id` int(11) NOT NULL, PRIMARY KEY  (`file_id`, `issue_id`)) ENGINE=InnoDB;


CREATE TABLE message (messg_id INT AUTO_INCREMENT, messg_sub_id INT NULL, account_id INT, project_id INT NULL, subject varchar(2048) NULL default 'Untitled Message', body TEXT NULL, submitted_by INT NOT NULL, status char NOT NULL default 1, created DATETIME NOT NULL, PRIMARY KEY(messg_id)) ENGINE = INNODB;
CREATE TABLE message_tag (messg_tag_id INT AUTO_INCREMENT, messg_id INT NOT NULL, tags varchar(2048) NOT NULL, PRIMARY KEY(messg_tag_id)) ENGINE = INNODB;
CREATE TABLE message_subs(messg_id INT NOT NULL, subscriber_id INT NOT NULL, PRIMARY KEY(messg_id, subscriber_id)) ENGINE = INNODB;


CREATE TABLE notification (id BIGINT AUTO_INCREMENT, invite_id INT NOT NULL, message TEXT NOT NULL, type INT NOT NULL, read_status SMALLINT DEFAULT '0' NOT NULL, created DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE notification_type (type_id INT, notification VARCHAR(248) NOT NULL, description TEXT, PRIMARY KEY(type_id)) ENGINE = INNODB;
CREATE TABLE notif_message (message_id INT AUTO_INCREMENT, body TEXT NOT NULL, created_by INT NOT NULL, notif_type SMALLINT DEFAULT '0' NOT NULL, created DATETIME NOT NULL, sub_message_id INT, title TEXT, subject TEXT, INDEX created_by_idx (created_by), INDEX sub_message_id_idx (sub_message_id), PRIMARY KEY(message_id)) ENGINE = INNODB;
CREATE TABLE notif_user (message_id INT, recipient INT, status SMALLINT DEFAULT '0' NOT NULL, updated DATETIME NOT NULL, PRIMARY KEY(message_id, recipient)) ENGINE = INNODB;

CREATE TABLE payment_card (payment_card_id INT AUTO_INCREMENT, first_name VARCHAR(148) NOT NULL, last_name VARCHAR(148) NOT NULL, card_num INT NOT NULL, card_type VARCHAR(5) NOT NULL, expiry_month VARCHAR(2) NOT NULL, expiry_year VARCHAR(4) NOT NULL, ccv VARCHAR(8) NOT NULL, created DATETIME NOT NULL, status SMALLINT DEFAULT '1' NOT NULL, PRIMARY KEY(payment_card_id)) ENGINE = INNODB;
CREATE TABLE payment_transaction (payment_transaction_id INT AUTO_INCREMENT, gateway_transaction_id VARCHAR(124) NOT NULL, account_id INT NOT NULL, user_id INT NOT NULL, created DATETIME NOT NULL, payment_card_id INT NOT NULL, total_value DECIMAL(6,2) DEFAULT 0.00, currency VARCHAR(8) DEFAULT 'USD' NOT NULL, status SMALLINT DEFAULT '0' NOT NULL, PRIMARY KEY(payment_transaction_id)) ENGINE = INNODB;

CREATE TABLE phone (phone_id INT AUTO_INCREMENT, type INT DEFAULT '0', created DATETIME NOT NULL, number VARCHAR(20), INDEX type_idx (type), PRIMARY KEY(phone_id)) ENGINE = INNODB;
CREATE TABLE phone_type (type_id INT, name VARCHAR(20), PRIMARY KEY(type_id)) ENGINE = INNODB;
CREATE TABLE profile (profile_id INT AUTO_INCREMENT, user_id INT NOT NULL, sex CHAR(1), created DATETIME NOT NULL, first_name VARCHAR(255), last_name VARCHAR(255), address_id INT, INDEX user_id_idx (user_id), INDEX address_id_idx (address_id), PRIMARY KEY(profile_id)) ENGINE = INNODB;



CREATE TABLE project_email (project_id INT, email_id INT, created DATETIME NOT NULL, PRIMARY KEY(project_id, email_id)) ENGINE = INNODB;
CREATE TABLE project_file (file_id INT, project_id INT, created DATETIME NOT NULL, PRIMARY KEY(file_id, project_id)) ENGINE = INNODB;
CREATE TABLE project_user (project_id INT NOT NULL AUTO_INCREMENT, user_id INT, team_id INT, created DATETIME NOT NULL, INDEX project_id_idx (project_id), PRIMARY KEY(user_id, team_id)) ENGINE = INNODB;
CREATE TABLE project_user_role (project_id INT, role_id INT, user_id INT, created DATETIME NOT NULL, PRIMARY KEY(project_id, role_id, user_id)) ENGINE = INNODB;
CREATE TABLE session (id VARCHAR(255), time BIGINT DEFAULT '0', data TEXT, PRIMARY KEY(id)) ENGINE = INNODB;


-- ID
CREATE TABLE task (account_id INT(11) NOT NULL, project_id INT(11) NOT NULL, id INT NOT NULL, group_id INT NOT NULL, created_by INT NOT NULL, name VARCHAR(240) NOT NULL, estimate_units DECIMAL(4,2), estimate_type INT DEFAULT '1', status INT DEFAULT '0' NOT NULL, created DATETIME NOT NULL, owner INT, description TEXT, due_date DATETIME, INDEX owner_idx (owner), INDEX project_id_idx (project_id), INDEX created_by_idx (created_by), PRIMARY KEY(account_id, project_id, id)) ENGINE = INNODB;
CREATE TABLE groups (account_id INT(11) NOT NULL, project_id INT(11) NOT NULL, id INT NOT NULL, parent_id INT NULL, name VARCHAR(240), primary_owner INT NULL, sec_owner INT NULL, created_by INT NULL, created DATETIME, PRIMARY KEY(account_id, project_id, id)) ENGINE = INNODB;
-- ID

CREATE TABLE team (team_id INT AUTO_INCREMENT, project_id INT NOT NULL, name VARCHAR(120) NOT NULL, created DATETIME NOT NULL, INDEX project_id_idx (project_id), PRIMARY KEY(team_id)) ENGINE = INNODB;
CREATE TABLE team_user (team_id INT AUTO_INCREMENT, user_id INT, created DATETIME NOT NULL, user_role_id INT, INDEX user_role_id_idx (user_role_id), PRIMARY KEY(team_id, user_id)) ENGINE = INNODB;
CREATE TABLE user_account (user_id INT, created DATETIME NOT NULL, first_name VARCHAR(255), last_name VARCHAR(255), email VARCHAR(255), PRIMARY KEY(user_id)) ENGINE = INNODB;
CREATE TABLE user_address (address_id INT, user_id INT, created DATETIME NOT NULL, type VARCHAR(25), PRIMARY KEY(address_id, user_id)) ENGINE = INNODB;
CREATE TABLE user_email (email_id INT, user_id INT, sequence INT DEFAULT '1' NOT NULL, created DATETIME NOT NULL, PRIMARY KEY(email_id, user_id)) ENGINE = INNODB;
CREATE TABLE user_group (group_id INT, user_id INT, PRIMARY KEY(group_id, user_id)) ENGINE = INNODB;
CREATE TABLE user_phone (phone_id INT, user_id INT, created DATETIME NOT NULL, PRIMARY KEY(phone_id, user_id)) ENGINE = INNODB;
CREATE TABLE user_profile (profile_id INT AUTO_INCREMENT, user_id INT NOT NULL, created DATETIME NOT NULL, street_1 VARCHAR(255), street_2 VARCHAR(255), city VARCHAR(255), state VARCHAR(255), zip VARCHAR(48), country VARCHAR(48), PRIMARY KEY(profile_id)) ENGINE = INNODB;
CREATE TABLE user_role (role_id INT, role_name VARCHAR(240) NOT NULL, role_category VARCHAR(240), PRIMARY KEY(role_id)) ENGINE = INNODB;
CREATE TABLE user_type (type_id INT, type VARCHAR(48) NOT NULL, description VARCHAR(255), PRIMARY KEY(type_id)) ENGINE = INNODB;

CREATE TABLE plan (plan_id INT, type VARCHAR(48) NOT NULL, description VARCHAR(255), price DECIMAL(3,2), PRIMARY KEY(plan_id)) ENGINE = INNODB;
CREATE TABLE plan_feature (plan_id INT, space INT(11) NOT NULL, num_users INT(11), num_projects INT(11), iphone_access CHAR(1), ssl_on CHAR(1), data_backup CHAR(1), PRIMARY KEY(plan_id)) ENGINE = INNODB;

CREATE TABLE `user_pref` (account_id INT(11) NOT NULL, `user_id` INT(11) NOT NULL, `prefs` VARCHAR(2048), PRIMARY KEY(`account_id`, `project_id`,`user_id`)) ENGINE = INNODB;

ALTER TABLE user_pref ADD FOREIGN KEY (account_id) REFERENCES account(id);
ALTER TABLE user_pref ADD FOREIGN KEY (user_id) REFERENCES sf_guard_user(id);

alter table groups add column list_sequence integer(11) after sec_owner;
alter table task add column list_sequence integer(11);

ALTER TABLE `groups` ADD FOREIGN KEY (account_id) REFERENCES account(id);
ALTER TABLE `groups` ADD FOREIGN KEY (project_id) REFERENCES project(id);
ALTER TABLE `groups` ADD FOREIGN KEY (parent_id) REFERENCES `groups`(id);
ALTER TABLE `groups` ADD FOREIGN KEY (primary_owner) REFERENCES sf_guard_user(id);
ALTER TABLE `groups` ADD FOREIGN KEY (sec_owner) REFERENCES sf_guard_user(id);
ALTER TABLE `groups` ADD FOREIGN KEY (created_by) REFERENCES sf_guard_user(id);

ALTER TABLE task ADD FOREIGN KEY (account_id) REFERENCES account(id);
ALTER TABLE task ADD FOREIGN KEY (project_id) REFERENCES project(id);
ALTER TABLE task ADD FOREIGN KEY (group_id) REFERENCES `groups`(id);
ALTER TABLE task ADD FOREIGN KEY (owner) REFERENCES sf_guard_user(id);
ALTER TABLE task ADD FOREIGN KEY (created_by) REFERENCES sf_guard_user(id);


ALTER TABLE account ADD FOREIGN KEY (user_id) REFERENCES sf_guard_user(id);
ALTER TABLE account ADD FOREIGN KEY (domain_id) REFERENCES domain(id);
ALTER TABLE account ADD FOREIGN KEY (address_id) REFERENCES address(address_id);
ALTER TABLE account ADD FOREIGN KEY (plan_id) REFERENCES plan(plan_id);

ALTER TABLE account_group ADD FOREIGN KEY (account_id) REFERENCES account(id);
ALTER TABLE account_user ADD FOREIGN KEY (user_id) REFERENCES sf_guard_user(id);
ALTER TABLE account_user ADD FOREIGN KEY (account_id) REFERENCES account(id);
ALTER TABLE account_user ADD FOREIGN KEY (team_id) REFERENCES team(team_id);
ALTER TABLE account_user_role ADD FOREIGN KEY (user_id) REFERENCES sf_guard_user(id);
ALTER TABLE account_user_role ADD FOREIGN KEY (account_id) REFERENCES account(id);
ALTER TABLE address ADD FOREIGN KEY (phone_id) REFERENCES phone(phone_id);
ALTER TABLE email ADD FOREIGN KEY (user_id) REFERENCES sf_guard_user(id);

ALTER TABLE event_log ADD FOREIGN KEY (user_id) REFERENCES sf_guard_user(id);
ALTER TABLE event_log ADD FOREIGN KEY (account_id) REFERENCES account(id);
ALTER TABLE event_log ADD FOREIGN KEY (project_id) REFERENCES project(id);
ALTER TABLE event_log ADD FOREIGN KEY (group_id) REFERENCES `groups`(id);
ALTER TABLE event_log ADD FOREIGN KEY (file_id) REFERENCES file(file_id);


ALTER TABLE file ADD FOREIGN KEY (project_id) REFERENCES project(id);
ALTER TABLE file_info ADD FOREIGN KEY (file_id) REFERENCES file(file_id);
ALTER TABLE file_info ADD FOREIGN KEY (version_id) REFERENCES file_version(version_id);
ALTER TABLE file_info ADD FOREIGN KEY (creator_id) REFERENCES sf_guard_user(id);
ALTER TABLE file_user ADD FOREIGN KEY (viewer_id) REFERENCES sf_guard_user(id);
ALTER TABLE file_user ADD FOREIGN KEY (file_id) REFERENCES file(file_id);
ALTER TABLE file_task ADD FOREIGN KEY (file_id) REFERENCES file(file_id);
ALTER TABLE file_task ADD FOREIGN KEY (task_id) REFERENCES task(id);
ALTER TABLE file_version ADD FOREIGN KEY (file_id) REFERENCES file(file_id);

ALTER TABLE issue_tracker ADD FOREIGN KEY (issue_id) REFERENCES issue(issue_id);
ALTER TABLE file_issue ADD FOREIGN KEY (file_id) REFERENCES file(file_id);
ALTER TABLE file_issue ADD FOREIGN KEY (issue_id) REFERENCES issue(issue_id);
ALTER TABLE issue_task ADD FOREIGN KEY (task_id) REFERENCES task(id);
ALTER TABLE issue_task ADD FOREIGN KEY (issue_id) REFERENCES issue(issue_id);
ALTER TABLE issue_comment ADD FOREIGN KEY (issue_id) REFERENCES issue(issue_id);
ALTER TABLE issue_comment ADD FOREIGN KEY (author) REFERENCES sf_guard_user(id);
ALTER TABLE issue_meta ADD FOREIGN KEY (issue_id) REFERENCES issue(issue_id);
ALTER TABLE issue ADD FOREIGN KEY (project_id) REFERENCES project(id);
ALTER TABLE issue ADD FOREIGN KEY (reported_by) REFERENCES sf_guard_user(id);
ALTER TABLE issue ADD FOREIGN KEY (assigned_to) REFERENCES sf_guard_user(id);




ALTER TABLE message ADD FOREIGN KEY (project_id) REFERENCES project(id);
ALTER TABLE message ADD FOREIGN KEY (account_id) REFERENCES account(id);
ALTER TABLE message ADD FOREIGN KEY (submitted_by) REFERENCES sf_guard_user(id);
ALTER TABLE message ADD FOREIGN KEY (messg_sub_id) REFERENCES message(messg_id);
ALTER TABLE message_tag ADD FOREIGN KEY (messg_id) REFERENCES message(messg_id);
ALTER TABLE message_subs ADD FOREIGN KEY (messg_id) REFERENCES message(messg_id);
ALTER TABLE message_subs ADD FOREIGN KEY (subscriber_id) REFERENCES sf_guard_user(id);


ALTER TABLE notif_message ADD FOREIGN KEY (sub_message_id) REFERENCES notif_message(message_id);
ALTER TABLE notif_message ADD FOREIGN KEY (created_by) REFERENCES sf_guard_user(id);
ALTER TABLE notif_user ADD FOREIGN KEY (recipient) REFERENCES sf_guard_user(id);

alter TABLE payment_transaction ADD FOREIGN KEY(payment_card_id) REFERENCES payment_card(payment_card_id);
alter TABLE payment_transaction ADD FOREIGN KEY(account_id) REFERENCES account(id);
alter TABLE payment_transaction ADD FOREIGN KEY(user_id) REFERENCES sf_guard_user(id);


ALTER TABLE phone ADD FOREIGN KEY (type) REFERENCES phone_type(type_id);
ALTER TABLE plan_feature ADD FOREIGN KEY (plan_id) REFERENCES plan(plan_id);

ALTER TABLE profile ADD FOREIGN KEY (user_id) REFERENCES sf_guard_user(id);
ALTER TABLE profile ADD FOREIGN KEY (address_id) REFERENCES address(address_id);

ALTER TABLE project ADD FOREIGN KEY (created_by) REFERENCES sf_guard_user(id);
ALTER TABLE project ADD FOREIGN KEY (address_id) REFERENCES address(address_id);

ALTER TABLE project_account ADD FOREIGN KEY (project_id) REFERENCES project(id);
ALTER TABLE project_account ADD FOREIGN KEY (account_id) REFERENCES account(id);

ALTER TABLE project_email ADD FOREIGN KEY (project_id) REFERENCES project(id);
ALTER TABLE project_email ADD FOREIGN KEY (email_id) REFERENCES email(email_id);

ALTER TABLE project_file ADD FOREIGN KEY (project_id) REFERENCES project(id);
ALTER TABLE project_file ADD FOREIGN KEY (file_id) REFERENCES file(file_id);

ALTER TABLE project_user ADD FOREIGN KEY (user_id) REFERENCES sf_guard_user(id);
ALTER TABLE project_user ADD FOREIGN KEY (team_id) REFERENCES team(team_id);
ALTER TABLE project_user ADD FOREIGN KEY (project_id) REFERENCES project(id);

ALTER TABLE project_user_role ADD FOREIGN KEY (user_id) REFERENCES sf_guard_user(id);
ALTER TABLE project_user_role ADD FOREIGN KEY (role_id) REFERENCES user_role(role_id);

ALTER TABLE sf_guard_group_permission ADD FOREIGN KEY (permission_id) REFERENCES sf_guard_permission(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_group_permission ADD FOREIGN KEY (group_id) REFERENCES sf_guard_group(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_remember_key ADD FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_group ADD FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_group ADD FOREIGN KEY (group_id) REFERENCES sf_guard_group(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_permission ADD FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_permission ADD FOREIGN KEY (permission_id) REFERENCES sf_guard_permission(id) ON DELETE CASCADE;



ALTER TABLE team ADD FOREIGN KEY (project_id) REFERENCES project(id);

ALTER TABLE team_user ADD FOREIGN KEY (user_role_id) REFERENCES user_role(role_id);
ALTER TABLE team_user ADD FOREIGN KEY (user_id) REFERENCES sf_guard_user(id);
ALTER TABLE team_user ADD FOREIGN KEY (team_id) REFERENCES team(team_id);

ALTER TABLE user_address ADD FOREIGN KEY (user_id) REFERENCES sf_guard_user(id);
ALTER TABLE user_address ADD FOREIGN KEY (address_id) REFERENCES address(address_id);

ALTER TABLE user_email ADD FOREIGN KEY (user_id) REFERENCES sf_guard_user(id);
ALTER TABLE user_email ADD FOREIGN KEY (email_id) REFERENCES email(email_id);

ALTER TABLE user_group ADD FOREIGN KEY (user_id) REFERENCES sf_guard_user(id);

ALTER TABLE user_phone ADD FOREIGN KEY (user_id) REFERENCES sf_guard_user(id);
ALTER TABLE user_phone ADD FOREIGN KEY (phone_id) REFERENCES phone(phone_id);


ALTER TABLE comment ADD FOREIGN KEY (account_id) REFERENCES account(id);
ALTER TABLE comment ADD FOREIGN KEY (project_id) REFERENCES project(id);
ALTER TABLE comment ADD FOREIGN KEY (group_id) REFERENCES `groups`(id);
ALTER TABLE comment ADD FOREIGN KEY (task_id) REFERENCES task(id);
ALTER TABLE comment ADD FOREIGN KEY (file_id) REFERENCES file(file_id);
ALTER TABLE comment ADD FOREIGN KEY (submitted_by) REFERENCES sf_guard_user(id);
 
SET FOREIGN_KEY_CHECKS = 1;