# Eletroproj Editorial — tema WordPress

Tema editorial inspirado na estrutura de revistas técnicas (como a Smashing Magazine), com a identidade da Eletroproj. Foco em leitura confortável e performance: sem jQuery, sem page builder, fontes auto-hospedadas e JavaScript mínimo (cerca de 5 KB).

## O que vem pronto

- **Cabeçalho** na cor da marca, com logo, menu, botão de modo claro/escuro e busca, mais uma faixa de categorias em "pílulas" logo abaixo.
- **Página inicial de revista:** artigo em destaque com imagem inclinada, dois artigos compactos, newsletter na lateral, guias essenciais (3 cards coloridos), grade de "Últimos artigos" em 2 colunas, cards de serviços e lista de todos os temas no rodapé.
- **Página do artigo:** autor, data, data de atualização e comentários; título grande; caixa com tempo de leitura, categorias e compartilhamento; **Resumo rápido**; **sumário automático** (aparece quando há 3 ou mais subtítulos H2); letra capitular; barra de progresso de leitura; caixa do autor; newsletter fixa na lateral; artigos relacionados; comentários.
- **Estilos de bloco** no editor: caixas *Nota*, *Dica*, *Atenção* e *Norma técnica* (nos blocos Grupo e Parágrafo), lista *Leitura complementar*, *Tabela técnica* e imagem *Com moldura*.
- **Padrões de bloco** na categoria "Eletroproj": Leitura complementar, Caixa "o que diz a norma" e Resumo em pontos.
- Blocos de código com tema escuro e botão **Copiar**.
- **Modo escuro** automático (segue o sistema) e botão para alternar; a escolha fica salva no navegador.
- **SEO:** HTML semântico, breadcrumbs, JSON-LD (Article + BreadcrumbList). O JSON-LD é desligado automaticamente se Yoast, Rank Math, SEOPress ou AIOSEO estiverem ativos.
- **Acessibilidade:** links "pular para o conteúdo", foco visível, menu acessível por teclado (Esc fecha) e bom contraste.
- Templates: início, artigo, página, categoria/tag/autor, busca (com o termo destacado), 404 e "Largura total (landing page)".

## Instalação (passo a passo)

1. No painel do WordPress, vá em **Aparência → Temas**.
2. Clique em **Adicionar novo tema** (botão no topo) → **Enviar tema**.
3. Clique em **Escolher arquivo**, selecione `eletroproj-editorial.zip` e clique em **Instalar agora**.
4. Clique em **Ativar**.

> Dica: teste antes no LocalWP ou num ambiente de testes (staging).

## Configuração (passo a passo)

### 1. Menus
1. Vá em **Aparência → Menus**.
2. Crie um menu (ex.: "Principal") com Artigos, Cursos, Calculadoras, Serviços e Contato. Embaixo, em **Configurações do menu → Exibir local**, marque **Menu principal (cabeçalho)** e clique em **Salvar menu**.
3. Crie um segundo menu com as categorias (na coluna da esquerda, abra **Categorias**, marque as que quiser e clique em **Adicionar ao menu**). Marque o local **Faixa de categorias**.
   - Se você não criar esse menu, o tema mostra sozinho as categorias com mais artigos.
4. (Opcional) Crie um menu para o rodapé (Sobre, Contato, Política de Privacidade…) e marque **Links do rodapé**.

### 2. Logo e cores
1. Vá em **Aparência → Personalizar → Identidade do site** e envie o logo. O ideal é a versão **branca** ou com fundo transparente, porque o cabeçalho é colorido.
2. Em **Personalizar → Tema Eletroproj → Cores**, escolha a **cor da marca** (cabeçalho, botões, destaques) e a **cor dos links**.
   - Escolha uma cor escura o bastante para o texto branco ficar legível (contraste mínimo de 4,5:1).

### 3. Newsletter
Em **Personalizar → Tema Eletroproj → Newsletter**:
- **Com plugin** (MailPoet, Mailchimp for WP etc.): cole o shortcode do formulário em **Shortcode do formulário**.
- **Sem plugin:** cole a URL de envio (action) do formulário do seu provedor de e-mail e o nome do campo de e-mail (normalmente `email` ou `EMAIL`).
- Enquanto nada estiver configurado, só os administradores veem um aviso tracejado dentro da caixa.

### 4. Página inicial
Em **Personalizar → Tema Eletroproj → Página inicial** você liga e desliga cada seção.
- **Guias essenciais:** crie a categoria **Guias** (slug `guias`) e coloque nela os artigos de referência. Os 3 mais recentes aparecem nos cards coloridos. Você pode usar outro slug no campo **Slug da categoria dos guias**.
- **Cards de serviços:** edite título, texto, link e ícone em **Tema Eletroproj → Cards de serviços**.

### 5. Artigos
- **Resumo rápido:** no editor do post, abra a barra lateral **Post → Resumo** (Excerpt) e escreva 1 ou 2 frases. Se o resumo ficar vazio, a caixa não aparece.
- **Imagem inclinada nos cards:** é a **Imagem destacada** do post. Sem ela, o tema usa o avatar do autor (configurado no Gravatar).
- **Bio do autor:** **Usuários → Perfil → Informações biográficas**.
- **Sumário:** aparece sozinho quando o post tem 3 ou mais subtítulos H2. Desligue em **Tema Eletroproj → Página do artigo**.
- **Caixas e lista "Leitura complementar":** selecione um bloco Parágrafo, Grupo ou Lista e escolha o estilo na barra lateral, em **Estilos**.
- **Calculadoras/ferramentas:** use um bloco **HTML personalizado** com o iframe ou o shortcode da ferramenta. Ele ocupa a largura do texto.

### 6. Landing pages
Ao editar uma página, na barra lateral **Página → Modelo**, escolha **Largura total (landing page)**. A página fica sem título e sem breadcrumbs, só com os seus blocos.

## Performance
- Use um plugin de cache (LiteSpeed Cache, por exemplo) e envie as imagens em WebP.
- As fontes já vêm em woff2 (subset latino, que cobre os acentos do português) e as duas principais são pré-carregadas.
- O CSS dos blocos é carregado só para os blocos usados em cada página.

## Estrutura de arquivos
```
eletroproj-editorial/
├── style.css            (cabeçalho do tema)
├── theme.json           (cores, fontes, tamanhos)
├── functions.php        (carrega os arquivos de /inc)
├── inc/                 (setup, assets, performance, personalizador, schema, sumário, tempo de leitura, estilos de bloco)
├── template-parts/      (cards, newsletter, autor, guias, serviços, listagem)
├── page-templates/      (largura total)
├── assets/css, js, fonts
└── header.php, footer.php, front-page.php, single.php, page.php, archive.php, search.php, 404.php, index.php, comments.php, searchform.php
```

## Fontes e licenças
- **Literata** (texto), **Bricolage Grotesque** (títulos) e **JetBrains Mono** (código): SIL Open Font License, livres para uso comercial. As licenças estão em `assets/fonts/`.
- Código do tema: GPL v2 ou posterior.
