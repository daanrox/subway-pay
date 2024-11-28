
# Subway Pay 

Site para iGaming para coletar moedas através do jogo Subway Surfers, em caso de grande quantidade de solicitações de Saque, podemos utilizar a [API Cash Out](https://github.com/daanrox/Pix-CashOut) para resgate do valor através de transferencia PIX imediata.

Para um melhor desempenho, e segurança utilize a hospedagem na Hostinger através deste link: [https://hostinger.com.br](https://hostinger.com.br?REFERRALCODE=1DANIEL1306)

ENTRE EM CONTATO PARA INTEGRAÇÃO COM OUTRAS GATEWAYS DE PAGAMENTO

Aplicação 100% funcional, caso tenha interesse em adquirir outros modelos como Candy Crush, Dino, Angry Birds, Mario ou Cassinos, entre em contato +5531992812273

# Doação

Para fazer uma doação em agradecimento pelo projeto! Acesse: [https://roxcheckout.shop](https://roxcheckout.shop)





![Subway Pay](front_example2.jpg)

### Deploy
Aplicação em produção [https://subwayaposta.shop](https://subwayaposta.shop)

### Docker

```bash
# Executar a stack
docker compose up --build

# Instalar o banco de dados (precisa da stack em execução, o comando pesquisa o container que contenha o nome "subway-pay-mariadb")
source docker.env ; cat sql_subway.sql | docker exec -i $(docker ps | grep subway-pay-mariadb | cut -d' ' -f 1) mariadb --password=$MARIADB_ROOT_PASSWORD $MYSQL_DATABASE
```

### Outros jogos

- Modelo com Jogo Dino : [https://pay-subwaysurf.store](https://pay-subwaysurf.store)
- Modelo com Jogo Candy Crush: [https://candycrushdasorte.com](https://candycrushdasorte.com)
- Modelo com Jogo Snake Bet: [https://cobra.roxgames.online/](https://cobra.roxgames.online/)
- Estão disponíveis também os jogos do Mario, Angry Birds, Flappy Bird, e Fruit Ninja

## Tecnologias Utilizadas

O site foi desenvolvido utilizando as seguintes tecnologias:

<div>
  <img align="center" src="https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white"/>
  <img align="center" src="https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white"/>
  <img align="center" src="https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black"/>
  <img align="center" src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white"/>
  <img align="center" src="https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white"/>
</div>

Não foi utilizado nenhum framework ou biblioteca para o desenvolvimento deste projeto.

## Contato
Se tiver dúvidas ou precisar de mais informações, sinta-se à vontade para entrar em contato:
- Email : [contato@daanrox.com](mailto:contato@daanrox.com)
- LinkedIn: [https://www.linkedin.com/in/daanrox/](Daanrox)

--- 

Projeto desenvolvido para um cliente especialista em iGaming
