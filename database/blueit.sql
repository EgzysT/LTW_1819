--
-- File generated with SQLiteStudio v3.1.1 on Tue Dec 4 11:28:40 2018
--
-- Text encoding used: System
--
PRAGMA foreign_keys = off;
BEGIN TRANSACTION;

-- Table: channel
DROP TABLE IF EXISTS channel;

CREATE TABLE channel (
    id                   INTEGER PRIMARY KEY,
    name                 VARCHAR NOT NULL,
    subscription_counter INTEGER NOT NULL
                                 DEFAULT (1),
    description          VARCHAR NOT NULL,
    image                VARCHAR
);

INSERT INTO channel (
                        id,
                        name,
                        subscription_counter,
                        description,
                        image
                    )
                    VALUES (
                        1,
                        'science',
                        9,
                        'Want to stay in touch with the latest science trends? Then grab a chair and read some stories.',
                        '../assets/channels/science.jpg'
                    );

INSERT INTO channel (
                        id,
                        name,
                        subscription_counter,
                        description,
                        image
                    )
                    VALUES (
                        2,
                        'news',
                        1,
                        'This  is the place for meaningful stories about the latest world events.',
                        '../assets/channels/news.jpg'
                    );

INSERT INTO channel (
                        id,
                        name,
                        subscription_counter,
                        description,
                        image
                    )
                    VALUES (
                        3,
                        'funny',
                        14,
                        'Funny place for funny people. Tell us your best joke.',
                        '../assets/channels/funny.jpg'
                    );


-- Table: comment
DROP TABLE IF EXISTS comment;

CREATE TABLE comment (
    post_id     INTEGER PRIMARY KEY
                        REFERENCES post,
    parent_post         REFERENCES post
);


-- Table: post
DROP TABLE IF EXISTS post;

CREATE TABLE post (
    id              INTEGER  PRIMARY KEY,
    content         VARCHAR  NOT NULL,
    posted_at       DATETIME NOT NULL,
    user_id         INTEGER  REFERENCES user,
    upvotes_count   INTEGER  NOT NULL
                             DEFAULT (0),
    downvotes_count INTEGER  NOT NULL
                             DEFAULT (0) 
);

INSERT INTO post (
                     id,
                     content,
                     posted_at,
                     user_id,
                     upvotes_count,
                     downvotes_count
                 )
                 VALUES (
                     1,
                     'abc',
                     2,
                     1,
                     0,
                     0
                 );


-- Table: story
DROP TABLE IF EXISTS story;

CREATE TABLE story (
    post_id    INTEGER PRIMARY KEY
                       REFERENCES post,
    channel_id         REFERENCES channel,
    title      VARCHAR NOT NULL
);

INSERT INTO story (
                      post_id,
                      channel_id,
                      title
                  )
                  VALUES (
                      1,
                      1,
                      'uma historia na vila'
                  );


-- Table: subscription
DROP TABLE IF EXISTS subscription;

CREATE TABLE subscription (
    user_id    INTEGER REFERENCES user,
    channel_id INTEGER REFERENCES channel,
    PRIMARY KEY (
        user_id,
        channel_id
    )
);

INSERT INTO subscription (
                             user_id,
                             channel_id
                         )
                         VALUES (
                             1,
                             2
                         );

INSERT INTO subscription (
                             user_id,
                             channel_id
                         )
                         VALUES (
                             1,
                             1
                         );


-- Table: user
DROP TABLE IF EXISTS user;

CREATE TABLE user (
    id          INTEGER PRIMARY KEY,
    email       VARCHAR UNIQUE
                        NOT NULL,
    username    VARCHAR UNIQUE
                        NOT NULL,
    password    VARCHAR NOT NULL,
    profile_pic VARCHAR DEFAULT ('../assets/profile_pics/0.jpg'),
    bio         VARCHAR DEFAULT ('This misterious stranger has no bio yet! :o'),
    points      INTEGER NOT NULL
                        DEFAULT (0) 
);

INSERT INTO user (
                     id,
                     email,
                     username,
                     password,
                     profile_pic,
                     bio,
                     points
                 )
                 VALUES (
                     1,
                     'teste',
                     'teste',
                     '$2y$12$jbSNo4oy63wlNv1/l5/Z0eOtoIotb42dKzFngH8fekX3Sxzohru.i',
                     NULL,
                     NULL,
                     0
                 );


-- Table: vote
DROP TABLE IF EXISTS vote;

CREATE TABLE vote (
    user_id   INTEGER  REFERENCES user (id),
    post_id   INTEGER  REFERENCES post (id),
    vote_type CHAR (1) NOT NULL
                       CHECK (vote_type = 'u' OR 
                              vote_type = 'd'),
    PRIMARY KEY (
        user_id,
        post_id
    )
);


-- Trigger: insert_downvote
DROP TRIGGER IF EXISTS insert_downvote;
CREATE TRIGGER insert_downvote
        BEFORE DELETE
            ON vote
          WHEN new.vote_type = 'd'
BEGIN
    UPDATE post
       SET downvotes_count = post.downvotes_count + 1
     WHERE post.id = old.post_id;
    UPDATE user
       SET points = user.points - 1
     WHERE old.post_id = post.id AND 
           post.user_id = user.id;
END;


-- Trigger: insert_upvote
DROP TRIGGER IF EXISTS insert_upvote;
CREATE TRIGGER insert_upvote
         AFTER INSERT
            ON vote
          WHEN new.vote_type = 'u'
BEGIN
    UPDATE post
       SET upvotes_count = post.upvotes_count + 1
     WHERE post.id = new.post_id;
    UPDATE user
       SET points = user.points + 1
     WHERE new.post_id = post.id AND 
           post.user_id = user.id;
END;


-- Trigger: subscribe
DROP TRIGGER IF EXISTS subscribe;
CREATE TRIGGER subscribe
         AFTER INSERT
            ON subscription
BEGIN
    UPDATE channel
       SET subscription_counter = channel.subscription_counter + 1
     WHERE new.channel_id = channel.id;
END;


-- Trigger: unsubscribe
DROP TRIGGER IF EXISTS unsubscribe;
CREATE TRIGGER unsubscribe
        BEFORE DELETE
            ON subscription
BEGIN
    UPDATE channel
       SET subscription_counter = channel.subscription_counter + 1
     WHERE old.channel_id = channel.id;
END;


-- Trigger: update_to_downvote
DROP TRIGGER IF EXISTS update_to_downvote;
CREATE TRIGGER update_to_downvote
         AFTER UPDATE
            ON vote
          WHEN old.vote_type = 'u' AND 
               new.vote_type = 'd'
BEGIN
    UPDATE post
       SET upvotes_count = post.upvotes_count - 1,
           downvotes_count = post.downvotes_count + 1
     WHERE post.id = new.post_id;
    UPDATE user
       SET points = user.points - 2
     WHERE new.post_id = post.id AND 
           post.user_id = user.id;
END;


-- Trigger: update_to_upvote
DROP TRIGGER IF EXISTS update_to_upvote;
CREATE TRIGGER update_to_upvote
         AFTER UPDATE
            ON vote
          WHEN old.vote_type = 'd' AND 
               new.vote_type = 'u'
BEGIN
    UPDATE post
       SET upvotes_count = post.upvotes_count + 1,
           downvotes_count = post.downvotes_count - 1
     WHERE post.id = new.post_id;
    UPDATE user
       SET points = user.points + 2
     WHERE new.post_id = post.id AND 
           post.user_id = user.id;
END;


COMMIT TRANSACTION;
PRAGMA foreign_keys = on;
