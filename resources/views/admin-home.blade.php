@extends('layouts.admin')

@section('title')
    Telepráctica
@endsection

@section('estilos')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
@endsection

@section('content-admin')
    <div class="container-fluid mt-3">
        <!-- Small boxes (Stat box) -->
        <div class="row">

            <div class="col-lg-3">
                <!-- small box -->
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h4>{{ $total_users_hoy }}</h4>

                        <h6>Registros hoy</h6>
                    </div>

                    <div class="icon fa-sm">
                        <i class="fas fa-user-plus"></i>
                    </div>

                    <a href="#" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <!-- ./col -->
            <div class="col-lg-3">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h4>{{ $total_users }}</h4>

                        <h6>Registros totales</h6>
                    </div>

                    <div class="icon fa-sm">
                        <i class="fas fa-user-friends"></i>
                    </div>

                    <a href="#" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <!-- ./col -->
            <div class="col-lg-3">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h4>{{ $porcentaje_validados }}<sup style="font-size: 15px">%</sup></h4>

                        <h6>Validados</h6>
                    </div>

                    <div class="icon fa-sm">
                        <i class="fas fa-user-check"></i>
                    </div>

                    <a href="#" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <!-- ./col -->
            <div class="col-lg-3">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h4>{{ $porcentaje_bajas }}<sup style="font-size: 15px">%</sup></h4>

                        <h6>Dados de baja</h6>
                    </div>

                    <div class="icon fa-sm">
                        <i class="fas fa-user-slash"></i>
                    </div>

                    <a href="#" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>

    <div class="card mt-3 mb-3 ml-3 mr-3">
        <div class="card-header">
            <h4 class="card-title">
                <i class="fas fa-users"></i>
                Reporte Mensual de Usuarios
            </h4>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <div class="btn-group">
                    <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                        <i class="fas fa-wrench"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                        <a href="#" class="dropdown-item">Acción</a>
                        <a href="#" class="dropdown-item">Otra acción</a>
                        <a href="#" class="dropdown-item">Más</a>
                        <a class="dropdown-divider"></a>
                        <a href="#" class="dropdown-item">Link</a>
                    </div>
                </div>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <p class="text-center">
                        <strong>Reporte: 1 marzo, 2021 - 30 marzo, 2021</strong>
                    </p>

                    <div class="chart">
                        <img src="/img/grafico-ejemplo.png" alt="Gráfico">
                    </div>
                    <!-- /.chart-responsive -->
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                    <p class="text-center">
                        <strong>Meta</strong>
                    </p>

                    <div class="progress-group">
                        Registros hoy
                        <span class="float-right"><b>{{ $total_users_hoy }}</b>/200</span>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-primary" style="width: 10%"></div>
                        </div>
                    </div>
                    <!-- /.progress-group -->

                    <div class="progress-group">
                        Registros totales
                        <span class="float-right"><b>{{ $total_users }}</b>/5000</span>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-success" style="width: 20%"></div>
                        </div>
                    </div>

                    <!-- /.progress-group -->
                    <div class="progress-group">
                        <span class="progress-text">Cuentas validadas</span>
                        <span class="float-right"><b>{{ $porcentaje_validados }}</b><sup
                                style="font-size: 10px">%</sup>/50<sup style="font-size: 10px">%</sup></span>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-warning" style="width: 60%"></div>
                        </div>
                    </div>

                    <!-- /.progress-group -->
                    <div class="progress-group">
                        Cuentas dadas de baja
                        <span class="float-right"><b>{{ $porcentaje_bajas }}</b><sup
                                style="font-size: 10px">%</sup>/40<sup style="font-size: 10px">%</sup></span>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-danger" style="width: 80%"></div>
                        </div>
                    </div>
                    <!-- /.progress-group -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- ./card-body -->
        <div class="card-footer">
            <div class="row">
                <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                        <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 17%</span>
                        <h5 class="description-header">{{ $total_users_hoy }}</h5>
                        <span>Hoy</span>
                    </div>
                    <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                        <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i>
                            0%</span>
                        <h5 class="description-header">{{ $total_users }}</h5>
                        <span>Total</span>
                    </div>
                    <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                        <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 20%</span>
                        <h5 class="description-header">{{ $porcentaje_validados }}</h5>
                        <span>Cuentas validadas</span>
                    </div>
                    <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-6">
                    <div class="description-block">
                        <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i>
                            18%</span>
                        <h5 class="description-header">{{ $porcentaje_bajas }}</h5>
                        <span>Cuentas dadas de baja</span>
                    </div>
                    <!-- /.description-block -->
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.card-footer -->
    </div>
@endsection
