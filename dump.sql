CREATE DATABASE `si_project`;
USE `si_project`;

--
-- Table structure for table `questions`
--
DROP TABLE IF EXISTS `questions`;
CREATE TABLE `questions` (
    `id` int(10) NOT NULL AUTO_INCREMENT,
    `question` varchar(150) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `answers`
--
DROP TABLE IF EXISTS `answers`;
CREATE TABLE `answers` (
    `id` int(10) NOT NULL AUTO_INCREMENT,
    `answer` text,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `questions`
--
DROP TABLE IF EXISTS `questions`;
CREATE TABLE `questions` (
    `id` int(10) NOT NULL AUTO_INCREMENT,
    `question` varchar(150) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `questions_answers`
--
DROP TABLE IF EXISTS `questions_answers`;
CREATE TABLE `questions_answers` (
    `id` int(10) NOT NULL AUTO_INCREMENT,
    `question_id` int(10) NOT NULL,
    `answer_id` int(10) NOT NULL,
    `is_correct` tinyint(1) DEFAULT '0',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- foreign keys for table `questions_answers`
--
ALTER TABLE questions_answers
    ADD CONSTRAINT FK_qa_question
FOREIGN KEY (question_id) REFERENCES questions (id)
    ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE questions_answers
    ADD CONSTRAINT `FK_qa_answer`
FOREIGN KEY (answer_id) REFERENCES answers (id)
    ON DELETE CASCADE  ON UPDATE CASCADE;
