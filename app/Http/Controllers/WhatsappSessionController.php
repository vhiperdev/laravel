<?php

namespace App\Http\Controllers;

use App\Models\WhatsappSession;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WhatsappSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::Id();

        $whatsapp_session = WhatsappSession::where('user_id', $userId)->where('scanned_status', 1)->get();

        $last_session = WhatsappSession::where('user_id', $userId)->where('scanned_status', 0)->first();

        return view('whatsapp.index', compact('whatsapp_session', 'last_session'));
    }

    public function saveSession(Request $request)
    {
        $whatsappSession = new WhatsappSession();
        $whatsappSession->user_id = $request->user_id;
        $whatsappSession->qr_code = $request->qr_code;
        $whatsappSession->save();
    }


    public function scannedStatus($id)
    {
        try {
            $whatsapp_session = WhatsappSession::findOrFail($id);
            $whatsapp_session->update(['scanned_status' => 1]);
            return redirect()->back()->with(['message' => 'Whatsapp session saved']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
