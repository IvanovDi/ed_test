<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function show()
    {
        return $this->getTree();
    }

    public function getTree($id=null)
    {
        $result = [];
        $Users = $this->getArray($id);
        foreach ($Users as $user) {
            $result[$user['id']]['name'] = $user['name'];
            foreach ($user['subordinate_groups'] as $subordinateGroup) {
                $subordinatesGroups = [];
                foreach ($subordinateGroup['users'] as $item) {
                    $subordinatesGroups[$item['id']]['name'] = $item['name'];
                    foreach ($item['subordinates'] as $subordinate) {

                        dd($this->getTree($subordinate['id']));
                        $subordinatesGroups[$item['id']]['subordinates'] = $this->getTree($subordinate['id']);
                    }
                }
                $result[$user['id']]['groups'][$subordinateGroup['id']] = [
                    'name' => $subordinateGroup['name'],
                    'users' => $subordinatesGroups
                ];
            }
            $result[$user['id']]['subordinates'] = $this->getTree($user['id']);
        }
        dd($result);
        return $result;
    }

    public function getArray($id)
    {
        static $result;
        if(!isset($result[$id])) {
            $result[$id] = User::where('head_user_id', $id)->with('subordinateGroups.users.subordinates')->get()->toArray();
        }
        return $result[$id];
    }
}
