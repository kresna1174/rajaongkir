<?php 

namespace App\Services;

use App\Repositories\FetchRepository;

class FetchService implements FetchServiceInterface {
    
    protected $fetchRepository;
    public function __construct(FetchRepository $fetchRepository)
    {
        $this->fetchRepository = $fetchRepository;
    }

    public function getProvince()
    {
        return $this->fetchRepository->getProvince();
    }

    public function getCity()
    {
        return $this->fetchRepository->getCity();
    }

}

?>