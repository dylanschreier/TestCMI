# Test technique

## Objectif
Créer une API permettant des gérer des membres, des articles ainsi que
leurs commentaires.

## Fonctionnalités
- [ ] Système d&#39;authentification
  - [ ] Via un token JWT
    - [ ] Communiqué via le header Authorization

- [ ] Membres
  - [ ] Se connecter
  - [x] Créer un membre via une commande console
  - [x] Modifier le mot de passe d'un membre via une commande console

- [ ] Articles
  - [ ] Nécessite un rôle admin
    - [ ] Créer un article
    - [ ] Mettre à jour un article
    - [ ] Supprimer un article
  - [ ] Accessible aux membres
    - [ ] Consulter la liste des articles
      - [ ] Doit permettre la pagination

- [ ] Commentaires
  - [ ] Nécessite un rôle admin
    - [ ] Approuver un commentaire
    - [ ] Supprimer un commentaire
  - [ ] Accessible aux membres
    - [ ] Lister les commentaires liés à un article
    - [ ] Lister les commentaires liés à un autre commentaire
    - [ ] Poster un commentaire lié à un article
    - [ ] Poster un commentaire lié à un autre commentaire
    - [ ] Editer son commentaire
    - [ ] Supprimer son commentaire
    - [ ] Noter un autre commentaire

## Détails techniques
- [ ] Utiliser Symfony dans sa dernière version LTS
- [ ] Utiliser le serveur Web local fourni par Symfony
- [ ] Les bundles tiers sont autorisés
- [ ] L&#39;API doit être REST et retourner du JSON
- [ ] Les verbes HTTP doivent être respectés
- [ ] Les codes HTTP doivent être respectés
  - [ ] (Pensez à valider les données saisies)
- [ ] Le cache HTTP doit être géré
- [ ] Utilisation de design patterns
- [ ] Permettre l'authentification via les réseaux sociaux Facebook et Google
- [ ] RESTful
- [ ] CQRS

## Livrable
L'ensemble du code produit devra être posté sur un GitHub