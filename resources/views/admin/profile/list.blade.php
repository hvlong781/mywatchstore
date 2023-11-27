@extends('admin.master')

@section('content')
<div class="row">
    <div class="col-lg-3"></div>
    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body text-center">
                                    {{-- <h2 class="card-title">{{ $title }}</h2> --}}

                                    <form method="POST" action="profile/update" enctype="multipart/form-data" id="profileForm">
                                        <!-- Hiển thị avatar dưới dạng hình tròn -->
                                        <label for="avatarInput" class="profile-avatar mb-4">
                                            @php
                                                $user = auth()->user();
                                                $avatarPath = $user ? $user->avatar : null;
                                            @endphp
                                            <img src="{{ $avatarPath ? asset($avatarPath) : asset('storage/avatar.jpg') }}" alt="Avatar" class="img-fluid rounded-circle" id="avatarPreview">
                                            <div class="overlay">
                                                <i class="ti-pencil-alt"></i>
                                            </div>
                                            <input type="file" name="avatar" id="avatarInput" class="form-control-file" accept="image/*" style="display: none;" onchange="updateAvatar(this);">
                                        </label>

                                        <!-- Input fields - Name, Email, Address, Phone -->
                                        <div class="form-group">
                                            {{-- <label for="name">Name:</label> --}}
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Họ tên</span>
                                                </div>
                                                <input type="text" name="name" value="{{ auth()->user()->name }}" class="form-control" disabled>
                                            </div>
                                            {{-- <input type="text" name="name" value="{{ auth()->user()->name }}" class="form-control" disabled> --}}
                                        </div>

                                        <div class="form-group">
                                            {{-- <label for="address">Address:</label> --}}
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Địa chỉ</span>
                                                </div>
                                                <input type="text" name="address" value="{{ auth()->user()->address ?? 'Not provided' }}" class="form-control" disabled>
                                            </div>
                                            {{-- <input type="text" name="address" value="{{ auth()->user()->address ?? 'Not provided' }}" class="form-control" disabled> --}}
                                        </div>

                                        <div class="form-group">
                                            {{-- <label for="phone">Phone:</label> --}}
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Số điện thoại</span>
                                                </div>
                                                <input type="text" name="phone" value="{{ auth()->user()->phone ?? 'Not provided' }}" class="form-control" disabled>
                                            </div>
                                            {{-- <input type="text" name="phone" value="{{ auth()->user()->phone ?? 'Not provided' }}" class="form-control" disabled> --}}
                                        </div>

                                        <!-- Nút chỉnh sửa và lưu -->
                                        <button type="button" class="btn btn-primary" onclick="toggleEdit()">Chỉnh Sửa</button>
                                        <button type="submit" class="btn btn-success d-none" id="saveBtn">Lưu Thay Đổi</button>
                                        <button type="button" class="btn btn-secondary d-none" onclick="cancelEdit()">Trở Lại</button>
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <style>
                    /* Tinh chỉnh CSS */
                    .profile-avatar {
                        position: relative;
                        margin-bottom: 20px; /* Giữa avatar và các trường thông tin */
                        cursor: pointer; /* Thêm thuộc tính con trỏ để chỉ ra có thể click vào */
                    }

                    .profile-avatar img {
                        width: 150px; /* Kích thước hình ảnh avatar */
                        height: 150px;
                        border-radius: 50%; /* Bo tròn hình ảnh */
                    }

                    .overlay {
                        position: absolute;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100%;
                        background: rgba(0, 0, 0, 0.5);
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        color: #fff;
                        opacity: 0;
                    }

                    .profile-avatar:hover .overlay {
                        opacity: 1;
                    }

                    .overlay i {
                        font-size: 24px;
                    }
                </style>

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        disableInputs();
                    });

                    function disableInputs() {
                        const form = document.getElementById('profileForm');
                        const inputs = form.querySelectorAll('input:not([type="file"])');
                        const saveBtn = document.getElementById('saveBtn');
                        const cancelBtn = document.querySelector('[onclick="cancelEdit()"]');

                        inputs.forEach(input => {
                            input.disabled = true;
                        });

                        saveBtn.classList.add('d-none');
                        cancelBtn.classList.add('d-none');
                    }

                    function toggleEdit() {
                        const form = document.getElementById('profileForm');
                        const inputs = form.querySelectorAll('input:not([type="file"])');
                        const saveBtn = document.getElementById('saveBtn');
                        const cancelBtn = document.querySelector('[onclick="cancelEdit()"]');

                        inputs.forEach(input => {
                            input.disabled = !input.disabled;
                        });

                        saveBtn.classList.toggle('d-none');
                        cancelBtn.classList.toggle('d-none');

                        if (!saveBtn.classList.contains('d-none')) {
                            // Chế độ chỉnh sửa, ẩn nút "Cancel"
                            cancelBtn.classList.add('d-none');
                        }
                    }

                    function cancelEdit() {
                        const form = document.getElementById('profileForm');
                        const inputs = form.querySelectorAll('input:not([type="file"])');
                        const saveBtn = document.getElementById('saveBtn');
                        const cancelBtn = document.querySelector('[onclick="cancelEdit()"]');

                        inputs.forEach(input => {
                            input.disabled = true;
                        });

                        saveBtn.classList.add('d-none');
                        cancelBtn.classList.add('d-none');
                    }

                    function updateAvatar(input) {
                        const preview = document.getElementById('avatarPreview');
                        const file = input.files[0];

                        if (file) {
                            const reader = new FileReader();

                            reader.onload = function (e) {
                                preview.src = e.target.result;
                            };

                            reader.readAsDataURL(file);
                        }
                    }
                </script>
            </div>
        </div>
    </div>
</div>
@endsection
