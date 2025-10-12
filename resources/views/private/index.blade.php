@extends('layouts.layout')
@section('content')
<div class="container pt-3 d-flex flex-column">
    <div class="bd-highlight mb-3">
        <button class="btn btn-primary p-2 border create-group">Create group</button>
    </div>
    <!-- def groups -->
    <div class="default_group">
        <div class="main-container">
            @foreach($defgroups as $defgroup)
                <div class="card">

                    <div class="title-row">
                        <h5 class="mb-3">{{$defgroup->name}}</h5>
                        <div class="dropdown">
                            <button type="button" class="btn" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-three-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><button type="submit" class="def-create-item" data-defgroup-id="{{$defgroup->id}}" >create item</button></li>
                                <!-- <li><hr class="dropdown-divider"></li> -->
                            </ul>
                        </div>
                    </div>
                    <div class="scroll def-items-container" id="defgroup-{{ $defgroup->id }}" data-defgroup-id="{{ $defgroup->id }}">
                        <!-- Тут JS підвантажить елементи -->
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- simple groups -->
    <div class="groups">
        <div class="main-container mt-4">
        </div>
    </div>

    <!-- Модалки для item -->
    <div class="modal fade" id="itemModal" tabindex="-1">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="itemModalTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
                <div class="modal-body" id="itemModalBody">
                    Завантаження...
                </div>
            </div>
        </div>
    </div>
</div>

@endsection