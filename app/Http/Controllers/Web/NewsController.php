<?php

namespace App\Http\Controllers\Web;

use App\Handlers\ArticleAnchorsHandler;
use App\Http\Controllers\Controller;
use App\Models\Anchor;
use App\Repositories\NewRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    private $newRepository;

    public function __construct(NewRepository $newRepository)
    {

        $this->newRepository = $newRepository;
    }

    public function index(Request $request){

        $news = $this->newRepository->model()->where('status',1)->orderBy('sort','desc')->paginate(10);

        $newNews = $this->newRepository->newNews();

        return template('news.index')->with('news',$news)->with('newNews',$newNews);
    }


    public function show($id,ProductRepository $productRepository){
        $news = $this->newRepository->find($id);
        if(!$news){
            abort(404);
        }

        $next = $this->newRepository->getNextArticle($id,$news->article_cate_id);
        $prev = $this->newRepository->getPrevArticle($id,$news->article_cate_id);
        $news->content = app(ArticleAnchorsHandler::class)->setAnchors($news->content,Anchor::get()->toArray());
        $news->content = app(ArticleAnchorsHandler::class)->relatedArticle($news->content,$id);

        return template('news.show',compact('news','next','prev'));

    }
}
