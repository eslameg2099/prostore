@can('viewAnyTrash', \App\Models\Delegate::class)
    <a href="{{ route('dashboard.delegates.trashed', request()->only('type')) }}" class="btn btn-outline-danger btn-sm">
        <i class="fas fa fa-fw fa-trash"></i>
        @lang('delegates.trashed')
    </a>
@endcan
