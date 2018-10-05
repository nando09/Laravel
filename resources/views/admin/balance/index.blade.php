@extends('adminlte::page')

@section('title', 'Home Dasboard')

@section('content_header')
	<h1 class="text-center">Saldo</h1>

	<ol class="breadcrumb">
		<li><a href="">Dashboard</a></li>
		<li><a href="">Saldo</a></li>
	</ol>
@stop

@section('content')
	<div class="box">
		<div class="box-header">
			<a href="{{ route('balance.deposit') }}" class="btn btn-primary"><i class="fa fa-cart-plus"></i> Recarregar</a>
			@if($amount > 0)
				<a href="{{ route('balance.withdraw') }}" class="btn btn-danger"><i class="fa fa-cart-arrow-down"></i> Sacar</a>
				<a href="{{ route('balance.transfer') }}" class="btn btn-primary">
					<i class="fa fa-exchange" aria-hidden="true"></i> Transferir
				</a>
			@endif
		</div>
		<div class="box-body">
			@include('admin.includes.alerts')
				<div class="small-box bg-green">
					<div class="inner">
						<h3>
							<font style="vertical-align: inherit;">
								<font style="vertical-align: inherit;">R$ </font>
							</font>
							<sup style="font-size: 20px">
								<font style="vertical-align: inherit;">
									<font style="vertical-align: inherit;">{{ number_format($amount, 2, ',', '') }}</font>
								</font>
							</sup>
						</h3>
					</div>
					<div class="icon">
						<i class="ion ion-cash"></i>
					</div>
					<a href="#" class="small-box-footer">
						<font style="vertical-align: inherit;">
							<font style="vertical-align: inherit;">Hístorico</font>
						</font>
						<i class="fa fa-arrow-circle-right"></i>
					</a>
				</div>
		</div>
	</div> 
@stop