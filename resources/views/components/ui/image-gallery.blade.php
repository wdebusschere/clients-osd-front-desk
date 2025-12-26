@props([
    'closeOnEsc' => true,
    'images' => [],
])
<div id="image-gallery-{{ md5(microtime()) }}"
     x-data="{
        open: false,
        startX: 0,
        isDragging: false,
        images: {{ json_encode($images) }},
        get loopedImages() {
            if(! this.images.length){
                return [];
            }else{
                return [this.images[this.images.length - 1], ...this.images, this.images[0]];
            }
        },
        get currentIndex() {
            if (this.current === -1) {
                return this.images.length;
            } else if (this.current === this.images.length) {
                return 1;
            }

            return this.current + 1;
        },
        current: 0,
        last: null,
        openGallery(currentImage = 0) {
            this.current = currentImage;

            this.open = true;

            this.$dispatch('image-gallery-opened');
        },
        closeGallery() {
            this.open = false;

            this.$dispatch('image-gallery-closed');
        },
        prev() {
            this.last = this.current;

            this.current--;
        },
        next() {
            this.last = this.current;

            this.current++;
        },
        goTo(val) {
            this.last = this.current;

            this.current = val;
        },
        transitionEnd() {
            if (this.current === -1) {
                this.goTo(this.images.length - 1);
            } else if (this.current === this.images.length) {
                this.goTo(0);
            }
        },
        startSwipe(event) {
            this.startX = event.touches[0].clientX;
        },
        endSwipe(event) {
            let xPosition = event.changedTouches[0].clientX;

            this.swipe(xPosition);
        },
        startMouseSwipe(event) {
            this.isDragging = true;

            this.startX = event.clientX;
        },
        endMouseSwipe(event) {
            if (!this.isDragging) {
                return;
            }

            this.isDragging = false;

            let xPosition = event.clientX;

            this.swipe(xPosition);
        },
        swipe(xPosition) {
            let direction = this.startX - xPosition;

            if (direction > 50) {
                this.next();
            } else if (direction < -50) {
                this.prev();
            }
        }
    }"
     x-init="() => {
        $watch('current', (val) => {
            if(val < -1) {
                goTo(images.length + val);
            }else if(val > images.length) {
                goTo(val - images.length);
            }
        });
    }"
     x-on:keyup.right.window="next()"
     x-on:keyup.left.window="prev()"
     @if($closeOnEsc)
         x-on:keydown.escape.window="closeGallery()"
     @endif
     class="relative">
    {{-- Open button --}}
    @if ($slot->isEmpty())
        <div class="inline-block">
            <button type="button" class="btn btn-primary btn-sm" x-on:click="openGallery()">
                <x-icons.outline.photo class="w-4 h-4"/>
            </button>
        </div>
    @else
        {{ $slot }}
    @endif
    {{-- Open button --}}

    {{-- Fullscreen Modal --}}
    @teleport('body')
    <div x-show="open"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-black bg-opacity-90 flex items-center justify-center z-50"
         x-cloak>
        {{-- Container --}}
        <div class="relative w-full h-full overflow-hidden flex items-center justify-center"
             x-on:touchstart.passive="startSwipe($event)"
             x-on:touchend.passive="endSwipe($event)"
             x-on:mousedown="startMouseSwipe($event)"
             x-on:mouseup="endMouseSwipe($event)">
            <div class="flex w-full h-full"
                 :style="`transform: translateX(${(current + 1) * -100}%)`"
                 :class="{ 'transition-transform duration-500 ease-in-out': !(last >= images.length || last < 0) }"
                 x-on:transitionend="transitionEnd()">
                {{-- Images --}}
                <template x-for="(image, index) in loopedImages" :key="index">
                    <div class="w-full h-full shrink-0 flex items-center justify-center">
                        <img :src="image.url" :alt="image.alt" draggable="false" class="max-w-full max-h-full"
                             :class="isDragging ? 'cursor-grabbing' : 'cursor-grab'">
                    </div>
                </template>
                {{-- Images --}}
            </div>

            {{-- Navigation Buttons --}}
            <button x-on:click="prev()"
                    class="absolute left-4 top-1/2 transform -translate-y-1/2 text-white text-3xl z-10">
                <x-icons.outline.chevron-left/>
            </button>

            <button x-on:click="next()"
                    class="absolute right-4 top-1/2 transform -translate-y-1/2 text-white text-3xl z-10">
                <x-icons.outline.chevron-right/>
            </button>
            {{-- Navigation Buttons --}}
        </div>
        {{-- Container --}}

        {{-- Toolbar --}}
        <div class="flex items-center justify-between absolute top-0 w-full px-4 py-3 bg-black bg-opacity-50 z-90">
            <div class="text-gray-300 text-sm font-bold">
                <span x-html="currentIndex"></span> / <span x-html="images.length"></span>
            </div>

            {{-- Close Button --}}
            <button x-on:click="closeGallery()" class="text-white text-3xl">
                <x-icons.outline.x-mark/>
            </button>
            {{-- Close Button --}}
        </div>
        {{-- Toolbar --}}
    </div>
    @endteleport
    {{-- Fullscreen Modal --}}
</div>
