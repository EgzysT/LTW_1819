CREATE TABLE user (
  id INTEGER PRIMARY KEY,
  email VARCHAR UNIQUE NOT NULL,
  username VARCHAR UNIQUE NOT NULL,
  password VARCHAR NOT NULL,
  profile_pic VARCHAR,
  bio VARCHAR,
  points INTEGER NOT NULL DEFAULT(0)
);

CREATE TABLE post (
    id INTEGER PRIMARY KEY,
    content VARCHAR NOT NULL,
    posted_at DATETIME NOT NULL,
    user_id INTEGER REFERENCES user(id),
    upvotes_count INTEGER NOT NULL DEFAULT(0),
    downvotes_count INTEGER NOT NULL DEFAULT(0)
);

CREATE TABLE vote (
    user_id INTEGER REFERENCES user(id),
    post_id INTEGER REFERENCES post(id),
    vote_type CHAR (1) NOT NULL CHECK (vote_type = 'u' OR vote_type = 'd'), 
    PRIMARY KEY (user_id, post_id)
);

CREATE TABLE channel (
    id INTEGER PRIMARY KEY,
    name VARCHAR NOT NULL,
    subscription_counter INTEGER NOT NULL DEFAULT(1)
);

CREATE TABLE subscription (
    user_id INTEGER REFERENCES user(id),
    channel_id INTEGER REFERENCES channel,
    PRIMARY KEY (user_id, channel_id)
);

CREATE TABLE story (
    post_id INTEGER PRIMARY KEY REFERENCES post(id),
    channel_id INTEGER REFERENCES channel(id),
    title VARCHAR NOT NULL
);

CREATE TABLE comment (
    post_id INTEGER PRIMARY KEY REFERENCES post(id),
    parent_post INTEGER REFERENCES post(id)
);