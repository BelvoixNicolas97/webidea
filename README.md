# 1. webidea

- [1. webidea](#1-webidea)
  - [1.1. Installation WordPress](#11-installation-wordpress)
    - [1.1.1. Configuration](#111-configuration)
    - [1.1.2. Configuration de la base de données](#112-configuration-de-la-base-de-données)
  - [1.2. Installation du thème](#12-installation-du-thème)
  - [1.3. Utilisation](#13-utilisation)

## 1.1. Installation WordPress

### 1.1.1. Configuration

Utiliser composer à la racine du dossier.

```
composer install
```

Suivre la documentation de [bedrock](https://roots.io/bedrock/docs/installation/) pour configurer les constants.

### 1.1.2. Configuration de la base de données

La base de données se trouve dans le fichier bdd.sql à la racine du dossier.

## 1.2. Installation du thème

Utiliser la composer et yarn.

```
composer install
yarn install
yarn build
```

Suivre la documentation de [Sage](https://roots.io/sage/docs/configuration/) pour configurer les chemins d'accès aux différente ressources.

## 1.3. Utilisation

Identifiant admin:

admin

1234
