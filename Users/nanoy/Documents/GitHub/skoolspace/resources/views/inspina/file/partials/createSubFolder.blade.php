
                                <div class="modal inmodal" id="subModal" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content animated bounceInRight">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                <i class="fa fa-laptop modal-icon"></i>
                                                <h4 class="modal-title">Create a Folder</h4>
                                                <small class="font-bold">Folders help in arranging and retrieving the files.</small>
                                            </div>
                                            <form action="{{ url('manager/'.$folder->id.'/sub/folder') }}" method="POST" id="createfolderform" enctype="multipart/form-data">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <div class="modal-body">
                                                   <div class=" form-group">
                                                   <label>Folder Name:</label>
                                                        <input class="form-control" id="name" name="name" type="text"/>
                                                   </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                                    <button type="button" id="createfolderbtn" class="btn btn-primary">Create Folder</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>