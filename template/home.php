<?php $v->layout("__theme");?>
    <div class="list">
        <h1 class="list-text">MJA Alocações</h1>
    </div>
    <div class="list-pesquisa form-inline">
        <a href="<?= url();?>" class="btn-resetar">Resetar</a>
        <input type="search" name="pesquisa" id="pesquisa" class="form-control" value="" placeholder="Buscar cliente"/>
        <a href="" class="btn btn-primary btn-pesquisar" id="btn-pesquisar">Pesquisar</a>
        <a class="btn btn-primary btn-adicionar" href="adicionar">Cadastrar novo cliente</a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Código cliente</th>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Razão social</th>
                    <th>CNPJ</th>
                    <th>Telefone</th>
                    <th>E-mail</th>
                    <th>Editar</th>
                    <th>Deletar</th>
                </tr>
            </thead>
            <tbody id="table-body">
            <?php foreach ($veiculos as $veiculo):?>
                <tr id="tr-<?=$veiculo->getId()?>">
                    <td><?= $veiculo->getModelo()?></td>
                    <td><?= $veiculo->getMarca()?></td>
                    <td><?= $veiculo->getPlaca()?></td>
                    <td><?= date("d/m/yy", strtotime($veiculo->getDataCadastro()));?></td>
                    <td><a  class="table-link" href="editar/<?=$veiculo->getId()?>"><i class="icon-pencil2"></i></a></td>
                    <td><a href="" class="excluir table-link" id="<?= $veiculo->getId() ?>"><i class="icon-bin"></i></a></td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
        <?php $v->start("script")?>
        <script src="<?= url()?>/template/assets/js/sweet.min.js"></script>
        <script src="<?= url()?>/template/assets/js/home.js"></script>
        <?php $v->stop(); ?>
    </div>
