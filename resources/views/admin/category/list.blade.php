@extends('admin.master')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 50px">ID</th>
                        <th>Tên danh mục</th>
                        <th>Trạng thái</th>
                        <th>Cập nhật</th>
                        <th style="width: 100px">&nbsp;</th>
                    </tr>
                </thead>

                <tbody>
                    {!! \app\Helpers\Helper::category($categories) !!}
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
