A simple REST API implementation with Symfony framework
Monkey Island test application

This project was created as a test project when I learnt the 
PHP Symfony framework. It is a Symfony bundle, and implements
CRUD operations over REST methods.


Introduction

This application is a plugin for Symfony PHP framework. In Symfony-speak it is a bundle (under the
name of GrambleMonkeyIslandBundle). To install it, follow these steps. If you already have a working
Symfony, the best thing to do is to install a new one, just for be sure, that it doesn't have any conflict
with my bundle.

Installation

Install Symfony

1) download Symfony's compressed file from http://symfony.com.

2) extract it to a convenient place, then move to /var/www. So you will have a directory
/var/www/Symfony. In the following we supposse that this is your current working directory.

3) follow the instructions found in the Symfony quick tour about the setup and configuration:
http://symfony.com/doc/current/quick_tour/the_big_picture.html. Important, that you should run the
webserver (with php app/console server:run command), and have to setup the database connection as
well.

Install the bundle:

1) copy the zipped version of the bundle to the src/ directory, so you will have
src/NSDataRefinery/MonkeyIslandBundle/ and several subdirectories underneath.

2) open app/config/routing.yml, and append the file with these lines:
# NSDataRefineryMonkeyIslandBundle routes
_monkey_island:
resource: "@NSDataRefineryMonkeyIslandBundle/Resources/config/routing.yml"

3) open app/AppKernel.php, and in registerBundles method add the following line into the $bundles
array:
new NSDataRefinery\MonkeyIslandBundle\NSDataRefineryMonkeyIslandBundle(),

Create database tables:
run the following command in command line (supposing your are in /var/www/Symfony).

$ php app/console doctrine:database:drop --force$ php app/console doctrine:database:create
$ php app/console doctrine:schema:update --force

Usage of the application
In the application we can create, list/read, update and delete cuddly toys (dogs and monkeys), and
weapons. We can also list ghosts, and all cuddly toys together.

Operation | HTTP method | Parameter | URL |
--- | --- | --- | --- |
List | GET | n/a | http://localhost:8000/api/cuddly_toys/ |
 |  |  | http://localhost:8000/api/cuddly_toys/dogs/ |
 |  |  | http://localhost:8000/api/cuddly_toys/monkeys/ |
 |  |  | http://localhost:8000/api/weapons/ |
 |  |  | http://localhost:8000/ghosts/ |
Read | GET | id | http://localhost:8000/api/cuddly_toys/dogs/{id}
 |  |  | http://localhost:8000/api/cuddly_toys/monkeys/{id}
 |  |  | http://localhost:8000/api/weapons/{id}
Create | POST | JSON | http://localhost:8000/api/cuddly_toys/dogs/
 |  |  | http://localhost:8000/api/cuddly_toys/monkeys/
 |  |  | http://localhost:8000/api/weapons/
Update | PUT | id, JSON | http://localhost:8000/api/cuddly_toys/dogs/{id}
 |  |  | http://localhost:8000/api/cuddly_toys/monkeys/{id}
 |  |  | http://localhost:8000/api/weapons/{id}
Delete | DELETE | id | http://localhost:8000/api/cuddly_toys/dogs/{id}
 |  |  | http://localhost:8000/api/cuddly_toys/monkeys/{id}
 |  |  | http://localhost:8000/api/weapons/{id}

The id should be a numeric value, which is the identifier of the item under operation. If the identifier is
not valid, the application returns 404 HTTP status code.

The JSON string is an object with two mandatory elements. In case of dogs, and monkeys the elements
are the “name” and the “energy_level”, in case of weapons the elements are “name” and
“power_level”. If the mandatory elements are missing, the application returns 409 HTTP status code.

• Dog/monkey example: {'name': 'Oscar', 'energy_level': 4}
• Weapon example: {'name': 'water', 'power_level': 3}

In case of create, update, and deletion the return value is a message about the success or the failure of
the operation. In case of list and read, the JSON contains the records itself. If operation was
successfull, the application return 200 HTTP status code.

Example requests:

Example requests:
create dogs
`curl -i -H "Accept: application/json" -X POST -d "{'name': 'Oscar', 'energy_level': 4}" http://localhost:8000/api/cuddly_toys/dogs/`
`curl -i -H "Accept: application/json" -X POST -d "{'name': 'Caesar', 'energy_level': 1}" http://localhost:8000/api/cuddly_toys/dogs/`
`curl -i -H "Accept: application/json" -X POST -d "{'name': 'Lassie', 'energy_level': 3}" http://localhost:8000/api/cuddly_toys/dogs/`
`curl -i -H "Accept: application/json" -X POST -d "{'name': 'Kantor', 'energy_level': 3}" http://localhost:8000/api/cuddly_toys/dogs/`

create monkeys
`curl -i -H "Accept: application/json" -X POST -d "{'name': 'Cheeta', 'energy_level': 3}" http://localhost:8000/api/cuddly_toys/monkeys/`
`curl -i -H "Accept: application/json" -X POST -d "{'name': 'Tivadar', 'energy_level': 1}" http://localhost:8000/api/cuddly_toys/monkeys/`

create weapons
`curl -i -H "Accept: application/json" -X POST -d "{'name': 'water', 'power_level': 3}" http://localhost:8000/api/weapons/`
`curl -i -H "Accept: application/json" -X POST -d "{'name': 'earth', 'power_level': 1}" http://localhost:8000/api/weapons/`
`curl -i -H "Accept: application/json" -X POST -d "{'name': 'air', 'power_level': 2}" http://localhost:8000/api/weapons/`
`curl -i -H "Accept: application/json" -X POST -d "{'name': 'fire', 'power_level': 4}" http://localhost:8000/api/weapons/`

list all cuddly toys
`curl -i -H "Accept: application/json" http://localhost:8000/api/cuddly_toys/`

list all dogs
`curl -i -H "Accept: application/json" http://localhost:8000/api/cuddly_toys/dogs/`

list all monkeys
`curl -i -H "Accept: application/json" http://localhost:8000/api/cuddly_toys/monkeys/`

list all weapons
`curl -i -H "Accept: application/json" http://localhost:8000/api/weapons/`

list ghosts
`curl -i -H "Accept: application/json" http://localhost:8000/ghosts/`

get individual dogs
`curl -i -H "Accept: application/json" http://localhost:8000/api/cuddly_toys/dogs/1`
`curl -i -H "Accept: application/json" http://localhost:8000/api/cuddly_toys/dogs/2`
`curl -i -H "Accept: application/json" http://localhost:8000/api/cuddly_toys/dogs/3`
`curl -i -H "Accept: application/json" http://localhost:8000/api/cuddly_toys/dogs/4`

get individual monkeys
`curl -i -H "Accept: application/json" http://localhost:8000/api/cuddly_toys/monkeys/1`
`curl -i -H "Accept: application/json" http://localhost:8000/api/cuddly_toys/monkeys/2`

get individual weapons
`curl -i -H "Accept: application/json" http://localhost:8000/api/weapons/1`
`curl -i -H "Accept: application/json" http://localhost:8000/api/weapons/2`
`curl -i -H "Accept: application/json" http://localhost:8000/api/weapons/3`
`curl -i -H "Accept: application/json" http://localhost:8000/api/weapons/4`

checking errors for non-existent values
`curl -i -H "Accept: application/json" http://localhost:8000/api/cuddly_toys/dogs/5`
`curl -i -H "Accept: application/json" http://localhost:8000/api/cuddly_toys/monkeys/3`
`curl -i -H "Accept: application/json" http://localhost:8000/api/weapons/5`

Note: these request return 404 HTTP code, and a JSON message.

delete a dog
`curl -i -H "Accept: application/json" -X DELETE http://localhost:8000/api/cuddly_toys/dogs/2`

delete a monkey
`curl -i -H "Accept: application/json" -X DELETE http://localhost:8000/api/cuddly_toys/monkeys/2`

delete a weapon
`curl -i -H "Accept: application/json" -X DELETE http://localhost:8000/api/weapons/2`

checking the items - proving, that we really deleted them
// checking deleted dog
`curl -i -H "Accept: application/json" http://localhost:8000/api/cuddly_toys/dogs/2`

// checking deleted monkey
`curl -i -H "Accept: application/json" http://localhost:8000/api/cuddly_toys/monkeys/2`

// checking deleted weapon
`curl -i -H "Accept: application/json" http://localhost:8000/api/weapons/2`

Note: these request return 404 HTTP code, and a JSON message.

// checking the lists (the deleted items will miss from these lists)
`curl -i -H "Accept: application/json" http://localhost:8000/api/cuddly_toys/dogs/`
`curl -i -H "Accept: application/json" http://localhost:8000/api/cuddly_toys/monkeys/`
`curl -i -H "Accept: application/json" http://localhost:8000/api/weapons/`

change a dog
`curl -i -H "Accept: application/json" -X PUT -d "{'name': 'Billy', 'energy_level': 2}" http://localhost:8000/api/cuddly_toys/dogs/3`

// proving that the dog has been changed
`curl -i -H "Accept: application/json" http://localhost:8000/api/cuddly_toys/dogs/3`

change a monkey
`curl -i -H "Accept: application/json" -X PUT -d "{'name': 'Billy', 'energy_level': 2}" http://localhost:8000/api/cuddly_toys/monkeys/1`

// proving that the monkey has been changed
`curl -i -H "Accept: application/json" http://localhost:8000/api/cuddly_toys/monkeys/1`

change a weapon
`curl -i -H "Accept: application/json" -X PUT -d "{'name': 'mud', 'power_level': 2}" http://localhost:8000/api/weapons/3`

// proving that the weapon has been changed
curl -i -H "Accept: application/json" http://localhost:8000/api/weapons/3

