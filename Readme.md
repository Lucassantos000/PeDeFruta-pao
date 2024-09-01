# Pé de Fruta-Pão (PDF)
Sistema para comprimir, mesclar ou separar arquivos pdf's

## Tecnologias usadas

### Docker 
### Php8.3 
### Mysql


## Para iniciar a aplicação

1. Inicie o contaier buildando a imagem
```bash
    docker compose up --build
```

2. Envie o .env para dentro do container na pasta /var/www
```bash
    docker cp .env php:/var/www/
```



