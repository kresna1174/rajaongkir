<?php 

namespace App\Repositories;

use App\Models\City;
use App\Models\Province;

class FetchRepository implements FetchRepositoryInterface {
    
    protected $provinceModel;
    protected $cityModel;
    public function __construct(Province $provinceModel, City $cityModel)
    {
        $this->provinceModel = $provinceModel;
        $this->cityModel = $cityModel;
    }

    public function getProvince()
    {
        return $this->provinceModel::select('*');
    }

    public function getCity()
    {
        return $this->cityModel::select('*');
    }

}

?>