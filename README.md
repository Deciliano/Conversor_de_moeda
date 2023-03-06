# conversor_de_moeda

##Desenhar um pequeno sistema que possua uma API Rest, que responda os seguintes métodos:

[get/post] /Products (todos os produtos)
[get/put/delete] /Products/$ID (por ID)
OBS.: 

- **POST: Método genérico para qualquer requisição que envia dados ao servidor;**
- **PUT: Método específico para atualização de dados no servidor;**

[get] /Currency/ (todas as cotações)
[get] /Currency/$symbol (exemplo: BRL, USD, EUR)

- Os produtos devem ser cadastrados em BRL, usando API no padrão Rest
-A cotação das outras moedas deve vir da API
[https://economia.awesomeapi.com.br/all](https://economia.awesomeapi.com.br/all)
-Seu model Produto vai ser bem básico. Vai ter:
id
name
price
-O DTO retornado nos GET's, precisa conter essa informação e um dicionario/mapa com esse price convertido pras outras cotações
- Projeto precisa de 3 'camadas' -> rotas / logica de negocio / repository
-Use o formato de dados que preferir para armazenar os dados, recomendo um banco de dados relacional simples, como um postgres.
-Conceitos como DTO, Interface precisam ser aplicados
-Precisa de teste unitário
-Precisa de Documentação Swagger
-Banco de Dados rodando no docker-compose.yml
-Um script SH q roda o projeto inteiro. Só vou dar git pull e rodar o script, se o projeto não funcionar, tão fudidos
