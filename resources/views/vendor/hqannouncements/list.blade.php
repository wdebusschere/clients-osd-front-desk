@if(count($announcements))
    <x-ui.card>
        <x-slot:heading>
            @choice('hqannouncements::strings.announcements', 0)
        </x-slot:heading>

        @foreach($announcements as $announcement)
            <x-ui.alert :type="$announcement->label">
                <div class="space-y-2">
                    <div class="mb-4">
                        <h3 class="font-semibold">{{ $announcement->title }}</h3>

                        <div class="text-sm text-muted">
                            <time datetime="{{$announcement->starts_at}}">
                                {{ \Carbon\Carbon::parse($announcement->starts_at)->format('d/m/Y') }}
                            </time>
                            -
                            <time datetime="{{$announcement->expires_at}}">
                                {{ \Carbon\Carbon::parse($announcement->expires_at)->format('d/m/Y') }}
                            </time>
                        </div>
                    </div>

                    @if(!empty($announcement->description))
                        <div>
                            {{ $announcement->description }}
                        </div>
                    @endif

                    @if(!empty($announcement->link))
                        <div>
                            <a class="link" href="{{ $announcement->link }}"><i
                                    class="fas fa-external-link-alt"></i> {{ $announcement->link }}
                            </a>
                        </div>
                    @endif
                </div>
            </x-ui.alert>
        @endforeach
    </x-ui.card>
@endif
