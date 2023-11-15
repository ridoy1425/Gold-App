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
    public function imageHandle($data, $attachment = null, $field)
    {
        if (!$attachment) return false;
        try {
            if ($data[$field] && Storage::disk('public')->exists($data[$field])) {
                Storage::disk('public')->delete($data[$field]);
            }

            $custom_path = $field . '/' . $data['id'];
            $avatarName = time() . '_' . $attachment->getClientOriginalName();
            $stored_path = $attachment->storeAs($custom_path, $avatarName, 'public');

            $field = $field;
            $data->update([$field => $stored_path]);
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
