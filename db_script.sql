DROP DATABASE IF EXISTS `VaesDB`;
-- SET DI ROBA VARIA
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE DATABASE IF NOT EXISTS `VaesDB` DEFAULT CHARACTER SET utf8;  -- avrà questo nome finche non sarà completo  TODO: modificare
USE `VaesDB`;


--
-- Table structure for table `avatar`
--



CREATE TABLE IF NOT EXISTS `avatar` (
  `ID` INT NOT NULL,  /*-- PRIMARY KEY*/
  `SEX` BIT(1) NOT NULL COMMENT '0=m, 1=f', -- The sex of the avatar
  `POWER` BIT(1) NOT NULL COMMENT '0=not powerful, 1=powerful',  			-- Whether the avatar is muscular or not
  `EXPERIENCE` BIT(1) NOT NULL COMMENT '0=not experienced, 1=experienced',  -- Whether the avatar is experienced or not
  `SEXUAL` BIT(1) NOT NULL COMMENT '0=not sexualized, 1=sexualized',  		-- Whether the avatar is sexualized or not  --The intention of the avatar, for some reason if I put this under, it's an error
  `INTENTION` BIT(1) NOT NULL COMMENT '0=good, 1=bad',
  `pic` VARCHAR(20)  NOT NULL UNIQUE,  -- path of the image file
  PRIMARY KEY (`ID`)
) ENGINE = 'InnoDB' ;


--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
    `ID` INT AUTO_INCREMENT NOT NULL,  /*--- PRIMARY KEY  we'll probably convert it into a string-*/
    `SEX` BIT(1) NOT NULL DEFAULT 0 COMMENT '0=m, 1=f', -- biological sex
    `AGE` INT(2) NOT NULL DEFAULT 0, -- between 6 and 99, 0 for admin
    `SEXOR` INT(2) NOT NULL DEFAULT 0,  -- sexual orientation, at the moment: 0=don't want to express, 1=heterosexual, 2=homosexual, 3=bisexual, 4=other 	probably we're going to add more
    `TRUSTED` BIT(1) NOT NULL DEFAULT 0 COMMENT '1 = trusted', /*Check whether the user is trusted or not. for example,it's not trusted if it has failed a control question, contradicted himself or the survey site flags it lower than good*/

  PRIMARY KEY (`ID`)
) ENGINE = 'InnoDB';


--TODO: da completare
-- first questionnaire, the one with the two games
CREATE TABLE IF NOT EXISTS `Q1` (
  `ID` INT  AUTO_INCREMENT NOT NULL,  -- PRIMARY KEY
  `PLAYTIME` INT(5) NOT NULL COMMENT '0=never, ...', --  0=Never, 1=Less than 1 hour, 2=Between 1 and 2 hours, 3=Between 2 and 4 hours, 4=More than 4 hours
  `GAME1` VARCHAR(100) NOT NULL,
  `GAME2` VARCHAR(100) NOT NULL,  /*Title of the second game   --Title of the first game*/
  `SEXISM1` INT NOT NULL, /*- --Should be between 1 and 5*/
  `SEXISM2` INT NOT NULL, /*- --Should be between 1 and 5*/
    /*`COMPLETED` BIT(1) NOT NULL DEFAULT 0 COMMENT '0=not yet, 1=done' */
  `USER_ID` INT NOT NULL,  /*--- The id of the user of course		FOREIGN KEY	*/
  
  PRIMARY KEY (`ID`),
  CONSTRAINT `fk_USERQ1`
		FOREIGN KEY (`USER_ID`)
		REFERENCES `VaesDB`.`USER`(`ID`)
		ON DELETE CASCADE
		ON UPDATE CASCADE
) ENGINE = 'InnoDB';


-- TODO: aggiungere domande di controllo
CREATE TABLE IF NOT EXISTS `Q2` (
  `ID` INT  AUTO_INCREMENT NOT NULL,  -- PRIMARY KEY
  `CONTROL_QUESTION` INT NOT NULL DEFAULT 4,
  `QUESTION1`INT NOT NULL DEFAULT 0 COMMENT 'man not complete',  			/*---Should be between 0 and 5   -   No matter how accomplishable is, a man is not truly complete as a person unless he has the love of a woman.*/
  `QUESTION2`INT NOT NULL DEFAULT 0 COMMENT 'women seeking favors', 		/*---Should be between 0 and 5   -   Many women are actually seeking special favors, such as hiring policies that favor them overmen, under the guise of asking for "equality."*/
  `QUESTION3`INT NOT NULL DEFAULT 0 COMMENT 'women not rescue', 			/*---Should be between 0 and 5   -   In a disaster, women ought not necessarily to be rescued before men.*/
  `QUESTION4`INT NOT NULL DEFAULT 0 COMMENT 'woman remarks sexy',  		/*---Should be between 0 and 5   -   Most women interpret innocent remarks or acts as being sexist.*/
  `QUESTION5`INT NOT NULL DEFAULT 0 COMMENT 'woman too offended', 		/*---Should be between 0 and 5   -   Women are too easily offended.*/
  `QUESTION6`INT NOT NULL DEFAULT 0 COMMENT 'happy without romantic',  	/*---Should be between 0 and 5   -   People are often truly happy in life without being romantically involved with a member of the other sex.*/
  `QUESTION7`INT NOT NULL DEFAULT 0 COMMENT 'fem not seeking power',  	/*--Should be between 0 and 5   -   Feminists are not seeking for women to have more power than men.*/
  `QUESTION8`INT NOT NULL DEFAULT 0 COMMENT 'women have purity',  		/*--Should be between 0 and 5   -   Many women have a quality of purity that few men possess.*/
  `QUESTION9`INT NOT NULL DEFAULT 0 COMMENT 'women should be protected',  /*--Should be between 0 and 5   -   Women should be cherished and protected by men.*/
  `QUESTION10`INT NOT NULL DEFAULT 0 COMMENT 'women fail appreciate',  	/*--Should be between 0 and 5   -   Most women fail to appreciate fully all that men do for them.*/
  `QUESTION11`INT NOT NULL DEFAULT 0 COMMENT 'women seek power',  		/*---Should be between 0 and 5   -   Women seek to gain power by getting control over men.*/
  `QUESTION12`INT NOT NULL DEFAULT 0 COMMENT 'man must adore woman',  	/*--Should be between 0 and 5   -   Every man ought to have a woman whom he adores.*/
  `QUESTION13`INT NOT NULL DEFAULT 0 COMMENT 'man complete no woman',  	/*---Should be between 0 and 5   -   Men are complete without women.*/
  `QUESTION14`INT NOT NULL DEFAULT 0 COMMENT 'Women exaggerate problems', /*--Should be between 0 and 5   -   Women exaggerate problems they have at work.*/
  `QUESTION15`INT NOT NULL DEFAULT 0 COMMENT 'women tight leash',  		/*---Should be between 0 and 5   -   Once a woman gets a man to commit to her, she usually tries to put him on a tight leash.*/
  `QUESTION16`INT NOT NULL DEFAULT 0 COMMENT 'women fail appreciate',  	/*--Should be between 0 and 5   -   When women lose to men in a fair competition, they typically complain about being discriminated against.*/
  `QUESTION17`INT NOT NULL DEFAULT 0 COMMENT 'women complain competition',/*---Should be between 0 and 5   -   A good woman should be set on a pedestal by her man*/
  `QUESTION18`INT NOT NULL DEFAULT 0 COMMENT 'women teasing',  			/*---Should be between 0 and 5   -   There are actually very few women who get a kick out of teasing men by seeming sexually available and then refusing male advances. */
  `QUESTION19`INT NOT NULL DEFAULT 0 COMMENT 'women superiro moral',  	/*---Should be between 0 and 5   -   Women, compared to men, tend to have a superior moral sensibility*/
  `QUESTION20`INT NOT NULL DEFAULT 0 COMMENT 'women fail appreciate',  	/*---Should be between 0 and 5   -   Men should be willing to sacrifice their own well being in order to provide financially for the women in their lives.*/
  `QUESTION21`INT NOT NULL DEFAULT 0 COMMENT 'man financial sacrifice',  	/*--Should be between 0 and 5   -   Feminists are making entirely reasonable demands of men.*/
  `QUESTION22`INT NOT NULL DEFAULT 0 COMMENT 'women more culture',  		/*--Should be between 0 and 5   -   Women, as compared to men, tend to have a more refined sense of culture and good taste.*/
    /*`COMPLETED` BIT(1) NOT NULL DEFAULT 0 COMMENT '0=not yet, 1=done'*/
  `USER_ID` INT NOT NULL,  -- The id of the user of course		FOREIGN KEY	
  
  PRIMARY KEY (`ID`),
  CONSTRAINT `fk_USERQ2`
		FOREIGN KEY (`USER_ID`)
		REFERENCES `VaesDB`.`USER`(`ID`)
		ON DELETE CASCADE
		ON UPDATE CASCADE
) ENGINE = 'InnoDB';

CREATE TABLE IF NOT EXISTS `Q3` (
  `ID` INT  AUTO_INCREMENT NOT NULL,  -- PRIMARY KEY
  `CONTROL_QUESTION` INT DEFAULT 0,
  `QUESTION1`INT NOT NULL DEFAULT 0 COMMENT 'man approach please himself', /*---Should be between 1 and 5   -   When approaching a woman, most men think more about what that women can do to please him than what he can do to please her*/
  `QUESTION2`INT NOT NULL DEFAULT 0 COMMENT 'man approach have sex', 		 /*--Should be between 1 and 5   -   Most men tend to approach a woman only when they want to have sex with her.*/
  `QUESTION3`INT NOT NULL DEFAULT 0 COMMENT 'man interest woman feelings', /*---Should be between 1 and 5   -   Most men are interested in women’s feelings because they want to be close to women.*/
  `QUESTION4`INT NOT NULL DEFAULT 0 COMMENT 'man flatter for sex',  		 /*---Should be between 1 and 5   -   When a man flatters a woman, it is because he wants to have sex with her.*/
  `QUESTION5`INT NOT NULL DEFAULT 0 COMMENT 'man interested bc of sex', 	 /*--Should be between 1 and 5   -   A man is likely to be interested in a woman to the extent to which she can satisfy his sexual appetite.*/
  `QUESTION6`INT NOT NULL DEFAULT 0 COMMENT 'man woman sexual objects',  	 /*---Should be between 1 and 5   -   Most men consider women sexual objects.*/
  `QUESTION7`INT NOT NULL DEFAULT 0 COMMENT 'relationship based closeness',/*---Should be between 1 and 5   -   Most relationships between a man and a woman are based on closeness and affection.*/
  `QUESTION8`INT NOT NULL DEFAULT 0 COMMENT 'man loses interest',  		 /*---Should be between 1 and 5   -   When his sexual desire weakens, a man will likely lose interest in a woman.*/
  `QUESTION9`INT NOT NULL DEFAULT 0 COMMENT 'women equals if sex',  		/*- --Should be between 1 and 5   -   When it comes to sex, for most men a woman equals another as long as she satisfies his sexual needs.*/
  `QUESTION10`INT NOT NULL DEFAULT 0 COMMENT 'man full cons. women',  	 /*---Should be between 1 and 5   -   Most men have a full consideration of women as persons.*/
    /*`COMPLETED` BIT(1) NOT NULL DEFAULT 0 COMMENT '0=not yet, 1=done' */
  `USER_ID` INT NOT NULL,  /*--- The id of the user of course		FOREIGN KEY	*/
  
  PRIMARY KEY (`ID`),
  CONSTRAINT `fk_USERQ3`
		FOREIGN KEY (`USER_ID`)
		REFERENCES `VaesDB`.`USER`(`ID`)
		ON DELETE CASCADE
		ON UPDATE CASCADE
)ENGINE = 'InnoDB';



--
-- Table structure for table `choice`
--

-- We use this one to store which combinations were already selected from the user and their order

CREATE TABLE IF NOT EXISTS `choice` (
  `ENTRY` INT NOT NULL COMMENT '1= first entry for user',/*-  -- NUMBER OF THE ENTRY FOR THE CURRENT USER, E.G.  1 -> FIRST ENTRY FOR THIS USER*/
  `TYPE` INT NOT NULL COMMENT '0=male, 1=female, 3=mix', /*- -- Type of choice, same sex or different sex*/
  `TIME` FLOAT NOT NULL COMMENT 'response time',/*- -- response time of each choice*/
  `CHOSEN` INT NOT NULL COMMENT 'id of avatar chosen',
  `USER_ID` INT NOT NULL, /*- -- The id of the user of course		FOREIGN KEY	*/
  `AVATAR1_ID` INT NOT NULL COMMENT 'left',/*-  -- The avatar presented on the left    FOREIGN KEY*/
  `AVATAR2_ID` INT NOT NULL COMMENT 'right',/*-  -- The avatar presented on the right  FOREIGN KEY*/
  
  
  
  PRIMARY KEY (`ENTRY`,`USER_ID`,`TYPE`),
  CONSTRAINT `fk_AVATAR1`
		FOREIGN KEY (`AVATAR1_ID`)
		REFERENCES `VaesDB`.`AVATAR`(`ID`)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
  CONSTRAINT `fk_AVATAR2`
		FOREIGN KEY (`AVATAR2_ID`)
		REFERENCES `VaesDB`.`AVATAR`(`ID`)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
  CONSTRAINT `fk_USERC`
		FOREIGN KEY (`USER_ID`)
		REFERENCES `VaesDB`.`USER`(`ID`)
		ON DELETE CASCADE
		ON UPDATE CASCADE
	
)ENGINE = 'InnoDB' ;
-- InnoDB for savepoints

