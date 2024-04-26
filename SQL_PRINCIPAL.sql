CREATE TABLE Utilisateur (
    ID_Utilisateur SERIAL PRIMARY KEY,
    Nom_Utilisateur CHAR(25),
    Prenom_Utilisateur CHAR(15),
    Adresse_EMail VARCHAR(75),
    Mot_de_Passe VARCHAR(100),
    Numero_Telephone SMALLINT
);

CREATE TABLE Trajet (
    ID_Trajet SERIAL PRIMARY KEY,
    heure_depart TIME,
    date_ajout TIMESTAMP,
    Date_trajet DATE,
    Places_disponibles SMALLINT,
    lieu_de_rendez_vous VARCHAR(50),
    ID_Utilisateur INTEGER,
    FOREIGN KEY (ID_Utilisateur) REFERENCES Utilisateur(ID_Utilisateur)
);

CREATE TABLE Vehicule (
    ID_Vehicule SERIAL PRIMARY KEY,
    Marque CHAR(15),
    Modele VARCHAR(50),
    Annee DATE,
    Couleur CHAR(15),
    ID_Trajet INTEGER,
    FOREIGN KEY (ID_Trajet) REFERENCES Trajet(ID_Trajet)
);

CREATE TABLE Avis (
    ID_Avis SERIAL PRIMARY KEY,
    date_avis TIMESTAMP,
    Note SMALLINT,
    Commentaire TEXT,
    ID_Trajet INTEGER,
    ID_Utilisateur_CIR INTEGER,
    FOREIGN KEY (ID_Trajet) REFERENCES Trajet(ID_Trajet),
    FOREIGN KEY (ID_Utilisateur_CIR) REFERENCES Utilisateur(ID_Utilisateur)
);

CREATE TABLE Message (
    ID_Message SERIAL PRIMARY KEY,
    Contenu_message TEXT,
    Date_d_envoie TIMESTAMP,
    ID_Utilisateur INTEGER,
    ID_Utilisateur_1 INTEGER,
    FOREIGN KEY (ID_Utilisateur) REFERENCES Utilisateur(ID_Utilisateur),
    FOREIGN KEY (ID_Utilisateur_1) REFERENCES Utilisateur(ID_Utilisateur)
);

CREATE TABLE Role (
    ID_Role SERIAL PRIMARY KEY,
    LibelleRole CHAR(15)
);

CREATE TABLE Arret (
    nom_arret VARCHAR(50) PRIMARY KEY,
    num_Arret SMALLINT,
    CP_ville SMALLINT,
    Details VARCHAR(150)
);

CREATE TABLE Conduit (
    ID_Utilisateur INTEGER,
    ID_Vehicule INTEGER,
    PRIMARY KEY (ID_Utilisateur, ID_Vehicule),
    FOREIGN KEY (ID_Utilisateur) REFERENCES Utilisateur(ID_Utilisateur),
    FOREIGN KEY (ID_Vehicule) REFERENCES Vehicule(ID_Vehicule)
);

CREATE TABLE Affecte (
    ID_Utilisateur INTEGER,
    ID_Role INTEGER,
    PRIMARY KEY (ID_Utilisateur, ID_Role),
    FOREIGN KEY (ID_Utilisateur) REFERENCES Utilisateur(ID_Utilisateur),
    FOREIGN KEY (ID_Role) REFERENCES Role(ID_Role)
);

CREATE TABLE Comprend (
    ID_Trajet INTEGER,
    nom_arret VARCHAR(50),
    PRIMARY KEY (ID_Trajet, nom_arret),
    FOREIGN KEY (ID_Trajet) REFERENCES Trajet(ID_Trajet),
    FOREIGN KEY (nom_arret) REFERENCES Arret(nom_arret)
);

CREATE TABLE Reserve (
    ID_Utilisateur INTEGER,
    ID_Trajet INTEGER,
    Statut_reservation VARCHAR(50),
    Date_Reservation DATE,
    PRIMARY KEY (ID_Utilisateur, ID_Trajet),
    FOREIGN KEY (ID_Utilisateur) REFERENCES Utilisateur(ID_Utilisateur),
    FOREIGN KEY (ID_Trajet) REFERENCES Trajet(ID_Trajet)
);

INSERT INTO role(id_role, libellerole) VALUES (1, 'Administrateur');
INSERT INTO role(id_role, libellerole) VALUES (2, 'Chauffeur');
INSERT INTO role(id_role, libellerole) VALUES (3, 'Membre');
