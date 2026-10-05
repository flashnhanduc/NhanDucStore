<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       // Gọi thư viện Faker với ngôn ngữ Tiếng Việt để tạo tên/địa chỉ giả cho giống thật
        $faker = Faker::create('vi_VN');

        // 1. TẠO 3 DANH MỤC
        $categories = ['Áo Nam', 'Quần Nam', 'Phụ Kiện'];
        $createdCategories = [];
        foreach ($categories as $cat) {
            $createdCategories[] = Category::create([
                'name' => $cat,
                'slug' => Str::slug($cat),
                'status' => 1
            ]);
        }

        // 2. TẠO 15 SẢN PHẨM & CÁC BIẾN THỂ TRONG KHO
        $sizes = ['S', 'M', 'L', 'XL'];
        $colors = ['Đen', 'Trắng', 'Xám', 'Xanh Navy'];

        for ($i = 1; $i <= 15; $i++) {
            $name = 'Sản phẩm áo quần thời trang ' . $i;
            $product = Product::create([
                'category_id' => $createdCategories[array_rand($createdCategories)]->id, // Chọn ngẫu nhiên 1 danh mục
                'name' => $name,
                'slug' => Str::slug($name . '-' . Str::random(5)),
                'price' => $faker->numberBetween(150, 500) * 1000, // Giá từ 150k - 500k
                'is_active' => 1,
            ]);

            // Mỗi sản phẩm tạo ngẫu nhiên 3 biến thể (Size/Màu)
            for ($j = 0; $j < 3; $j++) {
                ProductVariant::create([
                    'product_id' => $product->id,
                    'sku' => strtoupper(Str::random(8)),
                    'color' => $colors[array_rand($colors)],
                    'size' => $sizes[array_rand($sizes)],
                    'stock' => $faker->numberBetween(10, 50) // Tồn kho 10-50 cái
                ]);
            }
        }

        // 3. TẠO 30 ĐƠN HÀNG GIẢ CHO KHÁCH
        $variants = ProductVariant::with('product')->get(); // Lấy tất cả biến thể ra để bán

        for ($i = 1; $i <= 30; $i++) {
            $order = Order::create([
                'name' => $faker->name, // Tên ngẫu nhiên (VD: Nguyễn Văn A)
                'phone' => $faker->phoneNumber,
                'address' => $faker->streetAddress,
                'total_money' => 0, // Tạm thời để 0, lát cộng dồn tính sau
                'status' => $faker->numberBetween(0, 2), // Trạng thái 0, 1, 2
            ]);

            $totalMoney = 0;
            // Giả lập mỗi khách mua từ 1 đến 4 món đồ khác nhau
            $numItems = random_int(1, 4); 
            
            for ($k = 0; $k < $numItems; $k++) {
                $variant = $variants->random(); // Bốc bừa 1 cái áo/quần trong kho
                $quantity = random_int(1, 3); // Mua 1-3 cái
                $price = $variant->product->price; // Lấy giá gốc
                $total = $quantity * $price; // Thành tiền

                // Ghi vào chi tiết hóa đơn
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_variant_id' => $variant->id,
                    'quantity' => $quantity,
                    'price' => $price,
                    'total' => $total
                ]);

                $totalMoney += $total; // Cộng dồn vào tổng hóa đơn
            }

            // Update lại tổng tiền chính xác cho đơn hàng
            $order->update(['total_money' => $totalMoney]);
        }
    }
}
