insert into plan (plan_id, type, description, price) values (1, 'FREE', 'Free plan', 0.00);
insert into plan (plan_id, type, description, price) values (2, 'PERSONAL', 'Personal plan', 12.00);
insert into plan (plan_id, type, description, price) values (3, 'BASIC', 'Basic plan', 24.00);
insert into plan (plan_id, type, description, price) values (4, 'INTERMED', 'Interediate plan', 49.00);
insert into plan (plan_id, type, description, price) values (5, 'ADVANCED', 'Advanced plan', 99.00);
insert into plan (plan_id, type, description, price) values (6, 'PRO', 'Professional plan', 149.00);


insert into plan_feature (plan_id, space, num_users, num_projects, iphone_access, ssl_on, data_backup) values
(1, 20, 4, 1, 0, 0, 0),
(2, 500, 8, 5, 1, 0, 1),
(3, 3072, -1, 15, 1, 0, 1),
(4, 10240, -1, 30, 1, 1, 1),
(5, 20480, -1, -1, 1, 1, 1),
(6, 40960, -1, -1, 1, 1, 1);

insert into sf_guard_group (id, name, description) values
(1, 'admin', 'Administrator Group'),
(2, 'user', 'User group'),
(3, 'account_manager', 'Account Manager');

insert into domain (id, name) values
(1,	'nutshellapp.com'),
(2,	'kodazi.com'),
(3,	'protoglue.com');

