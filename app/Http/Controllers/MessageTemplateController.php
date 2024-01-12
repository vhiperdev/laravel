<?php

namespace App\Http\Controllers;

use App\Models\MessageTag;
use App\Models\MessageTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MessageTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $message_tag = MessageTag::all();
        $message_templates = MessageTemplate::where('created_by', Auth::Id())->get();
        return view('messaging.message-template', compact('message_tag', 'message_templates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('store', MessageTemplate::class);

        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string', 'max:255'],
            'vcard_name' => ['nullable', 'string', 'max:255'],
            'vcard_number' => ['nullable', 'string', 'max:255'],
            'image_attachment_url' => ['nullable', 'max:2048', 'mimes:jpeg,jpg,png,gif'],
            'audio_attachment_url' => ['nullable', 'max:2048', 'mimes:mp3,wav'],
            'video_attachment_url' => ['nullable', 'max:2048', 'mimes:mp4,avi,wmv'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with(['error' => $validator->errors()->first()]);
        } else {
            try {

                $data = $request->all();

                if ($request->hasFile('image_attachment_url')) {
                    $imagePath = $request->file('image_attachment_url')->store('uploads/images', 'public');
                    $data['image_attachment_url'] = asset('storage/' . $imagePath);
                }

                // Handle audio file
                if ($request->hasFile('audio_attachment_url')) {
                    $audioPath = $request->file('audio_attachment_url')->store('uploads/audios', 'public');
                    $data['audio_attachment_url'] = asset('storage/' . $audioPath);
                }

                // Handle video file
                if ($request->hasFile('video_attachment_url')) {
                    $videoPath = $request->file('video_attachment_url')->store('uploads/videos', 'public');
                    $data['video_attachment_url'] = asset('storage/' . $videoPath);
                }

                $data['created_by'] = Auth::id();
                $data = array_merge($data, ['created_by' => Auth::Id()]);
                MessageTemplate::create($data);

                return redirect()->back()->with('message', 'Created successfully');
            } catch (\Exception $e) {
                return redirect()->back()->with(['error' => $e->getMessage()]);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

        $message = MessageTemplate::find($request->id);
        $this->authorize('update', $message);

        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string', 'max:255'],
            'vcard_name' => ['nullable', 'string', 'max:255'],
            'vcard_number' => ['nullable', 'string', 'max:255'],
            'image_attachment_url' => ['nullable', 'file', 'max:2048', 'mimes:jpeg,jpg,png,gif'],
            'audio_attachment_url' => ['nullable', 'file', 'max:2048', 'mimes:mp3,wav'],
            'video_attachment_url' => ['nullable', 'file', 'max:2048', 'mimes:mp4,avi,wmv'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with(['error' => $validator->errors()->first()]);
        } else {
            try {

                $data = $request->all();
                // Handle image file
                if ($request->hasFile('image_attachment_url')) {
                    $imagePath = $request->file('image_attachment_url')->store('uploads/images', 'public');
                    $data['image_attachment_url'] = asset('storage/' . $imagePath);
                }

                // Handle audio file
                if ($request->hasFile('audio_attachment_url')) {
                    $audioPath = $request->file('audio_attachment_url')->store('uploads/audios', 'public');
                    $data['audio_attachment_url'] = asset('storage/' . $audioPath);
                }

                // Handle video file
                if ($request->hasFile('video_attachment_url')) {
                    $videoPath = $request->file('video_attachment_url')->store('uploads/videos', 'public');
                    $data['video_attachment_url'] = asset('storage/' . $videoPath);
                }

                $message->update($data);

                return redirect()->back()->with('message', 'Updated successfully');
            } catch (\Exception $e) {
                return redirect()->back()->with(['error' => $e->getMessage()]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('destroy', new MessageTemplate());
        try {
            MessageTemplate::where('id', $id)->where('created_by', Auth::Id())->first()->delete();
            return redirect()->back()->with('message', 'Deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
}
