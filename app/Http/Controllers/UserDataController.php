<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ResponsController;
class UserDataController extends Controller
{


    public function index(Request $request)
    {

        $country = $request->input('country');
        $user_id = $request->input('user_id');
        $post_id = $request->input('post_id');
        $timefrom = $request->input('timefrom');
        $timeto = $request->input('timeto');

        $users = \App\Models\User::with('address')
        ->with('posts');

        if(!empty($country)){
        //    $users->where('address.country', $country);
        $users->whereHas('address', function ($query) use ($country) {
                $query->where('country', '=', $country);
            });
        }

        if(!empty($user_id)){
            $users->where('id', $user_id);
        }

        if(!empty($post_id)){
            $users->whereHas('posts', function ($query) use ($post_id) {
                $query->where('id', '=', $post_id);
            });
        }

      if(!empty($timefrom)){
            $users->whereHas('posts', function ($query) use ($timefrom) {
                $query->where('created_at', '>=', $timefrom);
            });
        }

        if(!empty($timeto)){
            $users->whereHas('posts', function ($query) use ($timeto) {
                $query->where('created_at', '<=', $timeto);
            });
        }

        $res = $users->get('*');



        // for($i=0;$i<count($res);$i++){

        //    $newArray[$i]['id'] = $res[$i]->id;
        //    $newArray[$i]['name'] = $res[$i]->name;
        //    $newArray[$i]['email'] = $res[$i]->email;
        //    $newArray[$i]['address'] = $res[$i]->address;
        //    $newArray[$i]['posts'] = $res[$i]->posts;

        // }

        if(($res->isEmpty())){
            return (new ResponsController)->ErrorResponse('No data found', 404);
        }else{
            return (new ResponsController)->SuccessResponse($res,
        'Data found', 200);

    }

       // return response()->json($users->get('*'));
    }




}
