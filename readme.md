# projetOCR6

[![Codacy Badge](https://api.codacy.com/project/badge/Grade/990e93d498044f049e956f8df6622e1b)](https://app.codacy.com/gh/fkevin91/snowtricks?utm_source=github.com&utm_medium=referral&utm_content=fkevin91/snowtricks&utm_campaign=Badge_Grade_Settings)

[![Maintainability](https://api.codeclimate.com/v1/badges/d46f4c55600e835d8612/maintainability)](https://codeclimate.com/github/fkevin91/snowtricks/maintainability)

Technical Requirements
Before creating your first Symfony application you must:

Install PHP 7.2.5 or higher and these PHP extensions

Note that all newer, released versions of PHP will be supported during the lifetime of each Symfony release (including new major versions). For example, PHP 8.0 is supported.
Install Composer, which is used to install PHP packages.

install the dependencies present in the composer.json
example : TWIG

for import the project :

click clone a repository on vscode

then indicate the url of the repository :

"https://github.com/fkevin91/snowtricks"

lancer la commande : 
````
composer update
````

update your file .env

 - config access data base
 - config mails


entrer this command :

````
php bin/console doctrine:database:create
````

after :

````
php bin/console doctrine:migrations:migrate
````

Response : "yes"

if a problem occurs, remove all the .php migration versions then enter this command: 

````
php bin/console make:migration
````

response : "yes"

after : 
````
php bin/console doctrine:migrations:migrate
````

Response : "yes"

import play data.

enter this last command :

symfony serve:start
