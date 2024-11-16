# Gestion Matos chambé

! DOCKER !

## Installation
- via https :
```
git clone https://github.com/grintzdel/gestion_materiel
```

- via ssh (j'fais pas de tuto comment avoir une clef ssh) :
```
git clone git@github.com:grintzdel/gestion_materiel.git
```

## Requirements

- [Git](https://git-scm.com/downloads/win)

- [Docker](https://docs.docker.com/get-docker/)

- [NodeJS](https://nodejs.org/en/download/prebuilt-installer)

- Npm
```
npm install -g npm
```
- Sass
```
npm install -g sass
```

## Lancement

- lancer le docker-compose et renommer le .env.example en .env et ajouter les bonnes variables d'environnement
```
./start.sh
```

- configurer Composer pour avoir le dossier vendor
```
cd web/
composer install
```

- renommer le fichier .env.example en .env et modifier ses valeurs

- si l'on veut ajouter du style supplémentaire, il faut utiliser du SCSS et faire les commandes suivantes dans le terminal :
on se postionne au niveau du dossier style (dans le terminal)
```
cd web/src/style
```
puis lancer la commande suivante :
```
sass --watch style.scss:../public/style.css --style compressed
```
ou si l'on veut rester à la racine du projet, faire :
```
sass --watch web/src/style/style.scss:../public/style.css --style compressed
```