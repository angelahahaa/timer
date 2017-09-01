# use by: mysql < new_database_with_topic.sql
CREATE DATABASE IF NOT EXISTS quiz;
USE quiz
CREATE TABLE IF NOT EXISTS questions(
	question_ID int  			NOT NULL AUTO_INCREMENT, 
	question 	varchar(255) 	NOT NULL,
	option1 	varchar(255) 	NOT NULL,
	option2 	varchar(255) 	NOT NULL,
	option3 	varchar(255) 	NOT NULL,
	option4 	varchar(255) 	NOT NULL,
	answer 		int 			NOT NULL,
	topic 		int 			NOT NULL,
	PRIMARY KEY (question_ID)
	);

CREATE TABLE IF NOT EXISTS quizzes(
	quiz_ID 		int  			NOT NULL AUTO_INCREMENT,
	student_ID 		varchar(255) 	NOT NULL,
	date_created	datetime,
	PRIMARY KEY (quiz_ID)
	);

CREATE TABLE IF NOT EXISTS quiz_questions(
	ID 					int  		NOT NULL AUTO_INCREMENT, 
	quiz_ID 			int  		NOT NULL,
	question_ID 		int  		NOT NULL,
	selected_prediction	int 				,	# 1 for predicted correct, 0 for predicted wrong, NULL for no input
	selected_answer		int 				,
	correct				boolean				,	# redundant, here for convinience, 1 for correct, 0 for wrong	
	PRIMARY KEY (ID)
	);

CREATE TABLE IF NOT EXISTS students(
	student_ID	int  			NOT NULL AUTO_INCREMENT, 
	facebook_id	varchar(255) 			,		# should be a number but saved as varchar just incase
	name	 	varchar(255) 			,
	age			int 					,
	education	varchar(255)			,
	PRIMARY KEY (student_ID)
	);
# html codes: https://www.toptal.com/designers/htmlarrows/symbols/ (use decimal entity)
# power 3: &#179;
# cursive l: &#8467;
INSERT INTO questions(question,option1,option2,option3,option4,answer,topic) VALUES
('&#81;&copy;&#8457; ','the asnwer is A: symbol: &#8800;','the asnwer is B','the asnwer sym:  &divide; is C','&times;',1,7),
('&#81;&#8457;&#8467;','the asnwer is A: power 3 &#179;','the asnwer is B','the asnwer sym: &divide; is C','&#9731;&#9732;',1,2),
('&#81;&copy;&#8457; ','the asnwer is A: symbol: &#8800;','the asnwer is B','the asnwer sym:  &divide; is C','&times;',1,7),
('&#81;&#8457;&#8467;','the asnwer is A: power 3 &#179;','the asnwer is B','the asnwer sym: &divide; is C','&#9731;&#9732;',1,2),
('&#81;&copy;&#8457; ','the asnwer is A: symbol: &#8800;','the asnwer is B','the asnwer sym:  &divide; is C','&times;',1,7),
('&#81;&#8457;&#8467;','the asnwer is A: power 3 &#179;','the asnwer is B','the asnwer sym: &divide; is C','&#9731;&#9732;',1,2),
('&#81;&copy;&#8457; ','the asnwer is A: symbol: &#8800;','the asnwer is B','the asnwer sym:  &divide; is C','&times;',1,7),
('&#81;&#8457;&#8467;','the asnwer is A: power 3 &#179;','the asnwer is B','the asnwer sym: &divide; is C','&#9731;&#9732;',1,2),
('&#81;&copy;&#8457; ','the asnwer is A: symbol: &#8800;','the asnwer is B','the asnwer sym:  &divide; is C','&times;',1,7),
('&#81;&#8457;&#8467;','the asnwer is A: power 3 &#179;','the asnwer is B','the asnwer sym: &divide; is C','&#9731;&#9732;',1,2),
('&#81;&copy;&#8457; ','the asnwer is A: symbol: &#8800;','the asnwer is B','the asnwer sym:  &divide; is C','&times;',1,7),
('&#81;&#8457;&#8467;','the asnwer is A: power 3 &#179;','the asnwer is B','the asnwer sym: &divide; is C','&#9731;&#9732;',1,2),
('&#81;&copy;&#8457; ','the asnwer is A: symbol: &#8800;','the asnwer is B','the asnwer sym:  &divide; is C','&times;',1,7),
('&#81;&#8457;&#8467;','the asnwer is A: power 3 &#179;','the asnwer is B','the asnwer sym: &divide; is C','&#9731;&#9732;',1,2),
('&#81;&copy;&#8457; ','the asnwer is A: symbol: &#8800;','the asnwer is B','the asnwer sym:  &divide; is C','&times;',1,7),
('&#81;&#8457;&#8467;','the asnwer is A: power 3 &#179;','the asnwer is B','the asnwer sym: &divide; is C','&#9731;&#9732;',1,2);