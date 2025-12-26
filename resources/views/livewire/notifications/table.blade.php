<div>
    <div class="relative overflow-x-auto">
        <table class="table">
            <tbody>
                @foreach($notifications as $index => $notification)
                    <tr class="transition-colors {{ $notification->unread() ? 'bg-gray-50 dark:bg-slate-700' : '' }}"
                        wire:key="notification-row-{{ $index }}">
                        <td>
                            <button class="link font-semibold" wire:click="goToMessage('{{ $notification->id }}')">
                                {{ $notification->type }}
                            </button>

                            <div class="text-muted">
                                {{ $notification->data['title'] }}
                            </div>
                        </td>
                        <td>
                            {{ $notification->created_at->format('d/m/Y H:i') }}
                        </td>
                        <td class="text-right">
                            @if($notification->data['urgent'] ?? false)
                                <x-ui.badge color="red">@lang('app.urgent')</x-ui.badge>
                            @endif
                        </td>
                        <td class="whitespace-nowrap w-0">
                            <div class="flex items-center gap-2 justify-end">
                                <x-button type="button"
                                          class="btn-sm"
                                          wire:click="toggleRead('{{ $notification->id }}')">
                                    @if($notification->read())
                                        <x-icons.outline.envelope-open class="w-4 h-4"/>
                                    @else
                                        <x-icons.outline.envelope class="w-4 h-4"/>
                                    @endif
                                </x-button>

                                <x-button type="button" class="btn-sm"
                                          wire:click="delete('{{ $notification->id }}')"
                                          wire:confirm="{{ trans('crud.confirm_delete') }}"
                                          wire:loading.attr="disabled">
                                    <x-icons.outline.trash class="w-4 h-4"/>
                                </x-button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <x-ui.pagination-controls :collection="$notifications" class="mt-4"/>
</div>
