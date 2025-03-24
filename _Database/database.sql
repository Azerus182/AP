DROP DATABASE Lpfs;

CREATE DATABASE Lpfs;
USE Lpfs;

CREATE TABLE users (
    id            INTEGER     AUTO_INCREMENT UNIQUE,
    username      VARCHAR(64) NOT NULL UNIQUE,
    firstname     VARCHAR(64) NOT NULL,
    lastname      VARCHAR(64) NOT NULL,
    password      VARCHAR(128)NOT NULL,
    salt          VARCHAR(64) NOT NULL,
    role          INTEGER     NULL        DEFAULT     NULL,
    service       INTEGER     NULL        DEFAULT     NULL,
    PRIMARY KEY (id, username)
);
-- use Lpfs; select * from user;

CREATE TABLE services (
    id        INTEGER      AUTO_INCREMENT UNIQUE,
    name      VARCHAR(128) NOT NULL UNIQUE,
    PRIMARY KEY (id)
);
-- use Lpfs; select * from services;

CREATE TABLE tokens (
    id           INTEGER     NOT NULL,
    token        VARCHAR(64) NOT NULL UNIQUE,
    date         TIMESTAMP   NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id, token)
);
-- use Lpfs; select * from tokens;

CREATE TABLE roles (
    id                      INTEGER      AUTO_INCREMENT UNIQUE,
    name                    VARCHAR(128) NOT NULL UNIQUE,
    edit_users              BOOLEAN      NOT NULL    DEFAULT     FALSE,
    edit_services           BOOLEAN      NOT NULL    DEFAULT     FALSE,
    edit_roles              BOOLEAN      NOT NULL    DEFAULT     FALSE,
    edit_preadmitions       BOOLEAN      NOT NULL    DEFAULT     FALSE,
    view_all_preadmitions   BOOLEAN      NOT NULL    DEFAULT     FALSE,
    PRIMARY KEY (id, name)
);
-- use Lpfs; select * from roles;

CREATE TABLE preadmission (
    id              INTEGER      AUTO_INCREMENT UNIQUE,
    ssn             VARCHAR(15)  NOT NULL,
    type            BOOLEAN,
    doctor          INTEGER      NOT NULL,
    room            INTEGER,
    time            TIMESTAMP    NOT NULL,
    fName           VARCHAR(64)  NOT NULL,
    lName           VARCHAR(64)  NOT NULL,
    mName           VARCHAR(64)  DEFAULT   NULL,
    birthday        DATE         NOT NULL,
    gender          BOOLEAN      NOT NULL,
    disabled        BOOLEAN      NOT NULL,
    address         VARCHAR(256) NOT NULL,
    zipCode         VARCHAR(5)   NOT NULL,
    email           VARCHAR(128) NOT NULL,
    phone           VARCHAR(10)  NOT NULL,
    contactLName    VARCHAR(64),
    contactFName    VARCHAR(64),
    contactAddress  VARCHAR(64),
    contactPhone    VARCHAR(64),
    trustedLName    VARCHAR(64),
    trustedFName    VARCHAR(64),
    trustedAddress  VARCHAR(64),
    trustedPhone    VARCHAR(64),
    insuranceFund   VARCHAR(128) NOT NULL,
    isPolicyHolder  BOOLEAN      NOT NULL,
    mutualName      VARCHAR(128),
    mutualNum       VARCHAR(128),

    identityCard                INTEGER,
    vitalCard                   INTEGER,
    mutualCard                  INTEGER,
    famillyBook                 INTEGER,
    childAuthorization          INTEGER,
    singleParentAuthorization   INTEGER,

    PRIMARY KEY (id, ssn, doctor)
);
-- use Lpfs; select * from preadmission;

CREATE TABLE files (
    id              INTEGER       AUTO_INCREMENT UNIQUE,
    name            VARCHAR(256)  NOT NULL,
    ext             VARCHAR(64)   NOT NULL,
    PRIMARY KEY (id)
);
-- use Lpfs; select * from files;

