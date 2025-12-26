<?php

namespace App\Livewire\Tables;

use App\Models\Activity;
use App\Traits\Livewire\TableFeatures;
use Livewire\Attributes\Url;
use Livewire\Component;

class ActivityLogs extends Component
{
    use TableFeatures;

    #[Url]
    public $userId = '';

    #[Url]
    public $startDate = '';

    #[Url]
    public $endDate = '';

    public $updatesModalVisible = false;
    public ?Activity $selectedActivityLog;

    public function mount()
    {
        $this->authorize('viewAny', Activity::class);

        $this->order['created_at'] = 'DESC';
    }

    public function updated()
    {
        $this->resetPage();
    }

    public function render()
    {
        $activityLogs = Activity::with([
            'causer:id,name,profile_photo_path',
            'subject:id',
        ]);

        if ($this->userId !== '') {
            $activityLogs->where('causer_id', $this->userId);
        }

        if ($this->startDate !== '') {
            $activityLogs->whereDate('created_at', '>=', $this->startDate);
        }

        if ($this->endDate !== '') {
            $activityLogs->whereDate('created_at', '<=', $this->endDate);
        }

        foreach ($this->order as $attribute => $direction) {
            $activityLogs->orderBy($attribute, $direction);
        }

        return view(
            'livewire.tables.activity-logs',
            [
                'activityLogs' => $activityLogs->paginate($this->perPage)
            ]
        );
    }

    public function openUpdatesModal(Activity $activity)
    {
        $this->selectedActivityLog = $activity;

        $this->updatesModalVisible = true;
    }
}
