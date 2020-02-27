@extends('layouts.backendlayout')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Access Log</h1>

    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box">

                    {{-- <div class="box-header with-border">
                        <h3 class="box-title">Access Log List</h3>
                    </div> --}}

                    {{-- @include('include.flashMessage') --}}

                    <!-- /.box-body -->
                                        
                    {!! Form::open(['method'=>'GET', 'action'=>['\AnnaNovas\AccessLog\Http\controllers\AccessLogController@index']]) !!}
                    <!-- /.box-header -->

                    <div class="box-body">
                        <div class="row">
                            
                            {{-- <div class="col-md-2">
                                <div class="form-group">
                                    {!! Form::label('user', 'User') !!}
                                    {!! Form::select('user', $users, request()->get('user'), ['class'=>'form-control', 'style'=>'width:100%;']) !!}
                                </div>
                            </div> --}}

                            {{-- <div class="col-md-2">
                                <div class="form-group">
                                    {!! Form::label('staff', 'Staff') !!}
                                    {!! Form::select('staff', $staffs, request()->get('staff'), ['class'=>'form-control', 'style'=>'width:100%;']) !!}
                                </div>
                            </div> --}}
                            
                             <div class="col-md-2">
                                <div class="form-group">
                                    {!! Form::label('guard', 'Guard') !!}
                                    {!! Form::select('guard', ['0'=>'All'] + $guards, request()->get('route'), ['class'=>'form-control', 'style'=>'width:100%;']) !!}
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
                            
                            
                            <div class="col-md-2">
                                <div class="form-group">
                                    {!! Form::label('authentication', 'Authentication') !!}
                                    {!! Form::select('authentication', ['0'=>'All'] + $authentications, request()->get('authentication'), ['class'=>'form-control', 'style'=>'width:100%;']) !!}
                                </div>
                            </div>
                            
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
                                <th class="" style="min-width:50px;">Route</th>
                                <th class="" style="min-width:50px;">Path</th>
                                <th class="" style="min-width:50px;">Protocol</th>
                                {{-- <th class="" style="min-width:50px;">Full URL</th> --}}
                                <th class="" style="min-width:50px;">Method</th>
                                <th class="" style="min-width:50px;">Authentication</th>
                                <th class="" style="min-width:50px;">IP</th>
                                <th class="" style="min-width:50px;">UserAgent</th>
                                {{-- <th class="" style="min-width:50px;">Requested At</th> --}}
                                {{-- <th class="" style="min-width:50px;">Created At</th> --}}
                                {{-- <th class="" style="min-width:50px;">Updated At</th> --}}
                            </tr>
                            
                            @foreach($accessLogs as $accessLog)
                            <tr>
                                <td>{{ $accessLog->id }}</td>
                                {{-- <td>{!! $accessLog->user ? $accessLog->user->name  : '' !!}</td> --}}
                                <td>
                                    {!! $accessLog->taggable_type ? $accessLog->taggable_type .'<br>'.$accessLog->taggable->id : '' !!}
                                </td>
                                {{-- <td>
                                    @if($accessLog->staff)
                                    Name: {!! $accessLog->staff->name !!} <br>
                                    LoginID: {!! $accessLog->staff->loginid !!} <br>
                                    Shop: {!! $accessLog->staff->shop->shop_name !!} <br>
                                    @endif
                                    <br>
                                </td> --}}

                                {{-- <td>
                                    @if($accessLog->customer)
                                        Name: {!! $accessLog->customer->name !!} <br>
                                        LoginID: {!! $accessLog->customer->clientid !!} <br>
                                        Shop: {!! $accessLog->customer->shop->shop_name !!} <br>
                                    @endif
                                    <br>
                                </td> --}}

                                {{-- <td>{!! $accessLog->admin ? $accessLog->admin->name : '' !!}</td> --}}
                                
                                {{-- <td>{{ $accessLog->route_title }}</td> --}}
                                <td title="{{ $accessLog->url }}">{{ $accessLog->path->title }}</td>
                                <td>{{ $accessLog->protocol->title }}</td>
                                {{-- <td>{{ $accessLog->fullUrl }}</td> --}}
                                <td>{{ $accessLog->method->title }}</td>
                                <td>{{ $accessLog->authentication->title }}</td>
                                <td>{{ $accessLog->ip->title }}</td>
                                <td>{{ $accessLog->useragent->title }}</td>
                                
                                <td title="{{ $accessLog->created_at->format('Y-m-d H:i:s') }}">
                                    {{ $accessLog->created_at->diffForHumans() }}
                                    <br>
                                    {{ $accessLog->created_at->format('Y-m-d H:i:s') }}
                                </td>
                                {{-- <td>
                                    {{ $accessLog->created_at->diffForHumans() }}
                                    <br>
                                    {{ $accessLog->created_at->format('Y-m-d H:i:s') }}
                                </td>
                                <td>
                                    {{ $accessLog->updated_at->diffForHumans() }}
                                    <br>
                                    {{ $accessLog->updated_at->format('Y-m-d H:i:s') }}
                                </td> --}}
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
        $("#authentication").select2({
            placeholder: "Choos an option",
        });
        $("#ip").select2({
            placeholder: "Choos an option",
        });
        $("#useragent").select2({
            placeholder: "Choos an option",
        });
        
        


        
        
    });

</script>

@endsection