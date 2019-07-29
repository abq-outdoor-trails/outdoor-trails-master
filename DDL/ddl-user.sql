DROP TABLE IF EXISTS USER;


-- create table function

CREATE TABLE user (
	-- this creates the attribute for the primary key
	-- not null menas the attribute is required
	-- this is a strong entity
	userId              BINARY(16)   NOT NULL,
	userName            VARCHAR(32)  NOT NULL,
	userEmail           VARCHAR(128) NOT NULL,
	userHash            CHAR(97)     NOT NULL,
	userActivationToken CHAR(32),
	-- to make sure duplicate data cannot exist, create a unique index
	UNIQUE (userName),
	UNIQUE (userEmail),
	PRIMARY KEY (userId)


);