create table Accounts(
    Email VARCHAR(150) PRIMARY KEY,
    Secret VARCHAR(255)
);

create table UserRoles(
    Email VARCHAR(150) PRIMARY KEY,
    Roles VARCHAR(255)
);

create table PassReset(
    Email VARCHAR(150) PRIMARY KEY,
    EKey VARCHAR(255)
);


create table Agents(
    aid integer primary key auto_increment,
    name varchar(255),
    city varchar(100),
    state varchar(10),
    country varchar(100),
    can_var varchar(255)
);

create table clients(
    cid integer primary key auto_increment,
    name varchar(255),
    city varchar(100),
    state varchar(10),
    country varchar(100)
);

create table requests(
    cid integer primary key auto_increment,
    request varchar(255),
    des varchar(255),
    assigned_to integer
);