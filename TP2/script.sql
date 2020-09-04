#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: status
#------------------------------------------------------------

CREATE TABLE status(
        id            Int  Auto_increment  NOT NULL ,
        maritalStatus Varchar (50) NOT NULL
	,CONSTRAINT PK_status PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: clients
#------------------------------------------------------------

CREATE TABLE clients(
        id          Int  Auto_increment  NOT NULL ,
        lastname    Varchar (50) NOT NULL ,
        firstname   Varchar (50) NOT NULL ,
        birthdate   Date NOT NULL ,
        address     Text NOT NULL ,
        zipcode     Varchar (5) NOT NULL ,
        city        Varchar (50) NOT NULL ,
        phoneNumber Varchar (10) NOT NULL ,
        id_status   Int NOT NULL
	,CONSTRAINT PK_clients PRIMARY KEY (id)

	,CONSTRAINT FK_clients_status FOREIGN KEY (id_status) REFERENCES status(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: credits
#------------------------------------------------------------

CREATE TABLE credits(
        id           Int  Auto_increment  NOT NULL ,
        organization Varchar (50) NOT NULL ,
        total        Decimal (12,3) NOT NULL ,
        id_clients   Int NOT NULL
	,CONSTRAINT PK_credits PRIMARY KEY (id)

	,CONSTRAINT FK_credits_clients FOREIGN KEY (id_clients) REFERENCES clients(id)
)ENGINE=InnoDB;