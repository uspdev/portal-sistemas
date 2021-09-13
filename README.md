# Portal-sistemas

Portal para listar os sistemas da unidade.
Organizado por grupos e em cada grupo aparece a lista de sistemas

## instalação e configuração

* Clonar o projeto
* copiar o .env.example para .env
* gerar chave: `php artisan key:generate`
* configurar o .env: app, database, senhaunica, theme, replicado
* rodar migrations: `php artisan migrate:fresh --seed` (ambiente dev)
* rodar: `php artisan serve`

## Características

* Somente usuários autorizados no env ou adicionados manualmente
* Gerente pode configurar grupos e sistemas
* Admins pode gerenciar usuários

grupos
    nome
    coluna
    ordem
sistemas
    nome
    url
    comentario