<?php $v->layout("__theme"); ?>


<form>
    <div class="list">
        <h1 class="list-text">Cadastrar novo pedido</h1>
        <a class="btn btn-primary" href="<?= url() ?>">voltar</a>
    </div>

    <input type="hidden" name="_method" value="POST" />
    <fieldset>
        <legend>Dados pessoais</legend>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label class="required" id="label-nome" for="Nome">Nome complento / Razao Social</label>
                <input type="text" class="form-control" disabled id="Nome" value="<?= $nome ?>" placeholder="Ex: José nascimento da silva pereira">
            </div>
            <div class="form-group col-md-3">
                <label class="required" id="label-data_abertura" for="data_abertura">Data abertura</label>
                <input type="date" class="form-control" id="data_abertura" >
            </div>
            <div class="form-group col-md-3">
                <label class="required" id="label-data_realizacao" for="data_realizacao">Data realizacao</label>
                <input type="date" class="form-control" id="data_realizacao">
            </div>
        </div>
        
        <div class="form-group">
                <label class="required" id="label-local" for="local">Local do servico</label>
                <input type="text" class="form-control" id="local" placeholder="Ex: Cozinha">
        </div>

        <div class="form-row">
            <div class="form-group col-md-3">
                <label class="required" id="label-duração" for="duração">Duração do pedido</label>
                <input type="text" class="form-control" id="duração" placeholder="Ex: 80:00">
            </div>
            <div class="form-group col-md-9">
                <label class="required" id="label-total" for="total">Total do pedido</label>
                <input type="text" class="form-control" id="total" placeholder="Ex: R$ 1200">
            </div>
        </div>
    </fieldset>
    <input type="submit" id="btn-adicionar" ng-click="adicionar();" value="Cadastrar" class="btn btn-outline-primary btn-form">
</form>

<?php $v->start("script"); ?>
<script src="https://unpkg.com/imask"></script>
<script src="<?= url() ?>/template/assets/js/sweet.min.js"></script>
<script src="<?= url() ?>/template/assets/js/formAdicionar.js"></script>
<?php $v->stop(); ?>