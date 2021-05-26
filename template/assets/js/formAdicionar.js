let btnAdicionar = $("#btn-adicionar")[0];

btnAdicionar.addEventListener("click", validar);

let cep = document.getElementById('cep');
let cpfcnpj = document.getElementById('cpfcnpj');
let telefone = document.getElementById('telefone');

let maskOptionsCep = {
  mask: '00.000-000'
};

let maskOptionsCpfcnpj = {
  mask: '000.000.000-00'
};

let maskOptionsTelefone = {
  mask: '(00) 00000-0000'
};

IMask(cep, maskOptionsCep);
let maskCpfCnpj = IMask(cpfcnpj, maskOptionsCpfcnpj);
IMask(telefone, maskOptionsTelefone);

function onChangeFisicoJuridico(){
  let fisicaJuridica = $("#fisicaJuridica")[0];
  let cpfcnpj = $("#cpfcnpj")[0];

  if(!isNaN(parseInt(fisicaJuridica.value))){
    $("#razao").attr({
      disabled: parseInt(fisicaJuridica.value) ? true : false
    });

    $("#Nome").attr({
      disabled: !parseInt(fisicaJuridica.value) ? true : false
    });

    
    if(parseInt(fisicaJuridica.value)){
      maskCpfCnpj.updateOptions({
        mask: '000.000.000-00'
      });

      cpfcnpj.placeholder = "Ex: 000.000.000-00";
      $("#label-razao")
        .removeClass("required");

      $("#label-cpfcnpj")
        .text("CPF");

      $("#label-nome")
        .addClass("required");
    }else{
      maskCpfCnpj.updateOptions({
        mask: '00.000.000/0000-00'
      })

      cpfcnpj.placeholder = "Ex: 00.000.000/0000-00";
      $("#label-razao")
        .addClass("required");

      $("#label-cpfcnpj")
        .text("CNPJ");

      $("#label-nome")
        .removeClass("required");
    }

    cpfcnpj.value = "";
  }
}

function validar(evt) {
  evt.preventDefault();
  let cpf = "";
  let cnpj = "";
  
  let nome           = $("#Nome").val();
  let fisicaJuridica = parseInt($("#fisicaJuridica").val());
  let email          = $("#email").val();
  let razao          = $("#razao").val();
  let pais           = $("#pais").val();
  let estado         = $("#estado").val();
  let cep            = $("#cep").val();
  let numero         = parseInt($("#numero").val());
  let cidade         = $("#cidade").val();
  let complemento    = $("#complemento").val();
  let telefone       = $("#telefone").val();
  
  if(fisicaJuridica){
    cpf = $("#cpfcnpj").val();

  }else{
    cnpj = $("#cpfcnpj").val();
  }

  let erro = "";

  if (nome === "" && fisicaJuridica === 1) {
    erro += 'Informe o nome completo.\n';
  }

  if (isNaN(fisicaJuridica)) {
    erro += 'Informe o tipo de pessoa.\n';
  }

  if (cpf === "" && fisicaJuridica === 1) {
    erro += `Informe o CPF.\n`;
  }else if(cpf.length < 14 && fisicaJuridica === 1){
    erro += `Informe um CPF válido.\n`;
  }

  if (cnpj === "" && fisicaJuridica === 0) {
    erro += `Informe o CNPJ.\n`;
  }else if(fisicaJuridica === 0 && cnpj.length < 18){
    erro += `Informe um CNPJ válido.\n`;
  }

  if (razao === "" && fisicaJuridica === 0) {
    erro += `Informe a razão social.\n`;
  }

  if (email === "") {
    erro += `Informe o e-mail.\n`;
  }

  if (pais === "") {
    erro += `Informe o pais.\n`;
  }

  if (estado === "") {
    erro += `Informe o estado.\n`;
  }

  if (cep === "") {
    erro += `Informe o cep.\n`;
  }else if(cep.length < 10){
    erro += `Informe um CEP valido.\n`;
  }

  if (isNaN(numero)) {
    erro += `Informe o numero.\n`;
  }

  if (cidade === "") {
    erro += `Informe a cidade.\n`;
  }

  if(telefone && telefone.length < 15){
    erro += `Informe um telefone valido.\n`;
  }

  if(erro){
    swal({
      title: "Campos obrigatorios.",
      text: erro,
      icon: "error",
    });
    return;
  }else{
    let cliente = {
      nome,
      fisicaJuridica,
      cpf,
      cnpj,
      razao,
      pais,
      estado,
      email,
      cep,
      numero,
      cidade,
      complemento,
      telefone
    };

    adicionar(cliente);
  }

}

function adicionar(data) {
  $.ajax({
    url: "adicionar",
    method: "POST",
    dataType: "json",
    data,
    beforeSend: function () {
      $("#btn-adicionar")
        .val("")
        .toggleClass("btn btn-outline-primary spinner-border text-primary");
    },
    success: function () {
        swal({
          title: "Sucesso",
          text: "Cliente cadastrado com sucesso.",
          icon: "success",
        });
        
        $("#Nome").val("");
        $("#fisicaJuridica").val("1");
        $("#email").val("");
        $("#razao").val("");
        $("#pais").val("");
        $("#estado").val("");
        $("#cep").val("");
        $("#numero").val("");
        $("#cidade").val("");
        $("#complemento").val("");
        $("#telefone").val("");
        $("#cpfcnpj").val("");
    },
    complete: function () {
      $("#btn-adicionar")
        .val("Cadastrar")
        .toggleClass("btn btn-outline-primary spinner-border text-primary");
    },
    error: function (response) {
      try{
        let { cliente } = JSON.parse(response.responseText);

        if(cliente.error){
          swal({
            title: cliente.error,
            icon: 'error',
          });
        }
      }catch(e){
        console.log("Erro: ", e.message);
        swal({
          title: "Erro",
          text: "Erro ao tentar gravar.",
          icon: "error",
        });
      }
      
    },
  });
}

onChangeFisicoJuridico();