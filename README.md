#Gestion Matos chambé

! DEV local sous MAMP et BDD SQL !

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
- [Scoop](https://scoop.sh/)
Dans PowerShell :
```
Set-ExecutionPolicy -ExecutionPolicy RemoteSigned -Scope CurrentUser
Invoke-RestMethod -Uri https://get.scoop.sh | Invoke-Expression
```

- [Git](https://git-scm.com/downloads/win)

- PHP
```
scoop install php
```

- Composer
```
scoop install composer
```

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

- configurer Composer pour avoir le dossier vendor
```
composer install
```

- renommer le fichier .env.example en .env et modifier ses valeurs

- si l'on veut ajouter du style supplémentaire, il faut utiliser du SCSS et faire les commandes suivantes dans le terminal :
on se postionne au niveau du dossier style (dans le terminal)
```
cd src/style
```
puis lancer la commande suivante :
```
sass --watch style.scss:../public/style.css --style compressed
```
ou si l'on veut rester à la racine du projet, faire :
```
sass --watch src/style/style.scss:../public/style.css --style compressed
```