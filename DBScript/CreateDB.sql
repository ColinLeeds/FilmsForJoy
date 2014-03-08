create table film_information
(
  film_information_Id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  film_information_timestamp_created TIMESTAMP DEFAULT NOW(),
  film_title VARCHAR(200),
  film_description VARCHAR(800),
  film_genre INT,
  film_picture VARCHAR(100),
  film_seen_by_joy BIT,
  film_joy_rating INT,
  film_joy_comment VARCHAR(800),
  film_IMDB_link varchar(200),
  film_contributer_user_Id INT,
  film_contributer_rating INT
);

create table user
(
  user_Id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  user_name VARCHAR(200),
  user_password VARCHAR(20),
  user_type INT
);
