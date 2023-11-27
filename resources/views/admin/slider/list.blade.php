@extends('admin.master')

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th style="width: 50px">ID</th>
                        <th>Tiêu đề</th>
                        <th>Link</th>
                        <th>Hình ảnh</th>
                        <th>Trạng thái</th>
                        <th>Cập nhật</th>
                        <th style="width: 100px">&nbsp;</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($sliders as $key => $slider)
                        <tr>
                            <td>{{ $slider->id }}</td>
                            <td>{{ $slider->name }}</td>
                            <td>{{ $slider->url }}</td>
                            <td><a href="{{ $slider->image }}" target="_blank">
                                    <img src="{{ $slider->image }}" height="45px">
                                </a>
                            </td>
                            <td>{!! \App\Helpers\Helper::active($slider->active) !!}</td>
                            <td>{{ $slider->updated_at }}</td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="/admin/sliders/edit/{{ $slider->id }}">
                                    <i class="ti-pencil-alt"></i>
                                </a>

                                <a class="btn btn-danger btn-sm" href="#"
                                onclick="removeRow({{ $slider->id }},  '/admin/sliders/destroy')">
                                    <i class="ti-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                {!! $sliders->links() !!}
            </div>
        </div>
    </div>
</div>
@endsection
