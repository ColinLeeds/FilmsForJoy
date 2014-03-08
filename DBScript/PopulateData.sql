insert into user
(
  user_name,
  user_password,
  user_type
)
values
(
  'Colin Beeby',
  'cbeeby666',
  1
);

insert into user
(
  user_name,
  user_password,
  user_type
)
values
(
  'Joy Preece',
  'jpreece99',
  2
);

insert into user
(
  user_name,
  user_password,
  user_type
)
values
(
  'Dawn Preece',
  'dpreece',
  3
);

insert into film_information
(
  film_title,
  film_description,
  film_genre,
  film_picture,
  film_seen_by_joy,
  film_joy_rating,
  film_joy_comment,
  film_IMDB_link,
  film_contributer_user_Id,
  film_contributer_rating
)
values
(
  'The Prestige',
  'Fab film about two rival magicians trying to work out how each other performs in illusion. This one should keep you guessing till the very end. Stars Hugh Jackman, Christian Bale, Michael Caine and Scarlet Johansson. Nice cameo by David Bowie to watch out for!',
  1,
  'ThePrestige.jpg',
  0,
  0,
  '',
  'http://www.imdb.com/title/tt0482571/',
  1,
  4
);