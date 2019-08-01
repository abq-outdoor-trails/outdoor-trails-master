ALTER DATABASE abqbiketrails CHARACTER SET utf8 COLLATE utf_unicode_ci;

DROP TABLE IF EXISTS favoriteRoutes;
DROP TABLE IF EXISTS comments;
DROP TABLE IF EXISTS user;
DROP TABLE IF EXISTS routes;

-- CREATE TABLE statement for routes table
CREATE TABLE routes (
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
CREATE TABLE user (
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
CREATE TABLE comments (
	commentId BINARY(16) NOT NULL,
	commentRouteId BINARY(16) NOT NULL,
	commentUserId BINARY(16) NOT NULL,
	commentContent VARCHAR(256) NOT NULL,
	commentDate DATE NOT NULL,
	-- foreign keys for comments entity
	FOREIGN KEY(commentsRouteId) REFERENCES routes(routeId),
	FOREIGN KEY(commentsUserId) REFERENCES user(userId),
	-- primary key for comments entity
	PRIMARY KEY(commentId)
);

-- CREATE TABLE statement for favoriteRoutes table
CREATE TABLE favoriteRoutes (
	favoriteRoutesUserId BINARY(16) NOT NULL,
	favoriteRoutesRouteID BINARY(16) NOT NULL,
	-- foreign key --
	INDEX (favoriteRoutesUserId),
	FOREIGN KEY (favoriteRoutesUserId) REFERENCES user(userId),
	INDEX (favoriteRoutesRouteID),
	FOREIGN KEY (favoriteRoutesRouteID) REFERENCES routes(routeId)
);