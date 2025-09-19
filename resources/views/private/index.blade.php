@extends('layouts.layout')
@section('content')
<div class="container pt-3 d-flex flex-column">

    <div class="bd-highlight mb-3">
        <button class="btn btn-primary p-2 border" onclick="window.location.href='{{route('group.view.create')}}'">Create new group</button>
        <!-- <button class="btn btn-primary p-2 border" onclick="window.location.href='{{route('item.view.create')}}'">Create new item</button> -->
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
                                <li><button onclick="window.location.href='{{route('item.view.create')}}'">create item</button></li>
                                <!-- <li><hr class="dropdown-divider"></li> -->
                            </ul>
                        </div>
                    </div>
                    <div class="scroll" data-bs-spy="scroll" data-bs-offset="0" class="scrollspy-example" tabindex="0">
                        @forelse($defgroup->items as $item)
                            <div class="item-copy">
                                <div class="item"
                                    data-bs-toggle="modal" data-bs-target="#itemModal{{$item->id}}">
                                    <span class="tag">
                                        @foreach($item->tags->take(1) as $tag)
                                            {{$tag->name}}
                                        @endforeach
                                    </span>
                                    <span class="me-3">{{$item->name}}</span>
                                    <span class="copy-link" data-link="{{$item->link}}" role="button">
                                        {{$item->link}}
                                    </span>
                                </div>
                                <button class="copy" data-link="{{$item->link}}" type="button"> copy </button>
                            </div>
                        @empty
                            <span>this group has not got items!</span>
                        @endforelse
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- simple groups -->
    <div class="groups">
        <div class="main-container mt-4">
            @foreach($groups as $group)
                <div class="card">
                    <div class="title-row">
                        <h5> {{ $group->name }} </h5>
                        <div class="dropdown">
                            <button type="button" class="btn" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-three-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><button onclick="window.location.href='{{route('group.view.edit', $group->id)}}'">edit group</button></li>
                                <li><button onclick="window.location.href='{{route('item.view.create')}}'">create item</button></li>
                                <li><hr class="dropdown-divider"></li>
                                <form action="{{ route('groups.destroy', $group->id) }}" method="post" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure?')">Delete Group</button>
                                </form>
                            </ul>
                        </div>
                    </div>
                    <div class="scroll" data-bs-spy="scroll" data-bs-offset="0" class="scrollspy-example" tabindex="0">
                        @forelse($group->items as $item)
                            <div class="item-copy">
                                <div class="item" data-bs-toggle="modal" data-bs-target="#itemModal{{$item->id}}">
                                    <span class="tag">
                                        @foreach($item->tags->take(1) as $tag)
                                            {{$tag->name}}
                                        @endforeach
                                    </span>
                                    <span>{{$item->name}}</span>
                                </div>
                                <button class="copy" data-link="{{$item->link}}" type="button"> copy </button>
                            </div>
                        @empty
                            <div>this group has not got items!</div>
                        @endforelse
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Модалки для item -->
    @foreach(array_merge($defgroups->all(), $groups->all()) as $group)
        @foreach($group->items as $item)
            <div class="modal fade" id="itemModal{{$item->id}}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-fullscreen">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{$item->name}}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" value="{{ $item->tags->pluck('name')->implode(', ') }}" readonly>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" value="{{ $item->link }}" readonly>
                            <button class="btn btn-outline-secondary" onclick="navigator.clipboard.writeText('{{ $item->link }}')">📋 Копіювати</button>
                        </div>
                        <div class="input-group mb-3">
                            <textarea class="form-control" rows="3" readonly>{{$item->description}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endforeach

</div>

@endsection