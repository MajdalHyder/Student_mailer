# Student_mailer
Technical test

Ce test rentre dans le cadre d'un test technique pour la société Softia Engineering.

J'ai choisit Symfony pour la subtilité de créer l'infrastructure et le backend
sur une base de données MySQL j'ai 3 entités 
  
                               |----------------------------|
  Etudiant:                    |      Convention:           |  Attestation:
  id---------------------------| |--->id------------------- |  id
  nom                            |    nom                 | |->etudiant
  prenom                         |    nbHeur              |--->convention
  mail                           |                             message
  idConvention-------------------|



J'a Utilisé Ajax pour modifier le form en temps reéel sans besoin de faire refresh de la page
ce qui m'a couté un peu du temps.

Note: je suis capable de refaire le même test en NodeJS en utilisant Sequelize, et j'ai déjà défini le schema pour 
la base de données, avec l'insertion d'une convention.

