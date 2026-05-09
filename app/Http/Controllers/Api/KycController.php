<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KycSubmission;
use App\Models\KycDocument;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class KycController extends Controller
{
    public function submit(Request $request)
    {
        $request->validate([
            'documents' => 'required|array',
            'documents.*.type' => 'required|in:national_id_front,national_id_back,passport_photo,proof_of_address,selfie',
            'documents.*.file' => 'required|file|mimes:jpeg,png,jpg,pdf|max:5120',
        ]);

        $submission = KycSubmission::create([
            'user_id' => Auth::id(),
            'status' => 'submitted',
        ]);

        foreach ($request->file('documents') as $index => $doc) {
            $type = $request->documents[$index]['type'];
            $file = $doc['file'];
            $path = $file->store('kyc_documents/' . Auth::id(), 'private');

            KycDocument::create([
                'kyc_submission_id' => $submission->id,
                'user_id' => Auth::id(),
                'document_type' => $type,
                'file_name' => $file->getClientOriginalName(),
                'file_url' => $path,
                'file_size' => $file->getSize(),
                'mime_type' => $file->getMimeType(),
            ]);
        }

        return response()->json([
            'message' => 'KYC submitted successfully',
            'submission_id' => $submission->id,
            'status' => $submission->status
        ], 201);
    }

    public function status()
    {
        $submission = KycSubmission::where('user_id', Auth::id())
            ->latest()
            ->with('documents')
            ->first();

        if (!$submission) {
            return response()->json(['status' => 'not_submitted']);
        }

        return response()->json([
            'status' => $submission->status,
            'submission_date' => $submission->created_at,
            'rejection_reason' => $submission->rejection_reason,
            'documents' => $submission->documents->map(function ($doc) {
                return [
                    'type' => $doc->document_type,
                    'is_verified' => $doc->is_verified,
                ];
            })
        ]);
    }
}
