<div {{ $attributes->merge(['class' => 'flex flex-col h-20']) }}>
    <label for="{{ $name }}"
        class="font-['Catamaran Semi Bold'] uppercase tracking-widest text-lg">{{ $label }}</label>
    <div class="flex flex-1 relative">
        <input class="flex flex-1 border-b-[1px] border-black outline-none" type="{{ $type }}"
            name="{{ $name }}" id="{{ $name }}" placeholder="{{ $placeholder }}"
            value="{{ $value }}" title="{{ $title }}"
            maxlength="{{ $maxLength }}" inputmode="{{ $inputmode }}"
            {{ $attributes }}>
        @if ($type === 'password')
            <div class="absolute inset-y-0 right-0 flex items-center cursor-pointer">
                <span class="uppercase tracking-widest">voir</span>
            </div>
        @endif
    </div>
</div>
