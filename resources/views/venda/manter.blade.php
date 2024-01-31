@extends('adminlte::page')

@section('title')

@section('content_header')
<h3 class="m-0"><i class="fa fa-fw fa-book" aria-hidden="true"></i> {{ $title_page ?? 'Cadastrar Venda' }} </h3>

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endpush

@push('js')
<script src="{{ asset('js/manterVenda.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@endpush
@stop

@section('content')
@include('componentes.mensagem')

<label class="text-danger">
    <small> Campos marcados com (*) são obrigatórios.</small>
</label>

<form action="#" method="post" class="needs-validation" novalidate>
    <div class="row">
        <!-- Venda -->
        <div class="form-group col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="card box-shadow">
                <div class="card-header border-0 no-bg-color">
                    <h5 class="card-subtitle mt-1">Dados do Venda</h5>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-8 col-lg-8 col-xl-8">
                            <input type="hidden" name="id" value="{{ $venda->id ?? null }}" />
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <input type="hidden" name="manter" id="manter" value="{{ $MANTER ?? 'Salvar' }}" />

                            <!-- amount -->
                            <div class="form-group col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <label class="text-input">Amount *</label>
                                <input id="amount" name="amount" type="text" class="form-control validarErro" value="{{ old('amount', $venda->amount ?? null) }}" maxlength="100" autocomplete="off" required>

                                <div class="invalid-feedback"></div>

                                <label id="amount-error" class='text-danger invalid-feedback' style="display: none"></label>
                            </div>

                            <!-- amount -->
                            <div class="form-group col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <label class="text-input">Sales ID *</label>
                                <input id="sales_id" name="sales_id" type="text" class="form-control validarErro" value="{{ old('sales_id', $venda->sales_id ?? null) }}" maxlength="100" autocomplete="off" required>

                                <div class="invalid-feedback"></div>

                                <label id="amount-error" class='text-danger invalid-feedback' style="display: none"></label>
                            </div>

                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <!-- Produtos -->
                            <div class="form-group col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <hr>
                                <label class="text-input">Produto</label>
                            </div>
                            <div class="form-group row col-sm-12 col-md-12 col-lg-12 col-xl-12 ml-1">
                                @if (!empty($produtos))
                                @foreach ($produtos as $produto)
                                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 form-check">
                                <input type="checkbox" class="form-check-input" name="produtos[]" id="produto{{ $produto->id }}" value="{{ $produto->id }}" {{ in_array($produto->id,$listProdutos)  ? ' checked ' : '' }}>
                                    <label class="form-check-label" for="produto{{ $produto->id }}">{{ $produto->name }}</label>
                                </div>
                                @endforeach
                                @else
                                <option value="">Tag não encontrada</option>
                                @endif

                                <div class="invalid-feedback"></div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


            @include('componentes.loading')

            <div class="row">
                <div class="form-group col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <button id="{{ $MANTER ?? 'Cadastrar' }}" class="btn btn-primary float-right">
                        <i class="fa fa-floppy-o" aria-hidden="true"></i>
                        {{ $MANTER ?? 'Cadastrar' }}
                    </button>

                    <button type="button" onclick=location.href="{{ route('indexVenda') }}" class="btn btn-secondary mr-3 mb-5 float-left">
                        <i class="fa fa-step-backward" aria-hidden="true"></i> Voltar
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

@stop