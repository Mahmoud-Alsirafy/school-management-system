<?php
namespace App\Repository\Promotion;



interface PromotionRepositoryInterface{
     // Get All Promotion Info
    public function index();


    public function create_promotion();

    // Store New Promotion In DB
    public function store_promotion($request);


    public function delete($request);

}
