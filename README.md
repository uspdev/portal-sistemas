# Portal-sistemas

Portal para listar os sistemas da unidade.
Organizado por grupos e em cada grupo aparece a lista de sistemas

## instalação e configuração

* Clonar o projeto
* copiar o .env.example para .env
* gerar chave: `php artisan key:generate`
* configurar o .env
* rodar migrations: `php artisan migrate:fresh --seed` (ambiente dev)
* rodar: `php artisan serve`

grupos
    nome
    coluna
    ordem
sistemas
    nome
    url
    comentario