@extends('layouts.admin')
    @section('content')
	<!--面包屑导航 开始-->
	<div class="crumb_warp">
		<!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
		<i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a>
{{--        &raquo; <a href="{{url('admin/qalist')}}" target="main">发起提问</a>--}}
	</div>
	<!--面包屑导航 结束-->
	
	<!--结果集标题与导航组件 开始-->
{{--	<div class="result_wrap">--}}
{{--        <div class="result_title">--}}
{{--            <h3>快捷操作</h3>--}}
{{--        </div>--}}
{{--        <div class="result_content">--}}
{{--            <div class="short_wrap">--}}
{{--                <a href="#"><i class="fa fa-plus"></i>新增文章</a>--}}
{{--                <a href="#"><i class="fa fa-recycle"></i>批量删除</a>--}}
{{--                <a href="#"><i class="fa fa-refresh"></i>更新排序</a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <!--结果集标题与导航组件 结束-->

	
    <div class="result_wrap">
        <div class="result_title">
            <h3>本机系统基本信息</h3>
        </div>
        <div class="result_content">
            <ul>
                <li>
                    <label>操作系统</label><span>{{PHP_OS}}</span>
                </li>
                <li>
                    <label>运行环境</label><span>{{$_SERVER['SERVER_SOFTWARE']}}</span>
                </li>
                <li>
                    <label>PHP运行方式</label><span>apache2handler</span>
                </li>
{{--                <li>--}}
{{--                    <label>静静设计-版本</label><span>v-1.0</span>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <label>上传附件限制</label><span>2M</span>--}}
{{--                </li>--}}
                <li >
                    <label>北京时间</label><span id="time"><?php echo date('Y年m月d日 H时i分s秒')?></span>
                </li>
                <li>
                    <label>服务器域名/IP</label><span>{{$_SERVER['SERVER_NAME']}} [{{$_SERVER['SERVER_ADDR']}}]</span>
                </li>
                <li>
                    <label>Host</label><span>127.0.0.1</span>
                </li>
            </ul>

        </div>
        <script type="text/javascript">
            function showtime()
            {
                var myDate = new Date();
                document.getElementById("time").innerHTML = myDate.getFullYear() + "年 " + myDate.getHours() + "时 " + myDate.getMinutes() + "分 " + myDate.getSeconds() + "秒 " ;
                setTimeout("showtime()",1000);
            }
        </script>
        <div id="time">
            <script type="text/javascript">showtime();</script>
        </div>
    </div>

        @endsection