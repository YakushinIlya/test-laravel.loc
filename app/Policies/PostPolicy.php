<?php

namespace App\Policies;

use App\Models\Posts;
use App\Models\Roles;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return 1;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Posts $posts)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Posts $posts)
    {
        $role = $user->role[0]->id; //Получаем id роли
        if(Roles::allow((int)$role, 'update_post')) { //Проверяем есть ли общие права на редактирование
            if((int)$role==1) { //Если роль 1 (Менеджер) то редактируем любую запись
                return true;
            } elseif((int)$role==2 && $user->id==$posts['user_id']) { //Если роль 2 (сотрудник) и его запись то редактируем
                return true;
            }
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Posts $posts)
    {
        $role = $user->role[0]->id; //Получаем id роли
        if(Roles::allow((int)$role, 'delete_post')) { //Проверяем есть ли общие права на удаление
            if((int)$role==1) { //Если роль 1 (Менеджер) то удаляем любую запись
                return true;
            } elseif((int)$role==2 && $user->id==$posts['user_id']) { //Если роль 2 (сотрудник) и его запись то удаляем
                return true;
            }
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Posts $posts)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Posts $posts)
    {
        //
    }
}
