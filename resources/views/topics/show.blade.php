@extends('layouts.app')

@section('title', $topic->title)
@section('description', $topic->excerpt)

@section('content')

<div class="row">

    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs author-info">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="text-center">
                    作者：{{ $topic->user->name }}
                </div>
                <hr>
                <div class="media">
                    <div align="center">
                        <a href="{{ route('users.show', $topic->user->id) }}">
                            <img class="thumbnail img-responsive" src="{{ $topic->user->avatar }}" width="300px" height="300px">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 topic-content">
        <div class="panel panel-default">
            <div class="panel-body">
                <h1 class="text-center">
                    {{ $topic->title }}
                </h1>

                <div class="article-meta text-center">
                    {{ $topic->created_at->diffForHumans() }}
                    ⋅
                    <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
                    {{ $topic->reply_count }}
                </div>
                <div class="topic-body-parent">
                <div class="topic-body">
                    {!! $topic->body !!}
                </div>
                <a href="javascript:void(0);" class="read-more"><span>阅读全文<i class="fa fa-caret-down"></i></span></a>
                </div>
                @can('update',$topic)
                    <div class="operate">
                        <hr>
                        <a href="{{ route('topics.edit', $topic->id) }}" class="btn btn-default btn-xs" role="button">
                            <i class="glyphicon glyphicon-edit"></i> 编辑
                        </a>
                        <a href="{{ url('topics/'.$topic->id.'/destroy') }}" class="btn btn-default btn-xs" role="button">
                            <i class="glyphicon glyphicon-trash"></i> 删除
                        </a>
                    </div>
                @endcan
            </div>
        </div>
        {{-- 用户回复列表 --}}
        <div class="panel panel-default topic-reply">
            <div class="panel-body">
                @include('topics._reply_box', ['topic' => $topic])
                @include('topics._reply_list', ['replies' => $topic->replies()->with('user')->get()])
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style type="text/css">
#myAffix{
    z-index: 30;
}
#myAffix.affix{
    top: 0;
}
#myAffix.affix-bottom{
    border-top: 3px solid #eee;
    position: fixed;
}
.topic-body-parent{
    max-height: 500px;
    overflow: hidden;
    position: relative;
}
.topic-body-parent.expanded{
    max-height: none;
}
.topic-body-parent.expanded .read-more{
    display: none;
}
.topic-body-parent .read-more{
    text-align: center;
    display: block;
    height: 80px;
    margin-top: -80px;
    position: absolute;
    bottom: 0;
    width: 100%;
    text-decoration: none;

   background-image: -webkit-linear-gradient(top, rgba(255,255,255,0) 0, rgba(255,255,255,1) 100%);
  background-image: -o-linear-gradient(top, rgba(255,255,255,0) 0, rgba(255,255,255,1) 100%);
  background-image: -webkit-gradient(linear, center top, center bottom, color-stop(0, rgba(255,255,255,0)), to(rgba(255,255,255,1)));
  background-image: linear-gradient(to bottom, rgba(255,255,255,0) 0, rgba(255,255,255,1) 100%);
}
.topic-body-parent .read-more span{
    text-transform: uppercase;
    color: #000;
    font-weight: 600;
    text-shadow: 0 0 2px #888;
    position: absolute;
    bottom:0;
    left: 50%;

    -webkit-transform: translate(-50%, 0);
  -ms-transform: translate(-50%, 0);
  -o-transform: translate(-50%, 0);
  transform: translate(-50%, 0);
}
</style>

@endsection
@section('scripts')
<script type="text/javascript">
    if($('.topic-body-parent').height() >= $('.topic-body-parent > .topic-body').height()){
        $('.topic-body-parent .read-more').remove();
    }

    $('.topic-body-parent .read-more').on('click', function(){
        $(this).parents('.topic-body-parent').addClass("expanded");
    });
</script>
@endsection