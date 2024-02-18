Garage_vincent_parrot

Getting Started
These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

Prerequisites
What things you need to install the software and how to install them

PHP 8.3.2 


Installing
First :

Git clone https://github.com/Blacklight059/garage_vincent_parrot.git

Update ".env" with your parameters


Install Dependencies :

composer install


Install DB :

php bin/console doctrine:schema:update --force


Install fixtures :

php bin/console doctrine:fixtures:load


To test user features, an user will be created with : 

email : steven_gomes@hotmail.fr password : steven

you can add modify and delete post

you can accept and delete review

To test admin features, an admin will be created with : 

email : admin@admin.fr password : adminadmin

You can add modify and delete employee
You can add modify and delete hours