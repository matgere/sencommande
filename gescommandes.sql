CREATE TABLE  roles (
  id int(3) NOT NULL AUTO_INCREMENT,
  libelle varchar(150) NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE  users (
  id int(10) NOT NULL AUTO_INCREMENT,
  membre_id int(3),
  nom_complet varchar(50) NOT NULL,
  username varchar(50) NOT NULL,
  hashed_password varchar(40) NOT NULL,
  PRIMARY KEY (id),
  constraint fk_usermembre FOREIGN KEY (membre_id) references membres(id)
);

CREATE TABLE  users_admin (
  id int(10) NOT NULL AUTO_INCREMENT,
  nom_complet varchar(50) NOT NULL,
  username varchar(50) NOT NULL,
  hashed_password varchar(40) NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE categories (
   id int(3) NOT NULL AUTO_INCREMENT,	
   libelle varchar(50) NOT NULL,
  PRIMARY KEY (id)
) ;

CREATE TABLE groupements (
   id int(3) NOT NULL AUTO_INCREMENT,	
   nom varchar(60) NOT NULL,
   enseigne varchar(10) NOT NULL,
   adresse varchar(50) NULL,
   contact varchar(60) NULL,
   tel_c varchar(50) NULL,
   email_c varchar(50) NULL,
   rc varchar(50) NULL,
   ninea varchar(50) NULL,
  PRIMARY KEY (id)
) ;

CREATE TABLE membres (
   id int(11) NOT NULL AUTO_INCREMENT,	
   pack int(1) NOT NULL,
   groupement_id int(3),
   nom_complet varchar(100) NOT NULL,
   genre varchar(3) NOT NULL,
   date_naiss date NOT NULL,
   numero_cin varchar(50) NOT NULL,
   adresse varchar(60) NOT NULL,
   telephone varchar(30) NOT NULL,
   email varchar(50) NOT NULL,
   profession int(3) NOT NULL,
   structure int(3) NOT NULL,
   ethnie varchar(50) NOT NULL,
   sit_famille varchar(50) NOT NULL,
   religion varchar(50) NOT NULL,
   photo varchar(50) NOT NULL,
   presence varchar(50) NOT NULL,
   code_select varchar(50) NOT NULL,
   localite varchar(60) NOT NULL,
   date_entree date NOT NULL,
   tva varchar(1) NOT NULL,
   lp_maison varchar(50) NOT NULL,
   montant_credit varchar(50) NOT NULL,
   mode_paiement varchar(50) NOT NULL,
  PRIMARY KEY (id),
  constraint fk_groupement FOREIGN KEY (groupement_id) references groupements(id)
);

CREATE TABLE contrats (
   membre_id int(3) NOT NULL AUTO_INCREMENT,
   per_debut date NOT NULL,
   per_fin date NOT NULL,
  constraint fk_membre_contrat FOREIGN KEY (membre_id) references membres(id)
) ;

CREATE TABLE produits (
   id int(3) NOT NULL AUTO_INCREMENT,	
   code_article varchar(50) NOT NULL,
   categorie_id int(3) DEFAULT NULL,
   Date_mes date NOT NULL,
   libelle varchar(150) NOT NULL,
   prix_achat varchar(50) NOT NULL,
   prix_vente varchar(50) NOT NULL,
   code_archive varchar(50) NOT NULL,
   marge varchar(50) NOT NULL,
   seuil int(10) NOT NULL,
   packaging varchar(50) NOT NULL,
   colissage varchar(50) NOT NULL,
  PRIMARY KEY (id),
  constraint fk_idcategorie FOREIGN KEY (categorie_id) references categories(id)
) ;

CREATE TABLE commandes (
   id int(3) NOT NULL AUTO_INCREMENT,	
   membre_id int(3) NOT NULL,	
   date_commande date NOT NULL,
   numero_commande Varchar(30) DEFAULT NULL,
   mois_commande varchar(15) NOT NULL,
   annee_commande varchar(5) NOT NULL,
  PRIMARY KEY (id),
  constraint fk_idcommembre FOREIGN KEY (membre_id) references membres(id)
) ;

CREATE TABLE lignecommandes (
   commande_id int(3) NOT NULL,	
   produit_id int(3) NOT NULL,	
   quantite int(3) DEFAULT NULL,
   prix varchar(50) NOT NULL,
  PRIMARY KEY (id)
) ;

CREATE TABLE bons (
   id int(3) NOT NULL AUTO_INCREMENT,	
   date_bon varchar(50) NOT NULL,
   numero_bon int(3) DEFAULT NULL,
   code_fournisseur varchar(50) NOT NULL,
   code_membre int(3) NOT NULL,
   type_bon varchar(50) NOT NULL,
   ref_bon varchar(50) NOT NULL,
   observation varchar(50) NOT NULL,
   date_livraison varchar(50) NOT NULL,
   mois_commande varchar(50) NOT NULL,
   annee_commande varchar(50) NOT NULL,
  PRIMARY KEY (id)
) ;

CREATE TABLE fournisseurs (
   id int(3) NOT NULL AUTO_INCREMENT,	
   code_fournisseur varchar(50) NOT NULL,
   nom int(3) DEFAULT NULL,
   adresse varchar(50) NOT NULL,
   telephone int(3) NOT NULL,
   fax varchar(50) NOT NULL,
   email varchar(50) NOT NULL,
   numero_compte varchar(50) NOT NULL,
   code_presence varchar(50) NOT NULL,
   mode_reglement varchar(50) NOT NULL,
  PRIMARY KEY (id)
) ;

