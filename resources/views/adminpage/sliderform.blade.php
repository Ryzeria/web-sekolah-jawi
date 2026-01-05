{{-- resources/views/adminpage/sliderform.blade.php --}}

<x-adminpage.mainlayout>
    <x-slot:title>
        {{-- Dynamic Title --}}
        {{ isset($slider) ? 'Edit Slider' : 'Tambah Slider Baru' }}
    </x-slot:title>

    {{-- <x-slot:header>
        <img src="https://dummyimage.com/1200x300/3498db/ffffff&text=Form+Manajemen+Slider" alt="Form Header">
    </x-slot:header> --}}

    <x-slot:content>
        <div class="bg-white p-8 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold mb-6">
                {{ isset($slider) ? 'Edit Slider' : 'Tambah Slider Baru' }}
            </h2>

            {{-- General Error Message Summary --}}
            @if ($errors->any())
                <div class="mb-4 rounded-md bg-red-50 p-4" role="alert">
                    <h3 class="text-sm font-medium text-red-800">⚠️ There were some problems with your input.</h3>
                    <div class="mt-2 text-sm text-red-700">
                        <ul class="list-inside list-disc pl-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            {{-- Dynamic Form Action --}}
            <form action="{{ isset($slider) ? route('sliders.update', $slider->id) : route('sliders.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                {{-- Add PUT method for editing --}}
                @if (isset($slider))
                    @method('PUT')
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">Judul</label>
                        <input type="text" name="title" id="title"
                            class="mt-1 block w-full rounded-md shadow-sm @error('title') border-red-500 @else border-gray-300 @enderror"
                            value="{{ old('title', $slider->title ?? '') }}">
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="urutan" class="block text-sm font-medium text-gray-700">Urutan (No.)</label>
                        <input type="number" name="urutan" id="urutan"
                            class="mt-1 block w-full rounded-md shadow-sm @error('urutan') border-red-500 @else border-gray-300 @enderror"
                            value="{{ old('urutan', $slider->urutan ?? '') }}">
                        @error('urutan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">File Gambar</label>
                        <div class="flex items-center justify-center w-full">
                            <label for="image_url" id="dropzone-label"
                                class="flex flex-col items-center justify-center w-full h-48 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 @error('image_url') border-red-500 @enderror">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6 text-center">
                                    <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                    </svg>
                                    <p id="dropzone-text" class="mb-2 text-sm text-gray-500 px-2"><span
                                            class="font-semibold">Click to upload</span> or drag and drop</p>
                                    <p class="text-xs text-gray-500">PNG, JPG, PDF (MAX. 2MB)</p>
                                </div>
                                {{-- IMPORTANT: The `name` is "image_url" for the controller, and `id` matches the label's `for` --}}
                                <input id="image_url" name="image_url" type="file" class="hidden" />
                            </label>
                        </div>
                        @error('image_url')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                        {{-- Show current image if it exists --}}
                        @if (isset($slider) && $slider->image_url)
                            <div class="mt-4">
                                <p class="text-sm font-medium text-gray-500">Gambar Saat Ini:</p>
                                @if (Str::endsWith($slider->image_url, '.pdf'))
                                    <a href="{{ asset('storage/' . $slider->image_url) }}" target="_blank"
                                        class="text-blue-600 hover:underline">Lihat PDF</a>
                                @else
                                    <img src="{{ asset('storage/' . $slider->image_url) }}" alt="Current Icon"
                                        class="h-16 w-auto rounded-md mt-2">
                                @endif
                            </div>
                        @endif
                    </div>
                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea name="description" id="description" rows="3"
                            class="mt-1 block w-full rounded-md shadow-sm @error('description') border-red-500 @else border-gray-300 @enderror">{{ old('description', $slider->description ?? '') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="is_active" class="flex items-center">
                            <input type="checkbox" name="is_active" id="is_active" value="1"
                                class="rounded border-gray-300 text-indigo-600 shadow-sm"
                                @if (old('is_active', $slider->is_active ?? true)) checked @endif>
                            <span class="ml-2 text-sm text-gray-600">Is Active?</span>
                        </label>
                    </div>
                </div>

                <div class="flex items-center justify-end mt-6 space-x-4">
                    <a href="{{ route('sliders.index') }}"
                        class="text-gray-600 hover:text-gray-900 px-4 py-2 rounded-md border border-gray-300">
                        Cancel
                    </a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        {{-- Dynamic Button Text --}}
                        {{ isset($slider) ? 'Update' : 'Insert' }}
                    </button>
                </div>
            </form>
        </div>
    </x-slot:content>
</x-adminpage.mainlayout>

{{-- Scripts --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.getElementById('image_url');
        const dropzoneLabel = document.getElementById('dropzone-label');
        const dropzoneText = document.getElementById('dropzone-text');
        const originalText = dropzoneText.innerHTML;

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        // Add highlight effect
        function highlight() {
            dropzoneLabel.classList.add('border-blue-500', 'bg-blue-100');
        }

        // Remove highlight effect
        function unhighlight() {
            dropzoneLabel.classList.remove('border-blue-500', 'bg-blue-100');
        }

        // Prevent browser from opening the file when dragged over
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropzoneLabel.addEventListener(eventName, preventDefaults, false);
        });

        // Add highlight effect when dragging over
        ['dragenter', 'dragover'].forEach(eventName => {
            dropzoneLabel.addEventListener(eventName, highlight, false);
        });

        // Remove highlight effect when leaving the dropzone
        ['dragleave', 'drop'].forEach(eventName => {
            dropzoneLabel.addEventListener(eventName, unhighlight, false);
        });

        // Handle the dropped file
        dropzoneLabel.addEventListener('drop', function(e) {
            // Get the dropped files from the event object
            const dt = e.dataTransfer;
            const files = dt.files;

            // Assign them to our hidden file input
            fileInput.files = files;

            // Manually trigger a 'change' event to update the UI
            const event = new Event('change', {
                'bubbles': true
            });
            fileInput.dispatchEvent(event);
        }, false);


        // Update UI text when a file is selected (either by click or drop)
        fileInput.addEventListener('change', function() {
            if (this.files && this.files.length > 0) {
                dropzoneText.textContent = `File selected: ${this.files[0].name}`;
            } else {
                dropzoneText.innerHTML = originalText;
            }
        });
    });
</script>
