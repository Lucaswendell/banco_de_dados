<?php $v->layout("__theme"); ?>


<form>
    <div class="list">
        <h1 class="list-text">Cadastrar novo cliente</h1>
        <a class="btn btn-primary" href="<?= url() ?>">voltar</a>
    </div>

    <div class="alert " id="alert" style="display: none;" role="alert"></div>
    <input type="hidden" name="_method" value="POST" />
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="Nome">Nome complento</label>
            <input type="text" class="form-control" id="Nome" placeholder="Ex: José nascimento da silva pereira">
        </div>
        
        <div class="form-group col-md-4">
            <label for="inputState">Pessoa Física/Juridica</label>
            <select id="inputState" class="form-control">
                <option value="" selected>Escolha...</option>
                <option value="fisica">Física</option>
                <option value="juridica">Juridica</option>
            </select>
        </div>

        <div class="form-group col-md-4">
            <label for="cpfcnpj">CPF</label>
            <input type="text" class="form-control" id="cpfcnpj" placeholder="Ex: 000.000.000-00">
        </div>
    </div>
    <div class="form-group">
        <label for="razao">Razão social</label>
        <input type="text" class="form-control" id="razao" placeholder="Ex: Minha empresa LTDA.">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" placeholder="Ex: seuze@gmail.com">
    </div>

    <input type="submit" id="btn-adicionar" value="Cadastrar" class="btn btn-outline-primary btn-form">
</form>


<!-- <form method="POST" action="adicionar" class="form">
        
        <label for="modelo">Nome <span class="form-required">*</span></label>
        <input type="text" id="modelo" name="modelo" class="form-control" placeholder="Ex: José da silva">
        <label for="modelo">Razão <span class="form-required">*</span></label>
        <input type="text" id="modelo" name="modelo" class="form-control" placeholder="Ex: José da silva">
        <span id="modeloHelp" class="form-text text-muted"></span>
        <label for="marca">Marca <span class="form-required">*<span></label>
        <input type="text" id="marca" name="marca" class="form-control" placeholder="Ex: GM, Volkswagen, FIAT">
        <span id="marcaHelp" class="form-text text-muted"></span>
        <label for="placa">Placa <span class="form-required">*<span></label>
        <input type="text" id="placa" name="placa" class="form-control" placeholder="Ex: XXX-0000">
        <span id="placaHelp" class="form-text text-muted"></span>
        
        <p><span class="form-required">*</span> Campo obrigatorio.</p>
        <input type="submit" id="btn-adicionar" value="Cadastrar novo veiculo" class="btn btn-outline-primary btn-form">
    </form> -->
<?php $v->start("script"); ?>
<script src="<?= url() ?>/template/assets/js/formAdicionar.js"></script>
<?php $v->stop(); ?>