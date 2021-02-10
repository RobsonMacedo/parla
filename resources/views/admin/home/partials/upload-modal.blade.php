<div class="modal-dialog" role="document">

    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Novo upload</h4>
        </div>
        <div class="modal-body">
            <app-dropzone
                    url="/api/uploaded-files"
            ></app-dropzone>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-success" data-dismiss="modal">Fechar</button>
        </div>
    </div>
</div>
