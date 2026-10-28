# Starter

## Gerar Certificados SSL para Desenvolvimento

Navegue até a pasta `./server/ssl` e execute o comando abaixo para gerar os certificados:

```bash
openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout server.key -out server.crt -subj "/CN=localhost"
```