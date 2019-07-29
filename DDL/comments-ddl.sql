-- Drop tables if they exist
DROP TABLE IF EXISTS comments;

-- CREATE TABLE statement for comments table
CREATE TABLE comments (
   commentId BINARY(16) NOT NULL,
   commentsRouteId BINARY(16) NOT NULL,
   commentsUserId BINARY(16) NOT NULL,
   commentContent TEXT NOT NULL,
   commentDate DATE NOT NULL,
   -- foreign keys for comments entity
);