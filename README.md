# Task Tracker PHP

Projeto simples de **CRUD de tarefas** feito com PHP procedural, MySQL e `mysqli`.

A ideia do projeto é praticar os fundamentos de uma aplicação web com PHP:

- criar tarefas;
- listar tarefas;
- editar tarefas;
- marcar como concluida ou reabrir;
- deletar tarefas;
- filtrar por status;
- buscar por titulo;
- organizar codigo em pastas e funcoes reutilizaveis.

## Tecnologias

- PHP
- MySQL
- XAMPP
- DBeaver
- HTML
- CSS

## Como Rodar Localmente

1. Coloque o projeto dentro da pasta `htdocs` do XAMPP.

Exemplo:

```text
xampp/htdocs/task-tracker-php
```

2. Inicie o Apache e o MySQL pelo painel do XAMPP.

3. Crie o banco de dados no MySQL:

```sql
CREATE DATABASE task_tracker;
```

4. Crie a tabela:

```sql
USE task_tracker;

CREATE TABLE tarefas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    descricao TEXT,
    concluida TINYINT(1) DEFAULT 0,
    criada_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

5. Confira a conexao em `config/conexao.php`:

```php
$conexao = mysqli_connect("localhost", "root", "", "task_tracker");
```

6. Acesse no navegador:

```text
http://localhost/task-tracker-php/index.php
```

## Estrutura do Projeto

```text
task-tracker-php/
  acoes/
    alternar_status.php
    atualizar.php
    deletar.php
    salvar.php

  assets/
    Style.css

  config/
    conexao.php

  funcoes/
    tarefas.php
    validacoes.php

  editar.php
  index.php
  README.md
```

## Fluxo CRUD

- **Create:** `acoes/salvar.php`
- **Read:** `index.php`
- **Update:** `editar.php` + `acoes/atualizar.php`
- **Delete:** `acoes/deletar.php`

## Funcionalidades

- Cadastro de tarefas com titulo e descricao.
- Listagem das tarefas mais recentes primeiro.
- Edicao de titulo, descricao e status.
- Botao rapido para concluir ou reabrir uma tarefa.
- Confirmacao antes de deletar.
- Filtro por status:
  - todas;
  - pendentes;
  - concluidas.
- Busca por titulo respeitando o filtro atual.
- Mensagens de feedback com popup.
- CSS com cards, botoes, animacoes leves e layout responsivo.

## Organizacao do Codigo

O projeto foi refatorado para separar responsabilidades:

- `config/conexao.php`: conexao com o banco.
- `funcoes/validacoes.php`: validacoes reutilizaveis.
- `funcoes/tarefas.php`: funcoes que acessam a tabela `tarefas`.
- `acoes/`: arquivos que processam formularios ou acoes e redirecionam.
- `assets/`: arquivos visuais, como CSS.

## Observacao Sobre GitHub e Deploy

Este projeto usa PHP e MySQL. Por isso, ele **nao roda no GitHub Pages**, porque o GitHub Pages aceita apenas sites estaticos com HTML, CSS e JavaScript.

Para deixar o projeto online funcionando, e necessario usar uma hospedagem com:

- PHP;
- MySQL;
- suporte a upload dos arquivos do projeto.

Em uma hospedagem real, os dados de `config/conexao.php` normalmente mudam:

```php
mysqli_connect("host", "usuario", "senha", "nome_do_banco");
```

## Aprendizados

Este projeto pratica:

- `$_GET` e `$_POST`;
- formularios HTML;
- queries SQL;
- `mysqli_prepare`;
- `mysqli_stmt_bind_param`;
- validacao no backend;
- redirecionamento com `header`;
- sessoes com `$_SESSION`;
- organizacao de arquivos PHP;
- refatoracao simples com funcoes.
