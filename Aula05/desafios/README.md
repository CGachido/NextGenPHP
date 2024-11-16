# Desafio Aula 05

## 1. Implementar a classe QueryMongoDbBuilder
Analise o conjunto de classes juntamente com os testes.

A classe ```QueryMongoDbBuilder``` não está passando em seu teste unitário, faça a implementação interna baseado nos
`asserts` de seu teste.

## 2. Criando um adapter para a classe QueryBuilder
Precisamos que a classe `GetUsersUseCase` consiga realizar uma busca no MongoDB.

A atual busca usando o QueryBuilder de SQL está funcionando e testada em `tests/integration`.

Você precisa criar um **Adapter** para que consiga utilizar a classe de ```QueryMongoDbBuilder``` sem mexer na 
implementação usada na Classe `GetUsersUseCase`.

**Atenção:** Para esse desafio não pode haver alteração nas checagens dos testes nem 
nas classes: `GetUsersUseCase` e `QueryBuilder`.

**Obs:** Você pode alterar somente o teste de integração do ```QueryMongoDbBuilder``` 
localizado em: `tests/integration/GetUsersUseCaseTest.php`.

Comandos:
```
# Suba o container
make up

# instalar o phpunit
make install

# Rodar o teste
make test

# Rodar o teste em modo watch(hot-reload)
make test-watch
```
Recapitulação:

1. Implementar a classe `QueryMongoDbBuilder`
2. Criar um *Adapter* para substituir a `QueryBuilder`
3. O adapte no teste do useCase seu Adapter
