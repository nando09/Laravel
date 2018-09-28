@extends('adminlte::page')

@section('title', 'Depósito')

@section('content_header')
	<h1 class="text-center">Depositar no saldo</h1>

	<ol class="breadcrumb">
		<li><a href="">Dashboard</a></li>
		<li><a href="">Saldo</a></li>
		<li><a href="">Depósito</a></li>
	</ol>
@stop

@section('content')
	<div class="box">
		<div class="box-header">
			<h3>Fazer retirada</h3>
		</div>
		<div class="box-body">
			@include('admin.includes.alerts')
			<form method="post" action="{{ route('withdraw.store') }}">
				{!! csrf_field() !!}
				<div class="form-group">
					<input type="text" name="valor" placeholder="Valor retirada" class="form-control">
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-success">Sacar</button>
				</div>
			</form>
		</div>
	</div> 
@stop