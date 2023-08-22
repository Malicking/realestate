<nav class="sidebar">
    <div class="sidebar-header">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
            Malick<span>Roi</span>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>

    @php
        $user = Auth::user();
    @endphp

    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">TDB</span>
                </a>
            </li>


            @if ($user->can('type.menu') || $user->can('amenities.menu') || $user->can('property.menu') || $user->can('history.menu') || $user->can('message.menu') || $user->can('state.menu'))
                <li class="nav-item nav-category">Gestion des propriétés</li>

                @if ($user->can('type.all'))
                <li class="nav-item">
                    <a href="{{ route('type.all') }}" class="nav-link">
                        <i class="link-icon" data-feather="inbox"></i>
                        <span class="link-title">Types de propriétés</span>
                    </a>
                </li>                
                @endif
    
                @if ($user->can('amenities.all'))
                <li class="nav-item">
                    <a href="{{ route('amenities.all') }}" class="nav-link">
                        <i class="link-icon" data-feather="flag"></i>
                        <span class="link-title">Aménités</span>
                    </a>
                </li>
                @endif

                @if ($user->can('property.all'))
                <li class="nav-item">
                    <a href="{{ route('property.all') }}" class="nav-link">
                        <i class="link-icon" data-feather="layout"></i>
                        <span class="link-title">Propriétés</span>
                    </a>
                </li>                
                @endif
    
                @if ($user->can('history.menu'))
                <li class="nav-item">
                    <a href="{{ route('admin.package.history') }}" class="nav-link">
                        <i class="link-icon" data-feather="archive"></i>
                        <span class="link-title">Historique des forfaits</span>
                    </a>
                </li>                
                @endif

                @if ($user->can('message.menu'))
                <li class="nav-item">
                    <a href="{{ route('admin.property.message') }}" class="nav-link">
                        <i class="link-icon" data-feather="message-square"></i>
                        <span class="link-title">Messages</span>
                    </a>
                </li>                
                @endif
    
                @if ($user->can('state.all'))
                <li class="nav-item">
                    <a href="{{ route('state.all') }}" class="nav-link">
                        <i class="link-icon" data-feather="compass"></i>
                        <span class="link-title">Etats / régions</span>
                    </a>
                </li>                
                @endif
            @endif


            @if ($user->can('testimonial.menu'))                
                <li class="nav-item nav-category">Gestion des témoignages</li>

                @if ($user->can('testimonial.all'))
                <li class="nav-item">
                    <a href="{{ route('testimonial.all') }}" class="nav-link">
                        <i class="link-icon" data-feather="award"></i>
                        <span class="link-title">Témoignages</span>
                    </a>
                </li>                
                @endif
            @endif


            @if ($user->can('category.menu') || $user->can('post.menu') || $user->can('comment.menu'))                
                <li class="nav-item nav-category">Le Blog</li>

                @if ($user->can('blog.category.menu'))
                <li class="nav-item">
                    <a href="{{ route('blog.category.all') }}" class="nav-link">
                        <i class="link-icon" data-feather="grid"></i>
                        <span class="link-title">Catégories</span>
                    </a>
                </li>                
                @endif

                @if ($user->can('post.all'))
                <li class="nav-item">
                    <a href="{{ route('blog.post.all') }}" class="nav-link">
                        <i class="link-icon" data-feather="grid"></i>
                        <span class="link-title">Posts</span>
                    </a>
                </li>                
                @endif

                @if ($user->can('comment.menu'))
                <li class="nav-item">
                    <a href="{{ route('blog.post.comment') }}" class="nav-link">
                        <i class="link-icon" data-feather="grid"></i>
                        <span class="link-title">Commentaires</span>
                    </a>
                </li>                
                @endif
            @endif


            @if ($user->can('smtp.menu') || $user->can('site.menu'))
                <li class="nav-item nav-category">Paramètres</li>

                @if ($user->can('smtp.men'))
                <li class="nav-item">
                    <a href="{{ route('smtp.setting') }}" class="nav-link">
                        <i class="link-icon" data-feather="grid"></i>
                        <span class="link-title">SMTP</span>
                    </a>
                </li>                
                @endif

                @if ($user->can('site.menu'))
                <li class="nav-item">
                    <a href="{{ route('site.setting') }}" class="nav-link">
                        <i class="link-icon" data-feather="grid"></i>
                        <span class="link-title">Site</span>
                    </a>
                </li>                
                @endif                
            @endif


            @if ($user->can('agent.menu'))                    
                <li class="nav-item nav-category">Gestion des utilisateurs</li>

                @if ($user->can('agent.all'))
                <li class="nav-item">
                    <a href="{{ route('agent.all') }}" class="nav-link">
                        <i class="link-icon" data-feather="users"></i>
                        <span class="link-title">Les agents</span>
                    </a>
                </li>                
                @endif
            @endif


            @if ($user->can('role.menu'))
            <li class="nav-item nav-category">Rôles & Permissions</li>

            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#roleAndPerms" role="button" aria-expanded="false"
                    aria-controls="roleAndPerms">
                    <i class="link-icon" data-feather="anchor"></i>
                    <span class="link-title">Rôles & Permissions</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="roleAndPerms">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('permission.all') }}" class="nav-link">
                                Privilèges
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('roles.all') }}" class="nav-link">
                                Rôles
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('roles.permission.add') }}" class="nav-link">
                                Affectation de privilèges
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('roles.permission.all') }}" class="nav-link">
                                Privilèges par rôle
                            </a>
                        </li>

                    </ul>
                </div>
            </li>                
            @endif

            <li class="nav-item nav-category">Gestion des Admins</li>

            <li class="nav-item">
                <a href="{{ route('admin.all') }}" class="nav-link">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Les admins</span>
                </a>
            </li>

            <li class="nav-item nav-category">Docs</li>
            <li class="nav-item">
                <a href="https://www.nobleui.com/html/documentation/docs.html" target="_blank" class="nav-link">
                    <i class="link-icon" data-feather="hash"></i>
                    <span class="link-title">Documentation</span>
                </a>
            </li>
        </ul>
    </div>
</nav>

