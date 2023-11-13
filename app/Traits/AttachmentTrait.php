<?php

namespace App\Traits;

use Exception;
use Illuminate\Support\Facades\Storage;
use Webp;

use Intervention\Image\Facades\Image;
use App\Models\Attachment;
use App\Models\UserDetail;
use Illuminate\Support\Str;

trait AttachmentTrait
{
    public function imageHandle($data, $attachment = null)
    {
        if (!$attachment) return false;
        try {
            $userDetails = UserDetail::findOrFail($data['id']);

            if ($userDetails->$data['filed'] && Storage::disk('public')->exists($userDetails->$data['filed'])) {
                Storage::disk('public')->delete($userDetails->$data['filed']);
            }

            $custom_path = 'profile_image' . '/' . $data['id'];
            $avatarName = time() . '_' . $attachment->getClientOriginalName();
            $stored_path = $attachment->storeAs($custom_path, $avatarName, 'public');

            $userDetails->update([$data['filed'], $stored_path]);
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
