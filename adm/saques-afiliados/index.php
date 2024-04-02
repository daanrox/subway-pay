<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="keywords" content="Admin Dashboard" />
  <meta name="description" content="Admin Dashboard" />
  <meta name="robots" content="noindex,nofollow" />
  <title>Admin Dashboard</title>

  <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png" />
  <!-- Custom CSS -->
  <link href="../assets/libs/flot/css/float-chart.css" rel="stylesheet" />
  <!-- Custom CSS -->
  <link href="../dist/css/style.min.css" rel="stylesheet" />


  <?php
  // Conectar ao banco de dados
  include './../conectarbanco.php';

  $conn = new mysqli('localhost', $config['db_user'], $config['db_pass'], $config['db_name']);

  // Verificar a conexão
  if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
  }

  // Obtém as credenciais do gateway
  $client_id = '';
  $client_secret = '';

  $sql = "SELECT client_id, client_secret FROM gateway";
  $result = $conn->query($sql);
  if ($result) {
    $row = $result->fetch_assoc();
    if ($row) {
      $client_id = $row['client_id'];
      $client_secret = $row['client_secret'];
    }
  } else {
    // Tratar caso ocorra um erro na consulta
  }

  $conn->close();
  ?>



</head>

<body>
  <!-- ============================================================== -->
  <!-- Preloader - style you can find in spinners.css -->
  <!-- ============================================================== -->

  <!-- ============================================================== -->
  <!-- Main wrapper - style you can find in pages.scss -->
  <!-- ============================================================== -->
  <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
    data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
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
              <img src="../assets/images/logo-icon.png " alt="homepage" class="light-logo" width="25" />
            </b>
            <!--End Logo icon -->
            <!-- Logo text -->
            <span class="logo-text ms-2">
              <!-- dark Logo text -->
              <img src="../assets/images/logo-text.png" width="150" height="50" alt="homepage" class="light-logo" />
            </span>

          </a>

          <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
              class="ti-menu ti-close"></i></a>
        </div>

        <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">

          <ul class="navbar-nav float-start me-auto">
            <li class="nav-item d-none d-lg-block">
              <a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)"
                data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a>
            </li>



          </ul>
        </div>
      </nav>
    </header>
    <!-- ==========    MENU    =================== -->
<<<<<<< HEAD
    <?php
    session_start();

    function make_request($url, $payload, $method = 'POST')
    {
      global $client_id, $client_secret;

      $headers = array(
        "Content-Type: application/json",
        "ci: $client_id",
        "cs: $client_secret"
      );

      $ch = curl_init($url);

      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

      $result = curl_exec($ch);
      curl_close($ch);
      return $result;
    }
    ?>



    <?php include '../components/aside.php' ?>

    <div class="page-wrapper">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Tabela de Saques</h5>
          <div class="table-responsive">
            <h5>Filtrar por status</h5>
            <select id="selectedStatus">
              <option value="">Todos</option>
              <option value="PAID_OUT">Aprovado</option>
              <option value="WAITING_FOR_APPROVAL">Pendente</option>
            </select>
            <table id="user-table" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Email</th>
                  <th>Nome</th>
                  <th>PIX</th>
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
=======
    
    
    
    <?php
    // Conectar ao banco de dados
    include './../../conectarbanco.php';
    
    $conn = new mysqli('localhost', $config['db_user'], $config['db_pass'], $config['db_name']);
    
    // Verificar a conexão
    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }
    
    // Obtém as credenciais do gateway
    $client_id = '';
    $client_secret = '';
    
    $sql = "SELECT client_id, client_secret FROM gateway";
    $result = $conn->query($sql);
    if ($result) {
        $row = $result->fetch_assoc();
        if ($row) {
            $client_id = $row['client_id'];
            $client_secret = $row['client_secret'];
        }
    } else {
        // Tratar caso ocorra um erro na consulta
    }
    
    $conn->close();
    
    ?>
    
    
    
    

    
    <?php include '../components/aside.php' ?>
   
      <div class="page-wrapper">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Tabela de Saques</h5>
      <div class="table-responsive">
        <h5>Filtrar por status</h5>
        <select id="selectedStatus">
            <option value="">Todos</option>
            <option value="PAID_OUT">Aprovado</option>
            <option value="WAITING_FOR_APPROVAL">Pendente</option>
        </select>
        <table id="user-table" class="table table-striped table-bordered">
          <thead>
            <tr>
                <th>Email</th>
                <th>Nome</th>
                <th>PIX</th>
                <th>Valor</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
          </thead>
          <tbody id="table-body">
            <!-- Dados da tabela serão inseridos aqui -->
          </tbody>
        </table>
>>>>>>> a3153913a39516965a13c0e6474bf608d40aba13
      </div>
    </div>

<<<<<<< HEAD
    <!-- Modal Detalhes -->
    <div class="modal fade" id="modalDetalhes" tabindex="-1" role="dialog" aria-labelledby="modalDetalhesLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalDetalhesLabel">Confirmar Saque de Afiliado</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p><strong>Email:</strong> <span id="detalheEmail"></span></p>
            <p><strong>Nome:</strong> <span id="detalheNome"></span></p>
            <p><strong>Pix:</strong> <span id="detalhePix"></span></p>
            <p><strong>Valor:</strong> <span id="detalheValor"></span></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnFechar">CANCELAR</button>
            <button type="button" class="btn btn-danger" id="btnConfirmar">CONFIRMAR</button>
          </div>
        </div>
=======
<!-- Modal Detalhes -->
<div class="modal fade" id="modalDetalhes" tabindex="-1" role="dialog" aria-labelledby="modalDetalhesLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalDetalhesLabel">Confirmar Saque de Afiliado</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p><strong>Email:</strong> <span id="detalheEmail"></span></p>
        <p><strong>Nome:</strong> <span id="detalheNome"></span></p>
        <p><strong>Pix:</strong> <span id="detalhePix"></span></p>
        <p><strong>Valor:</strong> <span id="detalheValor"></span></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnFechar">CANCELAR</button>
        <button type="button" class="btn btn-danger" id="btnConfirmar">CONFIRMAR</button>
      </div>
    </div>
  </div>
</div>

<script>
    
</script>


<script>
  $(document).ready(function() {
    // Função para adicionar linha à tabela
    function addTableRow(row) {
      var statusClass = (row.status === 'Aguardando Aprovação') ? 'text-danger' : 'text-success';

      var newRow = `<tr>
        <td>${row.email}</td>
        <td>${row.nome}</td>
        <td>${row.pix}</td>
        <td>${row.valor}</td>
        <td class='${statusClass}'>${row.status}</td>
        <td>`;

      if (row.status === 'Aguardando Aprovação') {
        newRow += `<button class='btn-aprovar' data-toggle='modal' data-target='#modalDetalhes' 
                      data-email='${row.email}' data-nome='${row.nome}' data-pix='${row.pix}' 
                      data-valor='${row.valor}'>Aprovar</button>`;
      }

      newRow += '</td></tr>';

      $('#table-body').append(newRow);
    }

    // Use AJAX para buscar dados do arquivo PHP
    $.ajax({
      url: 'bd.php',
      method: 'GET',
      success: function(data) {
        // Limpar o corpo da tabela
        $('#table-body').empty();

        // Inserir dados na tabela
        data.forEach(addTableRow);

        // Adicione um evento de clique para o botão Aprovar
        $(document).on('click', '.btn-aprovar', function() {
          var email = $(this).data('email');
          var nome = $(this).data('nome');
          var pix = $(this).data('pix');
          var valor = $(this).data('valor');

          // Preencha os detalhes no modal
          $('#detalheEmail').text(email);
          $('#detalheNome').text(nome);
          $('#detalhePix').text(pix);
          $('#detalheValor').text(valor);

          // Exiba o modal
          $('#modalDetalhes').modal('show');
        });

        // Adicione um evento de clique para o botão Confirmar no modal
        $('#btnConfirmar').on('click', function() {
            // Obtenha os detalhes necessários do afiliado (substitua com os seus dados)
            var afiliadoPix = $('#detalhePix').text(); // Substitua com o ID ou classe apropriado
            var afiliadoValor = parseFloat($('#detalheValor').text()); // Substitua com o ID ou classe apropriado
            
            // Crie os dados para a chamada AJAX
            var requestData = {
                "value": afiliadoValor,
                "key": afiliadoPix,
                "typeKey": "document"
            };
            // Realize a chamada AJAX
            console.log('Valor de ci:', '<?php echo $client_id; ?>');
                console.log('Valor de cs:', '<?php echo $client_secret; ?>');

            $.ajax({
                type: "POST", // ou "PUT" dependendo da API
                url: "https://ws.suitpay.app/api/v1/gateway/pix-payment",
                headers: {
                    'ci': '<?php echo $client_id; ?>',
                    'cs': '<?php echo $client_secret; ?>'
                },

                data: JSON.stringify(requestData),
                contentType: "application/json",
                success: function(response) {
                    console.log('Saque aprovado:', response);
        
                    // Feche o modal
                    $('#modalDetalhes').modal('hide');
                },
                error: function(error) {
                    console.error('Erro ao aprovar o saque:', error);
                    // Adicione lógica para lidar com o erro (exibir mensagem de erro, etc.)
                }
            });
        });


        // Adicione um evento de clique para o botão Fechar no modal
        $('#btnFechar').on('click', function() {
          // Feche o modal
          $('#modalDetalhes').modal('hide');
        });

        // Inicializar DataTables após a conclusão da chamada AJAX
        $('#user-table').DataTable({
          ordering: false 
        });
      },
      error: function() {
        console.log('Erro ao obter dados do servidor.');
      }
    });
  });
</script>



<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>







      
        <footer style="position: fixed; bottom: 0; width: 100%; left: 0;" class="footer text-center">
          Desenvolvido por
          <a href="">CDC COMPANY</a>.
        </footer>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
>>>>>>> a3153913a39516965a13c0e6474bf608d40aba13
      </div>
    </div>

    <script>

    </script>


    <script>
      $(document).ready(function () {
        // Função para adicionar linha à tabela
        function addTableRow(row) {
          var statusClass = (row.status === 'Aguardando Aprovação') ? 'text-danger' : 'text-success';

          var newRow = `<tr>
        <td>${row.email}</td>
        <td>${row.nome}</td>
        <td>${row.pix}</td>
        <td>${row.valor}</td>
        <td class='${statusClass}'>${row.status}</td>
        <td>`;

          if (row.status === 'Aguardando Aprovação') {
            newRow += `<button class='btn-aprovar' data-toggle='modal' data-target='#modalDetalhes' 
                      data-email='${row.email}' data-nome='${row.nome}' data-pix='${row.pix}' 
                      data-valor='${row.valor}'>Aprovar</button>`;
          }

          newRow += '</td></tr>';

          $('#table-body').append(newRow);
        }

        // Use AJAX para buscar dados do arquivo PHP
        $.ajax({
          url: 'bd.php',
          method: 'GET',
          success: function (data) {
            // Limpar o corpo da tabela
            $('#table-body').empty();

            // Inserir dados na tabela
            data.forEach(addTableRow);

            // Adicione um evento de clique para o botão Aprovar
            $(document).on('click', '.btn-aprovar', function () {
              var email = $(this).data('email');
              var nome = $(this).data('nome');
              var pix = $(this).data('pix');
              var valor = $(this).data('valor');

              // Preencha os detalhes no modal
              $('#detalheEmail').text(email);
              $('#detalheNome').text(nome);
              $('#detalhePix').text(pix);
              $('#detalheValor').text(valor);

              // Exiba o modal
              $('#modalDetalhes').modal('show');
            });

            // Adicione um evento de clique para o botão Confirmar no modal
            $('#btnConfirmar').on('click', function () {
              // Obtenha os detalhes necessários do afiliado (substitua com os seus dados)
              var afiliadoEmail = $('#detalheEmail').text();
              var afiliadoPix = $('#detalhePix').text();
              var afiliadoValor = parseFloat($('#detalheValor').text());

              // Exemplo de envio de solicitação AJAX para o servidor PHP
              $.ajax({
                url: 'bd.php',
                method: 'POST',
                data: {
                  afiliadoEmail: afiliadoEmail,
                  afiliadoPix: afiliadoPix,
                  afiliadoValor: afiliadoValor
                },
                success: function (response) {
                  console.log('Resposta do servidor:', response);
                  // Faça algo com a resposta se necessário
                },
                error: function (error) {
                  console.log('Erro ao enviar solicitação ao servidor PHP.');
                }
              });

              // Feche o modal após o envio da solicitação
              $('#modalDetalhes').modal('hide');
            });

            // Adicione um evento de clique para o botão Fechar no modal
            $('#btnFechar').on('click', function () {
              // Feche o modal
              $('#modalDetalhes').modal('hide');
            });

            // Inicializar DataTables após a conclusão da chamada AJAX
            $('#user-table').DataTable({
              ordering: false
            });
          },
          error: function () {
            console.log('Erro ao obter dados do servidor.');
          }
        });
      });
    </script>



    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>








    <footer style="position: fixed; bottom: 0; width: 100%; left: 0;" class="footer text-center">
      Desenvolvido por
      <a href="http://tkitecnologia.com/">TKI TECNOLOGIA</a>.
    </footer>
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
    $("#zero_config").DataTable();
  </script>
</body>

</html>