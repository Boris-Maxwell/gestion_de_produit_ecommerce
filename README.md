# Développement Backend pour Site E-Commerce

## Description

Ce projet est une application back-office développée avec Laravel pour un site e-commerce. Il permet de gérer les produits et les catégories d'un site e-commerce, y compris la création, la lecture, la mise à jour et la suppression des éléments. Les produits peuvent être assignés à des catégories, et il est possible d'afficher et de gérer les stocks des produits.

## Fonctionnalités

- **CRUD pour Produits et Catégories** : Créez, lisez, mettez à jour et supprimez des produits et des catégories.
- **Assignation des Produits aux Catégories** : Assignez chaque produit à une catégorie spécifique.
- **Affichage des Produits** : Listez les produits avec leurs catégories et leur stock.
- **Gestion du Stock** : Gérez le stock des produits.
- **Filtrage des Produits** : Filtrez les produits par catégorie et par stock.

## Tables

### `products`

- `id` : Identifiant unique du produit
- `name` : Nom du produit
- `description` : Description du produit
- `price` : Prix du produit
- `stock` : Stock disponible
- `category_id` : Identifiant de la catégorie à laquelle le produit appartient

### `categories`

- `id` : Identifiant unique de la catégorie
- `name` : Nom de la catégorie

## Interface Utilisateur

### Interfaces CRUD

- **Produits** : Ajouter, modifier, supprimer et afficher des produits.
![Interface des Produits](/public/img/accueil_p.png)
![Interface d'ajout produit](/public/img/ajout_p.png)
![Interface de modification](/public/img/modif_p.png)
![Interface de suppression produit](/public/img/suppression_p.png)
- **Catégories** : Ajouter, modifier, supprimer et afficher des catégories.
![Interface des Catégories](/public/img/accueil_c.png)
![Interface d'ajout Catégories](/public/img/ajout_c.png)
![Interface de modification](/public/img/modif_c.png)

### Filtrage

- **Filtrage par Catégorie** : Sélectionnez une catégorie pour afficher les produits associés.
![Interface de filtrage des produits](/public/img/filtre_p.png)

- **Filtrage par Stock** : Définissez un intervalle de stock pour filtrer les produits.

