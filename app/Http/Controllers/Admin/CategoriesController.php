<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
    public function index()
    {
        $Category = Categorie::get();
        return view('dashboard.admin.categories.categories')->with('data', $Category);
    }

    public function add(Request $req)
    {
        $req->validate([
            'cat_name' => 'required|max:50'
        ]);

        $add = new Categorie;
        $add->cat_name = $req->cat_name;
        $add->save();

        if ($add) {
            $notificaton = [
                'message' => 'Category Added',
                'alert-type' => 'success'
            ];
            return redirect()->back()->with($notificaton);
        } else {
            $notificaton = [
                'message' => 'Somthing went wrong!',
                'alert-type' => 'error'
            ];
            return redirect()->back()->with($notificaton);
        }
    }

    public function update(Request $req)
    {
        $req->validate([
            'cat_name' => 'required|max:50'
        ]);

        // try {
        //     DB::table('categories')
        //         ->where('id', $req->cat_id)
        //         ->update(['cat_name' => $req->cat_name]);
        //     echo "Record updated successfully.<br/>";
        // } catch (\Exception $ex) {
        //     dd($ex);
        // }

        $update = DB::table('categories')
            ->where('id', '=', $req->cat_id)
            ->update(['cat_name' => $req->cat_name]);

        if ($update) {
            $notificaton = [
                'message' => 'Category Updated',
                'alert-type' => 'success'
            ];
            return redirect()->back()->with($notificaton);
        } else {
            $notificaton = [
                'message' => $update,
                'alert-type' => 'error'
            ];
            return redirect()->back()->with($notificaton);
        }
    }

    public function delete($id)
    {
        $delete = Categorie::find($id)->delete();
        if ($delete) {
            $notificaton = [
                'message' => 'Category Deleted',
                'alert-type' => 'success'
            ];
            return redirect()->back()->with($notificaton);
        }
    }
}
