<section>
    <header>
        {{-- <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p> --}}
    </header>

    <form method="post" action="{{ route('guru.store') }}" class="mt-6 space-y-6">
        @csrf

        <div>
            <x-input-label for="subject_id" :value="__('Subject')" />
            <x-select-input id="subject_id" name="subject_id" class="mt-1 block w-full" {{-- }}:value="old('name', $user->name)" --}} required autofocus>
                <option value="" hidden selected>Pilih Subject</option>
                @foreach($subjects as $subject)
                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                @endforeach
            </x-select-input>
            <x-input-error class="mt-2" :messages="$errors->get('subject_id')" />
        </div>

        <div>
            <x-input-label for="class_id" :value="__('Class')" />
            <x-select-input id="class_id" name="class_id" class="mt-1 block w-full" {{-- }}:value="old('name', $user->name)" --}} required autofocus>
                <option value="" hidden selected>Pilih Class</option>
                @foreach($classes as $class)
                <option value="{{ $class->id }}">{{ $class->name }}</option>
                @endforeach
            </x-select-input>
            <x-input-error class="mt-2" :messages="$errors->get('class_id')" />
        </div>

        <div>
            <x-input-label for="topic" :value="__('Topic')" />
            <x-text-input id="topic" name="topic" type="text" class="mt-1 block w-full" {{--  }}:value="old('email', $user->email)" --}} required placeholder="Tuliskan Topic..." />
            <x-input-error class="mt-2" :messages="$errors->get('topic')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Submit') }}</x-primary-button>
        </div>
    </form>
</section>
