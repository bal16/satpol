<?php

namespace App\Http\Controllers;

use App\Services\AttachmentService;
use Illuminate\Http\Request;

class AttachmentsController extends Controller
{
    public function __construct(private AttachmentService $attachments) {}

    public function __invoke(Request $request)
    {
        $request->validate(['attachment' => ['required', 'file']]);

        return response()->json([
            'attachment_url' => $this->attachments->store($request->file('attachment')),
        ]);
    }
}
