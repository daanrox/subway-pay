<?php
session_start();

// Verificar se a sessão existe
if (!isset($_SESSION['emailadm'])) {
    // Sessão não existe, redirecionar para outra página
    header("Location: login");
    exit();
}

include './../conectarbanco.php';

$conn = new mysqli('localhost', $config['db_user'], $config['db_pass'], $config['db_name']);


$sql = "SELECT * FROM app";
$result2 = $conn->query($sql);
$result = $result2->fetch_assoc();


?>

<!DOCTYPE html>
<html dir="ltr" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  
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
    <script disable-devtool-auto src='https://cdn.jsdelivr.net/npm/disable-devtool@latest'></script>
    <link
      rel="icon"
      type="image/png"
      sizes="16x16"
      href="https://daanrox.com/assets/image/rox-footer.png"
    />
    <!-- Custom CSS -->
    <link href="assets/libs/flot/css/float-chart.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet" />
    
  </head>
    <style>
         #chart_div {
            width: 80%;
            margin: 50px auto;
        }
    </style>
  <body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
      <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
      </div>
    </div>
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
            <a class="navbar-brand" href="#">
              <!-- Logo icon -->
              
              <!-- Logo text -->
              <span class="logo-text ms-2">
                <!-- dark Logo text -->
                <img
                  src="https://daanrox.com/assets/image/daanrox-logo.png"
                  width="100%" height="50"
                  alt="homepage"
                  class="light-logo"
                />
              </span>
              <!-- Logo icon -->
              <!-- <b class="logo-icon"> -->
              <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
              <!-- Dark Logo icon -->
              <!-- <img src="../assets/images/logo-text.png" alt="homepage" class="light-logo" /> -->

              <!-- </b> -->
              <!--End Logo icon -->
            </a>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Toggle which is visible on mobile only -->
            <!-- ============================================================== -->
            <a
              class="nav-toggler waves-effect waves-light d-block d-md-none"
              href="javascript:void(0)"
              ><i class="ti-menu ti-close"></i
            ></a>
          </div>
          <!-- ============================================================== -->
          <!-- End Logo -->
          <!-- ============================================================== -->
          <div
            class="navbar-collapse collapse"
            id="navbarSupportedContent"
            data-navbarbg="skin5"
          >
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
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
    <aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
      <!-- Sidebar navigation-->
      <nav class="sidebar-nav">
        <ul id="sidebarnav" class="pt-4">
          <li class="sidebar-item">
            <a
              class="sidebar-link waves-effect waves-dark sidebar-link"
              href="#"
              aria-expanded="false"
              ><i class="mdi mdi-view-dashboard"></i
              ><span class="hide-menu">Página inicial</span></a
            >
          </li>
          <li class="sidebar-item">
            <a
              class="sidebar-link waves-effect waves-dark sidebar-link"
              href="GGR"
              aria-expanded="false"
              ><i class="mdi mdi-margin"></i
              ><span class="hide-menu">GGR</span></a
            >
          </li>
          <li class="sidebar-item">
            <a
              class="sidebar-link waves-effect waves-dark sidebar-link"
              href="usuarios"
              aria-expanded="false"
              ><i class="mdi mdi-account"></i
              ><span class="hide-menu">Usuários</span></a
            >
          </li>
          <li class="sidebar-item">
            <a
              class="sidebar-link waves-effect waves-dark sidebar-link"
              href="depositos"
              aria-expanded="false"
              ><i class="mdi mdi-cash"></i
              ><span class="hide-menu">Depositos</span></a
            >
          </li>
          <li class="sidebar-item">
            <a
              class="sidebar-link waves-effect waves-dark sidebar-link"
              href="saques"
              aria-expanded="false"
              ><i class="mdi mdi-cash"></i
              ><span class="hide-menu">Saques</span></a
            >
          </li>
          
          
           <li class="sidebar-item">
            <a
              class="sidebar-link waves-effect waves-dark sidebar-link"
              href="pixels"
              aria-expanded="false"
              ><i class="mdi mdi-code-tags"></i
              ><span class="hide-menu">Pixels</span></a
            >
          </li>
          
          
          
                   <li class="sidebar-item">
            <a
              class="sidebar-link waves-effect waves-dark sidebar-link"
              href="./gateway"
              aria-expanded="false"
              ><i class="mdi mdi-cash"></i
              ><span class="hide-menu">Gateway</span></a
            >
          </li>
          
            <li class="sidebar-item">
            <a
              class="sidebar-link waves-effect waves-dark sidebar-link"
              href="./config"
              aria-expanded="false"
              ><i class="mdi mdi-account"></i
              ><span class="hide-menu">Configurações</span></a
            >
          </li>

                  
          <li class="sidebar-item">
                            <a
                              class="sidebar-link waves-effect waves-dark sidebar-link"
                              href="planos"
                              aria-expanded="false"
                              ><i class="mdi mdi-square-inc-cash"></i
                              ><span class="hide-menu">Afiliados</span></a
                            >
                        </li>
                      
         
      
         
      
           <li class="sidebar-item">
                            <a
                              class="sidebar-link waves-effect waves-dark sidebar-link"
                              href="https://wa.me/5531992812273?text=Preciso+de+suporte+com+o+painel+adm"
                              target="_blank"
                              aria-expanded="false"
                              ><i class="mdi mdi-message"></i
                              ><span class="hide-menu">Suporte</span></a
                            >
                        </li>
        
        
        
        
            <li class="sidebar-item p-3">
            <a
              href="/adm/logout.php"
              
              class="
                w-100
                btn 
                d-flex
                align-items-center
                text-white
              "
              style="background-color: #ff7c6b"
              ><i class="mdi mdi-logout font-20 me-2"></i>Sair</a
            >
          </li>
        </ul>
      </nav>
      <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
  </aside>
      <!-- ============================================================== -->
      <!-- End Left Sidebar - style you can find in sidebar.scss  -->
      <!-- ============================================================== -->
      <!-- ============================================================== -->
      <!-- Page wrapper  -->
      <!-- ============================================================== -->
      <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
              <h4 class="page-title">Dashboard</h4>
              <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                
                </nav>
              </div>
            </div>
          </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
          <!-- ============================================================== -->
          <!-- Sales Cards  -->
          <!-- ============================================================== -->
          <div class="row">

            <div class="col-md-6 col-lg-3 col-xlg-3">
              <div class="card card-hover">
                <div class="box bg-success text-center">
                  <h1 class="font-light text-white">
                    <i class="mdi mdi-arrow-down-bold"></i>
                  </h1>
                  <h4 class="text-white" id="valorUsuarios4">0</h4>
                  <h6 class="text-white">Depósitos</h6>
                </div>
              </div>
            </div>



               <!-- ============================================================== -->
               <script>
                // Evento de clique ou outra ação que aciona a leitura
                $(document).ready(function () {
                    // Solicitação AJAX
                    $.ajax({
                        type: "GET",
                        url: "php/numero_depositos.php",
                        success: function (response) {
                            // Atualiza o valor exibido na página
                            $("#valorUsuarios4").text(response);
                            console.log(response); // Exibe a resposta do servidor no console
                        },
                        error: function (error) {
                            console.log("Erro na solicitação AJAX: " + error);
                        }
                    });
                });
              </script>





            <!-- Column -->
            <div class="col-md-6 col-lg-3 col-xlg-3">
              <div class="card card-hover">
                <div class="box bg-danger text-center">
                  <h1 class="font-light text-white">
                    <i class="mdi mdi-arrow-up-bold"></i>
                  </h1>
                  <h4 class="text-white">0</h4>
                  <h6 class="text-white">Saques</h6>
                </div>
              </div>
            </div>
            <!-- Column -->

            <div class="col-md-6 col-lg-3 col-xlg-3">
              <div class="card card-hover">
                <div class="box bg-success text-center">
                  <h1 class="font-light text-white">
                    <i class="mdi mdi-account-multiple"></i>
                  </h1>
                  <h4 class="text-white" id="valorUsuarios">0</h4>
                  <h6 class="text-white">Usuarios</h6>
                </div>
              </div>
            </div>

           

           
           
       
          
          </div>
 <!-- ============================================================== -->

 <script>
  // Evento de clique ou outra ação que aciona a leitura
  $(document).ready(function () {
      // Solicitação AJAX
      $.ajax({
          type: "GET",
          url: "php/app.php",
          success: function (response) {
              // Atualiza o valor exibido na página
              $("#valorUsuarios").text(response);
              console.log(response); // Exibe a resposta do servidor no console
          },
          error: function (error) {
              console.log("Erro na solicitação AJAX: " + error);
          }
      });
  });
</script>
       
          <!-- ============================================================== -->

 <!-- card new -->
 <div class="card">
  <div class="card-body">
    <h4 class="card-title mb-0">Novidades</h4>
  </div>
  <ul class="list-style-none">
    <li class="d-flex no-block card-body">
      <i class="mdi mdi-check-circle fs-4 w-30px mt-1"></i>
      <div>
        <a href="#" class="mb-0 font-medium p-0"
          >Atualizacão do Sistema de afiliados</a
        >
        <span class="text-muted"
          >Sistema em atualização</span
        >
      </div>
      <div class="ms-auto">
        <div class="tetx-right">
          <h5 class="text-muted mb-0">20</h5>
          <span class="text-muted font-16">Out</span>
        </div>
      </div>
    </li>
   
   
  </ul>
</div>
      

          <!-- ============================================================== -->

          <div class="row">



            <div class="col-md-6 col-lg-4 col-xlg-3">
              <div class="card card-hover">
                <div class="box bg-success text-center">
                  <h1 class="font-light text-white" id="valorUsuarios3">
                    R$ 0,00
                  </h1>
                  <h4 class="text-white" >Total depositado</h4>
                </div>
              </div>
            </div>



                      <!-- ============================================================== -->
                      <script>
                        // Evento de clique ou outra ação que aciona a leitura
                        $(document).ready(function () {
                            // Solicitação AJAX
                            $.ajax({
                                type: "GET",
                                url: "php/total_depositos.php",
                                success: function (response) {
                                    // Atualiza o valor exibido na página
                                    $("#valorUsuarios3").text(response);
                                    console.log(response); // Exibe a resposta do servidor no console
                                },
                                error: function (error) {
                                    console.log("Erro na solicitação AJAX: " + error);
                                }
                            });
                        });
                      </script>
       
          <!-- ============================================================== -->



        
            <!-- Column -->
            <div class="col-md-6 col-lg-4 col-xlg-3">
              <div class="card card-hover">
                <div class="box bg-danger text-center">
                 
                    <h1 class="font-light text-white" id="valorUsuarios2">
                     0
                    </h1>
                    <h4 class="text-white">Total de cadastros</h4>
                </div>
              </div>
            </div>


             <!-- ============================================================== -->

 <script>
  // Evento de clique ou outra ação que aciona a leitura
  $(document).ready(function () {
      // Solicitação AJAX
      $.ajax({
          type: "GET",
          url: "php/app.php",
          success: function (response) {
              // Atualiza o valor exibido na página
              $("#valorUsuarios2").text(response);
              console.log(response); // Exibe a resposta do servidor no console
          },
          error: function (error) {
              console.log("Erro na solicitação AJAX: " + error);
          }
      });
  });
</script>
       
          <!-- ============================================================== -->




            <!-- Column -->
            <div class="col-md-6 col-lg-4 col-xlg-3">
              <div class="card card-hover">
                <div class="box bg-danger text-center">
                  <h1 class="font-light text-white">
                    R$ 0,00
                  </h1>
                  <h4 class="text-white">Total de Saques</h4>
                 

                </div>
              </div>
            </div>
             <!-- Column -->




             <style>
              /* Adicione estilos personalizados aqui */
              .custom-input {
                  width: 100px; /* Ajuste a largura conforme necessário */
                  
                  background-color: transparent;
                  color: white;
                  display: inline-block; /* Adiciona o input na mesma linha */
                  font-weight: 700;
                  font-size: 18px;
              }
          </style>

              <!-- card new -->

           


<div class="card">
  <div class="card-body">
    <div class="card-body">
      <h4 class="card-title mb-0">Configurações gerais</h4>
    </div>
<div class="row">

 <!-- ------------------------------------------------------------------------------------------------------- -->

<div class="col-md-6 col-lg-3 col-xlg-3 mb-3">
    <div class="card card-hover">
        <div class="box bg-dark text-center">
            <h1 class="font-light text-white">
                <i class="mdi mdi-arrow-down-bold"></i>
            </h1>
            <h5 class="text-white">Depósito Mínimo</h5>
            <h7 class="text-white">R$:</h7>
            <form action="/adm/processos.php?opcao=depositoMin" method="post" id="editForm3">  
                <input type="text" class="form-control custom-input" value="<?php echo $result['deposito_min'] ?>" id="valorApostaMax" placeholder="Digite o valor" name="valor" required>
                <br>
                <br>
                <button type="submit" class="btn btn-primary">Atualizar</button>
            </form>
        </div>
    </div>
</div>

<script>
    function enviarAtualizacao(opcao, value){
        console.log(opcao)
        console.log(value)
        requisicao = `./processos.php?opcao=${opcao}&value=${value}`;

        window.location.href = requisicao;
    }
</script>


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
function atualizarValor() {
    var novoValor = $("#valorDeposito").val();
    console.log("Novo Valor:", novoValor);

    $.ajax({
        type: "POST",
        url: "php/atualizar_deposito_minimo.php",
        data: { novo_valor: novoValor },
        success: function(response) {
            console.log(response);
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}
</script>
 <!-- ------------------------------------------------------------------------------------- -->
 <?php
include './../conectarbanco.php';

$conn = new mysqli('localhost', $config['db_user'], $config['db_pass'], $config['db_name']);


if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

?>

<div class="col-md-6 col-lg-3 col-xlg-3 mb-3">
    <div class="card card-hover">
        <div class="box bg-dark text-center">
            <h1 class="font-light text-white">
                <i class="mdi mdi-arrow-up-bold"></i>
            </h1>
            <h5 class="text-white">Saque Mínimo</h5>
            <h7 class="text-white">R$:</h7>
            <form action="/adm/processos.php?opcao=saqueMin" method="post" id="editForm3">  
                <input type="text" class="form-control custom-input" value="<?php echo $result['saques_min'] ?>" id="valorSaqueMin"   placeholder="Digite o valor" name="valor" required>
                <br>
                <br>
                <button type="submit" class="btn btn-primary">Atualizar</button>
            </form>
        </div>
    </div>
</div>
 <!-- ------------------------------------------------------------------------------------- -->

  <div class="col-md-6 col-lg-3 col-xlg-3 mb-3"> <!-- Adicionado mb-3 para margem inferior -->
    <div class="card card-hover">
      <div class="box bg-dark text-center">
        <h1 class="font-light text-white">
          <i class="mdi mdi-cash-multiple"></i>
        </h1>
        <h5 class="text-white">Aposta Máxima</h5>
        <h7 class="text-white">R$:</h7>
        <form action="/adm/processos.php?opcao=apostaMax" method="post" id="editForm3">  
                <input type="text" class="form-control custom-input" value="<?php echo $result['aposta_max'] ?>" id="valorSaqueMin" placeholder="Digite o valor" name="valor" required>
                <br>
                <br>
                <button type="submit" class="btn btn-primary">Atualizar</button>
            </form>
      </div>
    </div>
  </div>
 <!-- ------------------------------------------------------------------------------------- -->
  <div class="col-md-6 col-lg-3 col-xlg-3 mb-3">
    <div class="card card-hover">
        <div class="box bg-dark text-center">
            <h1 class="font-light text-white">
                <i class="mdi mdi-chemical-weapon"></i>
            </h1>
            <h5 class="text-white">Dificuldade do Jogo</h5>
            <h7 class="text-white">Velocidade</h7>
            <form action="/adm/processos.php?opcao=dificuldadeJogo"  method="post" id="editForm3">  
                <!-- Adicione o campo de dropdown aqui -->
                <select  name="valor" class="form-select custom-input" aria-label="Escolha a dificuldade">
                    <option <?php echo ($result['dificuldade_jogo'] == 'facil') ? 'selected' : ''; ?> value="facil">Fácil</option>
                    <option <?php echo ($result['dificuldade_jogo'] == 'medio') ? 'selected' : ''; ?> value="medio">Médio</option>
                    <option <?php echo ($result['dificuldade_jogo'] == 'dificil') ? 'selected' : ''; ?> value="dificil">Difícil</option>
                </select>
                <br>
                <br>
            <button type="submit" class="btn btn-primary" onclick="atualizarValor4()">Atualizar</button>
            </form>
        </div>
    </div>
</div>

  <div class="col-md-6 col-lg-3 col-xlg-3 mb-3"> <!-- Adicionado mb-3 para margem inferior -->
    <div class="card card-hover">
      <div class="box bg-dark text-center">
        <h1 class="font-light text-white">
          <i class="mdi mdi-cash-multiple"></i>
        </h1>
        <h5 class="text-white">Aposta Mínima</h5>
        <h7 class="text-white">R$:</h7>
        <form action="/adm/processos.php?opcao=apostaMin" method="post" id="editForm3">  
            <input type="text" class="form-control custom-input" value="<?php echo $result['aposta_min'] ?>" id="valorSaqueMin" placeholder="Digite o valor" name="valor" required>
            <br>
            <br>
            <button type="submit" class="btn btn-primary">Atualizar</button>
        </form>
        </div>
    </div>
  </div>
  

  <div class="col-md-6 col-lg-3 col-xlg-3 mb-3"> <!-- Adicionado mb-3 para margem inferior -->
    <div class="card card-hover">
      <div class="box bg-dark text-center">
        <h1 class="font-light text-white">
          <i class="mdi mdi-filter-variant"></i>
        </h1>
        <h5 class="text-white">Rollover do Saque</h5>
        <h7 class="text-white">X</h7>
        <form action="/adm/processos.php?opcao=rolloverSaque" method="post" id="editForm3">  
            <input type="text" class="form-control custom-input" value="<?php echo $result['rollover_saque'] ?>" id="valorSaqueMin" placeholder="Digite o valor" name="valor" required>
            <br>
            <br>
            <button type="submit" class="btn btn-primary">Atualizar</button>
        </form>
                 
      </div>
    </div>
  </div>

  <div class="col-md-6 col-lg-3 col-xlg-3 mb-3"> <!-- Adicionado mb-3 para margem inferior -->
    <div class="card card-hover">
      <div class="box bg-dark text-center">
        <h1 class="font-light text-white">
          <i class="mdi mdi-margin"></i>
        </h1>
        <h5 class="text-white">Taxa de Saque</h5>
        <h7 class="text-white">R%</h7>
        <form action="/adm/processos.php?opcao=taxaSaque" method="post" id="editForm3">  
            <input type="text" class="form-control custom-input" value="<?php echo $result['taxa_saque'] ?>" id="valorSaqueMin" placeholder="Digite o valor" name="valor" required>
            <br>
            <br>
            <button type="submit" class="btn btn-primary">Atualizar</button>
        </form>
             
      </div>
    </div>
    
  </div>
</div>

        <div id="chart_div"></div>
        
        
        <script>
            $.ajax({
              url: 'bd.php',
              method: 'GET',
              success: function(data) {
                // Limpar o corpo da tabela
                $('#table-body').empty();
                
        
                // Inserir dados na tabela
                data.forEach(function(row) {
                    var newRow = "<tr>" +
                    "<td>" + row.email + "</td>" +
                    "<td>" + row.telefone + "</td>" +
                    "<td>" + row.saldo + "</td>" +
                    "<td>" + row.plano + "</td>" +
                    "<td>" + row.depositou + "</td>" +
                    "<td>" + row.saldo_comissao + "</td>" +
                    "<td>" + row.percas + "</td>" +
                    "<td>" + row.ganhos + "</td>" +
                    "<td>" + row.cpa + "</td>" +
                    "<td><button class='btn-edit' data-id='" + row.id + "'>Editar</button></td>" +
                    "</tr>";
                  $('#table-body').append(newRow);
                });
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {
                // Obtém os dados do PHP usando Ajax
                var jsonData = $.ajax({
                    url: "data.php",
                    dataType: "json",
                    async: false
                }).responseText;
            
                // Converte os dados JSON em um array
                var data = new google.visualization.arrayToDataTable(JSON.parse(jsonData));
            
                // Configurações do gráfico
                var options = {
                    title: 'My Daily Activities',
                    pieHole: 0.4,
                };
            
                // Cria o gráfico e o coloca no elemento com o ID 'chart_div'
                var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
                chart.draw(data, options);
            }
        </script>
          
          </div>
       
        </div>
        
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <footer class="footer text-center">
          Desenvolvido por
          <a href="https://daanrox.com/" target='_blank'>DAANROX</a>.
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
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="dist/js/custom.min.js"></script>
    <!--This page JavaScript -->
    <!-- <script src="../dist/js/pages/dashboards/dashboard1.js"></script> -->
    <!-- Charts js Files -->
    <script src="assets/libs/flot/excanvas.js"></script>
    <script src="assets/libs/flot/jquery.flot.js"></script>
    <script src="assets/libs/flot/jquery.flot.pie.js"></script>
    <script src="assets/libs/flot/jquery.flot.time.js"></script>
    <script src="assets/libs/flot/jquery.flot.stack.js"></script>
    <script src="assets/libs/flot/jquery.flot.crosshair.js"></script>
    <script src="assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
    <script src="dist/js/pages/chart/chart-page-init.js"></script>
    <link rel="stylesheet" href="https://cdn.positus.global/production/resources/robbu/whatsapp-button/whatsapp-button.css">
      <a id="robbu-whatsapp-button" target="_blank" href="https://api.whatsapp.com/send?phone=5531992812273&text=Ol%C3%A1,%20vim%20pelo%20site%20e%20gostaria%20de%20tirar%20uma%20d%C3%BAvida%20sobre%20abrir%20uma%20plataforma%20de%20apostas%20ou%20problemas%20em%20algum%20de%20seus%20sites.">
        <div class="rwb-tooltip">Entre em contato!</div>
        <img src="https://cdn.positus.global/production/resources/robbu/whatsapp-button/whatsapp-icon.svg">
      </a>
  </body>
</html>
