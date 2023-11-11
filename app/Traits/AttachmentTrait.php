<?php

namespace App\Traits;

use Exception;
use Illuminate\Support\Facades\Storage;
use Webp;

use Intervention\Image\Facades\Image;
use App\Models\Attachment;

use Illuminate\Support\Str;

trait AttachmentTrait
{
    public function getAttachmentValidationRules($file_type = null)
    {
        if (!$file_type) return '';
        else if ($file_type == 'profile_image') {
            return 'required|file|mimes:jpg,jpeg,png,bmp,tiff,webp |max:104800';
        } else {
            return 'required|file|mimes:jpg,jpeg,png,bmp,tiff,webp,ppt,pptx,doc,docx,pdf,xls,xlsx|max:204800';
        }
    }

    public function createAttachment($data, $attachment = null)
    {
        if (!$attachment) return false;
        try {
            $file_type = Str::slug($data['file_type'], '_');
            $attachable_type = Str::slug($data['attachable_type'], '_');
            $custom_path = $file_type . '/' . $attachable_type . '/' . $data['attachable_id'];
            $avatarName = time() . '_' . $attachment->getClientOriginalName();
            $stored_path = $attachment->storeAs($custom_path, $avatarName, 'public');
            $data['file_path'] = $stored_path;
            return Attachment::create($data);
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
