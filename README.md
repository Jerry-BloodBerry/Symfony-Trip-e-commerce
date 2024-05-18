# Symfony-Trip-e-commerce - Amazing trip booking service
This project was created as part of computer science studies curriculum. The project goal was to create
a trip booking application similar to other booking applications that you can find on the Internet (e.g. booking.com).

This was also my first ever big project written in Symfony which helped me get invaluable experience with the framework.

## Running the project locally
There are two main options available to you if you want to run the project locally:
### Running with Docker
This is the recommended option. To run the project using docker simply execute the following command in the terminal
while in the project root directory

```bash
docker compose up
```

This will start all services required to run the application locally and will also import example data into the database.

### Running using Symfony binary
If you want to run the project using symfony binary instead of docker you will need
to execute a couple of commands:

First install the composer dependencies:
```bash
composer install
```

Second run your database locally and change this line in .env file so that it has the right credentials (username, password), host, port and database name:
```env
DATABASE_URL=postgres://postgres:password@localhost:5432/dreamholiday
```

If you don't have a database yet and you want to create one use this command when
your database server is running:
```bash
php bin/console doctrine:database:create
```

Then you can run doctrine migrations:
```bash
php bin/console doctrine:migrations:migrate
```

And load example data into the database **if you want**:
```bash
php bin/console doctrine:fixtures:load
```

After that you can finally run the application using the symfony binary (you must have it installed on your system):
```bash
symfony serve
```