DROP TABLE IF EXISTS routes;
DROP TABLE IF EXISTS favoriteRoutes;

-- create table for routes --
CREATE TABLE routes (
   routeId BINARY(16) NOT NULL,
   routeName VARCHAR(32),
   routeType VARCHAR(32),
   routeSpeedLimit BINARY(2),
   routeDescription VARCHAR(140),
   -- no unique index for routes-
   PRIMARY KEY (routeId)
);
 -- creates table for Favorite Routes --
 CREATE TABLE favoriteRoutes (
    favoriteRoutesUserId BINARY(16) NOT NULL,
    favoriteRoutesRouteID BINARY(16) NOT NULL,
    -- foreign key --
    INDEX (favoriteRoutesUserId),
    FOREIGN KEY (favoriteRoutesUserId) REFERENCES user(userId),
    INDEX (favoriteRoutesRouteID),
    FOREIGN KEY (favoriteRoutesRouteID) REFERENCES routes(routeId)
 );


