@extends('site.layout')

@section('content')
    @foreach ($page->sections as $index => $section)
        @php(ob_start())
        @includeFirst(["site.themes.{$theme}.sections.{$section['type']}", "site.sections.{$section['type']}"], ['d' => $section['data'], 'sectionId' => $section['id'], 'index' => $index])
        {!! \App\Support\SiteImages::section((string) ob_get_clean(), $index) !!}
    @endforeach
@endsection
