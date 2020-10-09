# Parla

Publicação quinzenal da Subdiretoria-Geral de Comunicação Social da Assembleia Legislativa do Estado do Rio de Janeiro

## Características da aplicação

- Git
- PHP 7.1 ou superior
- Composer

### Publicação de conteúdo
- Ao colocar fotos nas publicações, não se deve usar links não seguros (sem HTTPS). O Chrome bloqueia conteúdo não seguro por padrão e, por isso, a imagem não aparecerá no navegador a não ser que seja habilitada permissão para exibir conteúdo não seguro.
- Todos os links das fotos da tabela `article_photos` devem ser se manter em urls internas da aplicação

### Comandos disponíveis

#### Baixar imagens e salvar na pasta local
```
php artisan parla:download-images
```
O comando varre todas as imagens da tabela `article_photos`, faz download, salva na pasta storage com link público e atualiza a referência no banco de dados. Isso evita que hajam urls externas referenciadas.

#### Baixar imagens e salvar na pasta local
```
php artisan parla:download-file-from-url <file_url>
```
O comando faz download da imagem do link <file_url>, salva na pasta storage com link público. Isso evita que hajam urls externas referenciadas.


### Instalação 
#### Guia genérico de uma aplicação desenvolvida em PHP pelo Projetos Especiais

- Clonar o repositório
- Configurar servidor web para apontar para a pasta-do-site/public
- Instalar certificado SSL
- Criar um banco de dados (se necessário)
- Entrar na pasta do site
- Copiar o arquivo .env.example para .env
- Editar o arquivo .env e configurar os dados do sistema, inclusive banco de dados e setar o APP_ENV=production
- Executar o comando "composer install" para instalar todas as dependências
- Restaurar backup do banco de dados ou executar o comando "php artisan migrate" para criar a estrutura do banco de dados
- Executar o comando `php artisan migrate` para atualizar a estrutura do banco de dados (caso já não tenha sido executado no passo 8)
- Executar o comando `php artisan storage:link`

### Atualizando a aplicação

- Entrar na pasta do site
- Baixar as atualizações de código fonte usando Git (git pull ou git fetch + git merge, isso depende de como operador prefere trabalhar com Git)
- Executar o comando `composer install` para instalar todas as dependências (atualizadas)
- Executar o comando `php artisan migrate`

#### No ambiente de desenvolvimento

- vendor/bin/cghooks add --ignore-lock (uma vez)
- vendor/bin/cghooks update (uma vez)
- npm install (sempre)
- npm run watch (enquanto estiver programando)
