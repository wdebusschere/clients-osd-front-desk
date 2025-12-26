@props([
    'enterAction',
])

<label
    class="grid after:[grid-area:1/1/2/2] after:whitespace-pre-wrap after:invisible after:content-[attr(data-cloned-val)_'_']">
    <textarea {{ $attributes }}
              class="w-full p-0 bg-transparent border-0 appearance-none focus:ring-0 resize-none overflow-hidden [grid-area:1/1/2/2]"
              oninput="this.parentNode.dataset.clonedVal = this.value"
              @isset($enterAction)
                  x-on:keydown.enter.prevent="if(!$event.shiftKey) { {{ $enterAction }} } else { $event.target.value += '\n'; $el.parentNode.dataset.clonedVal = $el.value; }"
              @else
                  x-on:keydown.enter="if($event.shiftKey) { $event.preventDefault(); $event.target.value += '\n'; $el.parentNode.dataset.clonedVal = $el.value; }"
              @endisset
    ></textarea>
</label>
