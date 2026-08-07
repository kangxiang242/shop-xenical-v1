<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\CommentImage;
use App\Models\CommentLabel;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Carbon\Carbon;

class ProductController extends Controller
{
    public function index(ProductRepository $productRepository){
        $products = $productRepository->all();

        return template('product.index',compact('products'));
    }


    public function show($id){
        $product = Product::where('id',$id)->where('status',1)->first();

        if(!$product){
            abort(404);
        }

        $goods_thumbnail_untreated = app('cache.config')->get('goods_thumbnail');
        $goods_thumbnail = [];
        if($goods_thumbnail_untreated){
            $goods_thumbnail = json_decode($goods_thumbnail_untreated,true);
        }



        $goods_instructions_untreated = app('cache.config')->get('goods_instructions');
        $goods_instructions = [];
        if($goods_instructions_untreated){
            $goods_instructions = json_decode($goods_instructions_untreated,true);
        }

        if($product->quantity >= 24){
            $discount = collect();
        }else{
            $discount = Product::where('status',1)->where('quantity','>=',$product->quantity)->orderBy('quantity','asc')->limit(2)->get();
        }


        $comment = Comment::where('status',1)->where('mode',0)->get()->shuffle();

        $comment_images1 = CommentImage::where('status',0)->where('mode',0)->get()->shuffle();
        $comment_images2 = CommentImage::where('status',0)->where('mode',1)->get()->shuffle();


        foreach ($comment as $key => $item) {

            if($item->is_comment_image == 1 && !$item->comment_image){
                if($item->mode == 1){
                    $comment_image = $comment_images2->pop();
                }else{
                    $comment_image = $comment_images1->pop();
                }
                if($comment_image){
                    $item->comment_image = $comment_image->image;
                    $comment_image->status = 1;
                    $comment_image->save();
                    $item->save();
                }
            }


            if ($key == 0) {
                $item->time_at = mt_rand(1, 10) . '分钟前';
            } elseif ($key == 1) {
                $item->time_at = mt_rand(30, 59) . '分钟前';
            } elseif ($key == 2) {
                $item->time_at = mt_rand(1, 12) . '小时前';
            } elseif ($key == 3) {
                $item->time_at = mt_rand(13, 24) . '小时前';
            } elseif ($key == 4) {
                $item->time_at = '昨天';
            } else {
                // 计算减少的天数
                $days = floor(($key - 4) / 4);
                // 获取当前日期，并减去相应的天数
                $date = Carbon::now()->subDays($days);
                $item->time_at = $date->format('m月d日');
            }
        }

        $comment_labels = CommentLabel::orderBy('sort')->get();

        $goods = $product;

        return template('product.show',compact('product','goods','goods_thumbnail','goods_instructions','discount','comment_labels','comment'));
    }
}
