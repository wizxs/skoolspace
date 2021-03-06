@extends('school')

@section('css')
    <link href="http://localhost:8000/assets/plugins/boostrap-checkbox/css/bootstrap-checkbox.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="http://localhost:8000/assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" rel="stylesheet" type="text/css"/>
@stop

@section('sidebar')
    @include('partials.client.mail_nav')
@stop



@section('content')
        <div class="row">
            <div class="col-md-12">
                @include('partials.errors')
                <div class="row">
                    <div class="col-md-12">
                        <div class="grid simple" >
                            <div class="grid-body no-border" style="min-height: 850px;" >
                                <br>
                                <div class="row-fluid " >
                                    <h2>New Message </h2>
                                    <form method="post" action="{{ url('/'.$school->username.'/client/mail/send/'.$client->id) }}" >
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="row">

                                        <div class="form-group col-md-12">
                                            <label class="form-label">To:</label>
                                            <div class="controls">
                                               <select name="receiver_id">
                                                   <option>--   Choose Recipient   -- </option>
                                                   <option value="{{ $owner->id }}">Official Group Administrator</option>
                                                   @foreach($admins as $admin)
                                                       @if($admin->class == $client->class)
                                                        <option value="{{ $admin->user_id }}">{{ $admin->name .": ".$admin->role }}</option>
                                                       @elseif($admin->class == 0)
                                                           <option value="{{ $admin->user_id }}">{{ $admin->name .": ".$admin->role }}</option>
                                                       @endif
                                                   @endforeach
                                               </select>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label class="form-label">Subject</label>
                                            <span class="help">e.g. "Meeting Agenda"</span>
                                            <div class="controls">
                                                <input name="subject" type="text" class="form-control ">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <textarea name="message" id="text-editor" placeholder="Enter text ..." class="form-control" rows="25"></textarea>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@stop

@section('other')
    <div class="admin-bar" id="quick-access" style="">
        <div class="admin-bar-inner">
            <div class="form-horizontal">
            </div>
            <button class="btn btn-danger btn-cons btn-add" type="submit"><i class="icon-envelope"></i> Send</button>
            <button class="btn btn-white btn-cons btn-cancel" type="button">Save</button>
        </div>
    </div>
    </form>
    <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
@stop

@section('scripts')
    <script src="http://localhost:8000/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js" type="text/javascript"></script>
    <script src="http://localhost:8000/assets/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js" type="text/javascript"></script>
    <script src="http://localhost:8000/assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js" type="text/javascript"></script>
    <script src="http://localhost:8000/assets/js/demo.js" type="text/javascript"></script>

    <script>
        $(document).ready(function() {
            $('#text-editor').wysihtml5();
            $("#quick-access").css("bottom","0px");
        });
    </script>
@stop
