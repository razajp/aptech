<div>
    <label class="block text-gray-600 mb-2">{{ $label }}</label>
    <div class="flex gap-5">
        @foreach($options as $option)
            <label class="flex items-center">
                <input type="checkbox" class="mr-2" name="{{ $name }}[]" value="{{ $option }}"> {{ $option }}
            </label>
        @endforeach
    </div>
</div>