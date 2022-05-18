
CREATE DATABASE IF NOT EXISTS yeticaveartyom DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE yeticaveartyom;

CREATE TABLE category (
  id int(11) PRIMARY KEY AUTO_INCREMENT,
  name varchar(50) NOT NULL,
  name_eng varchar(50) NOT NULL
);

CREATE TABLE lot (
  id int(11) PRIMARY KEY AUTO_INCREMENT,

  creation_date datetime NOT NULL,
  name varchar(50) NOT NULL,
  description varchar(100) NOT NULL,
  image varchar(50) NOT NULL,
  starting_price int(11) NOT NULL,
  closing_date datetime NOT NULL,
  bet_step int(11) NOT NULL,

  author_id int(11) NOT NULL,
  winner_id int(11) NULL,
  category_id int(11) NOT NULL
);

CREATE TABLE bet (
  id int(11) PRIMARY KEY AUTO_INCREMENT,

  bet_date datetime NOT NULL,
  summa int(11) NOT NULL,
    
  user_id int(11) NOT NULL,
  lot_id int(11) NOT NULL
);

CREATE TABLE user_ (
  id int(11) PRIMARY KEY AUTO_INCREMENT,

  regisrtatoin_date datetime NOT NULL,
  email varchar(100) NOT NULL,
  name varchar(50) NOT NULL,
  password varchar(250) NOT NULL,
  avatar varchar(250) NOT NULL,
  contacts varchar(250) NOT NULL
);

ALTER TABLE lot
  ADD KEY author_id (`author_id`),
  ADD KEY category_id (`category_id`),
  ADD KEY winner_id (`winner_id`);

ALTER TABLE bet
  ADD KEY user_id (`user_id`),
  ADD KEY lot_id (`lot_id`);

ALTER TABLE bet
  ADD CONSTRAINT `bet_ibfk_1` FOREIGN KEY (user_id) REFERENCES user_ (id) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bet_ibfk_2` FOREIGN KEY (lot_id) REFERENCES lot (id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE lot
  ADD CONSTRAINT `lot_ibfk_1` FOREIGN KEY (author_id) REFERENCES user_ (id) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lot_ibfk_2` FOREIGN KEY (winner_id) REFERENCES user_ (id) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lot_ibfk_3` FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE ON UPDATE CASCADE;

