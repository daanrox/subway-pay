<?php
include '../conectarbanco.php';

$conn = new mysqli('localhost', $config['db_user'], $config['db_pass'], $config['db_name']);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$sql = "SELECT nome_unico, nome_um, nome_dois FROM app";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    $row = $result->fetch_assoc();


    $nomeUnico = $row['nome_unico'];
    $nomeUm = $row['nome_um'];
    $nomeDois = $row['nome_dois'];

} else {
    return false;
}

$conn->close();
?>

<!DOCTYPE html>

<html lang="pt-br" class="w-mod-js w-mod-ix wf-spacemono-n4-active wf-spacemono-n7-active wf-active"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><style>.wf-force-outline-none[tabindex="-1"]:focus{outline:none;}</style>
<meta charset="pt-br">
<title><?php echo $nomeUnico; ?></title>

<meta property="og:image" content="../img/logo.png">

<meta content="<?php echo $nomeUnico; ?>" property="og:title">
<meta name="twitter:site" content="@daanrox">
<meta name="twitter:image" content="../img/logo.png">
<meta property="og:type" content="website">

<meta content="width=device-width, initial-scale=1" name="viewport">
<link href="../arquivos/page.css" rel="stylesheet" type="text/css">
<link href="../arquivos/withdrawtable.css" rel="stylesheet" type="text/css">
<script src="../arquivos/webfont.js" type="text/javascript"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.6/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.6/js/jquery.dataTables.js"></script>

<script type="text/javascript">
                WebFont.load({
                    google: {
                        families: ["Space Mono:regular,700"]
                    }
                });
            </script>



<script type="text/javascript">
                ! function (o, c) {
                    var n = c.documentElement,
                        t = " w-mod-";
                    n.className += t + "js", ("ontouchstart" in o || o.DocumentTouch && c instanceof DocumentTouch) && (n
                        .className += t + "touch")
                }(window, document);
            </script>
<link rel="icon" type="image/png" sizes="32x32" href="../img/logo.png">
<link rel="icon" type="image/png" sizes="16x16" href="../img/logo.png">



<link rel="icon" type="image/x-icon" href="../img/logo.png">

<link rel="stylesheet" href="arquivos/css" media="all">
</head>
<body>
<div>
<div data-collapse="small" data-animation="default" data-duration="400" role="banner" class="navbar w-nav">
<div class="container w-container">
<a href="../" aria-current="page" class="brand w-nav-brand" aria-label="home">
<img src="../arquivos/l2.png" loading="lazy" height="28" alt="" class="image-6">
<div class="nav-link logo"><?php echo $nomeUnico; ?></div>
</a>
<nav role="navigation" class="nav-menu w-nav-menu">
<a href="../" class="nav-link w-nav-link" style="max-width: 940px;">Jogar</a>
<a href="../login/" class="nav-link w-nav-link w--current" style="max-width: 940px;">Login</a>

<a href="../cadastrar/" class="button nav w-button">Cadastrar</a>
</nav>


<script disable-devtool-auto src='https://cdn.jsdelivr.net/npm/disable-devtool@latest'></script>




<style>
  .nav-bar {
      display: none;
      background-color: #333; /* Cor de fundo do menu */
      padding: 20px; /* Espaçamento interno do menu */
      width: 90%; /* Largura total do menu */
    
      position: fixed; /* Fixa o menu na parte superior */
      top: 0;
      left: 0;
      z-index: 1000; /* Garante que o menu está acima de outros elementos */
      margin-top: 18%;
  }

  .nav-bar a {
      color: white; /* Cor dos links no menu */
      text-decoration: none;
      padding: 10px; /* Espaçamento interno dos itens do menu */
      display: block;
      margin-bottom: 10px; /* Espaçamento entre os itens do menu */
  }

  .nav-bar a.login {
      color: white; /* Cor do texto para o botão Login */
  }
  
  .button.w-button {
  text-align: center;
}

</style>

<script>
  document.addEventListener('DOMContentLoaded', function () {
      var menuButton = document.querySelector('.menu-button');
      var navBar = document.querySelector('.nav-bar');

      menuButton.addEventListener('click', function () {
          // Toggle the visibility of the navigation bar
          if (navBar.style.display === 'block') {
              navBar.style.display = 'none';
          } else {
              navBar.style.display = 'block';
          }
      });
  });
</script>



<style>
  .menu-button2{
      border-radius: 15px;
      background-color: #000;
  }
</style>




<div class="w-nav-button" style="-webkit-user-select: text;" aria-label="menu" role="button" tabindex="0" aria-controls="w-nav-overlay-0" aria-haspopup="menu" aria-expanded="false">
<div class="" style="-webkit-user-select: text;">


<a href="../deposito/" class="menu-button2 w-nav-dep nav w-button">DEPOSITAR</a>
</div>
</div>
<div class="menu-button w-nav-button" style="-webkit-user-select: text;" aria-label="menu" role="button" tabindex="0" aria-controls="w-nav-overlay-0" aria-haspopup="menu" aria-expanded="false">
<div class="icon w-icon-nav-menu"></div>
</div>
</div>
<div class="w-nav-overlay" data-wf-ignore="" id="w-nav-overlay-0"></div></div>
<div class="nav-bar">
<a href="../playdemo/" class="button w-button">
<div>Jogar</div>
</a>


<a href="../login/" class="button w-button">
<div >Login</div>
</a><a href="../cadastrar/" class="button w-button">
<div >Sair</div>
</a>
<a href="../cadastrar/" class="button w-button">Cadastrar</a>
</div>





<section id="hero" class="hero-section dark wf-section">
        <div class="minting-container w-container">
          
          <h2>1. Introdução</h2>
          <p>
            Estes termos e condições e os documentos referidos abaixo (os
            "Termos") aplicam-se ao uso da  <?php echo $nomeUnico; ?> e seus serviços.
          </p>
          <p>
            Você deve revisar cuidadosamente estes Termos, pois eles contêm
            informações importantes sobre seus direitos e obrigações relativas
            ao uso do site e formam um acordo legal vinculativo entre você -
            nosso cliente (o "Cliente") e nós. Ao usar este Site e/ou acessar a
             <?php echo $nomeUnico; ?>, você, seja você um convidado ou um usuário registrado com
            uma conta (“Conta”), concorda em ficar vinculado por estes Termos,
            juntamente com qualquer alterações, que podem ser publicadas de
            tempos em tempos. Se não aceitar estes Termos, deverá abster-se de
            acessar e usar o Site.
          </p>
          <h2>2. Termos gerais</h2>
          <p>
            Reservamo-nos o direito de revisar e alterar os termos de serviço
            (incluindo quaisquer documentos referidos e vinculados a abaixo) a
            qualquer momento. Você deve visitar esta página periodicamente para
            revisar os Termos e Condições. Alterações será vinculativo e entrará
            em vigor imediatamente após a publicação neste Site. Se você se
            opuser a qualquer alterações, você deve parar imediatamente de usar
            a  <?php echo $nomeUnico; ?> e pedir encerramento na conta. Seu uso continuado do
            Site após tais publicação indicará sua concordância em ficar
            vinculado aos Termos conforme alterados..
          </p>
          <h2>3. Suas obrigações</h2>
          <p>
            Você reconhece que em todos os momentos que acessar o site e usar a
             <?php echo $nomeUnico; ?> por qualquer motivo:
          </p>
          <p>
            3.1. Não fraudar em nenhum momento nosso sistema de afiliados,
            aposta ou depósito. Sujeito a análise com quitação de débitos por
            ganhos impróprios ou suspensão da conta.
          </p>
          <p>
            3.2. Você ser maior de idade. Você não deve acessar o site ou
            apostar na  <?php echo $nomeUnico; ?> se você não tiver 18 anos completos, sujeito a
            retenção do dinheiro até completar 18 anos e não alteramos dados
            para terceiros maiores de idade.
          </p>
          <p>3.3. Já foi banido por qualquer motivo anteriormente.</p>
          <p>
            3.4. Você não pode usar uma VPN, proxy ou serviços ou dispositivos
            semelhantes que mascarem ou manipulem a identificação da sua real.
          </p>
          <p>
            3.5. Você realizar os depósitos no site através da sua conta
            cadastrada no site.
          </p>
          <p>
            3.6. Você deve fazer todos os pagamentos para nós de boa fé e não
            tentar reverter um pagamento feito ou tomar qualquer ação que fará
            com que tal pagamento seja revertido por um terceiro.
          </p>
          <p>
            3.7. Ao fazer apostas, você pode perder parte ou todo o seu dinheiro
            depositado na  <?php echo $nomeUnico; ?> de acordo com estes Termos e você será
            totalmente responsável por essa perda.
          </p>
          <p>
            3.8. Você não está agindo em nome de outra parte ou para fins
            comerciais, mas apenas em seu próprio nome em nome de um particular
            a título pessoal.
          </p>
          <p>
            3.9. Você não deve tentar manipular qualquer mercado ou elemento
            dentro da  <?php echo $nomeUnico; ?> de má fé nem de uma maneira que afete
            adversamente a integridade da  <?php echo $nomeUnico; ?>.
          </p>
          <p>
            3.10. Você deve geralmente agir de boa fé em relação a nós da
             <?php echo $nomeUnico; ?> em todos os momentos e para todas as apostas realizadas na
             <?php echo $nomeUnico; ?>.
          </p>
          <p>
            3.11. Você, ou, se aplicável, seus funcionários, empregadores,
            agentes ou familiares, não estão registrados como um Afiliado em
            nosso programa de Afiliados.
          </p>
          <h2>4. Uso restrito</h2>
          <p>4.1. Você não deve usar a  <?php echo $nomeUnico; ?> se:</p>
          <p>
            4.1.1. Se você for menor de 18 anos (ou menor de idade, conforme
            estipulado nas leis do jurisdição aplicável a você) ou se você não
            for legalmente capaz de celebrar um acordo legal vinculativo com nós
            ou você agindo como um agente para, ou de outra forma em nome, de
            uma pessoa com menos de 18 anos (ou abaixo da idade de maioria
            conforme estipulado nas leis da jurisdição aplicável a você)
          </p>
          <p>
            4.1.2. Se você já tem um cadastro ativo, apenas autorizamos 1
            cadastro por CPF. Se realizar mais um cadastro no seu nome ou de
            terceiros e você pagar na conta desse terceiro.
          </p>
          <p>
            4.1.3. Se você for residente de um dos seguintes países, ou acessar
            o Site de um dos seguintes países:
          </p>
          <p>Estados unidos e territórios dos estados unidos,</p>
          <p>France and its territories,</p>
          <p>
            Holanda e seus territórios e países que formam o Reino dos Países
            Baixos, incluindo Bonaire, Sint Eustatius, Saba, Aruba, Curaçao.
          </p>
          <p>Australia e seus territórios,</p>
          <p>Reino Unido and Norte da Irlanda,</p>
          <p>Espanha</p>
          <p>Cyprus.</p>
          <p>
            4.1.4. Coletar nomes, endereços de e-mail e/ou outras informações de
            outros Clientes por qualquer meio (por por exemplo, enviando spam);
          </p>
          <p>
            4.1.5. interromper ou afetar ou influenciar indevidamente as
            atividades de outros player ou parceiro ou a operação da  <?php echo $nomeUnico; ?>
            em geral;
          </p>
          <p>
            4.1.6. para promover anúncios comerciais não solicitados, links
            afiliados e outras formas de solicitação que pode ser removido da
             <?php echo $nomeUnico; ?> sem aviso prévio, em casos de fraudes;
          </p>
          <p>
            4.1.7. qualquer forma que, em análise concluída seja constatada
            tentativa de: (i) enganar a  <?php echo $nomeUnico; ?> ou outro cliente usando o
             <?php echo $nomeUnico; ?> como publicidade enganosa; ou (ii) conspirar com qualquer
            outro player ou afiliado usando a SurfCashem para obter uma vantagem
            desonesta;
          </p>
          <p>
            4.1.8. fraudar o sistema de apostas ou violar qualquer um dos nossos
            Direitos de Propriedade Intelectual; ou
          </p>
          <p>4.1.9. por qualquer atividade ilícita.</p>
          <p>
            4.2. Você não pode vender ou transferir sua conta para terceiros,
            nem pode adquirir uma conta de jogador de um terceiro.
          </p>
          <p>
            4.3. Você não pode, de forma alguma, transferir saldo entre contas
            de jogadores.
          </p>
          <p>
            4.4. Podemos encerrar imediatamente sua conta mediante notificação
            por e-mail ou Whatsapp a você se você usar a  <?php echo $nomeUnico; ?> para fins não
            autorizados. Também podemos tomar medidas legais contra você por
            fazê-lo em determinadas circunstâncias.
          </p>
          <p>
            4.5. Funcionários da empresa, seus licenciados, subsidiárias,
            publicidade, ou outras agências, parceiros de mídia, contratados e
            membros das famílias imediatas de cada um NÃO estão permitidas a
            usar a  <?php echo $nomeUnico; ?> com dinheiro real sem o consentimento prévio do
            gerente de marketing. Deve tal atividade seja descoberta, a(s)
            conta(s) será(ão) encerrada(s) imediatamente e todos os bônus/ganhos
            serão perdido.
          </p>
          <h2>5. Registro</h2>
          <p>Você concorda que em todos os momentos que usar a  <?php echo $nomeUnico; ?>:</p>
          <p>
            5.1. Reservamo-nos o direito de recusar cadastros e/ou depósitos de
            qualquer pessoa que se enquadre em nossa politica privada.
            Reservamos que cadastros ou depósitos reembolsados, a  <?php echo $nomeUnico; ?> não
            tem qualquer obrigação de comunicar um motivo específico.
          </p>
          <p>
            5.2. Antes de cadastrar, depositar ou sacar, você deve estar ciente
            e ler e aceitar estes Termos. Em caso de suspeitas de múltiplas
            contas, depósito por terceiros ou qualquer outra suspeita você
            passará por uma análise prévia e caso seja necessário será
            necessário informar um documento de identidade e fornecer uma prova
            válida de identificação e qualquer outro documento que julgar
            necessário. Isso inclui, mas não se limita a, um ID com foto (cópia
            do passaporte, carteira de motorista ou carteira de identidade
            nacional) e uma conta de luz recente listando seu nome e endereço
            como comprovante de residência. Reservamo-nos o direito de suspender
            as apostas ou restringir as opções da conta em qualquer Conta até
            que as informações necessárias sejam recebidas. Este procedimento é
            feito de acordo com o regulamento de jogo aplicável e os requisitos
            legais de combate à lavagem de dinheiro. Além disso, você precisará
            para financiar sua conta de serviço usando os métodos de pagamento
            definidos na seção de pagamento do nosso site.
          </p>
          <p>
            5.3. Você deve fornecer informações de contato precisas, incluindo
            um endereço de e-mail válido e atualize essas informações no futuro
            para mantê-las precisas. É sua responsabilidade que mantenha seus
            dados de contato atualizados em sua conta. Não fazer isso pode
            resultar em você não receber notificações e informações importantes
            relacionadas à nossa conta, incluindo alterações que fazemos a estes
            Termos. Identificamos e nos comunicamos com nossos clientes por meio
            de seu endereço de e-mail registrado. É a responsabilidade do
            Cliente para manter uma conta de e-mail ativa e exclusiva, para nos
            fornecer o endereço de e-mail correto e avisar a Empresa sobre
            quaisquer alterações em seu endereço de e-mail.
          </p>
          <p>
            5.4. Você só tem direito para cadastrar uma conta para a  <?php echo $nomeUnico; ?>,
            regra vale para players e afiliados. As contas estão sujeitas a
            encerramento se for constatado que você tem várias contas
            registradas conosco. Isso inclui o uso de representantes, parentes,
            associados, afiliados, partes relacionadas, pessoas vinculadas e/ou
            terceiros operando em seu nome.
          </p>
          <p>
            5.5. Para garantir a segurança de ambos, em casos de suspeita de
            depósito fraudulentos ou realizados por terceiros, precisaremos
            confirmar sua identidade, podemos solicitar que você forneça conosco
            com informações pessoais adicionais, como seu nome e sobrenome, ou
            use qualquer informação de terceiros fornecedores que consideramos
            necessários. Caso alguma informação pessoal adicional seja obtida
            através de terceiros fontes, iremos informá-lo sobre os dados
            obtidos.
          </p>
          <p>
            5.6. Você deve manter sua senha para login na  <?php echo $nomeUnico; ?> de modo
            confidencial. Desde que as informações da conta com algumm problema
            for fornecida corretamente, temos o direito de assumir que as
            apostas, depósitos e saques foram foi feito por você. Aconselhamos
            que você altere sua senha regularmente e nunca a revele a qualquer
            terceiro. É sua responsabilidade proteger sua senha e qualquer falha
            em fazê-lo será por sua conta único risco e despesa. Você pode sair
            do site ao final de cada sessão. Se você acredita em algum de seus
            As informações da conta estão sendo usadas indevidamente por
            terceiros, ou sua conta foi invadida ou seu senha foi descoberta por
            terceiros, você deve nos notificar imediatamente. Você deve nos
            notificar se o seu O endereço de e-mail registrado foi invadido,
            podemos, no entanto, exigir que você forneça informações adicionais
            informações/documentação para que possamos verificar sua identidade.
            Iremos suspender imediatamente a sua conta uma vez que estamos
            cientes de tal incidente. Enquanto isso, você é responsável por
            todas as atividades em sua conta incluindo acesso de terceiros,
            independentemente de o acesso deles ter sido autorizado por você.
          </p>
          <p>
            5.7. Você não deve realizar reclamações ou iniciar difamações contra
            a empresa antes de procurar o suporte ao-vivo ou o time de
            marketing, Se sua conta foi suspensa, saldo corrigido ou está em
            análise. Os prejuízos serão atribuidos a você quem realizou o
            pagamento via PIX e por necessidade do Banco Central, apesar de você
            colocar algum CPF falso dentro do site, quando você faz o pagamento
            temos todos os dados necessários para realizar a cobrança dos
            prejuízos atribuidos a empresa..
          </p>
          <p>
            5.8. Apenas recebemos depósitos via PIX e os saques são apenas via
            PIX, ambos intermediatos por uma institução de pagamento
            terceirizada.
          </p>
          <p>
            5.9. Reservamos o direito de suspender contas e/ou debitar os saques
            e saldo disponivel na conta falsa de afiliados que estão fraudando o
            sistema para obter ganho acima de ganho.
          </p>
          <p>
            5.10. Após o seu cadastro e a realização de depósito, podemos entrar
            em contato para solicitar mais informações e/ou documentação sua
            para que possamos cumprir nossas obrigações regulatórias e legais.
          </p>
          <h2>6. Sobre sua conta</h2>
          <p>
            6.1. Você tem o direito de pedir o reembolso se não realizar nenhuma
            aposta após o depósito. Contate o suporte ao-vivo no canto inferior
            direito na tela do jogo.
          </p>
          <p>
            6.2. Contas em duplicidade, em nome de terceiros, depósitos
            realizados por terceiros e fraudes estão sujeitas a banimento sem
            reembolso.
          </p>
          <p>
            6.3. Podemos fechar ou suspender uma Conta se você não estiver ou
            acreditarmos razoavelmente que você não está cumprindo com estes
            Termos, ou para garantir a integridade ou justiça do Serviço ou se
            tivermos outras motivos para tal. Nem sempre podemos dar-lhe um
            aviso prévio. Se fecharmos ou suspendermos sua conta devido a você
            não cumprir estes Termos, podemos cancelar e/ou anular qualquer uma
            de suas apostas e reter qualquer dinheiro na sua conta (incluindo o
            depósito).
          </p>
          <p>
            6.4. Reservamo-nos o direito de encerrar ou suspender qualquer conta
            sem aviso prévio e devolver todos o saldo. As obrigações contratuais
            já vencidas serão, no entanto, honradas.
          </p>
          <p>
            6.5. Reservamo-nos o direito de recusar, restringir, cancelar ou
            limitar qualquer aposta a qualquer momento por qualquer motivo,
            incluindo qualquer aposta considerada fraudulenta para contornar
            nossos limites de apostas, como criação de novas contas e a
            utilização de terceiros para essas novas contas, estará sujeita aos
            nossos regulamentos do sistema.
          </p>
          <p>
            6.6. Se algum valor for creditado erroneamente em sua conta, ele
            permanecerá nossa propriedade e quando tomarmos conhecimento de
            qualquer erro, iremos notificá-lo e o valor será retirado de sua
            conta.
          </p>
          <p>
            6.7. Se, por qualquer motivo, você realizar saque em nome de
            terceiros ou com fraude, você ficará em dívida conosco pelo valor
            sacado.
          </p>
          <p>
            6.8. Você deve nos informar assim que tomar conhecimento de
            quaisquer erros em relação à sua conta.
          </p>
          <p>
            6.9. Lembre-se de que as apostas são puramente para entretenimento e
            prazer e você deve parar assim que deixa de ser divertido. Qualquer
            perda de dinheiro é de sua responsabilidade.
          </p>
          <p>
            6.10. Você não pode transferir, vender ou penhorar sua conta para
            outra pessoa. Esta proibição inclui a transferência de quaisquer
            ativos de valor de qualquer tipo, incluindo, mas não limitado à
            propriedade de contas, ganhos, depósitos, apostas, direitos e/ou
            reclamações em relação a esses ativos, legais, comerciais ou outros.
            o A proibição das referidas transferências também inclui, mas não se
            limita à oneração, penhora, cessão, usufruto, negociação,
            corretagem, hipoteca e/ou doação em cooperação com um fiduciário ou
            qualquer outro terceiro, empresa, pessoa física ou jurídica,
            fundação e/ou associação de qualquer forma ou forma
          </p>
          <p>
            6.11. Caso deseje encerrar sua conta conosco, contate nosso suporte
            ao-vivo no site.
          </p>
          <p>
            6.12. Ao fazer um depósito, o player receberá o valor do seu
            depósito como saldo real (dinheiro). Se você ativou um bônus durante
            o depósito, o dinheiro de bônus será adicionado ao seu saldo bônus.
            O saldo em dinheiro real (dinheiro) só poderá ser solicitado quando
            atingir o limite de apostas, no qual será igual a 2 vezes o valor do
            depósito antes que você possa sacá-lo.
          </p>
          <h2>7. Contas inativas</h2>
          <p>
            7.1. Contas inativas a mais de 1 mês terão R$10 descontados, caso
            ocorra o mesmo durante 3 meses, a conta será excluida.
          </p>
          <h2>8. Depósitos</h2>
          <p>
            8.1. Todos os depósitos devem ser feitos a partir de uma conta
            bancária com PIX registrado em seu próprio nome, e quaisquer
            depósitos feitos por terceiros será necessária a comprovação do
            depositante e do apostador, conforme as cláusulas abaixo
          </p>
          <p>
            8.2. Taxas e encargos podem ser aplicados a depósitos e saques de
            clientes, que podem ser encontrados no Site. Dentro na maioria dos
            casos, absorvemos taxas de transação para depósitos em sua conta
             <?php echo $nomeUnico; ?>. Você é responsável por seus próprios encargos bancários
            que você pode incorrer devido ao depósito de fundos conosco.
          </p>
          <p>
            8.3. A empresa não é uma instituição financeira e usa processadores
            de pagamento eletrônico de terceiros para processar depósitos em
            pix; eles não são processados ​​diretamente por nós. Se você
            depositar qualquer saldo na  <?php echo $nomeUnico; ?>, o prazo máximo de adicionar
            na sua conta é de 2 minutos. Se passar de 5 minutos e isso não se
            resolver, chame o suporte ao-vivo com o comprovante do pagamento.
          </p>
          <p>
            8.6. Os depósitos provenientes de atividades criminosas e/ou ilegais
            e/ou não autorizadas não devem ser depositados na  <?php echo $nomeUnico; ?>, em caso
            de suspeita o reembolso e banimento é imediato. Acrescentamos que
            será realizado um relatório e entregue para a polícia local sobre o
            ocorrido.
          </p>
          <h2>9. Saque de ganhos</h2>
          <p>
            9.1. Você pode retirar todo o saldo não utilizados e liberados em
            sua conta de jogador enviando um solicitação de retirada de acordo
            com nossas condições de retirada. O valor mínimo de saque por
            transação é de R$150,00 (o valor da barra de saque mínimo é rotativa
            conforme for realizado saque e pago). Com o prazo de até 7 dias
            úteis para pagamento.
          </p>
          <p>
            9.2. Não efetuaremos o reembolso em caso de qualquer aposta após os
            depósitos.
          </p>
          <p>
            9.3. Reservamo-nos o direito de solicitar identificação com foto,
            confirmação de endereço ou realizar verificações adicionais
            procedimentos (solicitar sua selfie, marcar uma chamada de
            verificação etc.) para fins de verificação de identidade antes de
            conceder quaisquer saques de sua conta. Também nos reservamos o
            direito de realizar a identidade verificação a qualquer momento
            enquanto você estiver com sua conta ativa..
          </p>
          <p>
            9.4. Todos os saques devem ser feitos via PIX. Clientes com valores
            mais altos (R$1.000) estará sujeito a adicionais verificações de
            segurança e prevenção a fraude.
          </p>
          <p>
            9.5. Se você deseja sacar o saldo disponível, mas sua conta está
            inacessível, inativa, bloqueada ou fechada, entre em contato com
            nosso Departamento de Atendimento ao Cliente.
          </p>
          <p>
            9.7. Observe que não podemos garantir pagamento de saques ou
            reembolsos no caso de você violar a política de uso restrito
            indicada nas Cláusulas 3.3 e 4.
          </p>
          <h2>10. Depósitos, pagamentos de ganhos e transações em geral</h2>
          <p>
            10.1. Você é totalmente responsável por pagar todos os valores
            devidos a nós em caso de ganhos inválidos e saldo em conta que não é
            suficiente para o pagamento. Você deve fazer todos os pagamentos
            para nós em boa fé e não tentar reverter um pagamento feito ou tomar
            qualquer ação que fará com que tal pagamento seja revertida por um
            terceiro para evitar uma responsabilidade legitimamente incorrida.
            Você nos reembolsará por qualquer estornos, difamação, recusa ou
            estorno de pagamento que você fizer e qualquer perda sofrida por nós
            como consequência disso. Reservamo-nos o direito de também impor uma
            taxa de administração de R$100, ou o equivalente em moeda por
            estorno, recusa ou estorno do pagamento que você faz..
          </p>
          <p>
            10.2. Reservamos o direito de usar processadores de pagamento
            eletrônico de terceiros e/ou bancos comerciais para processar
            pagamentos feitos por você e você concorda em ficar vinculado aos
            seus termos e condições, desde que sejam feitos ciente para você e
            esses termos não entram em conflito com estes Termos.
          </p>
          <p>
            10.3. Todas as transações feitas em nosso site podem ser verificadas
            para evitar lavagem de dinheiro ou financiamento do terrorismo
            atividade. Transações suspeitas serão relatadas à autoridade
            competente.
          </p>
          <p>
            10.4. Pagamentos efetuados por terceiros poderão entrar em análise
            manual em caso de saque, sendo solicitado documentos do depositante,
            endereço IP e dados pessoais para comprovar que realmente foi de boa
            fé. Caso contrário, a conta poderá ser suspensa.
          </p>
          <p>
            10.5. Saques são obrigatórios a retirada do valor do saldo atual
            quando se atinge a meta do valor de saque. A meta é estipulada em 8x
            o valor da soma dos depósitos na cnota.
          </p>
          <h2>11. Erros</h2>
          <p>
            11.1. Em caso de erro ou mau funcionamento do nosso sistema ou
            processos, todas as apostas serão anuladas. Você têm a obrigação de
            nos informar imediatamente assim que tomar conhecimento de qualquer
            erro com a  <?php echo $nomeUnico; ?>. No caso de erros de comunicação ou do sistema
            ou bugs ou vírus que ocorram em conexão com a  <?php echo $nomeUnico; ?> e/ou
            pagamentos feitos a você como resultado de um defeito ou erro no
             <?php echo $nomeUnico; ?>, não seremos responsáveis ​​perante você ou a terceiros
            por quaisquer custos, despesas, perdas ou reclamações diretas ou
            indiretas decorrentes ou resultantes de tais erros, e nos reservamos
            o direito de anular todos as apostas em questão e tomar qualquer
            outra ação para corrija esses erros.
          </p>
          <p>
            11.2. Fazemos todos os esforços para garantir que não cometemos
            erros ao entregar o resultado da aposta. No entanto, se como como
            resultado de erro humano ou problemas no sistema, uma aposta é
            aceita com o valor: claramente incorreto, dada a chance de de
            recorrer ao suporte que ocorreu no momento em que a aposta foi
            feita, nos reservamos o direito de cancelar ou anular essa aposta.
          </p>
          <p>
            11.3. Temos o direito de retirar saldo em conta ou cancelar saque de
            você qualquer valor pago em excesso e ajustar sua Conta para
            retificar qualquer erro. Um exemplo de tal erro pode ser quando o
            ganho da aposta está incorreto. Se houver fundos insuficientes em
            sua conta, podemos exigir que você nos pague o montante pendente
            relevante relacionado a quaisquer apostas ou apostas erradas. Assim,
            reservamo-nos o direito de cancelar, reduzir ou excluir quaisquer
            jogadas pendentes, e suspender a conta se colocadas com saldos
            ganhos do erro ou não.
          </p>
          <h2>12. Regras de jogo, reembolso e cancelamentos</h2>
          <p>
            12.1. O ganho em qualquer aposta será determinado imediatamente, e
            em casos de suspeita de fraude elas serão anuladas e seu saldo
            reduzido.
          </p>
          <p>
            12.2. Todos as apostas estão sujeitas a análise em até 72 horas,
            será creditado na conta, mas podemos reter o valor ganho através de
            fraude. Dentro de 72 horas após análise de possível fraude e caso
            confirmada, apenas redefiniremos/corrigiremos os resultados devido a
            erro, erro do sistema ou erros cometidos pela fonte de resultados de
            referência.
          </p>
          <p>
            12.3. Reservamos o direito de reter o saldo e banir em casos de
            fraude envolvendo múltiplas contas com o mesmo dono, múltiplas
            contas onde o depositante pagador não é o mesmo registrado no site,
            abuso de bugs e qualquer fraude contra nosso sistema.
          </p>
          <h2>13. Comunicação com a equipe de suporte</h2>
          <p>
            13.1. Todas as comunicações e notificações a serem dadas por você
            sob estes Termos para nós serão enviadas usando um o chat-ao vivo
            disponível no canto inferior direito do site, ou via e-mail.
          </p>
          <p>
            13.2. Todas as comunicações e notificações a serem dadas sob estes
            Termos por nós a você devem, a menos que de outra forma
            especificados nestes Termos, sejam publicados no Site e/ou enviados
            para o endereço de e-mail registrado que espera em nosso sistema
            para o Cliente relevante. O método de tal comunicação será de nossa
            exclusiva e discrição exclusiva.
          </p>
          <p>
            13.3. Todas as comunicações e notificações a serem dadas sob estes
            Termos por você ou por nós devem ser feitas por escrito em português
            e deve ser fornecido de e para o endereço de e-mail registrado em
            sua conta.
          </p>
          <h2>14. Assuntos além do nosso controle</h2>
          <p>
            Não podemos ser responsabilizados por qualquer falha ou atraso na
            prestação do Serviço devido a um evento de Força Maior que poderia
            razoavelmente ser considerado fora de nosso controle, apesar de
            nossa execução de medidas preventivas como: um ato de Deus; disputa
            comercial ou trabalhista; corte de energia; ato, falha ou omissão de
            qualquer governo ou autoridade; obstrução ou falha de serviços de
            telecomunicações; ou qualquer outro atraso ou falha causada por
            terceiros, e não seremos responsáveis ​​por qualquer perda ou dano
            resultante que você possa Sofra. Nesse caso, reservamo-nos o direito
            de cancelar ou suspender o Serviço sem incorrer em responsabilidade.
          </p>
          <h2>15. Responsabilidade</h2>
          <p>
            15.1. NA MEDIDA DO PERMITIDO PELA LEI APLICÁVEL, NÃO O COMPENSAREMOS
            POR QUALQUER PERDA OU DANO (DIRETO OU INDIRETO) QUE VOCÊ PODE SOFRER
            SE NÃO CUMPRIR NOSSAS OBRIGAÇÕES SOB ESTES TERMOS A MENOS QUE
            QUEBRAMOS QUAISQUER DEVERES IMPOSTOS POR LEI (INCLUINDO SE CAUSAR
            MORTE OU FERIMENTOS PESSOAIS POR NOSSA NEGLIGÊNCIA) NESSE CASO NÃO
            SEREMOS RESPONSÁVEIS PERANTE VOCÊ SE ESSA FALHA FOR ATRIBUÍDA A: (I)
            SUA PRÓPRIA CULPA; (II) UM TERCEIRO DESCONECTADO COM O NOSSO
            DESEMPENHO DESTES TERMOS (PARA EXEMPLO DE PROBLEMAS DEVIDO A
            DESEMPENHO DA REDE DE COMUNICAÇÕES, CONGESTIONAMENTO E CONECTIVIDADE
            OU O DESEMPENHO DO SEU COMPUTADOR EQUIPAMENTO); OU (III) QUAISQUER
            OUTROS EVENTOS QUE NEM NÓS NEM NOSSOS FORNECEDORES PODERIAMOS TER
            PREVISTO OU PREVISTO MESMO QUE NÓS OU ELES TIVESSEM CUIDADOS
            RAZOÁVEIS. COMO ESTE SERVIÇO É APENAS PARA USO DO CONSUMIDOR, NÃO
            SEREMOS RESPONSÁVEIS PARA QUALQUER PERDA DE NEGÓCIOS DE QUALQUER
            TIPO.
          </p>
          <p>
            15.2. NO CASO DE SERMOS RESPONSÁVEIS POR QUALQUER EVENTO SOB ESTES
            TERMOS, NOSSA RESPONSABILIDADE TOTAL AGREGADA PARA VOCÊ SOB OU EM
            CONEXÃO COM ESTES TERMOS NÃO DEVERÁ EXCEDER (A) O VALOR DAS APOSTAS
            E OU APOSTAS QUE VOCÊ COLOCADO ATRAVÉS DA SUA CONTA EM RELAÇÃO À
            APOSTA/APOSTA RELEVANTE OU PRODUTO QUE DEU ORIENTAÇÃO À APOSTA
            RELEVANTE RESPONSABILIDADE, OU (B) R$50 NO TOTAL, O QUE FOR MENOR.
          </p>
          <p>
            15.3. RECOMENDAMOS FORTEMENTE QUE VOCÊ (I) TENHA CUIDADO PARA
            VERIFICAR A ADEQUAÇÃO E COMPATIBILIDADE DO ATENDIMENTO COM SEU
            PRÓPRIO EQUIPAMENTO DE COMPUTADOR ANTES DO USO; E (II) TOMAR AS
            PRECAUÇÕES RAZOÁVEIS PARA PROTEGER CONTRA PROGRAMAS OU DISPOSITIVOS
            PREJUDICIAIS, INCLUINDO A INSTALAÇÃO DE SOFTWARE ANTIVÍRUS.
          </p>
          <h2>16. Menores de idade jogando em nosso website</h2>
          <p>
            16.1. Se suspeitarmos que você tem menos de 18 anos (ou menores de
            idade, conforme estipulado nas leis da jurisdição aplicável a você)
            quando você fez qualquer aposta sua conta será suspensa (bloqueada)
            para evitar que você colocar quaisquer outras apostas ou fazer
            quaisquer saques de sua conta. Em seguida, investigaremos o assunto,
            incluindo se você está apostando como agente ou em nome de uma
            pessoa menor de 18 anos (ou abaixo da maioridade conforme estipulado
            nas leis da jurisdição aplicável a você). Se tendo descobriu que
            você: (a) está atualmente; (b) Tinha menos de 18 anos ou abaixo da
            maioridade que se aplica a você em o momento relevante; ou (c) Tenha
            apostado como agente para ou a pedido de uma pessoa menor de 18 anos
            ou abaixo da maioridade aplicável:
          </p>
          <p>
            Todos os ganhos atualmente ou devidos a serem creditados em sua
            conta serão retidos e você será banido até completar 18 anos.;
          </p>
          <p>
            Todos os ganhos obtidos com apostas através da  <?php echo $nomeUnico; ?> enquanto
            menor de idade devem ser pagos a nós sob demanda (se você não
            cumprir esta disposição, procuraremos recuperar todos os custos
            associados à recuperação de tais valores);
          </p>
          <p>
            Quaisquer valores depositados em sua conta que não sejam ganhos
            serão retidos até que você completar 18 anos a nosso exclusivo
            critério. Reservamo-nos o direito de deduzir as taxas de transação
            de pagamento do valor a ser devolvido, incluindo taxas de transação
            para depósitos em sua conta  <?php echo $nomeUnico; ?>.net que cobrimos.
          </p>
          <p>
            16.2. Esta condição também se aplica a você se tiver mais de 18
            anos, mas estiver fazendo suas apostas dentro de uma jurisdição que
            especifica uma idade superior a 18 anos para apostas legais e você
            está abaixo disso idade mínima legal nessa jurisdição.
          </p>
          <p>
            16.3. No caso de suspeitarmos que você está violando as disposições
            desta Cláusula ou está tentando burlar as cláusulas para fins
            fraudulentos, nos reservamos o direito de tomar qualquer ação
            necessária para investigar o assunto, inclusive informando as
            agências de aplicação da lei relevantes. Sendo comprovada a ação, o
            banimento é permanente em todas as contas que você esteja envolvido.
          </p>
          <h2>17. Fraudes</h2>
          <p>
            Buscaremos sanções criminais e contratuais contra qualquer Cliente
            envolvido em fraude, desonestidade ou atos criminosos. Reteremos o
            pagamento a qualquer Cliente onde houver suspeita de qualquer um
            deles. O Cliente deverá indenizará e será responsável por nos pagar
            sob demanda todos os custos, encargos ou perdas sofridas ou
            incorridas por nós (incluindo quaisquer perdas diretas, indiretas ou
            consequentes, perda de lucro, perda de negócios e perda de
            reputação) decorrentes direta ou indiretamente de fraude,
            desonestidade ou ato criminoso do Cliente. Ressaltamos que a conta
            será banida permanentemente, sem direito a reembolso.
          </p>
          <h2>18. Propriedade intelectual</h2>
          <p>
            18.1. Qualquer uso não autorizado de nosso nome e logotipo pode
            resultar em ação legal e banimento do site contra você.
          </p>
          <p>
            18.2. Entre nós e você, somos os únicos proprietários dos direitos
            sobre a  <?php echo $nomeUnico; ?>, nossa tecnologia, software e sistemas de negócios
            (os "Sistemas"), bem como nossas probabilidades. Você não deve usar
            seu perfil pessoal para seu próprio ganho comercial (como vender sua
            atualização de status para um anunciante); e ao selecionar um
            usuário de parceiro para sua conta, nos reservamos o direito de
            removê-lo ou recuperá-lo se acharmos apropriado.
          </p>
          <p>
            18.3. Você não pode usar nosso URL, marcas registradas, nomes
            comerciais e/ou identidade visual, logotipos e/ou nossas
            probabilidades em conexão com qualquer produto ou serviço que não
            seja nosso, que de alguma forma possa causar confusão entre Clientes
            ou em público ou que de alguma forma nos denegrir.
          </p>
          <p>
            18.4. Exceto conforme expressamente previsto nestes Termos, nós e
            nossos licenciadores não concedemos a você qualquer autorização
            expressa ou direitos implícitos, licença, título ou interesse nos
            Sistemas ou Marcas e todos esses direitos, licenças, título e
            interesse especificamente retidos por nós e nossos licenciadores.
            Você concorda em não usar nenhum sistema automático ou dispositivo
            manual para monitorar ou copiar páginas da web ou conteúdo dentro da
             <?php echo $nomeUnico; ?>. Qualquer uso não autorizado ou reprodução pode resultar
            em ação legal contra você.
          </p>
          <h2>19. Sua licença</h2>
          <p>
            19.1. Sujeito a estes Termos e sua conformidade com eles, concedemos
            a você uma licença não exclusiva, limitada, não licença transferível
            e não sublicenciável para acessar e usar a  <?php echo $nomeUnico; ?> para seu uso
            pessoal não comercial apenas propósitos. Nossa licença para você
            termina se nosso contrato com você sob estes Termos terminar.
          </p>
          <p>
            19.2. Salvo em relação ao seu próprio conteúdo, você não pode, em
            nenhuma circunstância, modificar, publicar, transmitir, transferir,
            vender, reproduzir, fazer upload, postar, distribuir, executar,
            exibir, criar trabalhos derivados de ou em de qualquer outra forma
            explorar, a  <?php echo $nomeUnico; ?> e/ou qualquer conteúdo nele contido ou o
            software nele contido, exceto conforme expressamente permitido
            nestes Termos ou de outra forma no Site. Nenhuma informação ou
            conteúdo no Serviço ou disponibilizado a você em conexão com a
             <?php echo $nomeUnico; ?> pode ser modificado ou alterado, fundido com outros dados
            ou publicados de qualquer forma, incluindo, por exemplo, captura de
            tela ou banco de dados e qualquer outra atividade destinados a
            coletar, armazenar, reorganizar ou manipular tais informações ou
            conteúdo.
          </p>
          <p>
            19.3. Qualquer não conformidade por você com esta Cláusula também
            pode ser uma violação de nossa ou de terceiros propriedade
            intelectual e outros direitos de propriedade que podem sujeitá-lo a
            responsabilidade civil e/ou criminal além da suspensão imediata da
            conta.
          </p>
          <h2>20. Sua conduta e proteção dentro do site</h2>
          <p>
            20.1. Para sua proteção e proteção de todos os nossos Clientes, a
            publicação de qualquer conteúdo na  <?php echo $nomeUnico; ?>, bem como conduta
            relacionada a ele e/ou a  <?php echo $nomeUnico; ?>, que seja de alguma forma ilegal,
            inapropriada ou indesejável é estritamente proibido (“Comportamento
            Proibido”).
          </p>
          <p>
            20.2. Se você se envolver em algum comportamento proibido, ou
            determinarmos, a nosso exclusivo critério, que você está se
            envolvendo em Comportamento Proibido, sua Conta e/ou seu acesso
            podem ser encerrados imediatamente sem aviso prévio. Ações legais
            podem ser tomadas contra você por outro Cliente, outro terceiro
            parte, autoridades de execução e/ou nós em relação a você ter se
            envolvido em Comportamento Proibido.
          </p>
          <p>
            20.3. O comportamento proibido inclui, mas não se limita a, acessar
            ou usar o  <?php echo $nomeUnico; ?> para: promover ou compartilhar informações que
            você sabe que são falsas, enganosas ou ilegais; realizar qualquer
            atividade ilegal ou ilegal, como, mas não limitado a, qualquer
            atividade que promova ou promova qualquer atividade ou
            empreendimento criminoso, viole a privacidade ou outros direitos de
            outro Cliente ou de qualquer terceiro ou que crie ou espalhe Vírus
            informáticos; prejudicar menores de qualquer form está sujeito a
            banimento;
          </p>
          <p>
            Divulgar qualquer conteúdo que o usuário não tenha o direito de
            disponibilizar sob qualquer lei ou relação contratual ou fiduciária,
            incluindo, sem limitação, qualquer conteúdo que infrinja um terceiro
            direitos autorais, marca registrada ou outra propriedade intelectual
            e direitos de propriedade da parte;
          </p>
          <p>
            Divulgar qualquer conteúdo ou material que contenha qualquer vírus
            de software ou outro computador ou código de programação (incluindo
            HTML) projetado para interromper, destruir ou alterar a
            funcionalidade da  <?php echo $nomeUnico; ?>, sua apresentação ou qualquer outro
            site, software ou hardware de computador;
          </p>
          <p>
            Interferir, interromper ou fazer engenharia reversa da  <?php echo $nomeUnico; ?> de
            qualquer maneira, incluindo, sem limitação, interceptar, emular ou
            redirecionar os protocolos de comunicação usados ​​por nós, criar ou
            usar cheats, mods ou hacks ou qualquer outro software projetado para
            modificar a  <?php echo $nomeUnico; ?>, ou usando qualquer software que intercepte ou
            coleta informações de ou através da  <?php echo $nomeUnico; ?>;
          </p>
          <p>
            Recuperar ou indexar qualquer informação da  <?php echo $nomeUnico; ?> usando
            qualquer robô, spider ou outro mecanismo automatizado;
          </p>
          <p>
            Participar de qualquer atividade que, a nosso exclusivo e irrestrito
            critério, resulte ou pode resultar em outro Cliente sendo fraudado
            ou enganado;
          </p>
          <p>
            Divulgar qualquer publicidade não solicitada ou não autorizada ou
            correspondência em massa, Não minta na divulgação sobre nossa
            prestação de serviço, você será investigado e poderá ter a conta
            suspensa ou dinheiro debitado em casos de copywritings fakes
          </p>
          <p>
            Criar Contas no Site por meios automatizados ou sob pretextos falsos
            ou fraudulentos; personificar outro Cliente ou qualquer outro
            terceiro, ou qualquer outro ato ou coisa que consideremos
            razoavelmente contrário aos nossos princípios de negócios.
          </p>
          <p>
            A lista acima de Comportamentos Proibidos pode ser modificada por
            nós a qualquer momento ou de tempos em tempos ao tempo.
            Reservamo-nos o direito de investigar e tomar todas as ações que, a
            nosso exclusivo critério, julgarmos apropriado ou necessário de
            acordo com as circunstâncias, incluindo, sem limitação, a exclusão
            do postagem(ões) da  <?php echo $nomeUnico; ?> e/ou encerrar sua Conta, e tomar
            qualquer ação contra qualquer Cliente ou terceiro que direta ou
            indiretamente, ou conscientemente permite que qualquer terceiro,
            direta ou indiretamente, se envolver em Comportamento Proibido, com
            ou sem aviso a tal Cliente ou terceiro..
          </p>
          <h2>21. Links para outros sites</h2>
          <p>
            O  <?php echo $nomeUnico; ?> pode conter links para sites de terceiros que não são
            mantidos ou relacionados a nós e sobre os quais não temos controle.
            Os links para esses sites são fornecidos apenas para conveniência
            dos Clientes e não são de forma alguma investigados, monitorados ou
            verificados quanto à precisão ou integridade por nós. Links para
            esses sites não implica qualquer endosso de nossa parte e/ou
            qualquer afiliação com os sites vinculados ou seu conteúdo ou Seus
            donos). Não temos controle ou responsabilidade pela disponibilidade
            nem pela sua precisão, completude, acessibilidade e utilidade.
            Assim, ao acessar esses sites, recomendamos que você devem tomar as
            precauções usuais ao visitar um novo site, incluindo revisar sua
            política de privacidade e termos de uso
          </p>
          <h2>22. Reclamações</h2>
          <p>
            22.1. Se você tiver alguma preocupação ou dúvida sobre estes termos,
            entre em contato com nosso Atendimento ao Cliente Departamento
            através da aba suporte no site e o chat ao vivo no canto inferior
            direito da tela.
          </p>
          <p>
            22.2. NÃO ASSUMIMOS QUALQUER RESPONSABILIDADE PARA COM VOCÊ OU
            QUALQUER TERCEIRO QUANDO RESPONDER A QUALQUER RECLAMAÇÃO QUE
            RECEBEMOS OU TOMAMOS MEDIDAS EM RELAÇÃO A ELA.
          </p>
          <p>
            22.3. Se um Cliente não estiver satisfeito com a forma como uma
            aposta foi liquidada, o cliente deverá fornecer detalhes de sua
            reclamação ao nosso Departamento de Atendimento ao Cliente. Usaremos
            nossos esforços razoáveis ​​para responder a perguntas dessa
            natureza 24 horas por dia, mas em caso de análises e saldos mais
            altos será repassado para o setor administrativo e resolvido em até
            1 dia.
          </p>
          <p>
            22.4. As reclamações devem ser apresentadas no prazo de três (3)
            dias a partir da data em que a aposta ou depósito foi realizado em
            questão foi decidida. Nenhuma reclamação será honrada após este
            período. O cliente é o único responsável pela sua conta e atos.
            transações.
          </p>
          <p>
            22.5. No caso de uma reclamação entre você e nós, nosso Departamento
            de Atendimento ao Cliente tentará chegar a uma solução acordada.
            Caso nosso Departamento de Atendimento ao Cliente não consiga chegar
            a uma solução acordada com você, o assunto será encaminhado à nossa
            administração.
          </p>
          <p>
            22.6. Reembolsos de depósitos serão realizados apenas se o jogador
            não realizou nenhuma aposta.
          </p>
          <h2>23. Atribuição ao termo</h2>
          <p>
            Nem estes Termos nem qualquer um dos direitos ou obrigações aqui
            contidos podem ser atribuídos por você sem o prévio consentimento
            por escrito de nós, consentimento esse que não será retido
            injustificadamente. Podemos, sem o seu consentimento, atribuir todos
            ou parte de nossos direitos e obrigações a qualquer terceiro, desde
            que tal terceiro seja capaz de fornecer um serviço de qualidade,
            publicando um aviso por escrito neste efeito no serviço
          </p>
          <h2>24. Termos legais da prestação de serviço</h2>
          <p>
            No caso de qualquer disposição destes Termos ser considerada por
            qualquer autoridade competente como inexequível ou inválida, a
            disposição relevante deve ser modificada para permitir que seja
            aplicada de acordo com a intenção de o texto original na extensão
            máxima permitida pela lei aplicável. A validade e exequibilidade do
            restantes disposições destes Termos não serão afetadas.
          </p>
          <h2>25. Violação desses termos</h2>
          <p>
            Sem limitar nossos outros recursos, podemos suspender ou encerrar
            sua conta e nos recusar a continuar a fornecer a você a  <?php echo $nomeUnico; ?>,
            em ambos os casos sem aviso prévio, se, em nossa opinião razoável,
            você violar qualquer termo material destes Termos. A notificação de
            qualquer ação tomada será, no entanto, prontamente fornecido a você.
          </p>
          <h2>26. Regras em geral</h2>
          <p>
            26.1. Termo de acordo. Estes Termos permanecerão em pleno vigor e
            efeito enquanto você acessar ou usar a  <?php echo $nomeUnico; ?> ou é um Cliente ou
            visitante do Site. Estes Termos sobreviverão ao término de sua Conta
            por qualquer motivo.
          </p>
          <p>
            26.2. Afiliados. O saque mínimo é de R$100 do saldo disponível para
            todos os afiliados. É proibido criar contas falsas para se
            auto-indicar e ganhar dinheiro da indicação de si próprio, a conduta
            atribuida a esses atos será a suspensão da conta fake e debitar do
            saldo da conta principal o saldo fraudado. <br />Cláusula de Taxa de
            Saque para Pagamento Rápido ("SuitPay") via PIX<br />
            <br />As partes concordam que, para proporcionar um serviço de
            pagamento rápido e eficiente denominado "SuitPay" através da
            plataforma PIX, será aplicada uma taxa de saque de 3% sobre o valor
            total da transação. <br /><br />
            A taxa de saque tem como objetivo cobrir os custos operacionais e
            administrativos associados à execução imediata do pagamento via PIX,
            garantindo a transferência de fundos de forma célere e segura.
            <br /><br />
            A cláusula de taxa de saque será aplicada exclusivamente às
            transações realizadas utilizando o serviço SuitPay e não afetará
            outras transações ou métodos de pagamento disponíveis entre as
            partes.
            <br /><br />
            A taxa de saque será automaticamente adicionada ao valor total da
            transação antes da confirmação do pagamento. A parte que realiza o
            saque concorda em arcar com a taxa estipulada, a qual será debitada
            juntamente com o valor principal da transação.
            <br /><br />
            É importante ressaltar que o valor da taxa de saque não será
            reembolsável, independentemente do resultado da transação, seja ela
            concluída com sucesso ou cancelada por qualquer motivo.
            <br /><br />
            A parte que realiza o saque concorda em fornecer informações
            precisas e atualizadas para a execução do pagamento rápido via PIX,
            incluindo dados bancários válidos e suficientes para a transferência
            de fundos.
            <br /><br />
            A presente cláusula será regida pelas leis vigentes do país em que
            as partes estão estabelecidas, sendo eleito o foro da comarca
            competente para dirimir quaisquer questões decorrentes ou
            relacionadas a esta cláusula.<br /><br />
          </p>
          <p>
            26.3. Renúncia. Nenhuma renúncia por nós, seja por conduta ou de
            outra forma, de uma violação ou ameaça de violação por você de
            qualquer termo ou condição destes Termos será efetivo contra nós ou
            vinculará a nós, a menos que seja feito por escrito e devidamente
            assinado por nós, e, salvo disposição em contrário na renúncia por
            escrito, será limitado ao violação específica dispensada. A falha de
            nós em aplicar a qualquer momento qualquer termo ou condição destes
            Termos deverá não deve ser interpretado como uma renúncia de tal
            disposição ou do direito de nós de aplicar tal disposição em
            qualquer outra hora.
          </p>
          <p>
            26.4. Reconhecimento de culpa. Ao acessar ou usar A  <?php echo $nomeUnico; ?>, você
            reconhece ter lido, entendido e concordou com cada parágrafo destes
            Termos. Como resultado, você renuncia irrevogavelmente a qualquer
            argumentar, reivindicar, exigir ou proceder em contrário de qualquer
            coisa contida nestes Termos.
          </p>
          <p>
            26.5. Ao cadastrar e depositar, você concorda em seguir os termos.
            Estes Termos constituem o acordo integral entre você e nós com
            relação à sua acesso e uso da  <?php echo $nomeUnico; ?> e substitui todos os outros
            acordos e comunicações anteriores, sejam verbais ou escrito em
            relação ao assunto aqui tratado.
          </p>
        </div>
      </section>
      <div class="footer-section wf-section">
        <div class="domo-text"><?php echo $nomeUm; ?> <br /></div>
        <div class="domo-text purple"><?php echo $nomeDois; ?>  <br /></div>
       <div class="follow-test">© Copyright xlk Limited, with registered offices at Dr. M.L. King Boulevard 117, accredited by license GLH-16289876512. </div>
        <div class="follow-test">
        
        </div>
          <div class="follow-test">contato@<?php
$nomeUnico = strtolower(str_replace(' ', '', $nomeUnico));
echo $nomeUnico;
?>.com</div>
      </div>





<script type="text/javascript">
            <!-- Inclua a biblioteca jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Seu script jQuery -->
    <script type="text/javascript">
        $(document).ready(function () {
            $("#withdrawValue").keyup(function (e) {
                var value = $("[name='withdrawValue']").val();
                var final = (value / 100) * 95;
                $('#updatedValue').text('' + final.toFixed(2));
            });
        });
    </script>
        </div>
        <div id="imageDownloaderSidebarContainer">
          <div class="image-downloader-ext-container">
            <div tabindex="-1" class="b-sidebar-outer"><!---->
              <div id="image-downloader-sidebar" tabindex="-1" role="dialog" aria-modal="false" aria-hidden="true"
                class="b-sidebar shadow b-sidebar-right bg-light text-dark" style="width: 500px; display: none;"><!---->
                <div class="b-sidebar-body">
                  <div></div>
                </div><!---->
              </div><!----><!---->
            </div>
          </div>
        </div>
        <div style="visibility: visible;">
          <div></div>
          <div>
            <div
              style="display: flex; flex-direction: column; z-index: 999999; bottom: 88px; position: fixed; right: 16px; direction: ltr; align-items: end; gap: 8px;">
              <div style="display: flex; gap: 8px;"></div>
            </div>
            <style> @-webkit-keyframes ww-1d3e1845-0974-4ce9-92ae-64548dac571e-launcherOnOpen {
          0% {
            -webkit-transform: translateY(0px) rotate(0deg);
                    transform: translateY(0px) rotate(0deg);
          }

          30% {
            -webkit-transform: translateY(-5px) rotate(2deg);
                    transform: translateY(-5px) rotate(2deg);
          }

          60% {
            -webkit-transform: translateY(0px) rotate(0deg);
                    transform: translateY(0px) rotate(0deg);
          }


          90% {
            -webkit-transform: translateY(-1px) rotate(0deg);
                    transform: translateY(-1px) rotate(0deg);

          }

          100% {
            -webkit-transform: translateY(-0px) rotate(0deg);
                    transform: translateY(-0px) rotate(0deg);
          }
        }
        @keyframes ww-1d3e1845-0974-4ce9-92ae-64548dac571e-launcherOnOpen {
          0% {
            -webkit-transform: translateY(0px) rotate(0deg);
                    transform: translateY(0px) rotate(0deg);
          }

          30% {
            -webkit-transform: translateY(-5px) rotate(2deg);
                    transform: translateY(-5px) rotate(2deg);
          }

          60% {
            -webkit-transform: translateY(0px) rotate(0deg);
                    transform: translateY(0px) rotate(0deg);
          }


          90% {
            -webkit-transform: translateY(-1px) rotate(0deg);
                    transform: translateY(-1px) rotate(0deg);

          }

          100% {
            -webkit-transform: translateY(-0px) rotate(0deg);
                    transform: translateY(-0px) rotate(0deg);
          }
        }

        @keyframes ww-1d3e1845-0974-4ce9-92ae-64548dac571e-widgetOnLoad {
          0% {
            opacity: 0;
          }
          100% {
            opacity: 1;
          }
        }

        @-webkit-keyframes ww-1d3e1845-0974-4ce9-92ae-64548dac571e-widgetOnLoad {
          0% {
            opacity: 0;
          }
          100% {
            opacity: 1;
          }
        }
      </style></div>
      </div>
      </body>
      
      </html>