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
