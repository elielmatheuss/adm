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
    <h2 class="text-center">Hinos Especiais</h2>
    <div class="row">
      <div class="container">
        <div class="btnAdd">
          <a class="mb-xs mt-xs mr-xs btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalPrayer"><i class=" fa fa-plus"></i> Cadastrar</a>

          <button type="button" name="add" id="addEmployee" class="mb-xs mt-xs mr-xs btn btn-info"><i class="fa fa-print"></i> Imprimir</button>

          <a class="mb-xs mt-xs mr-xs btn btn-danger" href="views/hymns/dropHymns.php"><i class=" fa fa-bug"></i> DROP Tabela</a>

        </div>
        <div class="row">
          <div class="col-md-4"></div>
          <div class="col-md-12">
            <table id="example" class="table table-bordered table-striped mb-none">
              <thead>
                <th>ID</th>
                <th>CANTOR</th>
                <th>CIDADE</th>
                <th>PASTOR</th>
                <th>THIRD</th>
                <th>TÍTULO DO HINO</th>
                <th>AÇÕES</th>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
          <div class="col-md-8"></div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modalPrayer" tabindex="-1" role="dialog" aria-labelledby="modalPrayer" aria-hidden="true" style="margin-top: 50px">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form id="prayerForm" method="POST" action="compiler/processa_oracao.php">
            <div class="modal-header">
              <h5 class="modal-title" id="modal-title-defaul">Incluir Hino especial</h5>
            </div>
            <span id="msg-error"></span>
            <div class="modal-body">

              <div class="form-group">
                <label for="hymnsCantor">Nome do Cantor</label>
                <input type="text" name="hymnsCantor" class="form-control" id="hymnsCantor" placeholder="Digite seu nome aqui" style="color: #000000;">
              </div>
              <div class="form-group">
                <label for="hymnsCidade">Cidade</label>
                <input type="text" name="hymnsCidade" class="form-control" id="hymnsCidade" placeholder="Digite seu nome aqui" style="color: #000000;">
              </div>
              <div class="form-group">
                <label for="hymnsPastor">Nome do pastor</label>
                <input type="text" name="hymnsPastor" class="form-control" id="hymnsPastor" placeholder="Digite seu nome aqui" style="color: #000000;">
              </div>
              <div class="form-group">
                <label for="hymnsThird">Tarja (true ou false)</label>
                <input type="text" name="hymnsThird" class="form-control" id="hymnsThird" placeholder="Digite seu nome aqui" style="color: #000000;">
              </div>
              <div class="form-group">
                <label for="hymnsTitulo">Tarja (true ou false)</label>
                <input type="text" name="hymnsTitulo" class="form-control" id="hymnsTitulo" placeholder="Digite seu nome aqui" style="color: #000000;">
              </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger btn-md" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-success btn-md">Enviar</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- FORM EDITAR ORAÇÃO -->
    <div class="modal fade" id="modalPrayerEdit" tabindex="-1" role="dialog" aria-labelledby="modalPrayerEditLabel" aria-hidden="true" style="margin-top: 50px">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form id="updateOracao" method="POST" action="">
            <div class="modal-header">
              <h5 class="modal-title" id="modal-title-defaul">Editar Hino especial</h5>
            </div>
            <span id="msg-error"></span>
            <div class="modal-body">
              <input type="hidden" name="id" id="id" value="">
              <input type="hidden" name="trid" id="trid" value="">

              <div class="form-group">
                <label for="fieldHymnsCantor">Nome do Cantor</label>
                <input type="text" name="fieldHymnsCantor" class="form-control" id="fieldHymnsCantor" placeholder="Digite seu nome aqui" style="color: #000000;">
              </div>
              <div class="form-group">
                <label for="FieldHymnsCidade">Cidade</label>
                <input type="text" name="FieldHymnsCidade" class="form-control" id="FieldHymnsCidade" placeholder="Digite seu nome aqui" style="color: #000000;">
              </div>
              <div class="form-group">
                <label for="fieldHymnsPastor">Nome do pastor</label>
                <input type="text" name="fieldHymnsPastor" class="form-control" id="fieldHymnsPastor" placeholder="Digite seu nome aqui" style="color: #000000;">
              </div>
              <div class="form-group">
                <label for="fieldHymnsThird">Tarja (true ou false)</label>
                <input type="text" name="fieldHymnsThird" class="form-control" id="fieldHymnsThird" placeholder="Digite seu nome aqui" style="color: #000000;">
              </div>
              <div class="form-group">
                <label for="fieldHymnsTitulo">Tarja (true ou false)</label>
                <input type="text" name="fieldHymnsTitulo" class="form-control" id="fieldHymnsTitulo" placeholder="Digite seu nome aqui" style="color: #000000;">
              </div>



            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger btn-md" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-success btn-md">Enviar</button>
            </div>
          </form>
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
        'serverSide': 'false',
        'processing': 'true',
        'paging': 'true',
        'order': [],
        'ajax': {
          'url': 'views/hymns/manyHymns.php',
          'type': 'post',
        },
        "aoColumnDefs": [{
          "bSortable": false,
          "aTargets": [6]
        }, ]
      });
    });

    $(document).on('submit', '#updateOracao', function(e) {
      e.preventDefault();
      //var tr = $(this).closest('tr');
      var cantor = $('#fieldHymnsCantor').val();
      var cidade = $('#fieldHymnsCidade').val();
      var pastor = $('#fieldHymnsPastor').val();
      var third = $('#fieldHymnsThird').val();
      var titulo = $('#fieldHymnsTitulo').val();
      var id = $('#id').val();
      if (cantor != '' && titulo != '') {
        $.ajax({
          url: "views/hymns/updateHymns.php",
          type: "post",
          data: {
            cantor: cantor,
            cidade: cidade,
            pastor: pastor,
            third: third,
            titulo: titulo,
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
              var button = '<td><a href="javascript:void();" data-id="' + id + '" class="btn btn-info btn-md editbtn">Edit</a>  <a href="#!"  data-id="' + id + '"  class="btn btn-danger btn-md deleteBtn">Delete</a></td>';
              var row = table.row("[id='" + trid + "']");
              row.row("[id='" + trid + "']").data([id, nome, motivo_oracao, button]);
              $('#modalPrayer').modal('hide');
              window.location.href = "<?php echo "index.php?a=hymns.php"; ?>";
            } else {
              alert('Erro');
            }
          }
        });
      } else {
        alert('Prenecha todos os campos.');
      }
    });


    $('#example').on('click', '.editbtn ', function(event) {
      var table = $('#example').DataTable();
      var trid = $(this).closest('tr').attr('id');
      // console.log(selectedRow);
      var id = $(this).data('id');
      $('#modalPrayerEdit').modal('show');

      $.ajax({
        url: "views/hymns/getHymns.php",
        data: {
          id: id
        },
        type: 'post',
        success: function(data) {
          var json = JSON.parse(data);
          $('#fieldHymnsCantor').val(json.cantor);
          $('#fieldHymnsCidade').val(json.cidade);
          $('#fieldHymnsPastor').val(json.pastor);
          $('#fieldHymnsThird').val(json.third);
          $('#fieldHymnsTitulo').val(json.titulo);
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
          url: "views/hymns/deleteHymns.php",
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
              alert('erro');
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

    $('#fieldStateCodePrayer').on("change", function() {
      var idEstado = $("#fieldStateCodePrayer").val();
      $.ajax({
        url: 'views/audiencia/getCidades.php',
        type: 'POST',
        data: {
          id: idEstado
        },
        beforeSend: function() {
          $('#fieldCityCodePrayer').css({
            'display': 'block'
          });
          $('#fieldCityCodePrayer').html("Carregando...");
        },
        success: function(data) {
          $('#fieldCityCodePrayer').css({
            'display': 'block'
          });
          $('#fieldCityCodePrayer').html(data);
        },
        error: function(data) {
          $('#fieldCityCodePrayer').css({
            'display': 'block'
          });
          $('#fieldCityCodePrayer').html("Houve um erro ao carregar");
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
        if ($('#hymnsCantor').val() == "") {
          $("#msg-error").html('<div class="alert alert-danger" role="alert">Preencha o nome!</div>');
        } else if ($('#hymnsCidade').val() == undefined) {
          $("#msg-error").html('<div class="alert alert-danger" role="alert">Preencha a cidade!</div>');
        } else if ($('#hymnsPastor').val() == undefined) {
          $("#msg-error").html('<div class="alert alert-danger" role="alert">Informe o nome do pastor!</div>');
        } else if ($('#hymnsTitulo').val() == "") {
          $("#msg-error").html('<div class="alert alert-danger" role="alert">Informe o título do hino!</div>');
        } else {
          //Receber os dados do formulário
          var oracao = $("#prayerForm").serialize();
          $.post("views/hymns/addHymns.php", oracao, function(retorna) {
            if (retorna) {
              //Alerta de cadastro realizado com sucesso
              //$("#msg").html('<div class="text-success" role="alert">Oração enviada com sucesso!</div>');
              alert("Pedido de oração enviado com sucesso!!")
              // $("#msg").html(retorna);
              //Limpar os campo
              $('#prayerForm')[0].reset();

              //Fechar a janela modal cadastrar
              $('#modalPrayer').modal('hide');
              window.location.href = "<?php echo "index.php?a=hymns.php"; ?>";
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