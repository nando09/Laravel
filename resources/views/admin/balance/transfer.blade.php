@extends('adminlte::page')

@section('title', 'Transferencia')

@section('content_header')
	<h1 class="text-center">Transferir</h1>

	<ol class="breadcrumb">
		<li><a href="">Dashboard</a></li>
		<li><a href="">Saldo</a></li>
		<li><a href="">Transferir</a></li>
	</ol>
@stop

@section('content')
	<div class="box">
		<div class="box-header">
			<h3>Transferir  saldo (informe o recebedor)</h3>
		</div>
		<div class="box-body">
			@include('admin.includes.alerts')
			<form method="post" action="{{ route('transfer.store') }}">
				{!! csrf_field() !!}
				<div class="form-group">
					<input type="text" name="sender" placeholder="Informar quem vai receber (Nome ou Email)" class="form-control">
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-success">Próxima Etapa</button>
				</div>
			</form>
		</div>
	</div> 
@stop