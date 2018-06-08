import Vue from 'vue'
import VueRouter from 'vue-router'

import ChangePassword from '../components/ChangePassword.vue'
import PapersIndex from '../components/cruds/Papers/Index.vue'
import PapersCreate from '../components/cruds/Papers/Create.vue'
import PapersShow from '../components/cruds/Papers/Show.vue'
import PapersEdit from '../components/cruds/Papers/Edit.vue'
import ArtsIndex from '../components/cruds/Arts/Index.vue'
import ArtsCreate from '../components/cruds/Arts/Create.vue'
import ArtsShow from '../components/cruds/Arts/Show.vue'
import ArtsEdit from '../components/cruds/Arts/Edit.vue'
import JudgementsIndex from '../components/cruds/Judgements/Index.vue'
import JudgementsCreate from '../components/cruds/Judgements/Create.vue'
import JudgementsShow from '../components/cruds/Judgements/Show.vue'
import JudgementsEdit from '../components/cruds/Judgements/Edit.vue'
import UsersIndex from '../components/cruds/Users/Index.vue'
import UsersCreate from '../components/cruds/Users/Create.vue'
import UsersShow from '../components/cruds/Users/Show.vue'
import UsersEdit from '../components/cruds/Users/Edit.vue'
import PermissionsIndex from '../components/cruds/Permissions/Index.vue'
import PermissionsCreate from '../components/cruds/Permissions/Create.vue'
import PermissionsShow from '../components/cruds/Permissions/Show.vue'
import PermissionsEdit from '../components/cruds/Permissions/Edit.vue'
import RolesIndex from '../components/cruds/Roles/Index.vue'
import RolesCreate from '../components/cruds/Roles/Create.vue'
import RolesShow from '../components/cruds/Roles/Show.vue'
import RolesEdit from '../components/cruds/Roles/Edit.vue'

Vue.use(VueRouter)

const routes = [
    { path: '/change-password', component: ChangePassword, name: 'auth.change_password' },
    { path: '/papers', component: PapersIndex, name: 'papers.index' },
    { path: '/papers/create', component: PapersCreate, name: 'papers.create' },
    { path: '/papers/:id', component: PapersShow, name: 'papers.show' },
    { path: '/papers/:id/edit', component: PapersEdit, name: 'papers.edit' },
    { path: '/arts', component: ArtsIndex, name: 'arts.index' },
    { path: '/arts/create', component: ArtsCreate, name: 'arts.create' },
    { path: '/arts/:id', component: ArtsShow, name: 'arts.show' },
    { path: '/arts/:id/edit', component: ArtsEdit, name: 'arts.edit' },
    { path: '/judgements', component: JudgementsIndex, name: 'judgements.index' },
    { path: '/judgements/create', component: JudgementsCreate, name: 'judgements.create' },
    { path: '/judgements/:id', component: JudgementsShow, name: 'judgements.show' },
    { path: '/judgements/:id/edit', component: JudgementsEdit, name: 'judgements.edit' },
    { path: '/users', component: UsersIndex, name: 'users.index' },
    { path: '/users/create', component: UsersCreate, name: 'users.create' },
    { path: '/users/:id', component: UsersShow, name: 'users.show' },
    { path: '/users/:id/edit', component: UsersEdit, name: 'users.edit' },
    { path: '/permissions', component: PermissionsIndex, name: 'permissions.index' },
    { path: '/permissions/create', component: PermissionsCreate, name: 'permissions.create' },
    { path: '/permissions/:id', component: PermissionsShow, name: 'permissions.show' },
    { path: '/permissions/:id/edit', component: PermissionsEdit, name: 'permissions.edit' },
    { path: '/roles', component: RolesIndex, name: 'roles.index' },
    { path: '/roles/create', component: RolesCreate, name: 'roles.create' },
    { path: '/roles/:id', component: RolesShow, name: 'roles.show' },
    { path: '/roles/:id/edit', component: RolesEdit, name: 'roles.edit' },
]

export default new VueRouter({
    mode: 'history',
    base: '/admin',
    routes
})
