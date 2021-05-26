let btnPesquisar = $("#btn-pesquisar")[0];

btnPesquisar.addEventListener("click", pesquisar);

$(".excluir").each(function () {
  $(this)[0].addEventListener("click", excluir);
});

function excluir(evt) {
  evt.preventDefault();
  let id = this.getAttribute("id");

  swal({
    title: "Você tem certeza?",
    text: "Uma vez deletado, você não poderá recuperar!",
    icon: "warning",
    buttons: {
      cancel: "NÃO",
      defeat: "SIM",
    },
    dangerMode: true,
  }).then((willDelete) => {
    if (willDelete) {
      $.ajax({
        url: "excluir/" + id,
        method: "DELETE",
        dataType: "JSON",
        success: function (result) {
          $("#tr-" + id).fadeOut(500);
          let clientes = $(".tr-clientes");

          if (clientes.length === 0) {
            $("#table-body").html(`
              <tr>
                  <td colspan="9">Nenhum resultado encontrado.</td>
              </tr>`);
          }
        },
        error: function ({ responseText }) {
          try {
            let {
              cliente: { error },
            } = JSON.parse(responseText);
            swal({
              title: "Erro",
              icon: "error",
              text: error,
            });
          } catch (e) {
            console.log(e.message);
            swal({
              title: "Erro",
              icon: "error",
              text: "Erro ao tentar deletar cliente.",
            });
          }
        },
      });
    }
  });
}

function pesquisar(evt) {
  evt.preventDefault();
  let pesquisa = $("#pesquisa").val();

  if (pesquisa === "") {
    location.reload();
    return;
  }

  $.ajax({
    url: "" + pesquisa,
    method: "GET",
    dataType: "JSON",
    success: function ({ cliente }) {
      $(".btn-resetar")[0].style.display = "inline-block";

      $("#table-body").html(`
        <tr id="tr-${cliente.id} class="tr-clientes">
          <td>${cliente.id} </td>
          <td>${parseInt(cliente.fisicajuridica) ? cliente.nome : "-"}</td>
          <td>${parseInt(cliente.fisicajuridica) ? cliente.cpf : "-"}</td>
          <td>${!parseInt(cliente.fisicajuridica) ?  cliente.razaosocial : "-" } </td>
          <td>${!parseInt(cliente.fisicajuridica) ? cliente.cnpj  : "-" }</td>
          <td>${cliente.telefone ? cliente.telefone : '-'} </td>
          <td>${cliente.email} </td>
          <td><a class="table-link" href="editar/${cliente.id}"><i class="icon-pencil2"></i></a></td>
          <td><a href="" class="excluir table-link" id="${cliente.id}" ><i class="icon-bin"></i></a></td>
        </tr>`);
      let linkTr = $(`#${id}`)[0];
      linkTr.addEventListener("click", excluir);
    },
    error: function ({ responseText }) {
      $(".btn-resetar")[0].style.display = "none";

      try {
        let {
          cliente: { error },
        } = JSON.parse(responseText);

        swal({
          title: "Error",
          text: error,
          icon: "error",
        });
      } catch (e) {
        swal({
          title: "Error",
          text: "Erro ao pesquisar.",
          icon: "error",
        });
      }
    },
  });
}
