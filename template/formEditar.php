<?php $v->layout("__theme"); ?>
<div class="list">
    <h1 class="list-text">Editar Cliente</h1>
    <a class="btn btn-primary" href="<?= url(); ?>">voltar</a>
</div>
<?php if ($cliente) : ?>
    <form method="POST" action="editar" class="form">
        <input type="hidden" name="_method" value="POST" />
        <input type="hidden" name="id" id="id" value="<?= $cliente->getId() ?>" />
        <input type="hidden" name="idEndereco" id="idEndereco" value="<?= $cliente->getEndereco()->getId() ?>" />

        <fieldset>
            <legend>Dados pessoais</legend>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label class="required" id="label-nome" for="Nome">Nome complento</label>
                    <input type="text" class="form-control" id="Nome" value="<?= $cliente->getNome() ?>" placeholder="Ex: José nascimento da silva pereira">
                </div>

                <div class="form-group col-md-4">
                    <label for="fisicaJuridica" class="required">Pessoa Física/Juridica</label>
                    <select id="fisicaJuridica" disabled="true" onchange="onChangeFisicoJuridico()" name="fisicaJuridica" class="form-control">
                        <option value="">Escolha...</option>
                        <option value="1" <?= $cliente->getFisicaJuridica() ? 'selected' : '' ?>>Física</option>
                        <option value="0" <?= !$cliente->getFisicaJuridica() ? 'selected' : '' ?>>Juridica</option>
                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label for="cpfcnpj" id="label-cpfcnpj" class="required">CPF</label>
                    <input type="text" class="form-control" disabled value="<?= $cliente->getFisicaJuridica() ? $cliente->getCpf() : $cliente->getCnpj() ?>" id="cpfcnpj" placeholder="Ex: 000.000.000-00">
                </div>
            </div>

            <div class="form-group">
                <label class="required" id="label-razao" for="razao">Razão Social</label>
                <input type="text" class="form-control" id="razao" value="<?= $cliente->getRazaoSocial() ?>" placeholder="Ex: Minha Empresa LTDA.">
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="email" class="required">Email</label>
                    <input type="email" class="form-control" value="<?= $cliente->getEmail() ?>" id="email" placeholder="Ex: seuze@gmail.com">
                </div>
                <div class="form-group col-md-6">
                    <label for="telefone">Telefone</label>
                    <input type="text" class="form-control" id="telefone" value="<?= $cliente->getTelefone() ?>" placeholder="Ex: (00) 00000-0000">
                </div>
            </div>


        </fieldset>
        <fieldset>
            <legend>Endereço</legend>
            <div class="form-row">
                <div class="form-group col-md-2">
                    <label for="pais" class="required">Pais</label>
                    <input type="text" class="form-control" value="<?= $cliente->getEndereco()->getPais() ?>" maxlength="2" id="pais" placeholder="Ex: BR">
                </div>

                <div class="form-group col-md-2">
                    <label for="estado" class="required">Estado</label>
                    <input type="text" class="form-control" value="<?= $cliente->getEndereco()->getEstado() ?>" maxlength="2" id="estado" placeholder="Ex: CE">
                </div>

                <div class="form-group col-md-4">
                    <label for="cep" class="required">CEP</label>
                    <input type="text" class="form-control" value="<?= $cliente->getEndereco()->getCEP() ?>" id="cep" placeholder="Ex: 00.000-000">
                </div>

                <div class="form-group col-md-4">
                    <label for="numero" class="required">Número</label>
                    <input type="text" class="form-control" id="numero" value="<?= $cliente->getEndereco()->getNumero() ?>" placeholder="Ex: 12" maxlength="4">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="cidade" class="required">Cidade</label>
                    <input type="text" class="form-control" id="cidade" value="<?= $cliente->getEndereco()->getCidade() ?>" placeholder="Ex: Fortaleza">
                </div>
                <div class="form-group col-md-6">
                    <label for="complemento">Complemento</label>
                    <input type="text" class="form-control" id="complemento" value="<?= $cliente->getEndereco()->getComplemento() ?>" placeholder="Ex: Casa altos">
                </div>
            </div>
        </fieldset>

        <input type="submit" id="btn-editar" value="Editar" class="btn btn-outline-primary btn-form">
    </form>
<?php else : ?>
    <h1 class="text-center text-danger">Cliente não encotrado.</h1>
<?php endif; ?>
<?php $v->start("script"); ?>
<script src="https://unpkg.com/imask"></script>
<script src="<?= url() ?>/template/assets/js/sweet.min.js"></script>
<script src="<?= url() ?>/template/assets/js/formEditar.js"></script>
<?php $v->stop(); ?>