# Ventes aux enchères

Nous vous proposons un site de ventes aux enchères pour les voitures.  
Les professionnels pourront mettre leur voiture aux enchères et n'importe qui pourra enchérir.  
Une interface destinée aux administrateurs des posts sera également mise en place. 
Elle permettra de gérer les offres mises aux enchères. Il y aura également une page de statistique où les administrateurs des posts pourront voir l'influence qu'ont leur offres.   
Un système de "boost" pourra être mis en place. Cela consiste à mettre un post en avant pendant une durée déterminée. (fonctionnalité payante)

### Technologies utilisées 
* Front : React (matérial_ui)
* Api : Api Platform
* Back : Symfony

### Pages
#### Coté client
- page inscription
- page connexion
- page accueil (vu sur toutes les offres)
- page détails de l'offre (affiche les informations d’une offre et les enchères associées)
- achat

#### CRUD coté client qui poste l'offre
- page inscription
- page connexion
- page accueil (vu sur toutes les offres)
- page tableau de bord (affiche des statistiques) (tant de personnes sont intéressées par cette voiture)
- page offres (liste des offres publiées)
- page détails de l'offre (affiche les informations d’une offre et les enchères associées, possibilité de modifier/supprimer l'offre)


#### CRUD admin (nous)
- page connexion
- page accueil (vu sur toutes les offres)
- page détails de l'offre (affiche les informations d’une offre et les enchères associées, possibilité supprimer)
- page admin (vue sur toutes les offres avec les personnes qui les poste, possibilité de supprimer)