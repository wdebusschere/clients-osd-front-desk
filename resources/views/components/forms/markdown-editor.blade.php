@props([
    'id' => 'editor-'. str()->random(8),
    'height' => 400,
    'name' => null,
    'value' => null,
    'noMargin' => false
])

<div class="{{ $noMargin ? 'mb-0' : 'mb-5' }}">
    <div
        x-data="{
        height: '{{ $height }}px',
        tab: 'write',
        content: {{ collect($value) }},
        showConvertedMarkdown: false,
        convertedContent: '',
        convertedMarkdown() {
          this.showConvertedMarkdown = true;
          this.convertedContent = marked.parse(DOMPurify.sanitize(this.content));
        }
      }"
        class="relative"
        x-cloak
    >
        <div
            class="flex items-center bg-gray-100 dark:bg-gray-700 border border-b-0 border-gray-300 dark:border-slate-700 block rounded-t-lg pr-4">
            <div class="flex-1 py-2">
                <button type="button" class="btn"
                        :class="{ 'text-gray-900 dark:text-slate-100': tab === 'write' }"
                        x-on:click.prevent="tab = 'write'; showConvertedMarkdown = false">Write
                </button>
                <button type="button" class="btn"
                        :class="{ 'text-gray-900 dark:text-slate-100': tab === 'preview' && showConvertedMarkdown === true }"
                        x-on:click.prevent="tab = 'preview'; convertedMarkdown()">Preview
                </button>
            </div>
        </div>

        <x-forms.textarea name="{{ $name }}"
                          spellcheck="false"
                          x-show="! showConvertedMarkdown" id="{{ $id }}"
                          x-ref="input"
                          x-model="content"
                          class="rounded-t-none"
                          style="height: {{ $height }}px;"/>

        <div x-show="showConvertedMarkdown">
            <div x-html="convertedContent"
                 class="w-full prose max-w-none prose-indigo leading-6 rounded-b-md shadow-xs border border-gray-300 dark:border-slate-700 p-5 bg-white overflow-y-auto"
                 :style="`height: ${height}px; max-width: 100%`"></div>
        </div>
    </div>

    @error($name)
    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
    @enderror
</div>

@pushOnce('scripts')
    <script src="https://cdn.jsdelivr.net/npm/marked@4.0.12/marked.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/dompurify@2.3.6/dist/purify.min.js"></script>
@endpushOnce
