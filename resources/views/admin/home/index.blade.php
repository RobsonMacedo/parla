@extends('layouts.admin')

@section('content')
    <style>
        [v-cloak] {
            display: none;
        }
    </style>

    <div class="container-fluid" id="vue-admin" >

        <div v-cloak>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs mt-4" role="tablist">
                <li
                        role="presentation"
                        class="nav-item"
                        @click="__selectAdminPane()"
                >
                    <a class="active nav-link" href="#home" aria-controls="home" role="tab" data-toggle="tab">Admin</a>
                </li>
                <li
                        class="nav-item"
                        role="presentation"
                        @click="__selectPreviewPane()"
                >
                    <a class="nav-link"  href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Preview</a>
                </li>
                <li
                        class="nav-item"
                        role="presentation"
                        @click="__selectEditorialPane()"
                >
                    <a class="nav-link"  href="#editorial" aria-controls="profile" role="tab" data-toggle="tab">Expediente</a>
                </li>
                <li
                        class="nav-item"
                        role="presentation"
                        @click="__selectUploadsPane()"
                >
                    <a class="nav-link"  href="#uploads" aria-controls="profile" role="tab" data-toggle="tab">Uploads</a>
                </li>
            </ul>
            <!-- END Nav tabs -->



            <!-- OLD Nav tabs -->
{{--

            <ul class="nav nav-tabs" role="tablist">
                <li
                    role="presentation"
                    class="active"
                    @click="__selectAdminPane()"
                >
                    <a href="#home" aria-controls="home" role="tab" data-toggle="tab">Admin</a>
                </li>

                <li
                    role="presentation"
                    @click="__selectPreviewPane()"
                >
                    <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Preview</a>
                </li>

                <li
                        role="presentation"
                        @click="__selectEditorialPane()"
                >
                    <a href="#editorial" aria-controls="profile" role="tab" data-toggle="tab">Expediente</a>
                </li>

                <li
                        role="presentation"
                        @click="__selectUploadsPane()"
                >
                    <a href="#uploads" aria-controls="profile" role="tab" data-toggle="tab">Uploads</a>
                </li>
            </ul>
--}}

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="home">
                    <br>
                    @include('admin.home.partials.admin')
                </div>

                <div role="tabpanel" class="tab-pane" id="profile">
                    @include('admin.home.partials.preview')
                </div>

                <div role="tabpanel" class="tab-pane" id="editorial">
                    @include('admin.home.partials.editorial')
                </div>

                <div role="tabpanel" class="tab-pane" id="uploads">
                    @include('admin.home.partials.uploads')
                </div>
            </div>
        </div>
    </div>
@endsection
