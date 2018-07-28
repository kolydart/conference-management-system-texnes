@inject('request', 'Illuminate\Http\Request')
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">

            <li>
                <a href="{{ url('/') }}">
                    <i class="fa fa-wrench"></i>
                    <span class="title">@lang('quickadmin.qa_dashboard')</span>
                </a>
            </li>

            <li v-if="$can('paper_access')">
                <router-link :to="{ name: 'papers.index' }">
                    <i class="fa fa-newspaper-o"></i>
                    <span>@lang('quickadmin.papers.title')</span>
                </router-link>
            </li>
            <li v-if="$can('judgement_access')">
                <router-link :to="{ name: 'judgements.index' }">
                    <i class="fa fa-gavel"></i>
                    <span>@lang('quickadmin.judgements.title')</span>
                </router-link>
            </li>
            <li v-if="$can('art_access')">
                <router-link :to="{ name: 'arts.index' }">
                    <i class="fa fa-paint-brush"></i>
                    <span>@lang('quickadmin.arts.title')</span>
                </router-link>
            </li>
            <li v-if="$can('user_access')">
                <router-link :to="{ name: 'users.index' }">
                    <i class="fa fa-graduation-cap"></i>
                    <span>@lang('quickadmin.users.title')</span>
                </router-link>
            </li>
            <li class="treeview" v-if="$can('content_management_access')">
                <a href="#">
                    <i class="fa fa-book"></i>
                    <span>@lang('quickadmin.content-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li v-if="$can('content_page_access')">
                        <router-link :to="{ name: 'content_pages.index' }">
                            <i class="fa fa-file-o"></i>
                            <span>@lang('quickadmin.content-pages.title')</span>
                        </router-link>
                    </li>
                    <li v-if="$can('content_category_access')">
                        <router-link :to="{ name: 'content_categories.index' }">
                            <i class="fa fa-folder"></i>
                            <span>@lang('quickadmin.content-categories.title')</span>
                        </router-link>
                    </li>
                    <li v-if="$can('content_tag_access')">
                        <router-link :to="{ name: 'content_tags.index' }">
                            <i class="fa fa-tags"></i>
                            <span>@lang('quickadmin.content-tags.title')</span>
                        </router-link>
                    </li>
                </ul>
            </li>
            <li class="treeview" v-if="$can('user_management_access')">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>@lang('quickadmin.user-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li v-if="$can('permission_access')">
                        <router-link :to="{ name: 'permissions.index' }">
                            <i class="fa fa-briefcase"></i>
                            <span>@lang('quickadmin.permissions.title')</span>
                        </router-link>
                    </li>
                    <li v-if="$can('role_access')">
                        <router-link :to="{ name: 'roles.index' }">
                            <i class="fa fa-briefcase"></i>
                            <span>@lang('quickadmin.roles.title')</span>
                        </router-link>
                    </li>
                    <li v-if="$can('user_action_access')">
                        <router-link :to="{ name: 'user_actions.index' }">
                            <i class="fa fa-th-list"></i>
                            <span>@lang('quickadmin.user-actions.title')</span>
                        </router-link>
                    </li>
                </ul>
            </li>

            <li>
                <router-link :to="{ name: 'auth.change_password' }">
                    <i class="fa fa-key"></i>
                    <span class="title">@lang('quickadmin.qa_change_password')</span>
                </router-link>
            </li>

            <li>
                <a href="#logout" onclick="$('#logout').submit();">
                    <i class="fa fa-arrow-left"></i>
                    <span class="title">@lang('quickadmin.qa_logout')</span>
                </a>
            </li>
        </ul>
    </section>
</aside>
