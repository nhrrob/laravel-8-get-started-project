@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Role') }}</div>

                <div class="card-body">

                    @if (session('message'))
                    <div class="alert alert-success" role="alert">
                        {{ session('message') }}
                    </div>
                    @endif

                    <form method="POST" action='{{ route("admin.roles.store") }}' enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <input class="form-control" type="text" name="name" placeholder="Name">
                            @error('name')
                            <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <!-- Permissions Start -->
                        <div class="pt-3"></div>
                        <p>Permissions</p>
                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="checkbox">

                                    <input id="checkPermissionAll" type="checkbox" value="1" />
                                    <label for="checkPermissionAll">
                                        All
                                    </label>
                                </div>
                                <hr />
                            </div>

                            @php $i = 1; @endphp
                            @foreach($permissionGroups as $group)
                            <div class="row mt-1 mb-1 ml-1">
                                <div class="col-md-3">
                                    <div class="checkbox">
                                        <input id="{{$i}}Management" type="checkbox" name="group[]" value="{{$group->group_name}}" onclick="checkPermissionByGroup('role-{{$i}}-management-checkbox', this)" />

                                        <label for="{{$i}}Management">{{$group->group_name}}</label>

                                    </div>
                                </div>

                                <div class="col-md-9 role-{{$i}}-management-checkbox">
                                    <!-- As laravel 8 uses an extra folder for model, so not using App\User:: to make this project useful for both larvel 7 and 8 version; using auth()->user()  -->
                                    @php
                                    $permissions = auth()->user()->getPermissionsByGroupName($group->group_name); 
                                    $j = 1;
                                    @endphp

                                    @foreach($permissions as $permission)
                                    <div class="checkbox">
                                        <input id="checkPermission{{$permission->id}}" type="checkbox" name="permissions[]" value="{{$permission->name}}" />

                                        <label for="checkPermission{{$permission->id}}">
                                            {{$permission->name}}
                                        </label>

                                    </div>
                                    @php $j++; @endphp
                                    @endforeach
                                </div>
                            </div>
                            @php $i++; @endphp
                            @endforeach
                        </div>
                        <!-- Permissions End -->

                        <div class="form-group">
                            <a class="btn btn-danger mr-1" href='{{ route("admin.roles.index") }}' type="submit">Cancel</a>
                            <button class="btn btn-success" type="submit">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@include('admin.role.partials.scripts')
@endpush 