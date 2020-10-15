# Challenge Associations

## Supports de cours associés

- [Doc Symfony/Doctrine](https://symfony.com/doc/current/doctrine/associations.html)
- [Doc Symfony/Doctrine relations](https://symfony.com/doc/current/doctrine.html)
- [Lien vers la fiche récap Doctrine Associations](https://github.com/O-clock-Alumnis/fiches-recap/blob/master/symfony/themes/S2J2-Doctrine.md)
- [Lien vers la fiche récap Doctrine Intro](https://github.com/O-clock-Alumnis/fiches-recap/blob/master/symfony/themes/S2J1-Doctrine.md)

## Challenge Associations Doctrine

D'après le MCD suivant :

![](https://github.com/O-clock-Alumni/fiches-recap/blob/master/symfony/themes/img/mcd-challenge-intro-doctrine.png)

> Review = critique (= commentaire).

### Créer les entités `Review`,  `Author` et `Post`

### Post

- `title`
- `body`
- `image` (image en ligne qui commence par http://...)
- `nbLike`
- `createdAt`
- `updatedAt`

#### Review

- `username`
- `body`
- `createdAt`
- `updatedAt`

#### Author

- `name`
- `nbArticles`
- `createdAt`
- `updatedAt`

### Créer les relations entre `Review`, `Author` et `Post`

En s'inspirant de la correction de ce matin et de la fiche récap' associée ou de la doc Symfony.  
Cf : https://github.com/O-clock-Orion/Symfo-E06-intro-doctrine

> Créer les entités à l'aide de `php bin/console make:entity`

### Les manipuler depuis un contrôleur

Si vous voulez démarrer avec quelques données, créez-en vous-même depuis PhpMyAdmin.

#### Création d'objets + associations + sauvegarde

Comme vu en cours en mode "expérimentation" :

- Créér des données en liant **via le code** (dans le controlleur par exemple) une ou des reviews `Review` à un `Post` (via les associations),
- Créér des données en liant **via le code** (dans le controlleur par exemple)  un `Author` à un `Post` (via les associations).

#### Lecture et affichage

- Afficher la liste des posts URL = `/`.
- Afficher les reviews et l'auteur sur la fiche article URL = `/post/show/{id}`.
- Afficher tous les posts de tous les auteurs via URL = `/author/list` et faire un lien vers les posts (si des posts existent pour un auteur).

### BONUS "vie réelle"
Créer un formulaire _Ajouter une critique_ sur la page `/post/show/{id}` pour ajouter une critique depuis la page d'un article.