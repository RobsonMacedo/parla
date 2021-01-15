<br/>


<app-data-table :data="uploads" :render="JSON.stringify(uploads.data)" :current="currentUpload"></app-data-table>


<div class="row">
    <!-- Modal -->
    <div class="modal fade" id="upload-modal" tabindex="-1" role="dialog">
        @include('admin.home.partials.upload-modal', ['mode' => 'create'])
    </div>
</div>

