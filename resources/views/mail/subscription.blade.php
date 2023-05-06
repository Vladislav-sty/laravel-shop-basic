Шановний клієнт, товар {{ $sku->product->name }} ({{ $sku->propertyOptions->map->name->implode(", ") }}) на який ви були підписані, зʼявився у наявності.
<a href="{{ route('sku', [$sku->product->code, $sku->id]) }}">Переглянути</a>
