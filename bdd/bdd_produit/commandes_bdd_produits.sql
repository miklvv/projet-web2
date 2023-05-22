CREATE TABLE forfaitlivraison (
	idForfait INTEGER PRIMARY KEY AUTOINCREMENT,
	description VARCHAR(100) NOT NULL,
	montant int(8) NOT NULL
) ;

CREATE TABLE categorieproduit  (
	idCat  INTEGER PRIMARY KEY AUTOINCREMENT,
	intitule  VARCHAR(50) NOT NULL,
	description  VARCHAR(50) NOT NULL
) ;

CREATE TABLE  produit  (
	idPdt  INTEGER PRIMARY KEY AUTOINCREMENT,
	idCat  INTEGER NOT NULL,
	prixTTC  FLOAT(4,2) NOT NULL,
	designation  VARCHAR(100) NOT NULL,
	forfaitLivraison  int(3) NOT NULL,
	image_produit TEXT NOT NULL,
	CONSTRAINT fk_Cat FOREIGN KEY (idCat) REFERENCES categorieproduit(idCat) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT fk_Forfait FOREIGN KEY (forfaitLivraison) REFERENCES forfaitLivraison(idForfait) ON DELETE CASCADE ON UPDATE CASCADE
)  ;

-- Vider tout les tuples de forfaitLivraison :
-- DELETE FROM forfaitlivraison ;



-- Vider tout les tuples de categorieproduit :
-- DELETE FROM categorieproduit ;

INSERT INTO categorieproduit (intitule, description) VALUES ('Nourriture', 'Produits à manger');
INSERT INTO categorieproduit (intitule, description) VALUES ('Electronique', 'Produits à éléctroniques');
INSERT INTO categorieproduit (intitule, description) VALUES ('Cuisine', 'Produits de Cuisine');

-- Vider tout les tuples de categorieproduit :
-- DELETE FROM produit ;

INSERT INTO produit ( idCat, prixTTC, designation, forfaitLivraison, image_produit ) VALUES ( (SELECT idCat FROM categorieproduit WHERE intitule='Nourriture'), 17.99, 'Haribo', (SELECT idForfait FROM forfaitlivraison WHERE idForfait = 1), CHEMIN_IMAGE) ;
INSERT INTO produit ( idCat, prixTTC, designation, forfaitLivraison, image_produit ) VALUES ( (SELECT idCat FROM categorieproduit WHERE intitule='Electronique'), 30.99, 'Nintendo Switch', (SELECT idForfait FROM forfaitlivraison WHERE idForfait = 1), CHEMIN_IMAGE) ;