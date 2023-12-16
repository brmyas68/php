<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
          "name" => "افق گستران هاشمی",
            "email" => "info@ofoghgostaranhashemi.ir",
            "phone" => "02122458190",
            "slogan" => "همین امروز، مسیر آینده را هموار میسازیم",
            "start_year" => 1398,
            "location" => "35.79872121387227,51.50461436363651",
            "address" => "تهران،بزرگراه ارتش،جنب شمیران سنتر،پلاک77،ساختمان کیمیا،طبقه اول،واحد یک",
            "description" => "این یک متن تستی می باشد.این یک متن تستی می باشد.این یک متن تستی می باشد.این یک متن تستی می باشد.
            این یک متن تستی می باشد.این یک متن تستی می باشد.این یک متن تستی می باشد.این یک متن تستی می باشد.این یک متن تستی می باشد.
            این یک متن تستی می باشد.این یک متن تستی می باشد.این یک متن تستی می باشد.این یک متن تستی می باشد.این یک متن تستی می باشد."
        ];
        Company::create($data);
    }
}
