@props(['records'])
{{ $records->appends(['search' => request()->get('search')])->links('pagination::tailwind') }}