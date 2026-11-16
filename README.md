# eletroproj-theme

Tema WordPress do **eletroproj.com.br**, criado do zero a partir do layout no Figma, com foco máximo em performance (PageSpeed Insights).

## Fluxo
- `dev`: desenvolvimento.
- `main`: produção. Cada push na `main` envia o tema para o servidor via FTP (GitHub Actions, `.github/workflows/deploy.yml`), apenas os arquivos alterados.

## Secrets necessários (Settings › Secrets and variables › Actions)
| Nome | Exemplo |
|---|---|
| `FTP_SERVER` | `ftp.eletroproj.com.br` |
| `FTP_USERNAME` | usuário da conta FTP dedicada ao tema |
| `FTP_PASSWORD` | senha dessa conta |
| `FTP_SERVER_DIR` | `./` (se a conta FTP já aponta para a pasta do tema) |

---

## Segundo tema: Eletroproj Editorial (pasta `eletroproj-editorial/`)

Tema editorial independente (layout de revista técnica, inspirado na estrutura da Smashing Magazine). Fica na pasta `eletroproj-editorial/` e tem **deploy próprio** (`.github/workflows/deploy-editorial.yml`):

- Um push na `main` que altera `eletroproj-editorial/` envia **só essa pasta** para a pasta dela no servidor.
- O deploy do tema principal (`deploy.yml`) ignora essa pasta, então um tema nunca sobrescreve o outro.
- Enquanto o secret `EDITORIAL_FTP_SERVER_DIR` não existir, o deploy do Editorial fica desligado (só mostra um aviso).

### Secrets do Editorial (Settings › Secrets and variables › Actions)
| Nome | Obrigatório | Exemplo |
|---|---|---|
| `EDITORIAL_FTP_SERVER_DIR` | sim | `/public_html/wp-content/themes/eletroproj-editorial/` (sempre terminando com `/`) |
| `EDITORIAL_FTP_USERNAME` | se a conta FTP do tema principal só enxerga a pasta dele | usuário FTP com acesso a `wp-content/themes/` |
| `EDITORIAL_FTP_PASSWORD` | idem | senha dessa conta |
| `EDITORIAL_FTP_SERVER` | não (usa `FTP_SERVER`) | `ftp.eletroproj.com.br` |

Crie a pasta `wp-content/themes/eletroproj-editorial/` no servidor antes do primeiro deploy (pelo Gerenciador de Arquivos da hospedagem).

### Testar no LocalWP (Windows)
1. Clone o repositório (GitHub Desktop: **File › Clone repository** → `eletroproj-theme`), por exemplo em `C:\GitHub\eletroproj-theme`.
2. No LocalWP, clique no site → **Go to site folder**, e abra `app\public\wp-content\themes`.
3. Abra o **Prompt de Comando** e crie um atalho de pasta (junction) apontando para o repositório:
   ```
   mklink /J "C:\Users\SEU_USUARIO\Local Sites\SEU_SITE\app\public\wp-content\themes\eletroproj-editorial" "C:\GitHub\eletroproj-theme\eletroproj-editorial"
   ```
4. No WordPress local: **Aparência › Temas** → ative **Eletroproj Editorial**.

Assim, o que você editar no repositório aparece na hora no site local, e o mesmo código vai para o servidor pelo push na `main`. Configuração do tema: veja `eletroproj-editorial/README.md`.
