# Portal-sistemas

O Portal-sistemas permite criar um site para listar itens organizados em grupos.

![Print](docs/print.png)

## Características

* Grupos são dispostos em até 4 colunas
* Grupos e ítens podem conter texto adicional. No grupo é sempre visível, no item pode ser exibido clicando no botão <img src="docs/caret-down.png" width="12px">
* Login usando senha única: somente usuários autorizados previamente
* Admins gerenciam usuários
* Gerentes editam o conteúdo (grupos e ítens)

Esse sistema pode ser usado como portal de sistemas da Unidade mas também pode ser usado como uma coleção de links.

## instalação e configuração

* Clonar o projeto
* copiar o .env.example para .env
* gerar chave: `php artisan key:generate`
* configurar o .env: app, database, senhaunica, theme, replicado
* rodar migrations: `php artisan migrate:fresh --seed` (ambiente dev)
* rodar: `php artisan serve`
