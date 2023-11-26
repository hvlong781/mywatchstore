<!-- resources/views/profile.blade.php -->

@extends('main')

@section('content')
    <div class="bg0 m-t-23 p-b-140 p-t-80">
        <div class="container">
            @include('admin.alert')
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-body text-center">
                            <h2 class="card-title">{{ $title }}</h2>

                            <form method="POST" action="/profile/update" enctype="multipart/form-data" id="profileForm">
                                <!-- Hiển thị avatar dưới dạng hình tròn -->
                                <label for="avatarInput" class="profile-avatar mb-4">
                                    <img src="storage/{{ auth()->user()->avatar }}" alt="Avatar" class="img-fluid rounded-circle" id="avatarPreview">
                                    <div class="overlay">
                                        <i class="fa fa-camera"></i>
                                    </div>
                                    <input type="file" name="avatar" id="avatarInput" class="form-control-file" accept="image/*" style="display: none;" onchange="updateAvatar(this);">
                                </label>

                                <!-- Input fields - Name, Email, Address, Phone -->
                                <div class="form-group">
                                    <label for="name">Name:</label>
                                    <input type="text" name="name" value="{{ auth()->user()->name }}" class="form-control" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" name="email" value="{{ auth()->user()->email }}" class="form-control" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="address">Address:</label>
                                    <input type="text" name="address" value="{{ auth()->user()->address ?? 'Not provided' }}" class="form-control" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="phone">Phone:</label>
                                    <input type="text" name="phone" value="{{ auth()->user()->phone ?? 'Not provided' }}" class="form-control" disabled>
                                </div>

                                <!-- Nút chỉnh sửa và lưu -->
                                <button type="button" class="btn btn-primary" onclick="toggleEdit()">Edit Profile</button>
                                <button type="submit" class="btn btn-success d-none" id="saveBtn">Save Changes</button>
                                <button type="button" class="btn btn-secondary d-none" onclick="cancelEdit()">Cancel</button>
                                @csrf
                            </form>
                        </div>
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
@endsection
