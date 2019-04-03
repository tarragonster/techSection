<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Providers\CacheLog;
use App\Providers\TranslateFree;
use Illuminate\Http\Request;
use Royalmar\HtmlDomParser\HtmlDomParser;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\Search;

class DictionariesController extends Controller
{


    public function search(Request $request){
//        $searches = Search::orderBy('created_at','desc');
        $q = Input::get ( 'q' );
        $parser = new \HtmlDomParser();

        $selectOption = $request->input('language');
        if($selectOption=='E'){
            $link='https://en.oxforddictionaries.com/definition/'.$q;
            $html= $parser->fileGetHtml($link);


            $word=$html->find("span.hw", 0);
            $spelling=$html->find("span.phoneticspelling",0);

            if(isset($word)==false || isset($spelling)==false){

                $display='No words found';
                $spelling='';
                $type='';
                $defs=['','','','',''];
                $example=['','','','',''];

//                return view('searches.index')->with('defs', $defs)->with('display', $display)
//                    ->with('spelling',$spelling)->with('type',$type)->with('example',$example)
//                    ->with('selectOption',$selectOption)->with('q',$q);

            }else{
                $searches = DB::table('searches')->select('list')->distinct()->get();

                $n = 0;
                $t = -1;
                $k = 0;
                $display=$word->plaintext;
                $type=$html->find("span.pos", 0)->plaintext;

                $spelling=$html->find("span.phoneticspelling",0)->plaintext;
//                $example=$html->find(".ex em",0)->plaintext;

                $defs=array();
                for($i=0;$i<5;$i++){
                    $defs[]=$html->find("span.ind", $i);
                    if(isset($defs[$i])==false){
                        $defs[$i]='';
                    }else{
                        $defs[$i]=$html->find("span.ind", $i)->plaintext;
                    }
                }

                $example=array();
                for($i=0;$i<5;$i++){
                    $example[]=$html->find(".ex em", $i);
                    if(isset($example[$i])==false){
                        $example[$i]='';
                    }else{
                        $example[$i]=$html->find(".ex em", $i)->plaintext;
                    }
                }
                 $data['defs'] = $defs;
                return response($data, 200)
                    ->header('Content-Type', 'text/plain');

//                return view('searches.index')->with('defs', $defs)->with('display',$display)
//                    ->with('spelling',$spelling)->with('type',$type)->with('example',$example)
//                    ->with('selectOption',$selectOption)->with('n',$n)->with('q',$q)
//                    ->with('searches',$searches)->with('t',$t)->with('k',$k);

            }
        }else{
            $link='https://endic.naver.com/search.nhn?sLn=en&isOnlyViewEE=N&query='.$q;
            $html= $parser->fileGetHtml($link);
            $word=$html->find("span.fnt_e30", 0);

            if(isset($word)==false){

                $display='No words found';
                $spelling='';
                $type='';
                $defs=['','','','',''];
                $example='';
                return view('searches.index')->with('defs', $defs)->with('display', $display)
                    ->with('spelling',$spelling)->with('type',$type)->with('example',$example)
                    ->with('selectOption',$selectOption)->with('q',$q);

            }else{
                $searches = DB::table('searches')->select('list')->get();

                $n = 0;
                $t = -1;
                $k = 0;
                $display=$word->plaintext;
                $type='';

                $defs=array();
                for($i=0;$i<5;$i++){
                    $defs[]=$html->find("span.fnt_k05", $i);
                    if(isset($defs[$i])==false){
                        $defs[$i]='';
                    }else{
                        $defs[$i]=$html->find("span.fnt_k05", $i)->plaintext;
                    }
                }

                $spelling='';
                $example='';

//                return view('searches.index')->with('defs', $defs)->with('display',$display)
//                    ->with('spelling',$spelling)->with('type',$type)->with('example',$example)
//                    ->with('selectOption',$selectOption)->with('n',$n)->with('q',$q)
//                    ->with('searches',$searches)->with('t',$t)->with('k',$k);

            }
        }
    }




}


