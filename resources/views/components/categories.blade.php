{{--<div>--}}
{{--    <!-- It is not the man who has too little, but the man who craves more, that is poor. - Seneca -->--}}
{{--</div>--}}

@foreach($categories as $category)
    <x-category :category="$category" />
@endforeach
