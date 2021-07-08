# Fórmula um REST API

Com essa API é possível adicionar/buscar/deletar/atualizar:  pilotos, equipes e circuitos.

## Instalação

Para instalar no seu ambiente local lembre-se de parametrizar o seu banco de dados no .env com base no .env.example, e depois rodar:

```bash
php bin/console make:migration
```
Com isso vai ser criado uma migration com base no banco de dados parametrizado no .env .\
Depois basta rodar o comando abaixo para rodar essa migration.
```bash
php bin/console doctrine:migrations:migrate
```

## Rotas
Base:
``` 
/api/v1
```
Criar um piloto 
```bash
POST /driver
{
	"name":"Nome do Piloto",
	"born":"YYYY/mm/dd",
	"location":"cidade/pais",
	"race_wins":1, //numero de corridas ganhas
	"championship_win":2, //numero de campeonatos ganhos
	"photo":"URL foto",
	"team":1 //id da equipe
}
```
Criar uma equipe
```bash
POST /team
{
	"name":"Nome da Equipe",
	"born":"YYYY/mm/dd",
	"location":"cidade/pais",
	"photo":"URL foto"
}
```
Criar um circuito
```bash
POST /circuit
{
	"name":"Nome do Circuito",
	"location":"cidade/pais",
	"fast_lap":1.400,
	"fast_lap_driver":"Nome do Piloto",
	"photo": "URL foto"
}
```
Listar todos os pilotos
```bash
GET /drivers
```
Listar todas as equipes
```bash
GET /teams
```
Listar todos os circuitos
```bash
GET /circuits
```
Listar um piloto específico
```bash
GET /driver/{ID}
```
Listar uma equipe específica
```bash
GET /team/{ID}
```
Listar um circuito específico
```bash
GET /circuit/{ID}
```
Atualizar um piloto 
```bash
PUT /driver/{ID}
{
	"name":"Nome do Piloto",
	"born":"YYYY/mm/dd",
	"location":"cidade/pais",
	"race_wins":1, //numero de corridas ganhas
	"championship_win":2, //numero de campeonatos ganhos
	"photo":"URL foto",
	"team":1 //id da equipe
}
```
Atualizar uma equipe
```bash
PUT /team/{ID}
{
	"name":"Nome da Equipe",
	"born":"YYYY/mm/dd",
	"location":"cidade/pais",
	"photo":"URL foto"
}
```
Atualizar um circuito
```bash
PUT /circuit/{ID}
{
	"name":"Nome do Circuito",
	"location":"cidade/pais",
	"fast_lap":1.400,
	"fast_lap_driver":"Nome do Piloto",
	"photo": "URL foto"
}
```
Remover um piloto 
```bash
DELETE /driver/{ID}
```
Remover uma equipe 
```bash
DELETE /team/{ID}
```
Remover um circuito
```bash
DELETE /circuit/{ID}
```

## Filtros
```bash
GET rota?campo=valor
```
Ordenação exemplo
```bash
GET /drivers?name=Vettel
```

## Ordenação
```bash
GET rota?sort['campo']=DESC
GET rota?sort['campo']=ASC
```
Ordenação exemplo
```bash
GET /teams?sort['name']=DESC
```

## Paginação(padrão 1)
```bash
GET rota?page=numPagina
```
Paginação exemplo
```bash
GET /drivers?page=2
```

## Itens por página (padrão 3)
```bash
GET rota?itemsperpage=num
```
Paginação exemplo
```bash
GET /drivers?page=2
```
OBS: É possível combinar multiplos filtros

## License
[MIT](https://choosealicense.com/licenses/mit/)

