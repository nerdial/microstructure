## 👨‍💻 &nbsp;How to install


#### &nbsp;-  Clone the project

```bash
git clone git@github.com:nerdial/microstructure.git
cd ./microstructure
```

#### &nbsp;-  Copy .env-sample into .env
```bash
cp .env-sample .env
```

#### &nbsp;- Run the following to setup docker containers

```bash
docker-compose up -d
```

<hr>


### &nbsp;- Run migrations 

#### Open this url to run migrations

[http://localhost:8000/migrate](http://localhost:8000/migrate)


#### or run this command in terminal 

```bash
docker-compose exec php bash -c './vendor/bin/doctrine-migrations migrate --no-interaction'
```

### &nbsp;- Run unit tests

```bash
docker-compose exec php bash -c './vendor/bin/phpunit tests'
```


<hr>



### &nbsp;- Welcome page

[http://localhost:8000](http://localhost:8000)


### &nbsp;- phpmyadmin

[http://localhost:8001](http://localhost:8001)




 


