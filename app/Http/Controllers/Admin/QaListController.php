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
        unset($out);
        $ids=$input['table_id'];
        $idt=$input['question'];
        $wait_l=array(" ","    ","\t","\n","\r");
        $wait_s=array("","","","","");
        $idts=str_replace($wait_l,$wait_s,$idt);
        var_dump($idts);
        exec("/usr/bin/python3 /var/www/html/youstair.com/qa/QA_handler/main/test.py 2>&1 {$ids} {$idts} ",$out,$res);
        $ans=[];
        $index=4;
        $indet=0;
        while($index<7){
            $ans[$indet++]=explode(',',$out[$index++]);
        }
        $next_controller='Admin'.'\\'.$ids.'Controller@ask';
        print_r($next_controller);
        return redirect()->action($next_controller)->with('ans', $ans);
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
