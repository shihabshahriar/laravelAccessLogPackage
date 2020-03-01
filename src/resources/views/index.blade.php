@extends('layouts.backendlayout')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Access Log List</h1>

    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box">

                    
                                        
                    {!! Form::open(['method'=>'GET', 'action'=>['\AnnaNovas\AccessLog\Http\controllers\AccessLogController@index']]) !!}
                    <!-- /.box-header -->

                    <div class="box-body">
                        <div class="row">
                            
                            @foreach ($models as $model)
                                <div class="col-md-2">
                                    <div class="form-group">
                                        {!! Form::label( 'accesslogmodel_'.Str::slug($model, '-'), $model) !!}
                                        {!! Form::select( 'accesslogmodel_'.Str::slug($model, '-'), $modelData['accesslogmodel_'.Str::slug($model, '-')], request()->get('accesslogmodel_'.Str::slug($model, '-')), ['data-model'=>$model, 'class'=>'form-control ajax_data', 'style'=>'width:100%;']) !!}
                                    </div>
                                </div>
                            @endforeach
                            
                            
                             <div class="col-md-2">
                                <div class="form-group">
                                    {!! Form::label('guard', 'Guard') !!}
                                    {!! Form::select('guard', ['0'=>'All'] + $guards, request()->get('guard'), ['class'=>'form-control', 'style'=>'width:100%;']) !!}
                                </div>
                            </div>
                             
                            <div class="col-md-2">
                                <div class="form-group">
                                    {!! Form::label('path', 'Path') !!}
                                    {!! Form::select('path', ['0'=>'All'] + $paths, request()->get('path'), ['class'=>'form-control', 'style'=>'width:100%;']) !!}
                                </div>
                            </div>
                             
                            <div class="col-md-2">
                                <div class="form-group">
                                    {!! Form::label('protocol', 'Protocol') !!}
                                    {!! Form::select('protocol', ['0'=>'All'] + $protocols, request()->get('protocol'), ['class'=>'form-control', 'style'=>'width:100%;']) !!}
                                </div>
                            </div>
                             
                            
                            <div class="col-md-2">
                                <div class="form-group">
                                    {!! Form::label('method', 'Method') !!}
                                    {!! Form::select('method', ['0'=>'All'] + $methods, request()->get('method'), ['class'=>'form-control', 'style'=>'width:100%;']) !!}
                                </div>
                            </div>
                            
                            @if(Config::get('accesslog')['custom_authentication'])
                                <div class="col-md-2">
                                    <div class="form-group">
                                        {!! Form::label('custom_authentication', 'Custom Authentication') !!}
                                        {!! Form::select('custom_authentication', ['0'=>'All'] + $authentications, request()->get('custom_authentication'), ['class'=>'form-control', 'style'=>'width:100%;']) !!}
                                    </div>
                                </div>
                            @endif
                            
                            <div class="col-md-2">
                                <div class="form-group">
                                    {!! Form::label('ip', 'IP') !!}
                                    {!! Form::select('ip', ['0'=>'All'] + $ips, request()->get('ip'), ['class'=>'form-control', 'style'=>'width:100%;']) !!}
                                </div>
                            </div>
                            
                            <div class="col-md-2">
                                <div class="form-group">
                                    {!! Form::label('useragent', 'UserAgent') !!}
                                    {!! Form::select('useragent', ['0'=>'All'] + $useragents, request()->get('useragent'), ['class'=>'form-control', 'style'=>'width:100%;']) !!}
                                </div>
                            </div>
                            
                            <div class="col-md-2">
                                <div class="form-group">
                                    {!! Form::label('datefrom', 'Date (From)') !!}
                                    {!! Form::text('datefrom', null, ['class'=>'form-control', 'autocomplete'=>'off']) !!}
                                </div>
                            </div>
                            
                            <div class="col-md-2">
                                <div class="form-group">
                                    {!! Form::label('dateto', 'Date (To)') !!}
                                    {!! Form::text('dateto', null, ['class'=>'form-control', 'autocomplete'=>'off']) !!}
                                </div>
                            </div>
                            
                        </div>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>

                    {!! Form::close() !!}

                    <!-- /.box-header -->
                    <div class="box-body table-responsive ">
                        <table class="table table-bordered table-hover">
                            <tr>
                                <th class="" style="min-width:50px;">ID</th>
                                <th class="" style="min-width:150px;">User</th>
                                <th class="" style="min-width:50px;">Guard</th>
                                <th class="" style="min-width:50px;">Path</th>
                                <th class="" style="min-width:50px;">Protocol</th>
                                <th class="" style="min-width:50px;">Method</th>
                                @if(Config::get('accesslog')['custom_authentication'])
                                    <th class="" style="min-width:50px;">Custom Authentication</th>
                                @endif
                                <th class="" style="min-width:50px;">IP</th>
                                <th class="" style="min-width:50px;">UserAgent</th>
                                <th class="" style="min-width:50px;">Created At</th>
                            </tr>
                            
                            @foreach($accessLogs as $accessLog)
                            <tr>
                                <td>{{ $accessLog->id }}</td>
                                <td>
                                    {!! $accessLog->taggable_type ? $accessLog->taggable_type .'<br>'.$accessLog->taggable->name : '' !!}
                                </td>
                                
                                <td>{{ $accessLog->accessGuard->title }}</td>
                                <td title="{{ $accessLog->url }}">{{ $accessLog->path->title }}</td>
                                <td>{{ $accessLog->protocol->title }}</td>
                                <td>{{ $accessLog->method->title }}</td>
                                @if(Config::get('accesslog')['custom_authentication'])
                                    <td>
                                    @if($accessLog->authentication)
                                        {{ $accessLog->authentication->title }}
                                    @endif
                                    </td>
                                @endif
                                <td>{{ $accessLog->ip->title }}</td>
                                <td>{{ $accessLog->useragent->title }}</td>
                                
                                <td title="{{ $accessLog->created_at->format('Y-m-d H:i:s') }}">
                                    {{ $accessLog->created_at->diffForHumans() }}
                                    <br>
                                    {{ $accessLog->created_at->format('Y-m-d H:i:s') }}
                                </td>
                                
                            </tr>
                            @endforeach
                        </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <ul class="pagination pagination-sm no-margin pull-right">
                            Page {{ $accessLogs->currentPage() }}  , showing {{ $accessLogs->count() }} records out of {{ $accessLogs->total() }} total
                        </ul>
                    </div>

                    <div class="box-footer clearfix">
                        <ul class="pagination pagination-sm no-margin pull-right">
                            {{$accessLogs->appends(Request::all())->links()}}
                        </ul>
                    </div>

                </div>
                <!-- /.box -->

                <!-- /.box -->
            </div>
            <!-- /.col -->

            <!-- /.col -->
        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->
</div>

@endsection

@section('scripts')

<script>

    $(function () {
        
        $('#datefrom').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd'
        });
        
        $('#dateto').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd'
        });
        
        $("#guard").select2({
            placeholder: "Choos an option",
        });
        $("#path").select2({
            placeholder: "Choos an option",
        });
        $("#protocol").select2({
            placeholder: "Choos an option",
        });
        $("#method").select2({
            placeholder: "Choos an option",
        });
        $("#custom_authentication").select2({
            placeholder: "Choos an option",
        });
        $("#ip").select2({
            placeholder: "Choos an option",
        });
        $("#useragent").select2({
            placeholder: "Choos an option",
        });
        
        
        $(".ajax_data").select2({
            allowClear: true,
            placeholder: "All",
            minimumInputLength:2,
            ajax: {
                url: '{{ route('accesslog.access-logs-user-search') }}',
                data: function (params) {
                    // alert( $(this).attr("data-model") );
                    var query = {
                        search: params.term,
                        page: params.page || 1,
                        model: $(this).attr("data-model"),
                        "_token":"{{ csrf_token() }}"
                    }
                    // Query parameters will be ?search=[term]&page=[page]
                    return query;
                }
            }
        });

        
        
    });

</script>

@endsection