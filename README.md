# 🧾 Gestion des Frais - Application Symfony

![Symfony](https://img.shields.io/badge/Symfony-7.1.1-4b9cea?style=flat-square&logo=symfony)
![PHP](https://img.shields.io/badge/PHP-8.2-blue?style=flat-square&logo=php&logoColor=white)
![Doctrine](https://img.shields.io/badge/Doctrine-ORM-orange?style=flat-square&logo=doctrine)
![GitHub](https://img.shields.io/github/license/monprojet/frais-app?style=flat-square)
![Stars](https://img.shields.io/github/stars/monprojet/frais-app?style=flat-square)

> **Une application Symfony pour la gestion des frais professionnels, spécialement conçue pour les comptables et employés.**

Cette application permet de gérer des fiches de frais mensuelles, d'ajouter des frais hors forfait, et d'introduire une catégorisation des frais pour une meilleure analyse. 🚀

---

## 🎥 Aperçu de l'application

![Overview GIF](https://raw.githubusercontent.com/monprojet/frais-app/main/resources/demo/demo-overview.gif)

L'application offre :
- **Gestion des fiches de frais mensuelles**
- **Ajout et gestion des frais forfaitaires et hors forfait**
- **Catégorisation des frais hors forfait**
- **Statistiques pour mieux visualiser les dépenses par catégorie**

---

## 🛠️ Fonctionnalités principales

### ✅ Gestion des fiches de frais
- Saisie de fiches de frais par mois 🌙.
- Visualisation des détails de chaque fiche.

### ✅ Gestion des frais forfaitaires
- Ajout et modification des frais forfaitaires directement liés à une fiche.

### ✅ Gestion des frais hors forfait
- Ajout, édition et suppression des frais hors forfait.
- Association des frais hors forfait à des **catégories personnalisées**.

### ✅ Catégorisation des frais
- Les dépenses hors forfait sont regroupées dans les catégories suivantes :
  - Organisation de séminaires 📊
  - Cadeaux de fin d’année 🎁
  - Invitations au restaurant 🍴
  - Locations de conférences 🏢
  - Autres 🗂️
- **Personnalisation des catégories** via une interface dédiée pour les comptables.

### ✅ Statistiques des catégories
- Visualisation des dépenses cumulées par catégorie.
- **Diagrammes et tableaux interactifs** pour une analyse facile et rapide.

---

## 🚀 Installation et lancement

### 🖥️ Pré-requis

- PHP **8.2** ou supérieur
- Composer
- Base de données SQLite (ou MySQL, avec adaptation)
- Symfony CLI (optionnel)

---

### ⚙️ Instructions

1. **Clonez le dépôt GitHub :**

   ```bash
   git clone https://github.com/monprojet/frais-app.git
   cd frais-app
   ```

2. **Installez les dépendances :**

   ```bash
   composer install
   ```

3. **Configurez la base de données :**

   Modifiez le fichier `.env` si nécessaire, en spécifiant votre configuration de base de données.

   Par défaut, le projet utilise SQLite :
   ```env
   DATABASE_URL="sqlite:///%kernel.project_dir%/var/data.db"
   ```

4. **Appliquez les migrations :**

   ```bash
   php bin/console doctrine:database:create
   php bin/console doctrine:migrations:migrate
   ```

5. **Chargez les jeux de données par défaut (fixtures) :**

   ```bash
   php bin/console doctrine:fixtures:load
   ```

6. **Lancez le serveur web avec Symfony CLI ou PHP :**

   ```bash
   symfony server:start
   # ou
   php -S 127.0.0.1:8000 -t public
   ```

7. **Accédez à l'application dans votre navigateur :**  
   Ouvrez [http://127.0.0.1:8000](http://127.0.0.1:8000).

---

## 🗂️ Structure du projet

```plaintext
frais-app/
├── assets/             # Fichiers CSS et JavaScript (Webpack Encore)
├── config/             # Configuration Symfony
├── migrations/         # Fichiers de migration pour Doctrine
├── public/             # Fichiers publics (CSS/JS compilés, point d'entrée)
├── src/                # Code source PHP (Contrôleurs, Entités, etc.)
├── templates/          # Fichiers de templates Twig
├── tests/              # Tests unitaires et fonctionnels
└── var/                # Cache et fichiers logs
```

- **Entités principales :**
  - `FicheFrais` : Gestion des fiches de frais mensuelles.
  - `LigneFraisForfait` et `LigneFraisHorsForfait` : Gestion des frais associés à une fiche.
  - `CategorieFrais` : Catégorisation des frais hors forfait.

---

## 👩‍💻 Contribuer

Les contributions sont les bienvenues ! Veuillez suivre ces étapes pour soumettre votre modification :

1. **Forkez le projet :**  
   Cliquez sur le bouton "Fork" en haut de ce dépôt.

2. **Clonez votre fork localement :**
   ```bash
   git clone https://github.com/votre-utilisateur/frais-app.git
   ```

3. **Créez une branche :**
   ```bash
   git checkout -b feature/nom-de-la-fonctionnalité
   ```

4. **Poussez vos modifications et créez une Pull Request (PR) :**  
   Accédez à la section "Pull Requests" de ce dépôt pour soumettre votre contribution.

---

## 📊 Aperçu de l'analyse des frais

### Exemple de visualisation des dépenses par catégorie :  
![Statistics GIF](https://raw.githubusercontent.com/monprojet/frais-app/main/resources/demo/demo-stats.gif)

---

## 🛡️ Sécurité

L'application respecte les normes de sécurité :
- Authentification des utilisateurs (gestion des rôles via Symfony Security).
- Validation des données saisies et protections CSRF.
- Gestion sécurisée des mots de passe.

---

## 📜 Licence

Ce projet est sous licence MIT. Consultez le fichier [`LICENSE`](LICENSE) pour plus d'informations.

---

## 🌟 Remerciements

Merci à toutes les personnes qui ont contribué à ce projet !  

Conçu avec 💖 en utilisant **Symfony**, **Doctrine** et **Twig**.
