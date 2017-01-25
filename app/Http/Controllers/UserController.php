<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
class UserController extends Controller
{
    public function show()
    {
        $data = $this->getTree();
        return view('laravel_test.show', ['data' => $data]);
    }
    public function getTree($id=null)
    {
        $result = [];
        $users = $this->getArrayUsers($id);
        foreach ($users as $user) {
            $result[$user['id']]['name'] = $user['name'];
            foreach ($user['subordinate_groups'] as $subordinateGroup) {
                $subordinatesGroupUsers = [];
                foreach ($subordinateGroup['users'] as $item) {
                    $subordinatesGroupUsers[$item['id']]['name'] = $item['name'];
                    $subordinatesGroupUsers[$item['id']]['subordinates'] = $this->getTree($item['id']);
                }
                $result[$user['id']]['groups'][$subordinateGroup['id']] = [
                    'name' => $subordinateGroup['name'],
                    'users' => $subordinatesGroupUsers
                ];
            }
            $result[$user['id']]['subordinates'] = $this->getTree($user['id']);
        }
        return $result;
    }
    public function getArrayUsers($id)
    {
        if(!isset($result[$id])) {
            $result[$id] = User::where('head_user_id', $id)->with('subordinateGroups.users.subordinates')->get()->toArray();
        }
        return $result[$id];
    }
}