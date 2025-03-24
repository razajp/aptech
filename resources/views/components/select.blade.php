@props([
    'label' => '',          // Label text for the select
    'name' => '',           // Select name
    'options' => [],        // Options array (value => text)
    'value' => '',          // Default selected value
    'showDefault' => 'false',          // Default selected showDefault
    'class' => '',
    'withButton' => false,
    'btnId' => '', 
    'id' => '', 
    'btnText' => '+', 
])

@php
    $haveOptions = count($options) > 0;
@endphp

<div class="{{ $class }} form-group">
    @if($label)
        <label for="{{ $name }}" class="block font-medium text-[--secondary-text] mb-2">{{ $label }}</label>
    @endif

    <div class="relative flex gap-4">
        <select
            @if (!$haveOptions)
                disabled
            @endif

            id="{{ $id }}" 
            name="{{ $name }}"
            {{ $attributes->merge([
                'class' => 'w-full rounded-lg bg-[--h-bg-color] border-gray-400 text-[--text-color] px-3 py-2 border appearance-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all 0.3s ease-in-out'
            ]) }}
        >
            @if ($showDefault == "true" && $haveOptions)
                <option value="">
                    -- Select {{$label}} --
                </option>
            @endif

            @if ($haveOptions)
                @foreach($options as $optionValue => $optionText)
                    <option data-option='{{ $optionText['data_option'] ?? '' }}' value="{{ $optionValue }}" {{ old($name, $value) == $optionValue ? 'selected' : '' }}>
                        {{ $optionText['text'] }}
                    </option>
                @endforeach
            @else
                <option value="">
                    -- No options available --
                </option>
            @endif
        </select>

        <div class="absolute inset-y-0 right-2 flex items-center pointer-events-none">
            <svg class="w-5 h-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.06l3.72-3.83a.75.75 0 011.06-.02.75.75 0 01.02 1.06l-4.25 4.37a.75.75 0 01-1.08 0L5.21 8.27a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
            </svg>
        </div>

        @if ($withButton)
            <button id="{{$btnId}}" type="button" class="bg-[--primary-color] px-4 rounded-lg hover:bg-[--h-primary-color] transition-all 0.3s ease-in-out {{ $btnText === '+' ? 'text-lg font-bold' : 'text-nowrap' }} disabled:opacity-50 disabled:cursor-not-allowed">{{ $btnText }}</button>
        @endif
    </div>

    @error($name)
        <div class="text-[--border-error] text-xs mt-1 transition-all 0.3s ease-in-out">{{ $message }}</div>
    @enderror

    <div id="{{ $name }}-error" class="text-[--border-error] text-xs mt-1 hidden transition-all 0.3s ease-in-out"></div>
</div>