@foreach($items as $item)
  <li@lm-attrs($item) @if($item->hasChildren())class ="dropdown"@endif @lm-endattrs>
    @if($item->link) <a@lm-attrs($item->link) @lm-endattrs href="{{ $item->url() }}">
      @if($item->hasChildren()) <b class="caret"></b> @endif
      {{ $item->title }}
    </a>
    @else
      {{$item->title}}
    @endif
    @if($item->hasChildren())
      <ul>
        @include('menu-items', 
          array('items' => $item->children()))
      </ul> 
    @endif
  </li>
  @if($item->divider)
  	<li{{\HTML::attributes($item->divider)}}></li>
  @endif
@endforeach
