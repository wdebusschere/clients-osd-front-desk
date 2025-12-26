<?php

namespace EXperience\HQAnnouncements\Http\View\Composers;

use App\Repositories\HQ\AnnouncementRepository;
use Illuminate\View\View;

class HQAnnouncementsComposer
{
    /**
     * Bind data to the view.
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function compose(View $view)
    {
        $announcementsRepo = new AnnouncementRepository();

        $params = [
            'oauth_client_id' => config('services.osd-hq.client_id'),
        ];

        $announcements =  $announcementsRepo->all($params);

        $view->with(compact('announcements'));
    }
}
