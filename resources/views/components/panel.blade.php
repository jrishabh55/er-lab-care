<div class="panel panel-{{ $class ?? 'primary' }}">
    <div class="panel-heading">
        <strong>{{ $title }}</strong>
    </div>
    <div class="panel-body">
        {{ $slot }}
    </div>
    @isset($footer)
        <div class="panel-footer">
            {{ $footer }}
        </div>
    @endisset
</div>