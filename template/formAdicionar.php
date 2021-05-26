<?php $v->layout("__theme"); ?>


<form>
    <div class="list">
        <h1 class="list-text">Cadastrar novo cliente</h1>
        <a class="btn btn-primary" href="<?= url() ?>">voltar</a>
    </div>

    <input type="hidden" name="_method" value="POST" />
    <fieldset>
        <legend>Dados pessoais</legend>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label class="required" id="label-nome" for="Nome">Nome complento</label>
                <input type="text" class="form-control" id="Nome" placeholder="Ex: José nascimento da silva pereira">
            </div>

            <div class="form-group col-md-4">
                <label for="fisicaJuridica" class="required">Pessoa Física/Juridica</label>
                <select id="fisicaJuridica" onchange="onChangeFisicoJuridico()" name="fisicaJuridica" class="form-control">
                    <option value="">Escolha...</option>
                    <option value="1" selected>Física</option>
                    <option value="0">Juridica</option>
                </select>
            </div>

            <div class="form-group col-md-4">
                <label for="cpfcnpj" id="label-cpfcnpj" class="required">CPF</label>
                <input type="text" class="form-control" id="cpfcnpj" placeholder="Ex: 000.000.000-00">
            </div>
        </div>
        
        <div class="form-group">
                <label class="required" id="label-razao" for="razao">Razão Social</label>
                <input type="text" class="form-control" id="razao" placeholder="Ex: Minha Empresa LTDA.">
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="email" class="required">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Ex: seuze@gmail.com">
            </div>
            <div class="form-group col-md-6">
                <label for="telefone">Telefone</label>
                <input type="text" class="form-control" id="telefone" placeholder="Ex: (00) 00000-0000">
            </div>
        </div>


    </fieldset>
    <fieldset>
        <legend>Endereço</legend>
        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="pais" class="required">Pais</label>
                <input type="text" class="form-control" maxlength="2" id="pais" placeholder="Ex: BR">
            </div>

            <div class="form-group col-md-2">
                <label for="estado" class="required">Estado</label>
                <input type="text" class="form-control" maxlength="2" id="estado" placeholder="Ex: CE">
            </div>

            <div class="form-group col-md-4">
                <label for="cep" class="required">CEP</label>
                <input type="text" class="form-control" id="cep" placeholder="Ex: 00.000-000">
            </div>

            <div class="form-group col-md-4">
                <label for="numero" class="required">Número</label>
                <input type="text" class="form-control" id="numero" placeholder="Ex: 12" maxlength="4">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="cidade" class="required">Cidade</label>
                <input type="text" class="form-control" id="cidade" placeholder="Ex: Fortaleza">
            </div>
            <div class="form-group col-md-6">
                <label for="complemento">Complemento</label>
                <input type="text" class="form-control" id="complemento" placeholder="Ex: Casa altos">
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