{{--<div>--}}
{{--    <!-- It is not the man who has too little, but the man who craves more, that is poor. - Seneca -->--}}
{{--</div>--}}

@if($category->id == $parentId)
    <option value="{{$category->id}}" selected>
        @for($i=0 ; $i < $category->level ; $i++)
            {{"-"}}
        @endfor
        &nbsp;&nbsp;&nbsp;&nbsp;{{$category->name}}</option>
@else
    <option value="{{$category->id}}" >
        @for($i=0 ; $i < $category->level ; $i++)
            {{"-"}}
        @endfor
        &nbsp;&nbsp;&nbsp;&nbsp;{{$category->name}}</option>
@endif

<x-categories-s-o :categories="$category->Children" :parentId="$parentId" />
