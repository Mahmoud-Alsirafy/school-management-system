<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait UseZoom
{
    public function generateAccessToken()
    {
        return Http::withOptions(['verify' => false])
            ->timeout(480)->asForm()
            ->withBasicAuth(env('ZOOM_CLIENT_ID'), env('ZOOM_CLIENT_SECRET'))
            ->post('https://zoom.us/oauth/token', [
                'grant_type' => 'account_credentials',
                'account_id' => env('ZOOM_ACCOUNt_ID'),
            ])
            ->json('access_token');
    }

    public function zoomRequest()
    {
        $token = $this->generateAccessToken();
        return Http::withToken($token)->acceptJson();
    }

    public function createMeeting($request)
    {
        $response = $this->zoomRequest()->post(
            'https://api.zoom.us/v2/users/me/meetings',
            [
                'topic' => $request->topic,
                'type' => 2,
                'start_time' => $request->start_time,
                'duration' => $request->duration,
                'password' => $request->password,
                'timezone' => config('zoom.timezone'),
                'settings' => [
                    'join_before_host' => false,
                    'host_video' => false,
                    'participant_video' => false,
                    'mute_upon_entry' => true,
                    'waiting_room' => true,
                    'approval_type' => config('zoom.approval_type'),
                    'audio' => config('zoom.audio'),
                    'auto_recording' => config('zoom.auto_recording'),
                ]
            ]
        );


        return $response->json();
    }
    public function deleteMeeting($meetingId)
{
    try {
        $response = $this->zoomRequest()
            ->timeout(480)
            ->delete("https://api.zoom.us/v2/meetings/{$meetingId}");

        if ($response->status() === 204) {
            return true;
        }

        throw new \Exception($response->body());

    } catch (\Throwable $e) {
        throw new \Exception('Zoom delete error: ' . $e->getMessage());
    }
}
}
