### API для синхронизации данных между старой и новой базой
Стек:
  - Slim
  - Nginx
  - PostgreSql
  - ORM(doctrine)

приложение доступно по http://localhost:8080
  
## Команды

развернуть приложение (через утилиту make) 
```sh
$ make init
```
## Вход в pgadmin
pgadmin доступно по http://localhost:8081

- login - pgadmin4@pgadmin.org
- password - admin

подключение к серверу
- hostname/address - api-postgres
- port - 5432
- maintenance - app
- username - app
- password - secret
-------------------------------------
### Работа с API

##### Добавление данных (POST)
```sh
/api/{typeBaza}/add/{model}/{action}
```
где:
 - {typeBaza} - к какой базе относяться данные,имеет два значения
    - new-baza
    - old-baza
 
 - {model} - к какой сущности относяться данные,имеет три значения
    - request
    - product
    - transaction
 - {action} - к каким действиям относяться данные,имеет три значения
     - create
     - update
     - delete

данные для сохранения передаються в массиве
##### Проверка данных (GET)
```sh
/api/{typeBaza}/check/{model}/{action}
```
вернет ответ в виде
{
    "count": 2
},
кол-во записе в бд (вернет 0 если записей нет)

{model},{action} - опцианальны (без них вернеться общее кол-во данных)

##### Получение данных (GET)
```sh
/api/{typeBaza}/get-dat
```
вернет данные в формате
```sh
"data": [
        {
            "id": 9,
            "model": "product",
            "action": "create",
            "data": {
                "name": "alex",
                "product": "test",
                "price": "1"
            }
        },
        {
            "id": 10,
            "model": "product",
            "action": "create",
            "data": {
                "name": "alex",
                "product": "test",
                "price": "1"
            }
        }
    ]
```

можно добавить параметр для получение нужного количества записей
(default = 10)
```sh
/api/{typeBaza}/get-dat?limit=100
```
также можно передовать {model}/{action},для фильтрации данных

##### Удаление данных (DELETE)
```sh
/api/{typeBaza}/delete
```
в массиве передаються id - удаляемых данных