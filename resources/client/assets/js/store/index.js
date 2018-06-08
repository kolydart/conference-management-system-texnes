import Vue from 'vue'
import Vuex from 'vuex'
import Alert from './modules/alert'
import ChangePassword from './modules/change_password'
import Rules from './modules/rules'
import PapersIndex from './modules/Papers'
import PapersSingle from './modules/Papers/single'
import JudgementsIndex from './modules/Judgements'
import JudgementsSingle from './modules/Judgements/single'
import ArtsIndex from './modules/Arts'
import ArtsSingle from './modules/Arts/single'
import UsersIndex from './modules/Users'
import UsersSingle from './modules/Users/single'
import PermissionsIndex from './modules/Permissions'
import PermissionsSingle from './modules/Permissions/single'
import RolesIndex from './modules/Roles'
import RolesSingle from './modules/Roles/single'
import ContentCategoriesIndex from './modules/ContentCategories'
import ContentCategoriesSingle from './modules/ContentCategories/single'
import ContentTagsIndex from './modules/ContentTags'
import ContentTagsSingle from './modules/ContentTags/single'
import ContentPagesIndex from './modules/ContentPages'
import ContentPagesSingle from './modules/ContentPages/single'

Vue.use(Vuex)

const debug = process.env.NODE_ENV !== 'production'

export default new Vuex.Store({
    modules: {
        Alert,
        ChangePassword,
        Rules,
        PapersIndex,
        PapersSingle,
        JudgementsIndex,
        JudgementsSingle,
        ArtsIndex,
        ArtsSingle,
        UsersIndex,
        UsersSingle,
        PermissionsIndex,
        PermissionsSingle,
        RolesIndex,
        RolesSingle,
        ContentCategoriesIndex,
        ContentCategoriesSingle,
        ContentTagsIndex,
        ContentTagsSingle,
        ContentPagesIndex,
        ContentPagesSingle,
    },
    strict: debug,
})
