<?php
include 'db/connection.php';
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
  // Redirecione para outra página
  header('Location: login.php');
  exit;
}

?>

<!doctype html>
<html lang="en" class="h-100" data-bs-theme="auto">

<head>
  <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.css" />
</head>

<body>

  <section class="ms-5 mt-5 p-4">
    <h2 class="text-center">Audiência</h2>
    <div class="row">
      <div class="container">
        <div class="btnAdd">
          <a class="mb-xs mt-xs mr-xs btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAudience"><i class=" fa fa-plus"></i> Cadastrar</a>

          <button type="button" name="add" id="addEmployee" class="mb-xs mt-xs mr-xs btn btn-info"><i class="fa fa-print"></i> Geral</button>
          <button type="button" name="add" id="addEmployee" class="mb-xs mt-xs mr-xs btn btn-success"><i class="fa fa-print"></i> Cidades</button>

          <a class="mb-xs mt-xs mr-xs btn btn-danger" href="views/audiencia/dropAudiencia.php"><i class=" fa fa-bug"></i> DROP Tabela</a>
        </div>
        <div class="row">
          <div class="col-md-1"></div>
          <div class="col-md-12">
            <table id="example" class="table table-bordered table-striped mb-none">
              <thead>
                <th>Id</th>
                <th>TIPO</th>
                <th>NOME</th>
                <th>PASTOR</th>
                <th>ESTADO</th>
                <th>CIDADE</th>
                <th>PAIS</th>
                <th>Ações</th>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
          <div class="col-md-2"></div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modalAudience" tabindex="-1" aria-labelledby="modalAudience" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form id="FormAudience" method="POST" action="">
            <div class="modal-header">
              <h5 class="modal-title">Comunicar audiência</h5>
            </div>
            <span id="msg-error-aud"></span>
            <div class="modal-body">
              <div class="col-md-12">
                <div class="row">
                  <div class="col-lg-3">
                    <div class="custom-control custom-radio mb-3">
                      <input id="church" name="typeNotification" value="1" class="custom-control-input" type="radio">
                      <label class="custom-control-label" for="church">
                        <span>Irmãos</span>
                      </label>
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="custom-control custom-radio mb-3">
                      <input name="typeNotification" value="2" class="custom-control-input" id="brother" type="radio">
                      <label class="custom-control-label" for="brother">
                        <span>Igreja</span>
                      </label>
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="custom-control custom-radio mb-3">
                      <input name="typeNotification" value="3" class="custom-control-input" id="exterior" type="radio">
                      <label class="custom-control-label" for="exterior">
                        <span>Exterior</span>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <div id="contentAudience" class="hidden">
                <input type="hidden" name="id" id="id" value="">
                <input type="hidden" name="trid" id="trid" value="">

                <div class="form-group" id="nameAudienceDiv">
                  <label for="nameAudience">Nome:</label>
                  <input type="text" name="name" class="form-control" id="nameAudience" placeholder="Digite o seu nome aqui" style="color: #000000;">
                </div>
                <div class="form-group" id="ministerDiv">
                  <label for="minister">Pastor:</label>
                  <input type="text" name="minister" class="form-control" id="minister" placeholder="Digite o nome do pastor aqui" style="color: #000000;">
                </div>

                <div class="form-group focused" id="stateAudienceDiv">
                  <label for="stateAudience">Estado:</label>
                  <select class="form-control" data-tf="state" data-tf-to="#stateCodeAudience" id="stateAudience" name="stateCode" style="color: #000000;">
                    <?php
                    $result_estadoaud       = "SELECT * FROM estado";
                    $resultado_estadoaud    = mysqli_query($con, $result_estadoaud);
                    while ($row_estadoaud = mysqli_fetch_assoc($resultado_estadoaud)) { ?>
                      <option value="<?php echo $row_estadoaud['id']; ?>"><?php echo $row_estadoaud['nome']; ?></option> <?php
                                                                                                                        }
                                                                                                                          ?>
                  </select>
                </div>

                <div class="form-group" id="countryCodeDiv">
                  <label for="countryCode">País:</label>
                  <select class="form-control" id="countryCode" name="countryCode" style="color: #000000;">
                    <?php
                    $result_pais       = "SELECT * FROM pais";
                    $resultado_pais    = mysqli_query($con, $result_pais);
                    while ($row_pais = mysqli_fetch_assoc($resultado_pais)) { ?>
                      <option value="<?php echo $row_pais['id']; ?>"><?php echo $row_pais['nome']; ?></option> <?php
                                                                                                              }
                                                                                                                ?>
                  </select>
                </div>
                <div class="form-group" id="cityIrmaosDiv">
                  <label for="cityIrmaos">Cidade:</label>
                  <select class="form-control" id="cityIrmaosCode" name="cityIrmaosCode" style="color: #000000; display: none">
                  </select>
                </div>
                <div class="form-group" id="cityNameDiv">
                  <label for="cityName">Cidade:</label>
                  <input type="text" name="cityName" class="form-control" id="cityName" placeholder="Digite o nome da cidade aqui" style="color: #000000;">
                </div>
                <div class="form-group">
                  <label for="numberBrothers">Nro. de irmãos:</label>
                  <input type="number" class="form-control" name="numberBrothers" id="numberBrothers" placeholder="Digite o número aqui">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger btn-md" data-bs-dismiss="modal">Fechar</button>
              <button type="submit" class="btn btn-success" btn-md>Enviar</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- EDIÇÃO DA AUDIENCIA -->

    <div class="modal fade" id="audienciaModalEdit" tabindex="-1" aria-labelledby="audienciaModalEditLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="audienciaModalEditLabel">Alterar Audiência</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="updateAudiencia">
              <input type="hidden" name="id" id="id" value="">
              <input type="hidden" name="trid" id="trid" value="">

              <div class="col-md-12">
                <div class="row">
                  <div class="col-lg-3">
                    <div class="custom-control custom-radio mb-3">
                      <input id="church" name="fieldTypeNotification" value="1" class="custom-control-input" type="radio">
                      <label class="custom-control-label" for="church">
                        <span>Irmãos</span>
                      </label>
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="custom-control custom-radio mb-3">
                      <input name="fieldTypeNotification" value="2" class="custom-control-input" id="brother" type="radio">
                      <label class="custom-control-label" for="brother">
                        <span>Igreja</span>
                      </label>
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="custom-control custom-radio mb-3">
                      <input name="fieldTypeNotification" value="3" class="custom-control-input" id="exterior" type="radio">
                      <label class="custom-control-label" for="exterior">
                        <span>Exterior</span>
                      </label>
                    </div>
                  </div>
                </div>
              </div>

              <div id="contentAudience" class="hidden">
                <div class="form-group" id="nameAudienceDiv">
                  <label for="fieldNameAudience">Nome:</label>
                  <input type="text" name="fieldNameAudience" class="form-control" id="fieldNameAudience" placeholder="Digite o seu nome aqui" style="color: #000000;">
                </div>
                <div class="form-group" id="ministerDiv">
                  <label for="fieldMinister">Pastor:</label>
                  <input type="text" name="fieldMinister" class="form-control" id="fieldMinister" placeholder="Digite o nome do pastor aqui" style="color: #000000;">
                </div>
                <div class="form-group" id="ministerDiv">
                  <label for="fieldStateAudience">Estado:</label>
                  <input type="text" name="fieldStateAudience" class="form-control" id="fieldStateAudience" placeholder="Informe o Estado" style="color: #000000;">
                </div>
                <div class="form-group" id="ministerDiv">
                  <label for="fieldCountryCode">Pais:</label>
                  <input type="text" name="fieldCountryCode" class="form-control" id="fieldCountryCode" placeholder="Informe o Pais" style="color: #000000;">
                </div>
                <div class="form-group" id="cityNameDiv">
                  <label for="fieldCityName">Cidade:</label>
                  <input type="text" name="fieldCityName" class="form-control" id="fieldCityName" placeholder="Digite o nome da cidade aqui" style="color: #000000;">
                </div>
                <div class="form-group">
                  <label for="fieldNumberBrothers">Nro. de irmãos:</label>
                  <input type="number" class="form-control" name="fieldNumberBrothers" id="fieldNumberBrothers" placeholder="Digite o número aqui">
                </div>
              </div>

              <div class="modal-footer">
                <button type="submit" class="btn btn-success">Confirmar</button>
                <button type="button" class="btn btn-danger btn-md" data-bs-dismiss="modal">Fechar</button>
              </div>
          </div>
        </div>
      </div>


  </section>




  <!-- Optional JavaScript; choose one of the two! -->
  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="assets/js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
  <script src="assets/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="assets/js/dt-1.10.25datatables.min.js"></script>
  <script src="assets/js/init.js"></script>
  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
  -->

  <script type="text/javascript">
    $(document).ready(function() {
      $('#example').DataTable({
        "fnCreatedRow": function(nRow, aData, iDataIndex) {
          $(nRow).attr('id', aData[0]);
        },
        'serverSide': 'true',
        'processing': 'true',
        'paging': 'true',
        'order': [],
        'ajax': {
          'url': 'views/audiencia/manyAudiencia.php',
          'type': 'post',
        },
        "aoColumnDefs": [{
          "bSortable": false,
          "aTargets": [7]
        }, ]
      });
    });

    // $(document).on('submit', '#addUser', function(e) {
    //   e.preventDefault();
    //   var tipo = $('#typeNotification').val();
    //   var nome = $('#nameAudience').val();
    //   var pastor = $('#minister').val();
    //   var estado = $('#stateAudience').val();
    //   var cidade = $('#cityIrmaosCode').val();
    //   var pais = $('#countryCode').val();
    //   var nmr = $('#numberBrothers').val();
    //   if (tipo != '' && nome != '' && pastor != '' && estado != '' && cidade != '' && pais != '' && nmr != '') {
    //     $.ajax({
    //       url: "views/audiencia/addAudiencia.php",
    //       type: "post",
    //       data: {
    //         tipo: tipo,
    //         nome: nome,
    //         pastor: pastor,
    //         estado: estado,
    //         cidade: cidade,
    //         pais: pais,
    //         nmr: nmr
    //       },
    //       success: function(data) {
    //         var json = JSON.parse(data);
    //         var status = json.status;
    //         if (status == 'true') {
    //           mytable = $('#example').DataTable();
    //           mytable.draw();
    //           $('#modalAudience').modal('hide');
    //         } else {
    //           alert('failed');
    //         }
    //       }
    //     });
    //   } else {
    //     alert('Fill all the required fields');
    //   }
    // });


    $(document).on('submit', '#updateAudiencia', function(e) {
      e.preventDefault();
      //var tr = $(this).closest('tr');
      var tipo = $('#fieldTypeNotification').val();
      var nome = $('#fieldNameAudience').val();
      var pastor = $('#fieldMinister').val();
      var estado = $('#fieldStateAudience').val();
      var cidade = $('#fieldCityName').val();
      var pais = $('#fieldCountryCode').val();
      var nmr = $('#fieldNumberBrothers').val();
      var id = $('#id').val();
      if (tipo != '' && nome != '' && pastor != '' && estado != '' && cidade != '' && pais != '' && nmr != '') {
        $.ajax({
          url: "views/audiencia/updateAudiencia.php",
          type: "post",
          data: {
            tipo: tipo,
            nome: nome,
            pastor: pastor,
            estado: estado,
            cidade: cidade,
            pais: pais,
            nmr: nmr,
            id: id
          },
          success: function(data) {
            var json = JSON.parse(data);
            var status = json.status;
            if (status == 'true') {
              table = $('#example').DataTable();
              // table.cell(parseInt(trid) - 1,0).data(id);
              // table.cell(parseInt(trid) - 1,1).data(username);
              // table.cell(parseInt(trid) - 1,2).data(email);
              // table.cell(parseInt(trid) - 1,3).data(mobile);
              // table.cell(parseInt(trid) - 1,4).data(city);
              var button = '<td><a href="javascript:void();" data-id="' + id + '" class="btn btn-info btn-sm editbtn">Edit</a>  <a href="#!"  data-id="' + id + '"  class="btn btn-danger btn-sm deleteBtn">Delete</a></td>';
              var row = table.row("[id='" + trid + "']");
              row.row("[id='" + trid + "']").data([id, nome, pastor, estado, cidade, pais, nmr, button]);
              $('#exampleModal').modal('hide');
              window.location.href = "<?php echo "index.php?a=audiencia.php"; ?>";
            } else {
              alert('Erro');
            }
          }
        });
      } else {
        alert('Prenecha todos os campos.');
      }
      window.location.href = "<?php echo "index.php?a=audiencia.php"; ?>";
    });


    $('#example').on('click', '.editbtn ', function(event) {
      var table = $('#example').DataTable();
      var trid = $(this).closest('tr').attr('id');
      // console.log(selectedRow);
      var id = $(this).data('id');
      $('#audienciaModalEdit').modal('show');

      $.ajax({
        url: "views/audiencia/getAudiencia.php",
        data: {
          id: id
        },
        type: 'post',
        success: function(data) {

          var json = JSON.parse(data);
          $('#fieldTypeNotification').val(json.tipo);
          $('#fieldNameAudience').val(json.nome);
          $('#fieldMinister').val(json.pastor);
          $('#fieldStateAudience').val(json.estado);
          $('#fieldCountryCode').val(json.pais);
          $('#fieldCityName').val(json.cidade);
          $('#fieldNumberBrothers').val(json.nmr);
          $('#id').val(id);
          $('#trid').val(trid);
        }
      })
    });

    $(document).on('click', '.deleteBtn', function(event) {
      var table = $('#example').DataTable();
      event.preventDefault();
      var id = $(this).data('id');
      if (confirm("Confirma exclusão ? ")) {
        $.ajax({
          url: "views/audiencia/deleteAudiencia.php",
          data: {
            id: id
          },
          type: "post",
          success: function(data) {
            var json = JSON.parse(data);
            status = json.status;
            if (status == 'success') {
              //table.fnDeleteRow( table.$('#' + id)[0] );
              //$("#example tbody").find(id).remove();
              //table.row($(this).closest("tr")) .remove();
              $("#" + id).closest('tr').remove();
            } else {
              alert('Failed');
              return;
            }
          }
        });
      } else {
        return null;
      }
    })
  </script>

  <script>
    $('#lstmotivopedido').on("change", function() {
      var par_request = $(this).val();
      if (par_request == "19") {
        $('#requestPrayer').css({
          'display': 'block'
        });
      }
    });

    $('#notificationForm').on('submit', function(e) {
      e.preventDefault();
      var formObj = this;
      var form = $(this).serialize();
      $.post('welcome/storeNotification', form, function(response) {
        var divContent = normalizeAlert(response);
        $('#alertContent').empty();
        $('#alertContent').prepend(divContent);
        $('#modalNotification').modal('hide');
        $(formObj)[0].reset();
      });
    });

    $('#audienceForm').on('submit', function(e) {
      e.preventDefault();
      if ($("input[type=radio][name=typeNotification]:checked").length == 0) {
        return;
      }
      var formObj = this;
      var form = $(this).serialize();
      $.post('welcome/storeAudience', form, function(response) {
        var divContent = normalizeAlert(response);
        $('#alertContent').empty();
        $('#alertContent').prepend(divContent);
        $('#modalAudience').modal('hide');
        $(formObj)[0].reset();
      });
    });

    $('input[type=radio][name=typeNotification]').change(function() {
      $('#contentAudience').removeClass('hidden');
      if (this.value === '2') {
        $('#ministerDiv').show();
        $('#stateAudienceDiv').show();
        $('#cityIrmaosDiv').show();


        $('#nameAudienceDiv').hide();
        $('#cityCodeAudienceDiv').hide();
        $('#countryCodeDiv').hide();
        $('#cityNameDiv').hide();

        $('#nameAudience').val('');
        $('#minister').val('');
        $('#stateAudience').val('');
        $('#cityIrmaosCode').val('');
        $('#cityName').val('');
        $('#countryCode').val('');
        $('#numberBrothers').val('');
      } else if (this.value === '1') {
        $('#nameAudienceDiv').show();
        $('#stateAudienceDiv').show();
        $('#cityCodeAudienceDiv').show();
        $('#cityIrmaosDiv').show();
        $('#ministerDiv').show();

        $('#cityCodeAudienceDiv').hide();
        $('#countryCodeDiv').hide();
        $('#cityNameDiv').hide();

        $('#nameAudience').val('');
        $('#minister').val('');
        $('#stateAudience').val('');
        $('#cityIrmaosCode').val('');
        $('#cityName').val('');
        $('#countryCode').val('');
        $('#numberBrothers').val('');
      } else if (this.value === '3') {
        $('#nameAudienceDiv').show();
        $('#countryCodeDiv').show();
        $('#cityNameDiv').show();

        $('#stateAudienceDiv').hide();
        $('#cityCodeAudienceDiv').hide();
        $('#cityIrmaosDiv').hide();
        $('#stateAudienceDiv').hide();
        $('#ministerDiv').hide();

        $('#nameAudience').val('');
        $('#minister').val('');
        $('#stateAudience').val('');
        $('#cityIrmaosCode').val('');
        $('#cityName').val('');
        $('#countryCode').val('');
        $('#numberBrothers').val('');
      }
    });

    function normalizeAlert(response) {
      response = JSON.parse(response);
      var divContent = $('#templateAlertContent').text();
      if (response.success) {
        divContent = divContent.replace('%%icon%%', 'ni-like-2');
        divContent = divContent.replace('%%type%%', 'success');
        return divContent.replace('%%message%%', response.message);
      }
      divContent = divContent.replace('%%icon%%', 'ni-bell-55');
      divContent = divContent.replace('%%type%%', 'danger');
      return divContent.replace('%%message%%', response.message);
    }

    $('#stateCodePrayer').on("change", function() {
      var idEstado = $("#stateCodePrayer").val();
      $.ajax({
        url: 'views/audiencia/getCidades.php',
        type: 'POST',
        data: {
          id: idEstado
        },
        beforeSend: function() {
          $('#cityCodePrayer').css({
            'display': 'block'
          });
          $('#cityCodePrayer').html("Carregando...");
        },
        success: function(data) {
          $('#cityCodePrayer').css({
            'display': 'block'
          });
          $('#cityCodePrayer').html(data);
        },
        error: function(data) {
          $('#cityCodePrayer').css({
            'display': 'block'
          });
          $('#cityCodePrayer').html("Houve um erro ao carregar");
        }
      });
    })

    $('#stateAudience').on("change", function() {
      var idEstado = $("#stateAudience").val();
      $.ajax({
        url: 'views/audiencia/getCidades.php',
        type: 'POST',
        data: {
          id: idEstado
        },
        beforeSend: function() {
          $('#cityIrmaosCode').css({
            'display': 'block'
          });
          $('#ccityIrmaosCode').html("Carregando...");
        },
        success: function(data) {
          $('#cityIrmaosCode').css({
            'display': 'block'
          });
          $('#cityIrmaosCode').html(data);
        },
        error: function(data) {
          $('#cityIrmaosCode').css({
            'display': 'block'
          });
          $('#cityIrmaosCode').html("Houve um erro ao carregar");
        }
      });
    })

    //GRAVAR ORAÇÃO NO BANCO DE DADOS
    $(document).ready(function() {

      $('#prayerForm').on('submit', function(event) {
        event.preventDefault();
        //validar dados do formulario oração
        if ($('#namePrayer').val() == "") {
          $("#msg-error").html('<div class="alert alert-danger" role="alert">Preencha o nome!</div>');
        } else if ($('#stateCodePrayer').val() == undefined) {
          $("#msg-error").html('<div class="alert alert-danger" role="alert">Preencha o estado!</div>');
        } else if ($('#cityCodePrayer').val() == undefined) {
          $("#msg-error").html('<div class="alert alert-danger" role="alert">Preencha a cidade!</div>');
        } else if ($('#lstmotivopedido').val() == "") {
          $("#msg-error").html('<div class="alert alert-danger" role="alert">Informe o motivo do pedido!</div>');
        } else {
          //Receber os dados do formulário
          var oracao = $("#prayerForm").serialize();
          $.post("compiler/processa_oracao.php", oracao, function(retorna) {
            if (retorna) {
              //Alerta de cadastro realizado com sucesso
              //$("#msg").html('<div class="text-success" role="alert">Oração enviada com sucesso!</div>');
              alert("Pedido de oração enviado com sucesso!!")
              // $("#msg").html(retorna);
              //Limpar os campo
              $('#prayerForm')[0].reset();

              //Fechar a janela modal cadastrar
              $('#modalPrayer').modal('hide');
            } else {}
          });
        }
      });



      $('#FormAudience').on('submit', function(event) {
        event.preventDefault();
        //VALIDAÇÃO AUDIENCIA - IGREJA
        if ($("input[name='typeNotification']:checked").val() == '2') {
          if ($('#minister').val() == "") {
            $("#msg-error-aud").html('<div class="alert alert-danger" role="alert">Preencha o nome do seu pastor!</div>');
          } else if ($('#stateAudience').val() == undefined) {
            $("#msg-error-aud").html('<div class="alert alert-danger" role="alert">Escolha seu estado!</div>');
          } else if ($('#cityIrmaosCode').val() == undefined) {
            $("#msg-error-aud").html('<div class="alert alert-danger" role="alert">Escolha sua cidade!</div>');
          } else if ($('#numberBrothers').val() == "") {
            $("#msg-error-aud").html('<div class="alert alert-danger" role="alert">Informe o número de pessoas assistindo!</div>');
          } else {
            //Receber os dados do formulário
            var audience = $("#FormAudience").serialize();
            $.post("views/audiencia/addAudicencia.php", audience, function(retorna) {
              if (retorna) {
                //Alerta de cadastro realizado com sucesso
                //$("#msg").html('<div class="text-success" role="alert">Audiência enviada com sucesso!</div>');
                alert("Audiência enviada com sucesso!!")
                // $("#msg").html(retorna);
                //Limpar os campo
                $('#FormAudience')[0].reset();
                //Fechar a janela modal cadastrar
                $('#modalAudience').modal('hide');
                window.location.href = "<?php echo "index.php?a=audiencia.php"; ?>";
              } else {}
            });
          }
        }
        //FIM VALIDADÇÃO AUDIÊNCIA - IGREJA
        //VALIDAÇÃO AUDIENCIA - IRMAOS
        if ($("input[name='typeNotification']:checked").val() == '1') {
          if ($('#nameAudience').val() == "") {
            $("#msg-error-aud").html('<div class="alert alert-danger" role="alert">Preencha o nome!</div>');
          } else if ($('#minister').val() == "") {
            $("#msg-error-aud").html('<div class="alert alert-danger" role="alert">Preencha o nome do seu pastor!</div>');
          } else if ($('#stateAudience').val() == undefined) {
            $("#msg-error-aud").html('<div class="alert alert-danger" role="alert">Escolha seu estado!</div>');
          } else if ($('#cityIrmaosCode').val() == "") {
            $("#msg-error-aud").html('<div class="alert alert-danger" role="alert">Escolha sua cidade!</div>');
          } else if ($('#numberBrothers').val() == "") {
            $("#msg-error-aud").html('<div class="alert alert-danger" role="alert">Informe o número de pessoas assistindo!</div>');
          } else {
            //Receber os dados do formulário
            var audience = $("#FormAudience").serialize();
            $.post("views/audiencia/addAudicencia.php", audience, function(retorna) {
              if (retorna) {
                //Alerta de cadastro realizado com sucesso
                //$("#msg").html('<div class="text-success" role="alert">Audiência enviada com sucesso!</div>');
                alert("Audiência enviada com sucesso!!")
                // $("#msg").html(retorna);
                //Limpar os campo
                $('#FormAudience')[0].reset();
                //Fechar a janela modal cadastrar
                $('#modalAudience').modal('hide');
                window.location.href = "<?php echo "index.php?a=audiencia.php"; ?>";
              }
            });
          }
        }
        //FIM VALIDADÇÃO AUDIÊNCIA - IRMÃOS
        //VALIDAÇÃO AUDIENCIA - EXTERIOR
        if ($("input[name='typeNotification']:checked").val() == '3') {
          if ($('#nameAudience').val() == "") {
            $("#msg-error-aud").html('<div class="alert alert-danger" role="alert">Preencha seu nome!</div>');
          } else if ($('#countryCode').val() == undefined) {
            $("#msg-error-aud").html('<div class="alert alert-danger" role="alert">Escolha seu país!</div>');
          } else if ($('#cityName').val() == "") {
            $("#msg-error-aud").html('<div class="alert alert-danger" role="alert">Escolha sua cidade!</div>');
          } else if ($('#numberBrothers').val() == "") {
            $("#msg-error-aud").html('<div class="alert alert-danger" role="alert">Informe o número de pessoas assistindo!</div>');
          } else {
            //Receber os dados do formulário
            var audience = $("#FormAudience").serialize();
            $.post("views/audiencia/addAudicencia.php", audience, function(retorna) {
              if (retorna) {
                //Alerta de cadastro realizado com sucesso
                alert("Audiência enviada com sucesso!!")
                //$("#msg").html('<div class="text-success" role="alert">Audiência enviada com sucesso!</div>');
                // $("#msg").html(retorna);
                //Limpar os campo
                $('#FormAudience')[0].reset();
                //Fechar a janela modal cadastrar
                $('#modalAudience').modal('hide');
                window.location.href = "<?php echo "index.php?a=audiencia.php"; ?>";
              } else {}
            });
          }
        }
        //FIM VALIDADÇÃO AUDIÊNCIA - EXTERIOR
      });

    });
  </script>


  <!-- Modal EDITAR -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="updateUser">
            <input type="hidden" name="id" id="id" value="">
            <input type="hidden" name="trid" id="trid" value="">
            <div class="mb-3 row">
              <label for="nameField" class="col-md-3 form-label">Name</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="nameField" name="name">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="emailField" class="col-md-3 form-label">Email</label>
              <div class="col-md-9">
                <input type="email" class="form-control" id="emailField" name="email">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="mobileField" class="col-md-3 form-label">Mobile</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="mobileField" name="mobile">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="cityField" class="col-md-3 form-label">City</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="cityField" name="City">
              </div>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Add user Modal -->
  <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="addUser" action="">
            <div class="mb-3 row">
              <label for="addUserField" class="col-md-3 form-label">Name</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="addUserField" name="name">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="addEmailField" class="col-md-3 form-label">Email</label>
              <div class="col-md-9">
                <input type="email" class="form-control" id="addEmailField" name="email">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="addMobileField" class="col-md-3 form-label">Mobile</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="addMobileField" name="mobile">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="addCityField" class="col-md-3 form-label">City</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="addCityField" name="City">
              </div>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

</body>

</html>