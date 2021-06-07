@extends('layouts.base', ['activePage' => 'News'])

@section('content-header')
<div>
    <h3>
        <span class="oi oi-share-boxed"></span>
        ニュース一覧 ( 全{{ $news->count() }}件 )
    </h3>
    <div class="text-right">
        <a href="{{ route('news.create') }}" class="btn btn-round btn-info" rel="tooltip">
            <span class="oi oi-plus"></span>
            新規作成
        </a>
    </div>
</div>
@endsection

@section('content')
<table class="table">
    <thead>
    <tr>
        <th class="text-center">#</th>
        <th>Title</th>
        <th>Content</th>
        <th>Status</th>
        <th class="text-right">Actions</th>
    </tr>
    </thead>
    @foreach($news as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->title }}</td>
            <td>{{ $item->content }}</td>
            <td>{{ \App\Models\News::getStatusText($item->status) }}</td>
            <td class="td-actions text-right">
                <a href="{{ route('news.edit', $item) }}" class="btn btn-success btn-round" rel="tooltip" data-placement="bottom" title="Edit">
                    <span class="oi oi-pencil"></span>
                </a>
                <a href="javascript:void(0)" data-url="{{ route('news.destroy', $item) }}"
                   class="btn btn-danger btn-round delete-form-btn" rel="tooltip"
                   data-label="{{ $item->title }}" title="Delete">
                    <span class="oi oi-x"></span>
                </a>
            </td>
        </tr>
    @endforeach
</table>
<div class="box-footer clearfix">
    {!! $news->render() !!}
</div>
<form action="#" id="form-delete" method="POST">
    <input type="hidden" name="_method" value="delete" />
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
</form>
@endsection

@push('js')
    <script>
        $(function(){
            $('.delete-form-btn').on('click', function() {
                let btn = $(this);
                if (confirm('「' + btn.data('label') + '」' + 'を削除してよろしいでしょうか？')) {
                    $('#form-delete').attr('action', btn.data('url'));
                    $('#form-delete').submit();
                }
            })
        });

    </script>
@endpush
