<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GitgubController extends Controller
{
    static $base = 'https://api.github.com';

    public function frontpage(Request $request) {

        $c = curl_init();
        $url = 'https://github-trending-api.now.sh/repositories?language=&since=daily';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = json_decode(curl_exec($ch));

        switch ($request->s) {
            case 'name':
                usort($res, function ($a, $b) { return $a->name <=> $b->name; });
                break;
            case 'stars':
                usort($res, function ($a, $b) { return $a->stars <=> $b->stars; });
                break;
            case 'owner':
                usort($res, function ($a, $b) { return $a->author <=> $b->author; });
                break;
        }

        return view('frontpage', ['res' => $res,'url' => $url]);
    }

    public function searchpage(Request $request)
    {
        $request->flash();
        $ch = curl_init();

        $sort = '';
        $order = '';
        if ($request->sort  === 'name') {
            $sort = 'best-match';
            $order = 'asc';
        }
        elseif($request->sort === 'stars') {
            $sort = 'stars';
            $order = 'desc';
        }

        $url = self::$base . '/search/repositories?' . http_build_query(['q' => $request->qry, 'sort'=>$sort, 'order'=>$order]);

        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => [
                "Accept: application/vnd.github.v3+json",
                "Content-Type: text/plain",
                "User-Agent: Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 YaBrowser/16.3.0.7146 Yowser/2.5 Safari/537.36"
            ],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
        ]);
        $res = json_decode(curl_exec($ch));

        $pg = null;
        if ($res && $res->total_count){
            $cp = $request->p + 0;
            $sp = max($cp - 5, 0);
            $ep = $sp + 10;
            $last =  floor($res->total_count / 30);
            if ($ep > $last) {
                $ep = $last;
            }

            $pg = [
                'cur' => $cp,
                'start' => $sp,
                'end' => $ep,
                'last' => $last
            ];
        }

        return view('searchpage', ['res' => $res, 'url' => $url, 'pg'=>$pg ]);

    }




}

