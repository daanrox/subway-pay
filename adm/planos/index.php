<?php

    session_start();



    if (!isset($_SESSION['emailadm'])) {

        header("Location: ../login");

        exit();

    }

    

    include './../../conectarbanco.php';

    $conn = new mysqli($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_name']);

    

    if ($conn->connect_error) {

        die("Erro na conexão com o banco de dados: " . $conn->connect_error);

    }

    

    $result = $conn->query("SELECT * FROM app LIMIT 1");

    $result = $result->fetch_assoc();

    

    $cpa = $result['cpa'];

    $chance_afiliado = $result['chance_afiliado'];

    $deposito_min_cpa = $result['deposito_min_cpa'];

    $revenue_share_falso = $result['revenue_share_falso'];

    $max_saque_cpa = $result['max_saque_cpa'];

    $revenue_share = $result['revenue_share'];



?>



<!DOCTYPE html>

<html dir="ltr" lang="en">

  <head>

    <meta charset="utf-8" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />



    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">





    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <meta

      name="keywords"

      content="Admin Dashboard"

    />

    <meta

      name="description"

      content="Admin Dashboard"

    />

    <meta name="robots" content="noindex,nofollow" />

    <title>Admin Dashboard</title>

 

    <link rel="icon" type="image/png" sizes="16x16" href="https://daanrox.com/assets/image/rox-footer.png" />



    <!-- Custom CSS -->

    <link href="../assets/libs/flot/css/float-chart.css" rel="stylesheet" />

    <!-- Custom CSS -->

    <link href="../dist/css/style.min.css" rel="stylesheet" />



  </head>



  <body>

    <!-- ============================================================== -->

    <!-- Preloader - style you can find in spinners.css -->

    <!-- ============================================================== -->

  

    <!-- ============================================================== -->

    <!-- Main wrapper - style you can find in pages.scss -->

    <!-- ============================================================== -->

    <div

      id="main-wrapper"

      data-layout="vertical"

      data-navbarbg="skin5"

      data-sidebartype="full"

      data-sidebar-position="absolute"

      data-header-position="absolute"

      data-boxed-layout="full"

    >

      <!-- ============================================================== -->

      <!-- Topbar header - style you can find in pages.scss -->

      <!-- ============================================================== -->

      <header class="topbar" data-navbarbg="skin5">

        <nav class="navbar top-navbar navbar-expand-md navbar-dark">

          <div class="navbar-header" data-logobg="skin5">

            <!-- ============================================================== -->

            <!-- Logo -->

            <!-- ============================================================== -->

            <a class="navbar-brand" href="../">

              <!-- Logo icon -->

              <b class="logo-icon ps-2">

                <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->

                <!-- Dark Logo icon -->

                <img

                  src="https://daanrox.com/assets/image/daanrox-logo.png"

                  alt="homepage"

                  class="light-logo"

                  width="100%"

                />

              </b>

              <!--End Logo icon -->

              <!-- Logo text -->


           

            </a>

        

            <a

              class="nav-toggler waves-effect waves-light d-block d-md-none"

              href="javascript:void(0)"

              ><i class="ti-menu ti-close"></i

            ></a>

          </div>



          <div

            class="navbar-collapse collapse"

            id="navbarSupportedContent"

            data-navbarbg="skin5">

   

            <ul class="navbar-nav float-start me-auto">

              <li class="nav-item d-none d-lg-block">

                <a

                  class="nav-link sidebartoggler waves-effect waves-light"

                  href="javascript:void(0)"

                  data-sidebartype="mini-sidebar"

                  ><i class="mdi mdi-menu font-24"></i

                ></a>

              </li>

            

         

            

            </ul>

          </div>

        </nav>

      </header>

       <!-- ==========    MENU    =================== -->

    <?php include '../components/aside.php' ?>

      

      

      

      

      

      <style>

  /* Estilos da tabela */

  #user-table {

    width: 100%;

    border-collapse: collapse;

    margin-bottom: 20px;

  }



  #user-table th, #user-table td {

    border: 1px solid #ddd;

    padding: 8px;

    text-align: left;

  }



  #user-table th {

    background-color: #f2f2f2;

  }



  #user-table input[type="text"] {

    width: 80px; /* Ajuste conforme necessário */

    padding: 5px;

    margin: 0;

    box-sizing: border-box;

    border: none; /* Remover as bordas dos inputs */

    background-color: transparent; /* Tornar os inputs transparentes */

  }

  /* Estilos do botão */

  .btn-success {

    background-color: #28a745;

    color: #fff;

    border: none;

    padding: 10px 15px;

    font-size: 16px;

    cursor: pointer;

    border-radius: 4px;

  }

</style>





<div class="page-wrapper">

  <div class="card">

    <div class="card-body">

     

       

        <style>

            .box-container {

                display: flex;

                flex-direction: row;

                flex-wrap: wrap;

                width: 100%;

                justify-content: space-around;

            }

        

            .box {

                border: 1px solid white;

                padding: 20px;

                margin: 20px 0;

                min-width: 320px;

                width: 320px;

                background-color: #1f262d;

                border-radius: 15px;

                display: block;

            }

            .title {

                font-size: 20px;

                font-weight: bold;

                color: white;

            }

            .description {

                color: #b6b7bf;

                font-weight: 500;

            }

            

            .box-input {

                background: #b6b7bf;

                width: 100%;

                height: 32px;

                border-radius: 5px;

                border: 1px solid #dadbe5;

            }

            

            .box-btn {

                margin-top: 10px;

                border-radius: 5px;

            }

            

        </style>

 <div class="card">
  <div class="card-body">
    <h5 class="card-title">Saque de afiliados</h5>
    <div class="table-responsive">
      <table id="user-table" class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>Email</th>
            <th>Nome</th>
            <th>Pix</th>
            <th>Valor</th>
            <th>Status</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody id="table-body">
          <!-- Dados da tabela serão inseridos aqui -->
        </tbody>
      </table>
    </div>
  </div>
</div>

<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="paymentModalLabel">Confirmar Pagamento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
          onclick="$('#paymentModal').modal('hide');">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p><strong>Email:</strong> <span id="modalEmail"></span></p>
        <p><strong>Nome:</strong> <span id="modalNome"></span></p>
        <p><strong>Chave Pix:</strong> <span id="modalChavePix"></span></p>
        <p><strong>Valor:</strong> <span id="modalValor"></span></p>
        <p><strong>Status:</strong> <span id="modalStatus"></span></p>
        <div id="paymentResult" class="text-center mt-2"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger"
          onclick="$('#paymentModal').modal('hide');" data-dismiss="modal">Fechar</button>
        <button id="confirmPayment" class="text-white btn btn-success">Confirmar</button>
      </div>
    </div>
  </div>
</div>

<!-- KronosTech iGaming - Desenvolvimento de Sistemas -->

<script>
$(document).ready(function () {
  $.ajax({
    url: 'bd.php',
    method: 'GET',
    success: function (data) {
      $('#table-body').empty();

      data.forEach(function (row) {
        var newRow = "<tr>" +
          "<td>" + row.email + "</td>" +
          "<td>" + row.nome + "</td>" +
          "<td>" + row.pix + "</td>" +
          "<td>" + row.valor + "</td>" +
          "<td>" + row.status + "</td>" +
          "<td>" +
          "<select class='change-status' data-email='" + row.email + "' data-valor='" + row.valor + "'>" +
          "<option value='Aguardando Aprovação'" + (row.status === 'Aguardando Aprovação' ? 'selected' : '') + ">Aguardando Aprovação</option>" +
          "<option value='Aprovado'" + (row.status === 'Aprovado' ? 'selected' : '') + ">Aprovado</option>" +
          "<option value='Reprovado'" + (row.status === 'Reprovado' ? 'selected' : '') + ">Reprovado</option>" +
          "</select>" +
          "</td>" +
          "</tr>";

        $('#table-body').append(newRow);
      });

      $('#user-table').DataTable({
        ordering: false
      });
    },
    error: function () {
      console.log('Erro ao obter dados do servidor.');
    }
  });

  $(document).on('click', '.btn-pagar', function () {
    var email = $(this).data('email');
    var nome = $(this).data('nome');
    var chavepix = $(this).data('pix');
    var valor = $(this).data('valor');
    var status = $(this).data('status');

    $('#modalEmail').text(email);
    $('#modalNome').text(nome);
    $('#modalChavePix').text(chavepix);
    $('#modalValor').text(valor);
    $('#modalStatus').text(status);

    $('#paymentModal').modal('show');
  });

  $(document).on('change', '.change-status', function () {
    var email = $(this).data('email');
    var valorAtt = $(this).data('valor');
    var newStatus = $(this).val();

    // Chama a função para atualizar o status no banco de dados
    updateStatus(email, newStatus, valorAtt);
  });

  // ... Seu código existente ...

  function updateStatus(email, newStatus, valorAtt) {
    $.ajax({
      url: 'atualizar_status.php', // Substitua pelo caminho correto do seu script de atualização no servidor
      method: 'POST',
      data: { email: email, status: newStatus, valor: valorAtt },
      success: function (response) {
        // Atualiza a tabela no sucesso da requisição
        // Você pode adicionar feedback ao usuário se necessário
        if (response === 'success') {
          alert('Status atualizado com sucesso!');
          location.reload();
          
          // Recarregue os dados da tabela após a atualização, se necessário
          // Pode ser feito chamando novamente a função que carrega os dados no documento ready
        } else {
          alert('Erro ao atualizar o status.');
        }
      },
      error: function () {
        console.log('Erro ao enviar a requisição de atualização de status.');
      }
    });
  }
});
</script>




<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
      </div>
      <!-- ============================================================== -->
      <!-- End Page wrapper  -->
      <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="../assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="../dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="../dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="../dist/js/custom.min.js"></script>
    <!-- this page js -->
    <script src="../assets/extra-libs/multicheck/datatable-checkbox-init.js"></script>
    <script src="../assets/extra-libs/multicheck/jquery.multicheck.js"></script>
    <script src="../assets/extra-libs/DataTables/datatables.min.js"></script>
    <script>
      /****************************************
       *       Basic Table                   *
       ****************************************/
    //   $("#user-table").DataTable();
    </script>
            
    


        <div class="box-container">

            <div class="box">

                <form action='update.php?field=cpa' method='post'>

                    <p class="title">CPA (R$):</p> 

                    <p class="description">Ganho do afiliado em cada depósito feito pelo usuário indicado.<br> Essa configuração não edita o CPA de todos os usuários, somente dos novos usuários.</p>

                    <input class="box-input" name="value" value="<?php echo $cpa?>"/>

                    <button type="submit" class="btn box-btn btn-primary">Salvar Alterações</button>

                </form>

            </div>

            <div class="box">

                <form action='update.php?field=chance_afiliado' method='post'>

                    <p class="title">Chance do afiliado ganhar comissões de seus indicados (%):</p> 

                    <p class="description">Quantos % de cadastros irão contabilizar. (Ideal: 100%)</p>

                    <input class="box-input" name="value" value="<?php echo $chance_afiliado?>"/>

                    <button type="submit" class="btn box-btn btn-primary">Salvar Alterações</button>

                </form>

            </div>

            <div class="box">

                <form action='update.php?field=deposito_min_cpa' method='post'>

                    <p class="title">Depósito Mínimo Para Afiliado Ganhar CPA:</p> 

                    <p class="description">Valor de depósito mínimo que os convidados do afiliado devem fazer para gerar receita de CPA.</p>

                    <input class="box-input" name="value"value="<?php echo $deposito_min_cpa?>"/>

                    <button type="submit" class="btn box-btn btn-primary">Salvar Alterações</button>

                </form>

            </div>

            <!--<div class="box">-->

            <!--    <form action='update.php?field=revenue_share_falso' method='post'>-->

            <!--        <p class="title">Porcentagem de Rev. Share Falso (%):</p> -->

            <!--        <p class="description">Valor a mais de revenue share que irá aparecer aos usuários (aumentar lucros do site).</p>-->

            <!--        <input class="box-input" name="value" value="<?php echo $revenue_share_falso?>"/>-->

            <!--        <button type="submit" class="btn box-btn btn-primary">Salvar Alterações</button>-->

            <!--    </form>-->

            <!--</div>-->

            <div class="box">

                <form action='update.php?field=max_saque_cpa' method='post'>

                    <p class="title">Saque máximo:</p> 

                    <p class="description">Quantidade de saques máxima que um afiliado pode fazer por dia.</p>

                    <input class="box-input" name="value" value="<?php echo $max_saque_cpa?>"/>

                    <button type="submit" class="btn box-btn btn-primary">Salvar Alterações</button>

                </form>

            </div>

            <div class="box">

                <form action='update.php?field=revenue_share' method='post'>

                    <p class="title">Revenue Share (%):</p> 

                    <p class="description">Porcentagem dada aos afiliados por cada perca real dos indicados. <br> Essa configuração não edita o CPA de todos os usuários, somente dos novos usuários.</p>

                    <input class="box-input" name="value" value="<?php echo $revenue_share?>"/>

                    <button type="submit" class="btn box-btn btn-primary">Salvar Alterações</button>

                </form>

            </div>

        </div>



    </div>

  </div>

</div>



<?php

$conn->close();

?>





<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>


      </div>


    </div>


 <footer class="footer text-center">
        Desenvolvido por
        <a href="http://daanrox.com/">DAANROX</a>.
    </footer>


    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap tether Core JavaScript -->

    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <!-- slimscrollbar scrollbar JavaScript -->

    <script src="../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>

    <script src="../assets/extra-libs/sparkline/sparkline.js"></script>

    <!--Wave Effects -->

    <script src="../dist/js/waves.js"></script>

    <!--Menu sidebar -->

    <script src="../dist/js/sidebarmenu.js"></script>

    <!--Custom JavaScript -->

    <script src="../dist/js/custom.min.js"></script>

    <!-- this page js -->

    <script src="../assets/extra-libs/multicheck/datatable-checkbox-init.js"></script>

    <script src="../assets/extra-libs/multicheck/jquery.multicheck.js"></script>

    <script src="../assets/extra-libs/DataTables/datatables.min.js"></script>

    <script>

      /****************************************

       *       Basic Table                   *

       ****************************************/

      $("#zero_config").DataTable();

    </script>
<link rel="stylesheet" href="https://cdn.positus.global/production/resources/robbu/whatsapp-button/whatsapp-button.css">
      <a id="robbu-whatsapp-button" target="_blank" href="https://api.whatsapp.com/send?phone=5531992812273&text=Ol%C3%A1,%20vim%20pelo%20site%20e%20gostaria%20de%20tirar%20uma%20d%C3%BAvida%20sobre%20abrir%20uma%20plataforma%20de%20apostas%20ou%20problemas%20em%20algum%20de%20seus%20sites.">
        <div class="rwb-tooltip">Entre em contato!</div>
        <img src="https://cdn.positus.global/production/resources/robbu/whatsapp-button/whatsapp-icon.svg">
      </a>
  </body>

</html>

