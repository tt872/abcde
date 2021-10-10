<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Profile;
use Carbon\Carbon;
use App\Profile_histories;
class ProfileController extends Controller
{
    public function add()
    {
    return view('admin.profile.create');
    }
    public function create(Request $request)
    {
      $this->validate($request, Profile::$rules);
      $profile = new Profile;
      $form = $request->all();
      $profile->fill($form);
      $profile->save();
      return redirect('admin/profile/create');
    }
    public function edit(Request $request)
    {
      $profile = Profile::find($request->id);
      if (empty($profile)) {
        abort(404);    
      }
      return view('admin.profile.edit', ['profile_form' => $profile]);
      
      
    }
    
    
    public function update(Request $request)
    {
        $profile_history = new Profile_histories;
        $profile_history->news_id = $profile_history->id;
        $profile_history->edited_at = Carbon::now();
        $profile_history->save();
        
      return redirect('admin/profile/edit');
    }
  }

