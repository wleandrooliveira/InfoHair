        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="navbar-brand" href="<?= base_url() ?>home/index">Barbearia Brothers</a>
            </div>
            <!-- Top Menu Items -->
             <ul class="nav navbar-right top-nav">
               
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="<?= $active == 'home' ? 'active' : ''?>">
                        <a href="<?= base_url() ?>home/index"><i class="fa fa-fw fa-dashboard"></i> Home</a>
                    </li>
                    <li class="<?= ($active == 'clientes' || $active == 'funcionarios' || $active == 'servicos') ? 'active' : ''?>">
                        <a href="javascript:;" data-toggle="collapse" data-target="#cadastro"><i class="fa fa-plus-circle"></i> Cadastro <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="cadastro" class="collapse">
                            <li>
                               <a href="<?= base_url() ?>clientes/index"><i class="fa fa-users"></i> Clientes</a>
                            </li>
                            <li>
                                <a href="<?= base_url() ?>funcionarios/index"><i class="fa fa-user"></i> Funcion&aacute;rios</a>
                            </li>
                            <li>
                                <a href="<?= base_url() ?>servicos/index"><i class="fa fa-cut"></i> Servi&ccedil;os</a>
                            </li>
                        </ul>
                    </li>
                    <li class="<?= $active == 'mensagens' ? 'active' : ''?>">
                        <a href="<?= base_url() ?>mensagens/index"><i class="fa fa-fw fa-envelope"></i> Mensagens</a>
                    </li>
                    <li class="<?= $active == 'relatorios' ? 'active' : ''?>">
                        <a href="<?= base_url() ?>relatorios/index"><i class="fa fa-fw fa-table"></i> Relat&oacute;rios</a>
                    </li>
                    <li class="<?= $active == 'atendimentos' ? 'active' : ''?>">
                        <a href="<?= base_url() ?>atendimentos/index"><i class="fa fa-fw fa-usd"></i> Atendimentos</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
