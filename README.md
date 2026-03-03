
# Dashboard de Finanças Pessoais - Desafio Fullstack Pleno 🚀

> **⚠️ Nota de Esclarecimento:** > Este projeto não é um teste técnico real de uma empresa específica. O escopo abaixo foi gerado em parceria com a IA do Google (Gemini) com o objetivo de simular um teste técnico real para a vaga de **Desenvolvedor Fullstack Pleno**. 
> Minha intenção com este repositório é aprimorar meus conhecimentos nas tecnologias requisitadas (Vue.js 3 e Symfony), colocar em prática padrões de arquitetura e construir um portfólio sólido que reflita o que o mercado exige atualmente.

---


## 🙋🏽‍♂️ Sobre Mim

Olá! Meu nome é **Amanda Pereira** e sou uma desenvolvedora apaixonada por criar soluções eficientes e escaláveis. Atualmente, meu foco de estudo e atuação está no ecossistema PHP no backend e frameworks reativos como Vue.js no frontend.

Criei este projeto para me desafiar, sair da zona de conforto e demonstrar minhas habilidades na construção de uma aplicação de ponta a ponta, incluindo testes, documentação de API e conteinerização.

* 💼 **LinkedIn:** https://www.linkedin.com/in/amanda-pereira-dev/
* 📧 **E-mail:** amandapereiradevcontact@gmail.com
* 💻 **Portfólio:** https://pereiradev.vercel.app

---

# O Desafio Técnico: Desenvolvedor Fullstack Pleno 🚀

Olá! Ficamos muito felizes com o seu interesse em fazer parte do nosso time. 

Este teste técnico tem como objetivo avaliar suas habilidades práticas, organização, tomada de decisão e familiaridade com a nossa stack principal (Vue.js 3 e Symfony). Não buscamos apenas um código que funcione, mas sim um código limpo, manutenível, bem testado e documentado.

## 🎯 O Desafio: Dashboard de Finanças Pessoais

Você deverá desenvolver uma aplicação web de **Finanças Pessoais**. A aplicação deve permitir que o usuário gerencie suas receitas e despesas, e visualize um resumo de sua saúde financeira.

**Atenção à Arquitetura:** O projeto deve obrigatoriamente ter o **Backend (API REST)** e o **Frontend (SPA)** separados em diretórios distintos (ex: `/api` e `/web`), ou até mesmo em repositórios separados (se preferir, use um monorepo para facilitar o envio).

### 🛠️ Stack Tecnológica Exigida

* **Backend:** PHP 8.x, Symfony (versão 6 ou 7)
* **Banco de Dados:** MySQL 8.x
* **Frontend:** Vue.js 3 (utilizando Composition API e `<script setup>`), Vite

### ✨ Tecnologias Modernas e Práticas Recomendadas (Diferenciais Esperados para Pleno)

Para atingir o melhor nível e demonstrar sua senioridade, esperamos ver (ou encorajamos fortemente) o uso de:

* **Ambiente de Desenvolvimento:** Docker e Docker Compose (queremos rodar seu projeto com um único comando `docker-compose up`).
* **Gerenciamento de Estado (Front):** Pinia.
* **Estilização (Front):** Tailwind CSS ou um framework de UI moderno (ex: Vuetify, Quasar).
* **Qualidade e Testes:** PHPUnit para o backend e Vitest/Jest para o frontend.
* **Autenticação:** JWT (JSON Web Token).

---

## 📋 Escopo do Projeto

A aplicação deve conter as seguintes funcionalidades mínimas:

1.  **Autenticação:**
    * Cadastro de novo usuário.
    * Login/Logout.
2.  **Gestão de Transações:**
    * CRUD (Criar, Ler, Atualizar, Deletar) de transações financeiras.
    * Cada transação deve ter: Título, Valor, Tipo (Receita ou Despesa), Data e Categoria (ex: Alimentação, Lazer, Salário).
3.  **Dashboard Resumo:**
    * Visualização do Saldo Total.
    * Total de Receitas no mês atual.
    * Total de Despesas no mês atual.
    * *Bônus:* Um gráfico simples mostrando as despesas por categoria.

---

## 📖 Como a API deve ser documentada?

Para nós, um bom desenvolvedor pleno sabe que uma API sem documentação é uma API incompleta. 

Sua API deve ser documentada utilizando o padrão **OpenAPI (Swagger)**. 
* **No ecossistema Symfony**, recomendamos fortemente a utilização do bundle `NelmioApiDocBundle` para gerar a documentação interativa automaticamente a partir de anotações/atributos no seu código.
* A documentação deve ser acessível via browser (ex: `http://localhost:8000/api/doc`) quando o projeto estiver rodando.
* Todos os endpoints, parâmetros esperados, payloads de request/response e códigos de erro (400, 401, 404, etc.) devem estar devidamente mapeados.

---

## 🚦 O que vamos avaliar?

Ao revisar seu código, nossa equipe de engenharia olhará para os seguintes pontos:

* **Design de API:** A API é verdadeiramente RESTful? Os verbos HTTP e status codes estão corretos?
* **Organização do Código:** Separação de responsabilidades (Controllers, Services, Repositories). Uso de Design Patterns e princípios SOLID no backend.
* **Boas práticas de Vue 3:** Uso correto de reatividade, componentização, reaproveitamento de código (Composables) e gerenciamento de estado global.
* **Modelagem de Dados:** Estrutura das tabelas, chaves estrangeiras, índices e migrations.
* **Documentação e Setup:** A clareza do seu README e a facilidade de rodar o projeto do zero.
* **Segurança:** Proteção de rotas no front, validação de dados no back, senhas hasheadas e proteção contra vulnerabilidades comuns.
* **Testes:** Presença de testes unitários ou de integração cobrindo, no mínimo, as regras de negócio mais críticas (ex: cálculo do saldo).

---

## 🚀 Como entregar

1.  Faça um fork deste repositório (ou crie um repositório privado e nos adicione como colaboradores).
2.  Crie um `README.md` detalhado na raiz do seu projeto contendo:
    * Instruções claras de como configurar e rodar o projeto (Backend, Frontend e Banco de Dados).
    * Credenciais de teste (caso não exista uma rota de seed ou registro fácil).
    * Breve explicação sobre as decisões de arquitetura e bibliotecas escolhidas.
3.  Quando finalizar, responda ao e-mail do nosso RH com o link do seu repositório.

---

