<h1 align="center">Users Control</h1>
<br>

### If you download the repository as a zip, and to allow requests to reach your local machine from Docker containers, you need to follow these steps:
<br>

<h2 align="center">Open the Hosts File on Windows: </h2>
<br>

1. In Notepad, go to File > Open.
2. Navigate to C:\Windows\System32\drivers\etc.
3. In the file type dropdown (bottom right), select "All Files" to see the hosts file.
4. Select the hosts file and open it.
5. Add the following line at the end of the file:

<br>

```
127.0.0.1       users.local
```

6. Save and close the file.

<br>

<h2 align="center">For Linux and macOS:</h2>
<br>

1. Open a terminal and run:

```
sudo nano /etc/hosts
```

Then add:

```
127.0.0.1       users.local
```

<br>

<h2 align="center">Set up:</h2>
<br>

- The project use Docker, the only dependencies are:
- Docker.
- Make.


Make sure you have downloaded, [Docker](https://docs.docker.com/engine/install/)

Make sure you have downloaded make for Windows, [Make](https://sp21.datastructur.es/materials/guides/make-install.html#windows-installation)

Make sure you have downloaded make for Mac, [Make](https://formulae.brew.sh/formula/make)

<h2 align="center">Docker configuration and commands:</h2>
<br>

* Start containers.
```
$ make up
```

* Stop containers.
```
$ make down
```

<h2 align="center">Or</h2>
<br>

```
$ docker-compose up -d
```

```
$ docker-compose down
```

* Then.
```bash
$ make shell php

or

$ docker exec -ti usersControl_php sh

and

$ php artisan queue:listen
```


### Now you can use the app.

<br>

**Note:** If you have problems adding the hosts, when creating a user go to PhpMyAdmin and set is_active to 1 to be able to login.

<br>

<h2 align="center">Application access</h2>

[Laravel Application](http://users.local:8000)

[Without editing the hosts file](http://localhost:8000)

[PhpMyAdmin](http://localhost:7010)

[MailHog](http://localhost:8025)

<br>

## Commands for the tests outside the php shell:

```bash
php artisan test --filter AuthUserTest

php artisan test --filter ViewTest
```

<br>

**Note:** If you encounter this error:

```ERR
file_put_contents(/Users/usuario/workspace/userscontrol/storage/framework/views/187f828346b000af3c7029fb05171792.php): Failed to open stream: No such file or director
```


Solution:

```bash
$ sudo chown -R $USER:www-data /Users/usuario/workspace/userscontrol/storage

$ sudo chown -R $USER:www-data /Users/usuario/workspace/userscontrol/bootstrap/cache

$ php artisan config:clear

$ php artisan cache:clear

$ php artisan view:clear
```
