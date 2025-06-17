<?php

namespace Usamamuneerchaudhary\Commentify\Traits;
use App\Models\UserProfile;

trait HasUserAvatar
{
    /**
     * @return string
     */
    public function avatar(): string
    {
        $profile = UserProfile::where('user_id', $this->id)->first();
        return $profile && $profile->avatar ? 'uploads/users/'.$this->id.'/'.$profile->avatar : 'uploads/users/default/_avatar.jpg';
    }
}
