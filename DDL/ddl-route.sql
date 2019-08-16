DROP TABLE IF EXISTS route;
DROP TABLE IF EXISTS favoriteRoute;

-- create table for routes --
CREATE TABLE route (
   routeId BINARY(16) NOT NULL,
   routeName VARCHAR(32),
   routeFile VARCHAR(256) NOT NULL,
   routeType VARCHAR(32),
   routeSpeedLimit BINARY(2),
   routeDescription VARCHAR(140),
   -- no unique index for routes-
   PRIMARY KEY (routeId)
);
 -- creates table for Favorite Routes --
 CREATE TABLE favoriteRoute (
    favoriteRouteUserId BINARY(16) NOT NULL,
    favoriteRouteRouteID BINARY(16) NOT NULL,
    -- foreign key --
    INDEX (favoriteRouteUserId),
    FOREIGN KEY (favoriteRouteUserId) REFERENCES user(userId),
    INDEX (favoriteRouteRouteID),
    FOREIGN KEY (favoriteRouteRouteID) REFERENCES route(routeId)
 );


