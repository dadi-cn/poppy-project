<?php namespace Poppy\Core\Rbac\Contracts;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use InvalidArgumentException;

/**
 * 用户约束
 */
interface RbacUserContract
{
    /**
     * Many-to-Many relations with Role.
     * @return BelongsToMany
     */
    public function roles();

    /**
     * Checks if the user has a role by its name.
     * @param string|array $name       role name or array of role names
     * @param bool         $requireAll all roles in the array are required
     * @return bool
     */
    public function hasRole($name, $requireAll = false);

    /**
     * Check if user has a permission by its name.
     * @param string|array $permission permission string or array of permissions
     * @param bool         $requireAll all permissions in the array are required
     * @return bool
     */
    public function capable($permission, $requireAll = false);

    /**
     * Checks role(s) and permission(s).
     * @param string|array $roles       Array of roles or comma separated string
     * @param string|array $permissions array of permissions or comma separated string
     * @param array        $options     validate_all (true|false) or return_type (boolean|array|both)
     * @return array|bool
     * @throws InvalidArgumentException
     */
    public function ability($roles, $permissions, $options = []);

    /**
     * Alias to eloquent many-to-many relation's attach() method.
     * @param mixed $role 角色
     */
    public function attachRole($role);

    /**
     * Alias to eloquent many-to-many relation's detach() method.
     * @param mixed $role 角色
     */
    public function detachRole($role);

    /**
     * Attach multiple roles to a user
     * @param array $roles 多个角色
     */
    public function attachRoles($roles);

    /**
     * Detach multiple roles from a user
     * @param array $roles 多个角色
     */
    public function detachRoles($roles);
}
