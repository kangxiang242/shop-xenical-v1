<?php


namespace App\Http\Controllers\Web;


use App\Models\Compute;
use App\Models\Product;
use App\Repositories\FaqRepository;
use App\Services\VehicleService;
use Illuminate\Http\Request;

class PageController extends BaseController
{


    public function faq(){
        $faq = app(FaqRepository::class)->all();
        return template('faq',compact('faq'));
    }

    public function about(){
        $title = app('cache.config')->get('about_title');
        $content = app('cache.config')->get('about_content');
        $html_code = app('cache.config')->get('about_html_code');
        return template('page',compact('title','content','html_code'));
    }

    public function guide(){
        $title = app('cache.config')->get('notes_buy_title');
        $content = app('cache.config')->get('notes_buy_content');
        return template('page',compact('title','content'));
    }

}
