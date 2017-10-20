CREATE TABLE Kayttaja(
  id SERIAL PRIMARY KEY,
  kayttajatunnus varchar(50) NOT NULL,
  salasana varchar(50) NOT NULL,
  sahkoposti varchar(50) NOT NULL,
  admin bit DEFAULT '0'::bit NOT NULL
);

CREATE TABLE Ainesosa(
  id SERIAL PRIMARY KEY,
  nimi varchar(50) NOT NULL
);

CREATE TABLE Drinkkiresepti(
  id SERIAL PRIMARY KEY,
  tekija INTEGER REFERENCES Kayttaja(id),
  nimi varchar(50) NOT NULL,
  ohje varchar(500) NOT NULL,
  juomalaji varchar(50) NOT NULL
);

CREATE TABLE Reseptiehdotus(
  id SERIAL PRIMARY KEY,
  tekija INTEGER REFERENCES Kayttaja(id),
  nimi varchar(50) NOT NULL,
  ohje varchar(500) NOT NULL,
  juomalaji varchar(50) NOT NULL,
  hyvaksytty bit DEFAULT '0'::bit NOT NULL
);

CREATE TABLE Drinkinainesosa(
  atunnus INTEGER REFERENCES Ainesosa(id),
  etunnus INTEGER REFERENCES Reseptiehdotus(id),
  dtunnus INTEGER REFERENCES Drinkkiresepti(id)
);