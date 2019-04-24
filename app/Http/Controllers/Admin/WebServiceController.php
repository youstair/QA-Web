<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\WebService;
use App\Http\Model\QaList;
use http\Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class WebServiceController extends CommonController
{
    //
    //
    //get.admin/WebService  问答对列表首页
    public function index()
    {
//        $WebServices=(new WebService)->tree();
//        return view('admin.WebService.index')->with('data',$WebServices);
        $data=WebService::paginate(15);
//        print_r($data->links());
        return view('WebService.index',compact('data'));
    }
    //get admin/WebService/create 添加问答对
    public function create()
    {
        return view('WebService/add');
    }
    //post.admin/WebService 添加问答对提交
    public function store()
    {
        $input=Input::except('_token');
        $rules= [
//            'cate_name'=>'required',
            'question'=>'required',
            'answer'=>'required',
            'link'=>'required'
        ];
        $message=[
//            'cate_name.required'=>'问答对名称不能为空',
            'question.required'=>'问题不能为空',
            'answer.required'=>'答案不能为空',
            'link.required'=>'链接不能为空',
        ];
        $validator=Validator::make($_POST,$rules,$message);

        if($validator->passes())
        {
            $re=WebService::create($input);
            if($re){
                return redirect('admin/WebService');
            }else{
                back()->with('msg','数据填充失败，请稍后重试');
            }
        }
        else {

            return back()->withErrors($validator);
        }
    }

    //get  admin/WebService/{WebService} 展示问答对答案
    public function show($id)
    {
        $re=WebService::find($id);
        return $re->answer;
    }
    //put  admin.WebService.update
    public function update($id)
    {
        $input=Input::except('_token','_method');
        $re=WebService::where('id',$id)->update($input);
        if($re){
            return redirect('admin/WebService');
        }else{
            back()->with('msg','问答对更新失败，请稍后重试');
        }
    }
    //delete admin/WebService/{WebService}
    public function destroy($id)
    {
        $re=WebService::where('id',$id)->delete();
        if($re){
            $data=[
                'status'=>0,
                'msg'=>'问答对删除成功',
            ];
        }else{
            $data=[
                'status'=>1,
                'msg'=>'问答对删除失败，请稍后重试',
            ];
        }
        return $data;
    }
    //get  admin.WebService.edit
//    admin/WebService/{WebService}/edit
    public function edit($cate_id)
    {
        $field=WebService::find($cate_id);
//        $data=WebService::where('cate_pid',0)->get();
        return view('WebService.edit',compact('field'));
    }
}
