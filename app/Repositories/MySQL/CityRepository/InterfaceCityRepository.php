<?php

namespace App\Repositories\MySQL\CityRepository;

use App\Repositories\MySQL\IBaseRepository;

interface InterfaceCityRepository extends IBaseRepository
{
    public function getByProvinceId($provinceId);
}
