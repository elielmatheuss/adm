<?php
include('db/connection.php');
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
    <h2 class="text-center">Status da transmissão</h2>
    <div class="row">
      <div class="container">
        <div class="row">
          <div class="col-md-4"></div>
          <div class="col-md-12">
            <table id="example" class="table table-bordered table-striped mb-none">
              <thead>
                <th>Id</th>
                <th>URL</th>
                <th>EMBED</th>
                <th>TIPO</th>
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


    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Alterar status da transmissão</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="updatePlayer">
              <input type="hidden" name="id" id="id" value="">
              <input type="hidden" name="trid" id="trid" value="">
              <div class="mb-3 row">
                <label for="fieldUrl" class="col-md-3 form-label">Url</label>
                <div class="col-md-9">
                  <input type="text" class="form-control" id="fieldUrl" name="name">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="fieldEmbed" class="col-md-3 form-label">Embed</label>
                <div class="col-md-9">
                  <input type="text" class="form-control" id="fieldEmbed" name="fieldEmbed">
                </div>
              </div>

              <div class="mb-4 row">
                <div class="form-floating">
                  <select class="form-select" id="fieldTipo" aria-label="Floating label select example">
                    <option selected>Selecione a origem da transmissão</option>
                    <option value="1">offline</option>
                    <option value="2">saopedro</option>
                    <option value="3">jau</option>
                    <option value="4">youtube</option>
                    <option value="5">americo</option>
                  </select>
                  <label for="fieldTipo"> Status da Transmissão</label>
                </div>

              </div>
              <!-- 
              <div class="mb-3 row">
                <label for="fieldTipo" class="col-md-3 form-label">Status da Transmissão</label>
                <div class="col-md-9">
                  <input type="text" class="form-control" id="fieldTipo" name="fieldTipo">
                </div>
              </div> -->

              <button type="submit" class="btn btn-success">Confirmar</button>
              <button type="button" class="btn btn-danger btn-md" data-bs-dismiss="modal">Fechar</button>
            </form>
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
        'serverSide': 'false',
        'processing': 'true',
        'paging': 'true',
        'order': [],
        'ajax': {
          'url': 'views/player/manyPlayer.php',
          'type': 'post',
        },
        "aoColumnDefs": [{
          "bSortable": false,
          "aTargets": [4]
        }, ]
      });
    });

    $(document).on('submit', '#updatePlayer', function(e) {
      e.preventDefault();
      //var tr = $(this).closest('tr');
      var url = $('#fieldUrl').val();
      var file = $('#fieldEmbed').val();
      var tipo = $('#fieldTipo').val();
      var id = $('#id').val();
      if (tipo != '') {
        $.ajax({
          url: "views/player/updatePlayer.php",
          type: "post",
          data: {
            url: url,
            file: file,
            tipo: tipo,
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
              row.row("[id='" + trid + "']").data([tipo]);
              $('#exampleModal').modal('hide');
              window.location.href = "<?php echo "index.php?a=player.php"; ?>";
            } else {
              alert('Erro');
            }
          }
        });
      } else {
        alert('Prenecha todos os campos.');
      }
      window.location.href = "<?php echo "index.php?a=player.php"; ?>";
    });


    $('#example').on('click', '.editbtn ', function(event) {
      var table = $('#example').DataTable();
      var trid = $(this).closest('tr').attr('id');
      // console.log(selectedRow);
      var id = $(this).data('id');
      $('#exampleModal').modal('show');

      $.ajax({
        url: "views/player/getPlayer.php",
        data: {
          id: id
        },
        type: 'post',
        success: function(data) {
          var json = JSON.parse(data);
          alert(data);
          $('#fieldUrl').val(json.url);
          $('#fieldEmbed').val(json.file);
          $('#fieldTipo').val(json.tipo);
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
          url: "views/oracao/deleteOracao.php",
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
          $.post("views/oracao/addOração.php", oracao, function(retorna) {
            if (retorna) {
              //Alerta de cadastro realizado com sucesso
              //$("#msg").html('<div class="text-success" role="alert">Oração enviada com sucesso!</div>');
              alert("Pedido de oração enviado com sucesso!!")
              // $("#msg").html(retorna);
              //Limpar os campo
              $('#prayerForm')[0].reset();

              //Fechar a janela modal cadastrar
              $('#modalPrayer').modal('hide');
              window.location.href = "<?php echo "index.php?a=oracao.php"; ?>";
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


</body>

</html>