<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AttachmentsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $request->validate(['attachment' => ['required', 'file']]);

        // Store the file on the 'public' disk in an 'attachments' directory
        $path = $request->file('attachment')->store('attachments', 'public');

        return response()->json([
            'attachment_url' => Storage::url($path),
        ]);
    }
}
