<!-- Trong file sales_statistics.blade.php -->
@extends('admin.master')

@section('content')

    {{-- @include('admin.dashboard.status_count') --}}

    {{-- row2 --}}
    @include('admin.dashboard.conversion')

    {{-- @include('admin.dashboard.orders_today') --}}

    @include('admin.dashboard.money')
    {{-- end_row2 --}}


    {{-- row3 --}}
    @include('admin.dashboard.category')

    @include('admin.dashboard.brand')
    {{-- end_row3 --}}


    @include('admin.dashboard.sales_statistics')

@endsection
