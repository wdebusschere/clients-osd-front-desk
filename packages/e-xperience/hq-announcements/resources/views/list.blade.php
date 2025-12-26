@if(count($announcements))
    <div class="card">
        <div class="card-header">
            @choice('hqannouncements::strings.announcements', 0)
        </div>

        <div class="card-body">
            @foreach($announcements as $announcement)
                <div class="alert alert-{{ $announcement->label }}">
                    <p class="font-weight-bold mb-0">{{ $announcement->title }}</p>

                    <p class="font-xs mb-0">
                        <time datetime="{{$announcement->starts_at}}">
                            {{ \Carbon\Carbon::parse($announcement->starts_at)->format('d/m/Y') }}
                        </time>
                        -
                        <time datetime="{{$announcement->expires_at}}">
                            {{ \Carbon\Carbon::parse($announcement->expires_at)->format('d/m/Y') }}
                        </time>
                    </p>

                    @if(!empty($announcement->description))
                        <p class="mt-2 mb-0">
                            {{ $announcement->description }}
                        </p>
                    @endif


                    @if(!empty($announcement->link))
                        <hr>

                        <p class="my-0">
                            <a class="text-{{ $announcement->label }}" href="{{ $announcement->link }}"><i
                                    class="fas fa-external-link-alt"></i> {{ $announcement->link }}
                            </a>
                        </p>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endif
