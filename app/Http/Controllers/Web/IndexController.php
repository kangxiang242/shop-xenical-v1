<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Repositories\FaqRepository;
use App\Repositories\NewRepository;
use App\Repositories\ProductRepository;

class IndexController extends Controller
{
    public function index(ProductRepository $productRepository,NewRepository $newRepository){
        $products = $productRepository->all();

        $for_people_untreated = app('cache.config')->get('for_people');
        $for_people = [];
        if($for_people_untreated){
            $for_people = json_decode($for_people_untreated);
        }


        $news = $newRepository->top();

        $faq = app(FaqRepository::class)->all();

        return template('index',compact('products','news','for_people','faq'));
    }


}
