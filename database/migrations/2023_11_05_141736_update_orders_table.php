<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('user_name')->nullable(); // Tên người dùng
            $table->string('user_email')->nullable(); // Email người dùng
            $table->string('shipping_address')->nullable(); // Địa chỉ giao hàng
            $table->string('shipping_phone')->nullable(); // Số điện thoại người nhận hàng
            $table->enum('status', [
                'Đang chờ xử lý',
                'Đơn hàng đã được đặt',
                'Sẵn sàng để vận chuyển',
                'Đang trên đường giao',
                'Tiến hành giao hàng',
                'Đã giao',
                'Đã hủy'
            ])->default('Đang chờ xử lý'); // Trạng thái đơn hàng
            $table->text('message')->nullable(); // Tin nhắn từ khách hàng
            $table->string('invoice_number')->nullable(); // Số hóa đơn
            $table->timestamps(); // Thời gian tạo và cập nhật đơn hàng
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'user_name', 'user_email', 'shipping_address', 'shipping_phone',
                'status', 'message', 'invoice_number', 'created_at', 'updated_at'
            ]);
        });
    }
};
