ALTER DATABASE abqbiketrails CHARACTER SET utf8 COLLATE utf_unicode_ci;

-- Drop tables if they exist
DROP TABLE IF EXISTS comments;

-- CREATE TABLE statement for comments table
CREATE TABLE comments (
   commentId BINARY(16) NOT NULL,
   commentRouteId BINARY(16) NOT NULL,
   commentUserId BINARY(16) NOT NULL,
   commentContent VARCHAR(256) NOT NULL,
   commentDate DATE NOT NULL,
   -- foreign keys for comments entity
   FOREIGN KEY(commentRouteId) REFERENCES routes(routeId),
   FOREIGN KEY(commentUserId) REFERENCES user(userId),
   -- primary key for comments entity
   PRIMARY KEY(commentId)
);