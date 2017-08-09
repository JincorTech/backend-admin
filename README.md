# Jincor Administration

Jincor Administration is service implemented for internal Jincor usage.

##### Administrator is currently able to perform following actions:

1. View Companies data.
2. Manage dictionaries data (Company Types, Currencies, Economical Activity Types, etc.)

##### Road map is:

1. Remove registration.
2. Add more dictionaries management (Cities). 
3. Add dashboard section with statistics data.
4. Dockerize service.
5. Integrate messenger service to allow Administrator respond to end users support requests.
6. Improve UI/Implement brand new frontend instead of generated one.

##### How to install and test:

1. Clone this repo.
1. Build docker containers: docker-compose build --no-cache.
1. Run containers: docker-compose up -d
1. Init workspace: docker-compose exec workspace ./init.sh
1. Start development server: docker-compose exec workspace ./start.sh

##### Additional info:

This service is based on Infyom Laravel AdminLTE generator boilerplate: https://github.com/InfyOmLabs/adminlte-generator.
Infyom docs: http://labs.infyom.com/laravelgenerator/docs/5.4/introduction