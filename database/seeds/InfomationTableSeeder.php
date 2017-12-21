<?php

use Illuminate\Database\Seeder;

class InfomationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('information')->insert([
            'company_name' => 'UK Window',
            'address' => '488 Nguyễn Lương Bằng, Tp. Đà Nẵng',
            'logo' => '',
            'address_company' => 'Trụ sở chính : 488 Nguyễn Lương Bằng, Tp. Đà Nẵng
                                    Nhà máy : 488 Nguyễn Lương Bằng, Tp. Đà Nẵng
                                    ĐT: 0511. 3895. 666 *
                                    Fax: 0511. 3895. 669
                                    HOTLINE: 0905.191.191
                                    Email: ukwindow@gmail.com',

            'office' => 'Quảng Bình: 332 Trần Hưng Đạo, Tp. Đồng Hới Nhà máy: 488 Nguyễn Lương Bằng, Tp. Đà Nẵng
                            Huế: 51 Hai Bà Trưng Tp. Huế
                            Quy Nhơn: 388 Nguyễn Thái Học, Tp. Quy Nhơn
                            Lâm Đồng: 1D Hai Bà Trưng, Tp. Đà Lạt
                            Nha Trang: 21 Trần Quý Cáp, Tp.Nha Trang
                            Phú Yên: 303 Nguyễn Huệ, Tp. Tuy Hòa
                            HCM: 47 Điện Biên Phủ, Q. Bình Thạnh, Tp HCM',
            'video' => '',
        ]);
    }
}
