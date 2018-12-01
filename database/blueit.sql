--
-- File generated with SQLiteStudio v3.1.1 on Sat Dec 1 00:20:41 2018
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
                                 DEFAULT (1) 
);

INSERT INTO channel (
                        id,
                        name,
                        subscription_counter
                    )
                    VALUES (
                        0,
                        'funny',
                        0
                    );

INSERT INTO channel (
                        id,
                        name,
                        subscription_counter
                    )
                    VALUES (
                        1,
                        'science',
                        0
                    );

INSERT INTO channel (
                        id,
                        name,
                        subscription_counter
                    )
                    VALUES (
                        2,
                        'news',
                        0
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


-- Table: story
DROP TABLE IF EXISTS story;

CREATE TABLE story (
    post_id    INTEGER PRIMARY KEY
                       REFERENCES post,
    channel_id         REFERENCES channel,
    title      VARCHAR NOT NULL
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


-- Table: user
DROP TABLE IF EXISTS user;

CREATE TABLE user (
    id          INTEGER PRIMARY KEY,
    email       VARCHAR UNIQUE
                        NOT NULL,
    username    VARCHAR UNIQUE
                        NOT NULL,
    password    VARCHAR NOT NULL,
    profile_pic VARCHAR,
    bio         VARCHAR,
    points      INTEGER NOT NULL
                        DEFAULT (0) 
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
