<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Illuminate\Support\Facades\Redis;
use Log;
class updategoodshits extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'updategoodshits';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '从redis更新商品详情点击量到数据库';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $hits = Redis::zrange('hit',0,-1);
//        dd($hits);
        if(count($hits)){
            foreach ($hits as $v){
                $update = [
                    'hits' =>Redis::zscore('hit',$v)
                ];
                $hitarr = explode('_',$v);
                $goods_id = $hitarr[1];
                $res = DB::table('goods')->where('goods_id',$goods_id)->update($update);
                if($res){
                    Log::info($goods_id.'更新点击量成功');
                }
            }
        }

    }
}
