@extends('layouts.admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/index')}}">首页</a> &raquo; 发起提问
    </div>
    <!--面包屑导航 结束-->

    <!--结果集标题与导航组件 开始-->
    <!--结果集标题与导航组件 结束-->
{{-- admin/category/{category}--}}
    <div class="result_wrap">
        <form action="{{url('admin/qalist/{getanswer}')}}" method="get">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                <tr>
                    <th width="120"><i class="require">*</i>问题分类：</th>
                    <td>
                        <select name="table_id">
                            <option value="0">==问题分类==</option>
                            @foreach($data as $d)
                                <option value="{{$d->cate_name}}">{{$d->cate_name}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>请输入问题：</th>
                    <td>
                        <input type="text" class="lg" name="question">
                        <span><i class="fa fa-exclamation-circle yellow"></i>问题必须填写</span>
                    </td>
                </tr>

                <tr>
                    <th></th>
                    <td>
                        <input type="submit" value="发起提问">

                    </td>
                </tr>
                </tbody>
            </table>
        </form>
    </div>
    @endsection
