# 🎓 Trombinoscope — La Manu

Une application web de trombinoscope inspirée des *Yearbooks* américains, développée dans le cadre d'un projet scolaire à **La Manu, École des métiers du numérique**.

Chaque élève dispose d'une fiche avec sa photo, son nom, sa classe et sa citation personnelle. Les administrateurs peuvent gérer l'annuaire de manière entièrement dynamique.

---

## ✨ Fonctionnalités

- 📋 **Fiches élèves** — nom, prénom, classe et citation (Yearbook Quote)
- 📸 **Upload de photos** — formats `.jpg` et `.png`, avec vérification du poids et de l'extension
- 🗂️ **Filtrage par niveau** — afficher uniquement les élèves d'une promotion (B1, B2, B3…)
- 🔐 **Interface d'administration** — espace dédié pour ajouter et gérer les profils
- 🎨 **UI personnalisée** — design moderne aux couleurs de La Manu

---

## 🛠️ Stack technique

| Côté | Technologies |
|------|-------------|
| Backend | PHP, SQL (PDO) |
| Frontend | HTML, CSS, JavaScript |
| Base de données | MySQL |
| Outils | Figma (maquettes), Laragon |

---

## 🗄️ Structure de la base de données

Le schéma suit une approche **Merise** avec les entités principales :

- `etudiants` — informations personnelles + chemin vers la photo + citation
- `classes` — niveaux de promotion (B1, B2, B3…)

---

## 📁 Arborescence

Trombinoscope/
├── assets/
│   ├── css/
│   ├── images/
│   └── js/
├── source/
│   ├── database/
│   ├── functions/
│   ├── pages/
│   ├── partials/
│   └── uploads/
└── index.php

---

## 👥 Équipe & Répartition

| | Baptiste Marchand | Justine Franconville |
|---|---|---|
| GitHub | [@MarchandBaptiste](https://github.com/MarchandBaptiste) | [@justfrancon-alt](https://github.com/justfrancon-alt) |
| Rôle | Architecture BDD, backend PHP/PDO, intégration frontend, upload, sessions, administration, design UI | Direction artistique, charte graphique |

---

## 📌 Contexte

Projet réalisé en **première année Bachelor Développement** à [La Manu](https://la-manu.fr) — Amiens.