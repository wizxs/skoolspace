
                                <div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content animated bounceInRight">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                <i class="fa fa-laptop modal-icon"></i>
                                                <h4 class="modal-title">Upload New File</h4>
                                                <small class="font-bold">Only images and documents to be shared ( Maximum file size: 24mb ).</small>
                                            </div>
                                            <form action="{{ url('manager/upload') }}" method="POST" enctype="multipart/form-data">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <div class="modal-body">
                                                   <div class="row form-group"><label>Upload a file:</label> <input type="file" name="file" placeholder="Select a file to upload" class="form-control col-sm-12"></div>
                                                   <div class=" row form-group pull-right">
                                                   <label>Select a group</label>
                                                        <select name="group">
                                                            <option value="">--Choose a group--</option>
                                                            @foreach($groups as $group)
                                                                <option value="{{ $group->id }}">{{ $group->name }}</option>
                                                            @endforeach
                                                        </select>
                                                   </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>