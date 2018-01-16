<?php

namespace App\Repositories;

use App\Member;
use App\Role;
use App\Grade;

/**
 * 用户仓库UserRepository
 *
 * @author raoyc<raoyc2009@gmail.com>
 */
class MemberRepository extends BaseRepository
{
    /**
     * The Role instance.
     *
     * @var App\Role
     */
    protected $role;

    /**
     * Create a new UserRepository instance.
     *
     * @param  App\Member $user
     * @param  App\Role $role
     * @return void
     */
    public function __construct(
        Member $user,
        Grade $role)
    {
        $this->model = $user;
        $this->role = $role;
    }

    /**
     * 存储管理员
     *
     * @param  App\Member $member
     * @param  array $inputs
     * @return App\User
     */
    private function saveMember($member, $inputs)
    {
        $member->username = $member->nickname = e($inputs['username']);
        $member->password = bcrypt(e($inputs['password']));
        $member->email = e($inputs['email']);
        $member->realname = e($inputs['realname']);
        $member->phone = e($inputs['phone']);
        $member->max_number = e($inputs['max_number']);

        if ($member->save()) {
            return $member;
            //$member->roles()->attach($inputs['role']);  //附加上用户组（角色）
        }

        return $member;
    }


    /**
     * 更新管理型用户
     *
     * @param  App\User $member
     * @param  array $inputs
     * @return void
     */
    private function updateMember($member, $inputs)
    {
        $member->nickname = e($inputs['nickname']);
        $member->realname = e($inputs['realname']);
        $member->phone = e($inputs['phone']);
        $member->is_locked = e($inputs['is_locked']);
        $member->max_number = e($inputs['max_number']);
        if ((!empty($inputs['password'])) && (!empty($inputs['password_confirmation']))) {
            $member->password = bcrypt(e($inputs['password']));
        }
        $member->role = e($inputs['role']);
        $member->start_date = e($inputs['start_date']) ? e($inputs['start_date']).' 00:00:00' : null;
        $member->end_date = e($inputs['end_date']) ? e($inputs['end_date']).' 23:59:59' : null;
        if ($member->save()) {

            //确保一个管理员只拥有一个角色
            /*$roles = $member->roles;
            if ($roles->isEmpty()) {  //判断角色结果集是否为空
                $member->roles()->attach($inputs['role']);  //空角色，则直接同步角色
            } else {
                if (is_array($roles)) {
                    //如果为对象数组，则表明该管理用户拥有多个角色
                    //则删除多个角色，再同步新的角色
                    $member->detachRoles($roles);
                    $member->roles()->attach($inputs['role']);  //同步角色
                } else {
                    if ($roles->first()->id !== $inputs['role']) {
                        $member->detachRole($roles->first());
                        $member->roles()->attach($inputs['role']);  //同步角色
                    }
                }
            }*/
            //上面这一大段代码就是保证一个管理员只拥有一个角色
        }
    }

    /**
     * 获取所有角色(用户组)
     *
     * @return Illuminate\Support\Collection
     */
    public function role()
    {
        return $roles = $this->role->all();
    }

    /**
     * 获取用户角色
     *
     * @param  App\User
     * @return Illuminate\Support\Collection
     */
    public function getRole($member)
    {
        return $member->grades->first();
    }

    /**
     * 伪造一个id为0的Role对象
     *
     * @return App\Role
     */
    public function fakeRole()
    {
        $role = new $this->role;
        $role->id = 0;  //id置为不存在的0
        return $role;
    }


    #********
    #* 资源 REST 相关的接口函数 START
    #********
    /**
     * 用户资源列表数据
     *
     * @param  array $data
     * @param  string $extra
     * @param  string $size 分页大小
     * @return Illuminate\Support\Collection
     */
    public function index($data = [], $extra = '', $size = null)
    {
        if (!ctype_digit($size)) {
            $size = cache('page_size', '10');
        }

        $s_phone = e($data['s_phone']);
        if (!empty($s_phone)) {
            $users = $this->model->where('phone', '=', $s_phone)
                                ->where(function ($query) use ($data) {
                                    $s_name = e($data['s_name']);
                                    if (!empty($s_name)) {
                                        $query->where('username', 'like', '%'.$s_name.'%')
                                              ->orWhere('nickname', 'like', '%'.$s_name.'%')
                                              ->orWhere('realname', 'like', '%'.$s_name.'%');
                                    }
                                })
                                ->paginate($size);
        } else {
            $users = $this->model->where(function ($query) use ($data) {
                                    $s_name = e($data['s_name']);
                                    if (!empty($s_name)) {
                                        $query->where('username', 'like', '%'.$s_name.'%')
                                              ->orWhere('nickname', 'like', '%'.$s_name.'%')
                                              ->orWhere('realname', 'like', '%'.$s_name.'%');
                                    }
                                })
                                ->paginate($size);
        }
        return $users;
    }

    /**
     * 存储用户
     *
     * @param array $inputs
     * @param  string $extra
     * @return App\User
     */
    public function store($inputs, $extra = '')
    {
        $user = new $this->model;

        $user = $this->saveMember($user, $inputs);

        return $user;
    }


    /**
     * 获取编辑的用户
     *
     * @param  int $id
     * @param  string $extra
     * @return App\User
     */
    public function edit($id, $extra = '')
    {
        $user = $this->model->findOrFail($id);
        return $user;
    }

    /**
     * 更新用户
     *
     * @param  int $id
     * @param  array $inputs
     * @param  string $extra
     * @return void
     */
    public function update($id, $inputs, $extra = '')
    {
        $user = $this->model->findOrFail($id);
        $user = $this->updatemember($user, $inputs);
    }
    #********
    #* 资源 REST 相关的接口函数 END
    #********

    /**
     * 更新当前用户资料
     * 
     * @param  App\User $me
     * @param  array $inputs
     * @return void
     */
    public function updateMe($me, $inputs)
    {
        $me->nickname = e($inputs['nickname']);
        $me->realname = e($inputs['realname']);
        if (!empty($inputs['phone'])) {
            $me->phone = e($inputs['phone']);
        }
        if ((!empty($inputs['password'])) && (!empty($inputs['password_confirmation']))) {
            $me->password = bcrypt(e($inputs['password']));
        }
        if ($me->save()) {
            //触发更新个人资料事件，这里将触发事件放置在仓库里可能有些不妥
            //event(new UserUpdate($me));
        }
    }

}
