<?php

namespace App\Http\Controllers;

use App\Models\PostAdmin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


use function Laravel\Prompts\alert;

class PostadminController extends Controller
{
    public function lihatpost() {
        $data = PostAdmin::with('user')->where('user_id', Auth::user()->id)->get();
        return view('admin.postingan', ['data' => $data]);
    }

    public function uploadpost()  {
        return view('admin.tambahp_admin');
    }

    public function tambahpost(Request $request) {

        $model  = new PostAdmin();
        $model->judul = $request->judul;
        $model->subjudul = $request->subjudul;
        $model->tanggal = $request->tanggal;
        $model->isi = $request->isi;
        $model->user_id = Auth::user()->id;

        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            @unlink(storage_path('app/public/admin_post/' . $model->cover));
            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/admin_post', $filename);
            $model->cover = $filename;
        }

        $model->save();

        return redirect()->route('admin.postingan')->with('success', 'Images uploaded successfully.');


    }

    public function tampilpost($id)
    {
        $data = PostAdmin::findorfail($id);
        return view('admin.tampil_post', compact('data'));
    }

    public function editpost(Request $request, $id)
    {
        $data = PostAdmin::findOrfail($id);
        $data->update([

            "judul" => $request->judul,
            "subjudul" => $request->subjudul,
            "tanggal" => $request->tanggal,
            "isi" => $request->isi,

        ]);

        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            @unlink(storage_path('app/public/admin_post/' . $data->cover));
            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/admin_post', $filename);
            $data->cover = $filename;
        }
        $data->update();

        return redirect('postingan')->with('success', 'Images Update Successfully');
    }

    public function deletepost($id)
    {
        $data = PostAdmin::findOrFail($id);
        Storage::delete('public/admin_post/' . $data->cover);
        $data->delete();

        return redirect()->route('admin.postingan')->with(['success' => 'Data Berhasil Dihapus!']);
    }



}

