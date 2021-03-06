-- This is not the final database structure

CREATE TABLE icuser (
  user_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  first_name VARCHAR(100) NOT NULL,
  last_name VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  password VARCHAR(100) NOT NULL, -- Hash of the encrypted password
  birth_date DATETIME NOT NULL,
	gender VARCHAR(100) NOT NULL,
	profile_pic VARCHAR(100) DEFAULT 'default.png', -- File name for public/images/profiles
	about TEXT NULL
);

CREATE TABLE page (
  page_id INT AUTO_INCREMENT NOT NULL,
  creator_user_id INT NOT NULL,
  password VARCHAR(100) NOT NULL, -- Hash of the encrypted password
  page_name VARCHAR(100) NOT NULL,
  page_type VARCHAR(100) NOT NULL, -- Like: business, organization, celebrity
  date_of_creation DATETIME NOT NULL,
  contact_email VARCHAR(100) NOT NULL,
  contact_address VARCHAR(250) DEFAULT NULL,
  contact_postal_code VARCHAR(100) DEFAULT NULL,
  contact_phone VARCHAR(100) DEFAULT NULL,
  page_pic VARCHAR(100) DEFAULT 'default_business.jpg',
  page_cover_pic VARCHAR(100) DEFAULT NULL,
  since_date DATETIME DEFAULT NULL, -- Date of the business not the creation
  about TEXT DEFAULT NULL
  PRIMARY KEY(page_id, creator_user_id)
);

CREATE TABLE post (
   post_id INT AUTO_INCREMENT NOT NULL, -- when the post holder is a page, the user_id
                                        -- is the administrator's id who uploaded the post
   user_id INT NOT NULL, -- Owner of this post
   date_of_upload DATETIME NOT NULL,
   image VARCHAR(100) NULL, -- File name for public/images/posts can be here
   content TEXT NOT NULL,
   holder_type VARCHAR(255) DEFAULT 'user', -- can also be 'page'
   post_publicity VARCHAR(100) DEFAULT 'public', -- can be public, private, own
   -- Own: only on the uploader's page
   -- Private: Never shown, only for the uploader
   PRIMARY KEY(user_id, post_id)
);

CREATE TABLE action ( -- Actions like comment/upvotes/downvotes stored here
   action_id INT AUTO_INCREMENT NOT NULL,
   entity_id INT NOT NULL, -- Where was the action
   user_id INT NOT NULL, -- Who did the action
   action_date DATETIME NOT NULL, -- When it happened
   entity_type VARCHAR(100) NOT NULL, -- like post/user and ?
   action_type VARCHAR(100) NOT NULL, -- comment/upvote/page_upvote/message and ?
   seen_by_user VARCHAR(100) NOT NULL, -- To user seen it or not?
   to_user_id INT NOT NULL,
   content TEXT NULL, -- Only relevant when the type is comment
   PRIMARY KEY(user_id, post_id, action_id)
);

CREATE TABLE friend (
  friend_id INT AUTO_INCREMENT NOT NULL,
  from_user_id INT NOT NULL, -- Request from this user
  to_user_id INT NOT NULL, -- To this user
  status VARCHAR(100) NOT NULL, -- Can be friends, request, muted_request ...
  PRIMARY KEY(friend_id, user1_id, user2_id)
);

CREATE TABLE message (
  message_id INT AUTO_INCREMENT NOT NULL,
  from_user_id INT NOT NULL,
  to_user_id INT NOT NULL,
  send_date DATETIME NOT NULL,
  status VARCHAR(255) NOT NULL, -- seen, not_seen ...
  content LONGTEXT NOT NULL,
  PRIMARY KEY(message_id)
);
