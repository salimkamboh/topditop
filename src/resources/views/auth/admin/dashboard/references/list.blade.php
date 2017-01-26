@extends("master.dashboard-layout")

@section("pageTitle") All References @stop

@section("content")

    <section id="dashboard-references">
        <div class="container">
            <div class="row">

                <div class="col-sm-12 pagination-main">
                    <a href="{{ route("admin_section") }}"><i
                                class="icon-arrow-left"></i><span>back to Dashboard</span></a>
                    <span>&gt;</span>
                    <a href="{{ route("admin_references") }}"><span>{{ trans('messages.manage_reference') }}</span></a>
                    <h3>{{ trans('messages.manage_reference') }}</h3>
                </div>

                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-4 ">
                            <div class="widget-side item-shadow">

                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="row">

                                @if(isset($references))
                                    @foreach($references as $reference)

                                        <div class="col-md-6">
                                            <div class="single-item item-shadow">
                                                <img alt="" class="img-responsive"
                                                     src="@if($reference->getImageByThumb('reference_thumb') !== null) {{$reference->getImageByThumb('reference_thumb')}} @endif">
                                                @if($reference->status == 0)
                                                    <div class="item-overlay">{{ trans('messages.unpublish_reference') }}</div>@endif
                                                <div class="item-info">
                                                    <div class="item-info-top clearfix">
                                                        <div class="width-fix">
                                                            <span class="title">{{$reference->title}}</span>
                                                            <span class="number-of pull-left">({{$reference->getNumberOfImages()}} {{ trans('messages.scene') }})</span></div>
                                                        <span class="date pull-right">{{$reference->getNiceDate()}}</span>
                                                    </div>
                                                    <div class="item-info-bottom">
                                                        @if($reference->status == 0)
                                                            <a href="javascript:void(0)" class="click-button">Unpublished</a>
                                                        @else
                                                            <a href="{{ route("admin_reference_edit", $reference) }}"
                                                               class="click-button">{{ trans('messages.manage_reference') }}</a>
                                                        @endif

                                                        @if($reference->status == 0)
                                                            <a href="{{ route("dashboard_reference_publish", $reference) }}"
                                                               class="click-button">{{ trans('messages.publish_reference') }}</a>
                                                        @else
                                                            <a href="{{ route("dashboard_reference_unpublish", $reference) }}"
                                                               class="click-button">{{ trans('messages.unpublish_reference') }}</a>
                                                        @endif
                                                        <a href="{{ route("dashboard_reference_delete", $reference) }}"
                                                           class="click-button">{{ trans('messages.delete_reference') }}﻿</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-md-6 text-center">
                                        <h2>There are no references.</h2>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop
