<div style="margin-top: 25px;">
    <div class="card">
        <div class="card-body scrollable">
            <textarea v-model="editorial" cols="30" rows="20" class="form-control"></textarea>

            <div @click="__saveEditorial()" :class="'pull-right btn btn-sm ' + (editorial == editorialCopy ? 'btn-primary' : 'btn-primary')" style="margin-top: 25px;">
                <span v-if="editorial == editorialCopy">
                    Gravado
                </span>

                <span v-else>
                    Gravar
                </span>
            </div>
        </div>
    </div>
</div>
