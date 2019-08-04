ALTER DATABASE abqbiketrails CHARACTER SET utf8;

<<<<<<< HEAD
DROP TABLE IF EXISTS favoriteRoute;
DROP TABLE IF EXISTS comment;
DROP TABLE IF EXISTS `user`;
DROP TABLE IF EXISTS route;

-- CREATE TABLE statement for routes table
CREATE TABLE route (
=======
DROP TABLE IF EXISTS favoriteRoutes;
DROP TABLE IF EXISTS comments;
DROP TABLE IF EXISTS `user`;
DROP TABLE IF EXISTS routes;

-- CREATE TABLE statement for routes table
CREATE TABLE routes (
>>>>>>> class-Comments
	routeId BINARY(16) NOT NULL,
	routeName VARCHAR(32),
	routeFile VARCHAR(256) NOT NULL,
	routeType VARCHAR(32),
	routeSpeedLimit TINYINT,
	routeDescription VARCHAR(140),
	-- no unique index for routes-
	PRIMARY KEY (routeId)
);

-- CREATE TABLE statement for user table
CREATE TABLE `user` (
	-- this creates the attribute for the primary key
	-- not null means the attribute is required
	-- this is a strong entity
	userId BINARY(16) NOT NULL,
	userName VARCHAR(32) NOT NULL,
	userEmail VARCHAR(128) NOT NULL,
	userHash CHAR(97) NOT NULL,
	userActivationToken CHAR(32),
	UNIQUE (userName),
	UNIQUE (userEmail),
	PRIMARY KEY(userId)
);

-- CREATE TABLE statement for comments table
CREATE TABLE comment (
	commentId BINARY(16) NOT NULL,
	commentRouteId BINARY(16) NOT NULL,
	commentUserId BINARY(16) NOT NULL,
	commentContent VARCHAR(256) NOT NULL,
	commentDate DATE NOT NULL,
	-- foreign keys for comments entity
	FOREIGN KEY(commentRouteId) REFERENCES route(routeId),
	FOREIGN KEY(commentUserId) REFERENCES user(userId),
	-- primary key for comments entity
	PRIMARY KEY(commentId)
);

-- CREATE TABLE statement for favoriteRoutes table
CREATE TABLE favoriteRoute (
	favoriteRouteUserId BINARY(16) NOT NULL,
	favoriteRouteRouteID BINARY(16) NOT NULL,
	-- foreign key --
	INDEX (favoriteRouteUserId),
	FOREIGN KEY (favoriteRouteUserId) REFERENCES user(userId),
	INDEX (favoriteRouteRouteID),
	FOREIGN KEY (favoriteRouteRouteID) REFERENCES route(routeId)
);