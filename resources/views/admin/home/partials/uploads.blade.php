<br/>
<div class="row">
    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-12">
                        <div class="btn-toolbar">
                            @{{ uploads.length }} uploads

                            <div class="btn btn-danger btn-sm pull-right" data-toggle="modal" data-target="#upload-modal">
                                <i class="fa fa-plus"></i>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="panel-body scrollable">
                <div class="row">
                    <div class="col-md-12">
                        <div class="div">
                            <ul class="list-group">
                                <li v-for="upload in uploads" @click="busy ? false : __selectUpload(upload, true)" :class="'list-group-item cursor-pointer bg-info ' + (currentUpload && currentUpload.id == upload.id ? 'active' : '')">
                                    <div class="row">
                                        <div class="col-xs-8">
                                            <i class="fa fa-file"></i>

                                            @{{ upload.original_name }}
                                        </div>

                                        <div class="col-xs-4 text-right">
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <span v-if="currentUpload && currentUpload.id === upload.id && busy">
                                                        <i class="fa fa-cog fa-spin"></i>
                                                    </span>
                                                </div>

                                                <div class="col-xs-9 pull-right">
                                                    <button type="button" class="pull-right btn btn-sm btn-primary" tooltip="Copiar link"
                                                            v-clipboard:copy="upload.sharing_url"
                                                            v-clipboard:success="__clipboardCopySuccess"
                                                            v-clipboard:error="__clipboardCopyError"
                                                    >
                                                        <i class="fa fa-copy"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div v-if="currentUpload" class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-left">
                            <div class="row">
                                <div class="col-md-12">
                                    Preview
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel-body scrollable">
                <div class="row">
                    <div class="col-md-12">
                        <img style="width:100%" :src="currentUpload.url" alt="Girl in a jacket">
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="row">
    <!-- Modal -->
    <div class="modal fade" id="upload-modal" tabindex="-1" role="dialog">
        @include('admin.home.partials.upload-modal', ['mode' => 'create'])
    </div>
</div>

