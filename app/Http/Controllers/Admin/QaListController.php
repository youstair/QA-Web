<?php

namespace App\Http\Controllers\Admin;


use App\Http\Model\QaList;
use Illuminate\Support\Facades\Input;

class QaListController extends CommonController
{
    //get.admin/qalist  展示分类列表
    public function index()
    {
//        $qalists=(new qalist)->tree();
//        return view('admin.qalist.index')->with('data',$qalists);
        $data=QaList::all();
//        print_r($data->links());
        return view('admin.ask',compact('data'));
    }

    //get  admin/qalist/{qalist} 展示提问结果
    public function show($qalist)
    {
        $input=Input::except('_token');
//        var_dump($input);
        unset($out);
        $fin = fopen("/var/www/html/youstair.com/qa/QA_handler/main/php_w.json", "w+");
// some code to be executed....

        fwrite($fin, json_encode($input));
        fclose($fin);
        $ids=$input['table_id'];
        $idt=$input['question'];
        $wait_l=array(" ","    ","\t","\n","\r");
        $wait_s=array("","","","","");
        $idts=str_replace($wait_l,$wait_s,$idt);
//        var_dump($ids);
//        var_dump($idts);
//        $c=exec("/usr/bin/python3.6 /var/www/html/youstair.com/qa/QA_handler/main/core_model.py 2>&1 {$ids} {$idts}", $out, $res);
//        $c=exec("PYTHONIOENCODING=utf-8 /usr/bin/python3.6  /var/www/html/youstair.com/qa/QA_handler/main/core_model.py 2>&1 {$idts} {$ids}",$out,$res);
        $c=exec("PYTHONIOENCODING=utf-8 /usr/bin/python3.6 /var/www/html/youstair.com/qa/QA_handler/main/core_model.py 2>&1 $ids $idts", $out, $res);
//        var_dump($out);
        $json_string = file_get_contents('/var/www/html/youstair.com/qa/QA_handler/main/python_w.json');
//        $json_string = fopen('/var/www/html/youstair.com/qa/QA_handler/main/python_w.json', "r");
//
//         用参数true把JSON字符串强制转成PHP数组
//        var_dump($json_string);
//        $data = [];
        $data = json_decode($json_string);
//        var_dump($data);
//        var_dump($data[0]->question);
        return view('getaspnet')->with('data', $data);
//        var_dump($data[0]['question']);
//        if(end($out)==']'){
//            if(end($out)==']') echo 'yes';
//            else echo 'no';
//            echo count($out);
//            $index=count($out);
//            $pin=17;
//            while($pin>=1){
//                var_dump($out[$index - $pin]);
//                $pin--;
//            }
//            $array=[];
//
//            $arrays=[];
//
//        }else{
//            return back()->with('smsg','回答失败，请规范您的输入');
//        }

//
//        $ans=[];
//        $index=4;
//        $indet=0;
//        while($index<7){
//            $ans[$indet++]=explode(',', $out[$index++]);
//        }
//        $next_controller='Admin'.'\\'.$ids.'Controller@ask';
////        print_r($next_controller);
////        var_dump($ans);
////        var_dump($out);
//        return redirect()->action($next_controller)->with('ans', $ans);
    }

    //get.admin/qalist  展示分类列表
    public function AnswerList()
    {
//        $webservices=(new webservice)->tree();
//        return view('admin.webservice.index')->with('data',$webservices);
        $data=QaList::paginate(15);
//        print_r($data->links());
        return view('QaList.index',compact('data'));
    }
    public function AddList()
    {
//        $webservices=(new webservice)->tree();
//        return view('admin.webservice.index')->with('data',$webservices);
        $data=QaList::paginate(15);
//        print_r($data->links());
        return view('QaList.AddList',compact('data'));
    }
}
