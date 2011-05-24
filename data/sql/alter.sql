ALTER TABLE milestone ADD column sub_milestone_id INT(11) after milestone_id;
ALTER TABLE milestone ADD FOREIGN KEY (sub_milestone_id) REFERENCES milestone(milestone_id);

ALTER TABLE task MODIFY group_id int(11);

