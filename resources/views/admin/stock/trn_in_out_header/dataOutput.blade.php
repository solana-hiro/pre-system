@extends('layouts.admin.app')
@section('page_title', '在庫データ書出し')
@section('title', '在庫データ書出し')
@section('description', '')
@section('keywords', '')
@section('canonical', '')

@section('content')
	<form role="search" action="{{ route('stock_management.stock.data.output.export') }}" method="post" name="">
	    @csrf
        <div class="main-area">
            <div class="button_area">
                <div class="div">
                    <button class="button-2" type="submit" name="execute"><div class="text_wrapper_3">実行する</div></button>
                </div>
            </div>
            <div class="msg">
                <div class="view">
                    <div class="text_wrapper"><br/>
                </div>
            </div>
        </div>
    </form>
@endsection
