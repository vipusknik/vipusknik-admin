<?php

namespace App\Traits\Institution;

use App\Models\Institution\SocialMedia;

trait HasSocialMedia
{
    /**
     * Get social media relations in nicely formatted way
     * @return object
     */
    public function socialMedia()
    {
        $socialMedia = [];

        foreach ($this->social_media as $item) {
            $socialMedia[$item->service] = [
                'url' => $item->url,
                'display_title' => $item->display_title,
            ];
        }

        return $socialMedia ?: [];
    }

    /**
     * Relation to social_media table
     * @return Collection
     */
    public function social_media()
    {
        return $this->hasMany(SocialMedia::class);
    }

    public function attachSocialMedia($socialMedia)
    {
        $socialMedia = array_filter((array) $socialMedia, function($site) {
            return ! empty($site['url']);
        });

        $attachableSocialMedia = [];

        foreach ($socialMedia as $service => $data) {
            $attachableSocialMedia[] = [
                'service' => $service,
                'url' => $data['url'],
                'display_title' => $data['display_title']
            ];
        }

        $this->social_media()->createMany($attachableSocialMedia);

        return $this;
    }

    public function updateSocialMedia($socialMedia)
    {
        $this->social_media()->delete();

        $this->attachSocialMedia($socialMedia);

        return $this;
    }

    public function getSocialMediaSitesAttribute()
    {
        return $this->socialMedia();
    }
}
