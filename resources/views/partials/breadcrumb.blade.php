<?php
$data = $breadcrumbs ?? [];
?>
<div class="col-lg-4">
    <div class="page-header-breadcrumb">
        <ul class="breadcrumb-title">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">
                    <i class="feather icon-home"></i>
                </a>
            </li>
            @foreach ($data as $key => $breadcrumb)
                @if(Route::has($key))
                    <li class="breadcrumb-item">
                        <a href="{{ route($key) }}">{{ $breadcrumb }}</a>
                    </li>
                @endif
            @endforeach
            <li class="breadcrumb-item">
                <a href="javascript:void(0);">{{ $title }}</a>
            </li>
        </ul>
    </div>
</div>

