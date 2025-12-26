<div x-data>
    <button type="button" class="relative" wire:click.prevent="$set('showingAsidePanel', true)">
        @if($notifications->count())
            <span
                class="animate-ping absolute top-1 right-0.5 block h-1 w-1 rounded-full ring-2 ring-red-400 bg-red-600"></span>
        @endif

        <x-icons.outline.bell class="w-5 h-5"/>
    </button>

    @teleport('body')
    <x-ui.aside-dialog wire:model.live="showingAsidePanel">
        <x-slot:title>
            @lang('crud.showing_latest', ['resource' => strtolower(trans_choice('app.notifications', 0))])
        </x-slot:title>

        <div class="flex flex-col gap-2">
            @forelse($notifications as $index => $notification)
                <a href="#"
                   role="button"
                   class="px-3 py-2 border-gray-200 dark:border-slate-700 border rounded-md grid gap-1 block"
                   wire:click.prevent="goToMessage('{{ $notification->id }}')">
                    <div class="flex items-center gap-4">
                        <div class="grow text-base font-semibold">
                            {{ $notification->type }}
                        </div>

                        @if($notification->data['urgent'] ?? false)
                            <x-ui.badge color="red">@lang('app.urgent')</x-ui.badge>
                        @endif

                        <time class="text-muted text-sm" datetime="{{ $notification->created_at }}">
                            {{ $notification->created_at->format('d/m/Y H:i') }}
                        </time>
                    </div>

                    <div>
                        {{ $notification->data['title'] }}
                    </div>
                </a>
            @empty
                <div class="px-4 py-2 italic text-muted text-center text-sm">
                    {{ __('No new notifications') }}
                </div>
            @endforelse
        </div>

        <x-slot:footer class="flex">
            <a class="btn btn-primary" href="{{ route('notifications.index') }}">
                <x-icons.outline.eye class="w-4 h-4 mr-1"/> @lang('app.view_all_notifications')
            </a>
        </x-slot:footer>
    </x-ui.aside-dialog>
    @endteleport
</div>
